<?php


namespace App\Http\Controllers\Publicaciones;


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
    $validator = Validator::make($request->all(), [
        'select' => 'required',
        //'videoanimal' => 'required',
        'title'=>'required',
        'contenido'=>'required',
       // 'imageanimal' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //'videoanimal' => 'required|mimes:mp4|max:100000',

    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => implode(",", $validator->messages()->all())
        ]);
    }



try{
    $data=$request->all();
    $hash     = new Hashids('', 20);
    $animalHash= $hash->decode($data['select']);



    #subiendo images a la nube y obteniendo el url del video.
    $image = $request->file('imageanimal');
    $file = $request->file('imageanimal');
    $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('images'), $imageName);
    $url = asset('images/' . $imageName);


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
