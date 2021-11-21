<?php


namespace App\Http\Controllers\PUBLICACIONES;


use App\Http\Controllers\Controller;
use App\Models\ANIMALES\ANIMales;
use App\Models\CATALOGOS\CATEventos;
use App\Models\PUBLICACIONES\PUBlicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Hashids\Hashids;
class PublicacionesController extends Controller
{
protected function inserPost(Request $request){
    $rules = [
        'select' => ['required'],
        'title' => ['required','min:1', 'max:80'],
        'contenido' => ['required','min:1', 'max:500'],
    ];
    $messages = [
        'select.required' => 'Debe seleccionar un tipo de animal para la publicación.',
        'title.required' => 'El titulo de la publicación es requerido.',
        'title.min' => 'El titulo debe tener al menos un caracter.',
        'title.max' => 'El titulo no debe exceder de los 80 caracteres.',
        'title.regex' => 'El titulo contiene caracteres no validos.',
        'contenido.required' => 'El contenido de la publicación es requerido.',
        'contenido.min' => 'El contenido debe tener al menos un caracter.',
        'contenido.max' => 'El titcontenidoulo no debe exceder de los 500 caracteres.'
    ];
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        $messages = $validator->messages();
        return response()->json([
            'success' => false,
            'message' => $messages->first(),
        ]);
    }



try{
    if($request->file('imageanimal')){
        $rules2 = [
            'imageanimal' => ['mimes:jpeg,png,jpg,svg|max:2048'],
        ];
        $messages2 = [
            'imageanimal.max' => 'El archivo no debe ser superior a 2 megas'
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

        $file = $request->file('imageanimal');
        $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $imageName);
        $url = asset('images/' . $imageName);
    }else{
        $url = null;
    }

    $data=$request->all();
    $hash     = new Hashids('', 20);
    $animalHash= $hash->decode($data['select']);


    DB::beginTransaction();
    $NewPost = new PUBlicaciones();
    $NewPost->setTitle($data['title']);
    $NewPost->setDescrip($data['contenido']);
    $NewPost->setImage($url);
    $NewPost->setAnimal($animalHash[0]);
    $NewPost->save();
    DB::commit();
    return response()->json(
        [
            'success' => true,
            'message' => 'Publicación creada exitosamente.'
        ]
    );
}catch (\Exception $exception){
    DB::rollBack();
    return response()->json(
        [
            'success' => false,
            'message' => 'Error, intentar más tarde..'
        ]
    );
}
}



}
