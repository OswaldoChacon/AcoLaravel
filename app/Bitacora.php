<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Bitacora extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'motivo', 'dato_anterior','dato_nuevo','evidencias','id_tipocambio','id_proyecto','id_solicitante'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id_cambio'
    ];
  
  /*  public function horasforo()
    {
    	// return $this->belongsTo(Foro::class,'id','id_foro');
    } */
}