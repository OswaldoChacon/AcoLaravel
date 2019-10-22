<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diapositiva extends Model
{
    public $timestamps = false;
	protected $fillable = ['criterio', 'ponderacion'];
	
    public function hojas()
    {
    	return $this->belongsToMany(Hoja::class)->withPivot('evaluacion');
    }
}
