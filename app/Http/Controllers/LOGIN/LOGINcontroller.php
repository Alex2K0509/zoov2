<?php

namespace App\Http\Controllers\LOGIN;
#models
use App\Models\User;
#libraries
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
class LOGINcontroller extends Controller
{
    public function loginAPI(Request $request)
    {

        $rules = [
            'email' => ['required', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'El campo de email no puede estar vacío.',
            'email.regex' => 'El valor del campo email no es un tipo de correo electronico valido.',
            'password.required' => 'El campo de contraseña no puede estar vacío.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = [
                "errors" => [
                    "code" => "403",
                    "message" => $messages->first(),
                    "message_large" => "No se pudo crear la cuenta de usuario.",
                    "action" => "Favor de validar que los campos requeridos tengan contenido"
                ],
            ];
            $this->MResponse->fail($error, 403);
            return $this->MResponse->built()->json();
        }
        $remember = ($request->has('rememberme')) ? true : false;
        $data = $request->all();

        #las credenciales del usuario
        $email = $data['email'];
        $password = $data['password'];
        $type = $data['type'];
        $credential = array(
            'email' => $email,
            'password' => $password,
            'type' => $type
        );

        try {
            if (Auth::attempt($credential, $remember)) {
                $user = Auth::user();
                $name = $user->getName();
                $uid = $user->getId();
                $email = $user->getEmail();
                $token = $user->createToken('authToken');
                $success = [
                    "user" => ["name" => $name,
                        "uid" => $uid,
                        "email" => $email,
                        "user_type" => $type,
                    ],
                    "token" => $token->accessToken,
                    "expire" => Carbon::parse($token->token->expires_at)->format('d-m-Y H:i:s'),
                    "version" => "1.0",
                ];


                return response()->json($success, 200);
            } else {
                $message = 'Usuario o contraseña incorrecto.';
                $error = [
                    "error" => [
                        "message" => $message,
                    ],
                ];

                return response()->json($error, 403);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception
            ]);
        }
    }
}
