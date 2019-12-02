<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horariodocente extends Model
{
   //    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'id','id_docente', 'id_horarioforos', 'hora','disponible','posicion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    public function horasDocente()
    {
    	return $this->belongsTo(Docente::class,'id','id_docente');
    }
}
