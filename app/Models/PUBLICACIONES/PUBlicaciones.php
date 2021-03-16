<?php


namespace App\Models\PUBLICACIONES;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class PUBlicaciones extends Model
{
    protected $table = 'publicaciones';
    protected $primaryKey = 'pub_id';
    public $timestamps = false;

    public function setId($id)
    {
        $this->setAttribute($this->primaryKey, $id);
        return $this;

    }
    public function getId()
    {
        return $this->getAttribute($this->primaryKey);
    }
    public function setTitle($title)
    {
        $this->setAttribute('pub_titulo', $title);
        return $this;
    }

    public function getTitle()
    {
        return $this->getAttribute('pub_titulo');
    }

    public function setDescrip($descrip)
    {
        $this->setAttribute('pub_descripcion', $descrip);
        return $this;
    }

    public function getDescrip()
    {
        return $this->getAttribute('pub_descripcion');
    }

    public function setImage($image)
    {
        $this->setAttribute('pub_foto', $image);
        return $this;
    }

    public function getImage()
    {
        return $this->getAttribute('pub_foto');
    }
    public function setVideo($video)
    {
        $this->setAttribute('pub_video', $video);
        return $this;
    }

    public function getVideo()
    {
        return $this->getAttribute('pub_video');
    }
    public function setAnimal($anim)
    {
        $this->setAttribute('pub_animal', $anim);
        return $this;
    }

    public function getAnimal()
    {
        return $this->getAttribute('pub_animal');
    }

    public function setCreatedAt($video)
    {
        $this->setAttribute('pub_created_at', $video);
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->getAttribute('pub_created_at');
    }



    #publicaciones estaticas

public static function getPosts($id,$params =[]){
    $query = self::join('animales','an_id','=','pub_animal')
        ->where('pub_animal','=',$id);

    if(isset($params['month']) and !is_null($params['month'])){
             $query->whereMonth( 'pub_created_at',$params['month']);
         }
    if(isset($params['year']) and !is_null($params['year'])){
        $query->whereYear( 'pub_created_at',$params['year']);
    }
    $query->GroupBy('pub_id')->OrderBy('pub_id','DESC')->paginate($params['take']);

    return $query;
}

#relaciones
    public function animales()
    {
        return $this->belongsTo('App\Models\ANIMALES\ANIMales', 'pub_animal', 'an_id');
    }

}
