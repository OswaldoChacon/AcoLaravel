<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    public $timestamps = false;
    protected $fillable = ['noforo', 'titulo', 'periodo', 'anoo', 'id_user', 'acceso'];

    public function seminario()
    {
        return $this->hasOne(Seminario::class);
    }
    public function forohoras()
    {
        return $this->belongsTo(Horarioforo::class, 'id', 'id_foro');
    }
}
