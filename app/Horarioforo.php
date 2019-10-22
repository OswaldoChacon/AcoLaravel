<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarioforo extends Model
{
    //    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'id_foro', 'dia', 'horario_inicio','horario_termino','fecha_foro', 'duracion','no_alumnos',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
    public function horasforo()
    {
    	// return $this->belongsTo(Foro::class,'id','id_foro');
    }
}
