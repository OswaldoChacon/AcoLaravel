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
    protected $fillable = [
        'id_foro', 'horario_inicio','horario_termino','fecha_foro','inicio_break','fin_break',
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
