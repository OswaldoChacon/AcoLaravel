<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Residencia extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'id_proyectos', 'lugar','ciudad','periodo_residencia','ano','solicitado','id_alumno'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
  
  /*  public function horasforo()
    {
    	// return $this->belongsTo(Foro::class,'id','id_foro');
    } */
}
