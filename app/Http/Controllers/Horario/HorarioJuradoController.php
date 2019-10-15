<?php

namespace App\Http\Controllers\Horario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
class HorarioJuradoController extends Controller
{
    public function index(){
        $jurado= DB::table('docentes')
        ->select('docentes.id as id_docente',
        DB::raw('CONCAT(prefijo," ",nombre," ",paterno," ", materno) as nombre '))
        ->join('jurados', 'docentes.id', '=', 'jurados.docente_id')
        ->join('proyecto_foros','proyecto_foros.id','=','jurados.proyectoforo_id')
        ->join('foros','proyecto_foros.id_foro','=','foros.id')
        ->where('foros.acceso',1)
        ->where('proyecto_foros.participa',1)
        ->get();
        $horarios = DB::table('horarioforos')
        ->select('horario_inicio as inicio', 'horario_termino as termino', 'fecha_foro as fecha', 'horarioforos.id as id')
        ->join('foros','horarioforos.id_foro','=','foros.id')
        ->where('foros.acceso',1)
        ->get();
        // $date= date('H:i:s');
        $inicio = date('H:i:s', strtotime($horarios[0]->inicio));
        $termino = date('H:i:s', strtotime($horarios[0]->termino));

        // dd($newDate);

        $horas=array();

        $temp=" ";
        while($inicio != $termino){
            $newDate = strtotime ( '+1 hour', strtotime ($inicio) ) ;
            $newDate = date('H:i:s' , $newDate);
            $temp = $inicio . " - " . $newDate;
            $inicio = $newDate;
             array_push($horas, $temp);
            // dd($temp);
        }
        // dd($horas);
        return view ('oficina.profesHorario.addHour', compact('jurado','horarios','horas'));
    }
}
