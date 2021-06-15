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
    ini_set('max_execution_time', 180);

    $validator = Validator::make($request->all(), [
        'select' => 'required',
        //'videoanimal' => 'required',
        'title'=>'required',
        'contenido'=>'required',
        'imageanimal' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //'videoanimal' => 'required|mimes:mp4|max:100000',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => implode(",", $validator->messages()->all())
        ]);
    }


    /*$getID3 = new \getID3;
    $file = $getID3->analyze($video);
    $playtime_seconds = $file['playtime_seconds'];
    $duration = date('H:i:s.v', $playtime_seconds);


dd($duration);
     *
     */


try{
    $data=$request->all();
    $hash     = new Hashids('', 20);
    $animalHash= $hash->decode($data['select']);



    #subiendo images a la nube y obteniendo el url del video.
    $image = $request->file('imageanimal');
    $ImageName = Str::random(10).'.'.$image->getClientOriginalExtension();
    $filePath = 'images/' . $ImageName;
    $diskImage = \Storage::disk('public')->put($filePath, file_get_contents($image),'public');
    $gcsImage = \Storage::disk('public');
    $imageurl = $gcsImage->url('images'. "/" .$ImageName);


    DB::beginTransaction();
    $NewPost = new PUBlicaciones();
    $NewPost->setTitle($data['title']);
    $NewPost->setDescrip($data['contenido']);
    $NewPost->setImage($imageurl);
   // $NewPost->setVideo($videourl);
    $NewPost->setAnimal($animalHash[0]);
    $NewPost->save();
    DB::commit();
    return response()->json(
        [
            'success' => true,
            'message' => 'Publicación creadqwww coomo de que nos'
        ]
    );
}catch (\Exception $exception){
    dd($exception);
    DB::rollBack();
    return response()->json(
        [
            'success' => true,
            'message' => 'Error, intentar más tarde..'
        ]
    );
}
}



}
