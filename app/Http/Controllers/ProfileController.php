<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_profile' => __('You are not allowed to change data for a default user.')]);
        }

        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for a default user.')]);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }


    public function editPic(Request $request)
    {

        #dd($user);
        #$dada= $request->all();
        #dd($dada);
        $imageProfile = $request->file('imageProfile');
        #dd($imageProfile);
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
            #dd($UserInfo);
            #SUBIENDO LA IMAGEN AL DRIVE
            $imageName = Str::random(10) . '.' . $imageProfile->getClientOriginalExtension();
            $filePath = 'images/' . $imageName;
            $diskImage = \Storage::disk('gcs')->put($filePath, file_get_contents($imageProfile), 'public');
            $gcsImage = \Storage::disk('gcs');
            $imageurl = $gcsImage->url('images' . "/" . $imageName);

            $UserInfo = User::find($uid);
           # dd($UserInfo->getPic());
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
