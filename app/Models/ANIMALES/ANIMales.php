<?php


namespace App\Models\ANIMALES;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ANIMales extends Model
{
    protected $table = 'animales';
    protected $primaryKey = 'an_id';
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

    public function setNombre($name)
    {
        $this->setAttribute('an_nombre', $name);
        return $this;

    }
    public function getNombre()
    {
        return $this->getAttribute('an_nombre');
    }

    public function setEspecie($especie)
    {
        $this->setAttribute('an_especie', $especie);
        return $this;

    }
    public function getEspecie()
    {
        return $this->getAttribute('an_especie');
    }
    public function setImage($url)
    {
        $this->setAttribute('an_image', $url);
        return $this;

    }
    public function getImage()
    {
        return $this->getAttribute('an_image');
    }

    public function getCreatedAt()
    {
        return $this->getAttribute('created_at');
    }
    #RELATIONS
    public function publicaciones()
    {
        return $this->hasMany('App\Models\PUBLICACIONES\PUBlicaciones', 'pub_animal', 'an_id');
    }



}
