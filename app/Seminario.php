<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminario extends Model
{
    // protected $primaryKey = 'id_seminario';
    // protected $table = 'seminarios';
    public $timestamps = false;
    protected $fillable = ['titulo', 'numeroSeminario', 'periodo', 'anio','numeroForo'];//,'foro_id'];

    public function foro()
    {
    	return $this->belongsTo(Foro::class);
    }

    public function proyectoforo()
    {
    	return $this->hasOne(ProyectoForo::class);
    }
}
