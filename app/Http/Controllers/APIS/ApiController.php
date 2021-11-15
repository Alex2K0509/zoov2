<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;

use App\Models\ANIMALES\ANIMales;
use App\Models\CATALOGOS\CATEventos;
use App\Models\PUBLICACIONES\PUBlicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ApiController extends Controller
{
    /**
 * @version 1.0.0
 * @date 2021-03-10
 * @type api
 * @function returnamos todos los eventos creados
 * @return mixed
 */
protected function getEventos(){
    try {
        $Eventos = CATEventos::all();
        if(count($Eventos) <=0){
            $response = [
                "mensaje" => "no existen eventos",
            ];
            return response()->json($response, 200);
        }
        $response = [
            "mensaje" => "succes",
            "eventos" => $Eventos
        ];
        return response()->json($response, 200);
    }catch (\Exception $exception){
        #dd($response);
        $response = [
            "mensaje" => "error",
            "eventos" => $exception->getMessage()
        ];
        return response()->json($response, 400);
    }
}
    /**
     * @version 1.0.0
     * @date 2021-03-10
     * @type api
     * @function retornamos toda la información de los animales creados
     * @return mixed
     */
protected function getAnimales(){
    try {
        $AnimaleInfo = ANIMales::all();
        $response = [
            "mensaje" => "succes",
            "animales" => $AnimaleInfo
        ];
        return response()->json($response, 200);
    }catch (\Exception $exception){
        #dd($response);
        $response = [
            "mensaje" => "error",
            "error" => $exception->getMessage()
        ];
        return response()->json($response, 400);
    }

}
    /**
     * @version 1.0.0
     * @date 2021-03-10
     * @type api
     * @function retornamos toda la información de las publicaciones creadqs
     * @return mixed
     */

protected function getPublicaciones(Request $request){
    try {
        $data = $request->all();
        #dd($data);
        $take    = isset($data['limit'])? !is_null($data['limit'])? $data['limit'] : 100 : 100;
        $month=$data['month'];
        $year=$data['year'];
        $params= [
            "take"    => $take,
            "month"=>$month,
            "year"=>$year,
        ];
$publicacionesAll = PUBlicaciones::getPosts($data['id'],$params)->get();

        if (count($publicacionesAll)) {
            $response = [
                "mensaje" => "success",
                "publicaciones" => $publicacionesAll
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                "mensaje" => "error",
                "publicaciones" => "No se encontraron publicaciones con los parametros solicitados"
            ];
            return response()->json($response, 404);
        }
    }catch (\Exception $exception){
       # dd($exception);
        $response = [
            "mensaje" => "error",
            "error" => $exception->getMessage()
        ];
        return response()->json($response, 400);
    }
}

}
