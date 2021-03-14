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




}
