<?php

namespace App\Models\CATALOGOS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

#use softdeletes;
class CATEventos extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'eve_eve';
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


    public function setEveNombre($nombre)
    {
        $this->setAttribute('eve_nombre', $nombre);
        return $this;
    }

    public function getEveNombre()
    {
        return $this->getAttribute('eve_nombre');
    }

    public function setEveDescripcion($descr)
    {
        $this->setAttribute('eve_descripcion', $descr);
        return $this;
    }

    public function getEveDescripcion()
    {
        return $this->getAttribute('eve_descripcion');
    }

    public function setEveHorarioIni($horarioini)
    {
        $this->setAttribute('eve_horario_ini', $horarioini);
        return $this;
    }

    public function getEveHorarioIni()
    {
        return $this->getAttribute('eve_horario_ini');
    }

    public function setEveHorarioFin($horariofin)
    {
        $this->setAttribute('eve_horario_fin', $horariofin);
        return $this;
    }

    public function getEveHorarioFin()
    {
        return $this->getAttribute('eve_horario_fin');
    }


    public function setEveFechaIni($fechaini)
    {
        $this->setAttribute('eve_fecha_inicio', $fechaini);
        return $this;
    }

    public function getEveFechaIni()
    {
        return $this->getAttribute('eve_fecha_inicio');
    }

    public function setEveFechaFin($fechafin)
    {
        $this->setAttribute('eve_fecha_final', $fechafin);
        return $this;
    }

    public function getEveFechaFin()
    {
        return $this->getAttribute('eve_fecha_final');
    }

    public function setEveImage($image)
    {
        $this->setAttribute('eve_imagen', $image);
        return $this;
    }

    public function getEveImage()
    {
        return $this->getAttribute('eve_imagen');
    }

    #FUNCIONES ESTATICAS
    public static function getEventos(){
        $query = self::all();

        return $query;
    }

}
