<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoForo extends Model
{
    public $timestamps = false;
    protected $table = 'proyectos';

    protected $fillable = ['id','id_foro','titulo','nombre_de_empresa','objetivo','lineadeinvestigacion_id','areadeconocimiento_id',
    'id_asesor','aceptado','calificacion_foro','calificacion_seminario','promedio','participa'];

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
