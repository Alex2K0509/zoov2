<?php

namespace App\Http\Controllers\QR;

use App\Http\Controllers\Controller;
use App\Models\qrcode;
use App\Models\User;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as HHash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
class QrController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\QR  $model
     * @return \Illuminate\View\View
     */
    public function admin(User $model)
    {
        return view('qr.index');
    }

    protected function createQr(Request $request){
        $rules = [
            'nameQR' => ['required'],
            'imageQR' => ['mimes:jpeg,png,jpg,svg|max:2048|required'],
        ];
        $messages = [
            'nameQR.required' => 'El nombre del codigo es requerido.',
            'imageQR.required' => 'La imagen para el codigo es requerida.',
            'imageQR.max' => 'El archivo no debe ser superior a 2 megas',
            'imageQR.mimes' => 'El archivo debe contener alguno de los siguientes formatos: jpeg, png o jpg.',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return response()->json([
                'success' => false,
                'message' => $messages->first(),
            ]);
        }

        try {

            $file = $request->file('imageQR');
            $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $url = asset('images/' . $imageName);

            $qrName = Str::random(10);
            $qrimage= public_path('images/QR/'.$qrName);
            \QRCodes::url($url)->setSize(8)->setMargin(2)->setOutfile($qrimage)->png();
            $urlQR = asset('images/QR/' . $qrName);

            $data = $request->all();

            DB::beginTransaction();

            $QR = new Qrcode();
            $QR->setNombre($data['nameQR']);
            $QR->setImage($data['imageQR']);
            $QR->setQR($url);
            $QR->setImageQR($urlQR);
            $QR->save();
            DB::commit();
            return response()->json([
                "success"=>true,
                "message" => 'QR creado correctamente'
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }

    protected function tableQr(Request $request)
    {
        $user = Auth::user();
        $uid = $user->getId();

        $allQR = Qrcode::all();


        $hash = new Hashids('', 10);

        if ($request->ajax()) {
            return Datatables::of($allQR)
                ->addIndexColumn()
                ->addColumn('adminName', function ($data) {
                    $desc = $data->getNombre();
                    $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">' . $desc . '</div>';
                    return $btn;
                })
                ->addColumn('adminEmail', function ($data) {
                    $desc = $data->getQR();
                    $desc2 = $data->getNombre();
                    $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">' . '<img src="'.$desc.'" width="50" height="50" alt="' . $desc2 . '">' . '</div>';
                    return $btn;
                })
                ->addColumn('adminStatus', function ($data) {
                    $desc = $data->getImageQR();
                    $desc2 = $data->getNombre();
                    $btn = '<div data-toggle="tooltip" data-placement="left" title="' . $desc . '">' . '<img src="'.$desc.'" width="50" height="50" alt="' . $desc2 . '">' . '</div>';
                    return $btn;
                })
                ->addColumn('action', function ($data) {
                    $userID = $data->getId();
                    $desc = $data->getImageQR();
                    return '<div>
                            <button href="javascript:void(0)" onclick="deleteQR(\'' . $userID . '\')"
                            class="btn btn-outline-danger btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Eliminar QR">
                            <i class="fa fa-trash"></i>
                            </button>

                            <a href="' . $desc . '" download="'. $desc .'"
                            class="btn btn-outline-success btn-sm"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Descargar QR">
                            <i class="fa fa-download"></i>
                            </a>
                </div>';
                })
                ->rawColumns(['adminName', 'adminEmail', 'adminStatus', 'action'])
                ->make(true);
        }

    }


    protected function deleteQr(Request $request){
        $data = $request->all();
        $id = $data['code'];

        try {
            $user = Qrcode::where('qr_ID', '=', $id[0])->first();
            $user->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'QR eliminado correctamente.'
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Error, intentar más tarde.'
                ]
            );
        }
    }
}
