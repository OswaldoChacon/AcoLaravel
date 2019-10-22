<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoForo extends Model
{
    public $timestamps = false;
    protected $table = 'proyecto_foros';

    protected $fillable = ['id_foro', 'id_foro_titulo', 'titulo', 'objetivo', 'linea', 'area', 'assesor', 'maestro', 'oficina', 'calificacion', 'nombre_de_empresa'];

    public function seminario()
    {
        return $this->belongsTo(Seminario::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'jurados', 'proyectoforo_id', 'docente_id')->withPivot('hoja_id');
    }

    public function hojas()
    {
        return $this->belongsToMany(Hoja::class, 'jurados', 'proyectoforo_id', 'hoja_id')->withPivot('docente_id');
    }
}
