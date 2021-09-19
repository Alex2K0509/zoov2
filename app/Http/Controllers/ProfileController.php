<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as HHash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
#borrar despues
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }


    public function update(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => implode(",", $validator->messages()->all())
                ]);
            }

            $data = $request->all();

            $userId= auth()->user()->id;
            $update = User::where('id',$userId)->first();
            $update->name = $data['name'];
            $update->save();
            $name = $update->name;
            return response()->json(
                [
                    'success' => true,
                    'message' => 'La información se ha actualizado correctamente.',
                    'name' => $name
                ]
            );
        }catch (\Exception $exception){
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error, intentar más tarde.',
                ]
            );
        }
    }


    public function password(Request $request)
    {
        $rules = [
            'old_password' => ['required', 'min:1', 'max:120', 'regex:/^[A-Za-z0-9]+$/u'],
            'password' => ['required', 'min:1', 'max:100', 'regex:/^[A-Za-z0-9]+$/u'],
            'password' => ['required', 'min:1', 'max:100', 'regex:/^[A-Za-z0-9]+$/u'],

        ];
        $messages = [
            'old_password.required' => 'El campo de la contraseña anterior no puede estar vacío.',
            'old_password.min' => 'El campo de la contraseña anterior debe tener al menos un caracter.',
            'old_password.max' => 'El campo de la contraseña anterior no debe exceder de los 120 caracteres.',
            'old_password.regex' => 'El campo de de la contraseña anterior no cumple con el formato permitido.',
            'password.required' => 'El campo de la nueva contraseña no puede estar vacío.',
            'password.min' => 'El campo de la nueva contraseña debe tener al menos un caracter.',
            'password.max' => 'El campo de la nueva contraseña no debe exceder de los 100 caracteres.',
            'password.regex' => 'El campo de de la nueva contraseña no cumple con el formato permitido.',
            'password_confirmation.required' => 'El campo de la nueva contraseña no puede estar vacío.',
            'password_confirmation.min' => 'El campo de la nueva contraseña debe tener al menos un caracter.',
            'password_confirmation.max' => 'El campo de la nueva contraseña no debe exceder de los 100 caracteres.',
            'password_confirmation.regex' => 'El campo de de la nueva contraseña no cumple con el formato permitido.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();

            return response()->json(
                [
                    'success' => false,
                    'message' => $messages,
                ]
            );
        }
        try {
            $data = $request->all();
            $newPassword= $data['password'];
            $confirmPassword = $data['password_confirmation'];

            #validando que la contraseña antigua sea igual a la ingresas
            $user = Auth::user();
            $Oldpassword = $user->password;
            $initialPassword = $data['old_password'];




            if (!HHash::check($initialPassword,$Oldpassword)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'La contraseña anterior no coincide con la ingresada.',
                    ]
                );
            }

            if ($newPassword != $confirmPassword){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'La nueva contraseña y su confirmación no coinciden.',

                    ]
                );
            }

            $user->password = HHash::make($newPassword);
            $user->save();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'La contraseña se ha actualizado correctamente.',

                ]
            );
            return true;
        }catch (\Exception $exception){

        }
    }


    public function editPic(Request $request)
    {


        $imageProfile = $request->file('imageProfile');
        #dD($imageProfile);
        if (!is_null($imageProfile)) {
            $validator = Validator::make($request->all(), [
                'eventeimage' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => implode(",", $validator->messages()->all())
                ]);
            }
        }

        try {
            $uid = Auth::user()->id;
            $UserInfo = User::find($uid);
            $imageName = Str::random(10) . '.' . $imageProfile->getClientOriginalExtension();
            $filePath = public_path('/images');
            #AJUSTANDO EL TAMAÑO Y GUARDANDO LA IMAGEN
            $img = Image::make($imageProfile->path());
            $img->resize(300, 200, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$imageName);


            $imageurl = asset('images/' . $imageName);

            $UserInfo->setPic($imageurl);
            $UserInfo->save();

            return response()->json([
                'success' => true,
                'image' => $imageurl,
                'message' => "Se ha actulizado correctamente."
            ]);

        }catch(\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }


    }

}
