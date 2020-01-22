<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tipo_cambio extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'nombre_cambio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id_tipocambio'
    ];
  
  /*  public function horasforo()
    {
    	// return $this->belongsTo(Foro::class,'id','id_foro');
    } */
}