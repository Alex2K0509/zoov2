<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;

use App\Models\ANIMALES\ANIMales;
use App\Models\CATALOGOS\CATEventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class CatalogosController extends Controller
{
    /**
 * @version 1.0.0
 * @date 2021-03-10
 * @function Inserta un evento en la db y sube la imagen de este mismo a la nube.
 * @return mixed
 */
    protected function InserEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'descrip'=>'required',
            'dateini'=>'required',
            'datefin'=>'required',
            'timeini'=>'required',
            'timefin'=>'required',
            'eventeimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(",", $validator->messages()->all())
            ]);
        }

        $User = auth()->user();
        $file = $request->file('eventeimage');
        $Imagename  = Str::random(10).'.'.$file->getClientOriginalExtension();
        $filePath = 'images/' . $Imagename;

        $disk = \Storage::disk('gcs')->put($filePath, file_get_contents($file),'public');
        $gcs = \Storage::disk('gcs');
        $url = $gcs->url('images'. "/" .$Imagename);
        $data=$request->all();
        #dd("se subio",$url,$data);
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
                    'success' => true,
                    'message' => 'Error, intentar más tarde.'
                ]
            );
        }


        //dd("entra");
    }
    /**
     * @version 1.0.0
     * @date 2021-03-11
     * @function Inserta un tipo de animal.
     * @return mixed
     */

    protected function InsertAnimal(Request $request){
        $data=$request->all();
        #dd($data);
        $validator = Validator::make($request->all(), [
            'nameAni' => 'required',
            'especieAni'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(",", $validator->messages()->all())
            ]);
        }
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

        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Error, intentar más tarde.'
                ]
            );
        }

    }



}
