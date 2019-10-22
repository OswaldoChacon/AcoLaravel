<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impreso extends Model
{
    protected $fillable = ['criterio', 'ponderacion'];
    public $timestamps = false;
    public function hojas()
    {
    	return $this->belongsToMany('App\Hoja')->withPivot('evaluacion');
    }

    // public function puestos ()
    // {
    //     return $this->belongsToMany(Divipol::class)->withTimestamps();
    // }

    // public function users ()
    // {
    //     return $this->belongsToMany(User::class)->withTimestamps();
    // }
}
