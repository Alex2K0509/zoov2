<?php

namespace App\Http\Controllers\WEBHOOK;

use App\Http\Controllers\Controller;
use App\Models\TOKENS\TOKen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Exception;
class NotiWebhookController extends Controller
{
    public function webHooks(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        #VALIDACIONES GLOBALES
        $validator = Validator::make($request->all(), [
            "object"=> 'required',
            "event"=> 'required',
        ]);
        if ($validator->fails()) {
            $errors =$validator->errors();
            $response = [
                "mensaje"          => "Los(a) variables/datos enviadas(o) por la plataforma no han sido encontrados/no son correctos",
                "error" => $errors
            ];
            return response()->json($response, 400);
        }
        try {
            if ($data['object'] == "event"){

                switch ($data['event']){
                    case 'token_insert':
                        $validatorInsert = Validator::make($request->all(), [
                            "object"=> 'required',
                            "event"=> 'required',
                            'token' => 'required',
                        ]);
                        if ($validatorInsert->fails()) {
                            $errors = $validatorInsert->errors();
                            $response = [
                                "mensaje" => "Los(a) variables/datos enviadas(o) por la plataforma no han sido encontrados/no son correctos",
                                "error" => $errors
                            ];
                            return response()->json($response, 400);
                        }
                        $insertToken = TOKen::InsertToken($data);
                        return $insertToken;
                        break;
                    default:
                        $response = [
                            "mensaje" => "Evento no valido",

                        ];
                        return response()->json($response, 400);
                        break;
                }


            }
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }


    }
}
