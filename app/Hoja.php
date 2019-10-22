<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hoja extends Model
{
    public $timestamps = false;
    protected $fillable = ['calificacion', 'observaciones'];

    public function impresos()
    {
        return $this->belongsToMany('App\Impreso')->withPivot('evaluacion');
    }

    public function diapositivas()
    {
        return $this->belongsToMany(Diapositiva::class)->withPivot('evaluacion');
    }

    public function resumes()
    {
        return $this->belongsToMany(Resume::class)->withPivot('evaluacion');
    }

    public function proyectosforos()
    {
        return $this->belongsToMany(ProyectoForo::class, 'jurados', 'hoja_id', 'proyectoforo_id')->withPivot('docente_id');
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'jurados', 'hoja_id', 'docente_id')->withPivot('proyectoforo_id');
    }
}
