<?php

namespace App\Http\Controllers\Horario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Illuminate\Support\Facades\Session;

class HorarioJuradoController extends Controller
{
    public function index(Request $request)
    {

        $min = DB::table('foros')->select('duracion as minutos')->where('acceso', '=', 1)->get();
        if(count($min)>0){

            $minutos = $min[0]->minutos;
        }
        else{
            Session::flash('mesage', "DEBE TENER ACTIVADO EL FORO AL CUAL DESEA GENERAR EL HORARIO, PARA PODER ASIGNAR HORARIO DISPONIBLE A LOS DOCENTES PARTICIPANTES ");
            Session::flash('alert-class', 'alert-danger');
        }

        $jurado = DB::table('docentes')
            ->select(
                'docentes.id as id_docente',
                DB::raw('CONCAT(prefijo," ",nombre," ",paterno," ", materno) as nombre ')
            )
            ->join('jurados', 'docentes.id', '=', 'jurados.id_docente')
            ->join('proyectos', 'proyectos.id', '=', 'jurados.id_proyecto')
            ->join('foros', 'proyectos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->where('proyectos.participa', 1)
            ->groupBy('nombre')
            ->orderBy('id_docente')
            ->get();
        $horarios = DB::table('horarioforos')
            ->select('horario_inicio as inicio', 'horario_termino as termino', 'fecha_foro as fecha', 'horarioforos.id as id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->get();

        $horariosdocentes= DB::table('horariodocentes')->where('disponible',1)->get();

        $longitud = count($horarios);
        $temp = " ";
        $intervalosContainer =array();

        foreach($horarios as $item){
            $intervalo = array();
            while ($item->inicio <= $item->termino) {
                $newDate = strtotime('+0 hour', strtotime($item->inicio));
                $newDate = strtotime('+' . $minutos . 'minute', $newDate);
                $newDate = date('H:i:s', $newDate);
                $temp = $item->inicio . " - " . $newDate;
                $item->inicio = $newDate;

                if ($newDate > $item->termino) { } else {
                    array_push($intervalo, $temp);
                }
            }
            array_push($intervalosContainer, $intervalo);
        }
        // dd($intervalosContainer);

        $posicionbreak= DB::table('horariobreak')->select('horariobreak.id as id','horariobreak.id_horarioforo as id_horarioforo',
        'horariobreak.horario_break as horariobreal','horariobreak.posicion as posicion','horariobreak.disponible as disponible',
        'horarioforos.id as idhf')
        ->join('horarioforos','horariobreak.id_horarioforo','=','horarioforos.id')
        ->where('disponible',1)->get();

        return view('oficina.profesHorario.addHour', compact('jurado', 'horarios', 'intervalosContainer','horariosdocentes','posicionbreak'));
    }
    public function setHorarioJurado(Request $request)
    {
        $idDocente = $request->get('idDocente');
        $idHorarioForo = $request->get('idHorarioForo');
        $hora = $request->get('hora');
        $disponible = $request->get('disponible');
        $posicion = $request->get('posicion');

        $horariodocente = DB::table('horariodocentes')
            ->where('id_docente', $idDocente)
            ->where('id_horarioforos', $idHorarioForo)
            ->where('hora',$hora)->get();

        if (count($horariodocente) > 0) {
            $deletes = DB::table('horariodocentes')
            ->where('id', $horariodocente[0]->id)
            ->delete();

            // DB::table('horariodocentes')
            //     ->where('id', $horariodocente[0]->id)
            //     ->update(['hora' => $hora, 'disponible' => $disponible, 'posicion' => $posicion]);
        }
        else {
            DB::table('horariodocentes')->insert([
                [
                    'id_docente' => $idDocente,
                    'id_horarioforos' => $idHorarioForo,
                    'hora' => $hora,
                    'disponible' => $disponible,
                    'posicion' => $posicion

                ],
            ]);
        }
    }
}
