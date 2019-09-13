<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
     protected $fillable = ['noforo','titulo','periodo','anoo','oficina','acceso'];

     public function seminario()
    {
        return $this->hasOne(Seminario::class);
    }
    public function forohoras()
    {
    	return $this->belongsTo(Horarioforo::class,'id','id_foro');
    }
}
