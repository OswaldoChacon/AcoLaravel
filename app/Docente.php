<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Docente extends Authenticatable
{
    public $timestamps = false;
    // protected $table = 'docentes';
    protected $fillable = [
        'id', 'name_usuario', 'email', 'nombre', 'paterno', 'materno', 'prefijo', 'password', 'acceso', 'matricula','id_tokendocentes'
    ];    
    public function proyectosforos()
    {
        return $this->belongsToMany(ProyectoForo::class, 'jurados', 'docente_id', 'proyectoforo_id')->withPivot('hoja_id');
    }

    public function hojas()
    {
        return $this->belongsToMany(Hoja::class, 'jurados', 'docente_id', 'hoja_id')->withPivot('proyectoforo_id');
    }
    public function docentehoras()
    {
        return $this->hasMany(Horariodocente::class, 'id', 'id_docente');
    }
}
