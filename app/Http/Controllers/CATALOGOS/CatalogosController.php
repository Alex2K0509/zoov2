<?php

namespace App\Http\Controllers\CATALOGOS;

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
        $rules = [
            'name' => ['required','min:1', 'max:80'],
            'descrip' => ['required','min:1', 'max:255'],
            'timeini' => ['required'],
            'timefin' => ['required'],
            'dateini' => ['required'],
            'datefin' => ['required']
        ];
        $messages = [
            'name.required' => 'El campo de nombre es requerido',
            'name.min' => 'El campo de nombre debe tener al menos un caracter.',
            'name.max' => 'El campo de nombre no debe exceder de los 80 caracteres.',
            'descrip.descrip' => 'El campo de la descripción es requerido.',
            'descrip.min' => 'El campo de la descripción debe tener al menos un caracter.',
            'descrip.max' => 'El campo de la descripción no debe exceder de los 255 caracteres.',
            'timeini.required' => 'La hora de inicio es requerida.',
            'timefin.required' => 'La hora de fin es requerida.',
            'dateini.required' => 'La fecha de inicio es requerida.',
            'datefin.required' => 'La fecha de fin es requerida.'
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

        if($request->file('eventeimage')){
            $rules2 = [
                'eventeimage' => ['mimes:jpeg,png,jpg,svg|max:2048'],
            ];
            $messages2 = [
                'eventeimage.max' => 'El archivo no debe ser superior a 2 megas'
            ];
            $validator2 = Validator::make($request->all(), $rules2, $messages2);
            if ($validator2->fails()) {
                $messagesF = $validator2->messages();
                return response()->json(
                    [
                        'success' => false,
                        'message' =>$messagesF->first(),
                    ]
                );
            }

            $file = $request->file('eventeimage');
            $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $imageName);
            $url = asset('images/' . $imageName);
        }else{
            $url = null;
        }



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
                    'message' => $exception->getMessage()
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
        $rules = [
            'nameAni' => ['required'],
            'especieAni' => ['required']
        ];
        $messages = [
            'nameAni.required' => 'El nombre del animal es requerido.',
            'especieAni.required' => 'La especie del animal es requerida.'
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

        $data = $request->all();
        try {


            DB::beginTransaction();

            $Animal = new ANIMales();
            $Animal->setNombre($data['nameAni']);
            $Animal->setEspecie($data['especieAni']);
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
