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
                            <button href="javascript:void(0)" onclick="deleteAnimals(\'' . $userID . '\')"
                            class="btn btn-outline-danger btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Eliminar administrador">
                            <i class="fa fa-trash"></i>
                            </button>
                <button href="javascript:void(0)" onclick="infoAnimals(\'' . $userID . '\')"
                            class="btn btn-outline-success btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Bloquear administrador">
                            <i class="far fa-edit"></i>
                            </button>
                <button href="javascript:void(0)" onclick="infoAnimals(\'' . $userID . '\')"
                            class="btn btn-outline-primary btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Enviar email para cambio de contraseña.">
                            <i class="fa fa-envelope"></i>
                            </button>
                </div>';
                })
                ->rawColumns(['adminName', 'adminEmail', 'adminStatus', 'action'])
                ->make(true);
        }

    }
}
