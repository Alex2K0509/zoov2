<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    protected $table = 'qr';
    protected $primaryKey = 'qr_ID';
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
        $this->setAttribute('qr_name', $name);
        return $this;

    }

    public function getNombre()
    {
        return $this->getAttribute('qr_name');
    }

    public function setImage($url)
    {
        $this->setAttribute('qr_image', $url);
        return $this;

    }

    public function getImage()
    {
        return $this->getAttribute('qr_image');
    }

    public function setQR($url)
    {
        $this->setAttribute('qr_codeURL', $url);
        return $this;

    }

    public function getQR()
    {
        return $this->getAttribute('qr_codeURL');
    }

    public function setImageQR($url)
    {
        $this->setAttribute('qr_imageURL', $url);
        return $this;

    }

    public function getImageQR()
    {
        return $this->getAttribute('qr_imageURL');
    }
}
