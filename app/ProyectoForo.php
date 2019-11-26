<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoForo extends Model
{
    public $timestamps = false;
    protected $table = 'proyectos';

    protected $fillable = ['id','id_foro','id_proyecto','titulo','nombre_de_empresa','objetivo','lineadeinvestigacion_id','areadeconocimiento_id',
    'id_asesor','aceptado','calificacion_foro','calificacion_seminario','promedio','participa'];

    public function seminario()
    {
        return $this->belongsTo(Seminario::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'jurados', 'id_docente', 'id_proyecto')->withPivot('hoja_id');
    }

    public function hojas()
    {
        return $this->belongsToMany(Hoja::class, 'jurados', 'id_proyecto', 'hoja_id')->withPivot('id_docente');
    }
}
