<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;

use App\Models\ANIMALES\ANIMales;
use App\Models\CATALOGOS\CATEventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CatalogosController extends Controller
{
    /**
     * @return mixed
     * @version 1.0.0
     * @date 2021-03-10
     * @function Inserta un evento en la db y sube la imagen de este mismo a la nube.
     */
    protected function InserEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'descrip' => 'required',
            'dateini' => 'required',
            'datefin' => 'required',
            'timeini' => 'required',
            'timefin' => 'required',
            //'eventeimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(",", $validator->messages()->all())
            ]);
        }

        $User = auth()->user();
        $file = $request->file('eventeimage');
        $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $imageName);
        $url = asset('images/' . $imageName);


        $data = $request->all();

        try {
            DB::beginTransaction();


            $Eventos = new CATEventos();
            $Eventos->setEveNombre($data['name']);
            $Eventos->setEveDescripcion($data['descrip']);
            $Eventos->setEveHorarioIni($data['timeini']);
            $Eventos->setEveHorarioFin($data['timefin']);
            $Eventos->setEveFechaIni($data['dateini']);
            $Eventos->setEveFechaFin($data['datefin']);
            $Eventos->setEveImage($url);
            $Eventos->save();
            DB::commit();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Evento creado exitosamente.'
                ]
            );
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error, intentar más tarde.'
                ]
            );
        }


        //dd("entra");
    }

    /**
     * @return mixed
     * @version 1.0.0
     * @date 2021-03-11
     * @function Inserta un tipo de animal.
     */

    protected function InsertAnimal(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'nameAni' => 'required',
            'especieAni' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(",", $validator->messages()->all())
            ]);
        }
        try {
            DB::beginTransaction();
            $file = $request->file('imageAni');
            $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $url = asset('images/' . $imageName);


            $Animal = new ANIMales();
            $Animal->setNombre($data['nameAni']);
            $Animal->setEspecie($data['especieAni']);
            $Animal->setImage($url);
            $Animal->save();
            DB::commit();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Animal almacenado exitosamente.'
                ]
            );

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error, intentar más tarde.'
                ]
            );
        }

    }


}
