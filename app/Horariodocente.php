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
    protected $fillable = [
        'id','id_docente', 'dia', 'hora_inicio','hora_entrada','fecha'
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
    	return $this->belongsTo(Docente::class,'id','id_foro');
    }
}
