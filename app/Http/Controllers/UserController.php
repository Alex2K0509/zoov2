<?php

namespace App\Http\Controllers;

use App\Models\ANIMALES\ANIMales;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Hash as HHash;
use DataTables;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }
    public function admin(User $model)
    {
        return view('users.admin');
    }

    protected function createAdmin(Request $request){
        $data = $request->all();
        $emailExist = User::where('email',$data['emailAdmin'])->first();
        if(!is_null($emailExist)){
            return response()->json([
                "success"=>false,
                "message" => 'Ya existe una cuenta con este email.'
            ]);
        }
        DB::beginTransaction();
        try {

            $usuario = new User();
            $usuario->setName($data['nameAdmin'].''.$data['apepatAdmin'].''.$data['apematAdmin']);
            $usuario->setEmail($data['emailAdmin']);
            $usuario->password = HHash::make($data['paswordAdmin']);
            $usuario->setType(1);
            $usuario->setStatusNum(1);
            $usuario->save();
            DB::commit();
            return response()->json([
                "success"=>true,
                "message" => 'Administrador creado correctamente'
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }

    protected function tableAdmin(Request $request)
    {
        $user = Auth::user();
        $uid = $user->getId();
        $allAdmins = User::where('type',1)
            ->where('id','!=',$uid)
            ->get();

        $hash = new Hashids('', 10);

        if ($request->ajax()) {
            return Datatables::of($allAdmins)
                ->addIndexColumn()
                ->addColumn('adminName', function ($data) {
                    $desc = $data->getName();
                    $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">' . $desc . '</div>';
                    return $btn;
                })
                ->addColumn('adminEmail', function ($data) {
                    $desc = $data->getEmail();
                    $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">' . $desc . '</div>';
                    return $btn;
                })
                ->addColumn('adminStatus', function ($data) {
                    $desc = $data->getStatus();
                    $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">' . $desc . '</div>';
                    return $btn;
                })
                ->addColumn('action', function ($data) use ($hash) {
                    $userID = $hash->encode($data->getId());
                    return '<div>
                            <button href="javascript:void(0)" onclick="deleteAdmin(\'' . $userID . '\')"
                            class="btn btn-outline-danger btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Eliminar administrador">
                            <i class="fa fa-trash"></i>
                            </button>
                <button href="javascript:void(0)" onclick="infoAdmin(\'' . $userID . '\')"
                            class="btn btn-outline-success btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Editar adminitrador">
                            <i class="far fa-edit"></i>
                            </button>
                </div>';
                })
                ->rawColumns(['adminName', 'adminEmail', 'adminStatus', 'action'])
                ->make(true);
        }

    }

    protected function  infoAdmin(Request $request){
        $data = $request->all();
        try {
            $hash = new Hashids('', 10);
            $id = $hash->decode($data['code']);
            $InfoUser = User::find($id[0]);
            return response()->json([
                "nameAdmin" => $InfoUser->getName(),
                "emailAdmin" => $InfoUser->getEmail(),
                "status" => $InfoUser->getStatus(),
            ]);
        }catch (\Exception $exception){
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }
    protected function  editAdmin(Request $request){
        $rules = [
            'nameAdmin-Editar' => ['min:1', 'max:70', 'regex:/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/'],
            'emailAdmin-Editar' => ['min:1', 'max:70', 'regex:/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/'],

        ];
        $messages = [
            'nameAdmin-Editar.min' => 'El campo de nombre debe tener al menos un caracter.',
            'nameAdmin-Editar.max' => 'El campo de nombre no debe exceder de los 70 caracteres.',
            'nameAdmin-Editar.regex' => 'El campo de nombre no cumple con el formato permitido.',
            'emailAdmin-Editar.min' => 'El campo de email debe tener al menos un caracter.',
            'emailAdmin-Editar.max' => 'El campo de email no debe exceder de los 70 caracteres.',
            'emailAdmin-Editar.regex' => 'El campo de email no cumple con el formato permitido.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            
            return response()->json(
                [
                    'success' => false,
                    'message' =>$messages->first(),
                ]
            );
        }

        try {
            $data = $request->all();

            $hash = new Hashids('', 10);
            $idUsuario = $hash->decode($data['id']);
            $UpdateA = User::where('id', $idUsuario)->first();
            $UpdateA->setName($data['nameAdmin-Editar']);
            $UpdateA->setEmail($data['emailAdmin-Editar']);
            $UpdateA->setStatusNum($data['status-edit']);
            $UpdateA->save();

            return response()->json([
                'success' => true,
                'message' => "Se ha actualizado correctamente."
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
