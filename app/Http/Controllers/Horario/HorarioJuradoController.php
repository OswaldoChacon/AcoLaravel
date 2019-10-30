<?php
namespace App\Http\Controllers\Horario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;

class HorarioJuradoController extends Controller
{
    public function index(Request $request)
    {
        $min= DB::table('foros')->select('duracion as minutos')->where('acceso','=',1)->get();
        $minutos = $min[0]->minutos;

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
            ->get();
        $horarios = DB::table('horarioforos')
            ->select('horario_inicio as inicio', 'horario_termino as termino', 'fecha_foro as fecha', 'horarioforos.id as id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->get();

        $longitud = count($horarios);
        $temp = " ";
        $intervalosContainer =array();
        // dd($horarios);
        foreach($horarios as $item){
            $intervalo = array();
            while ($item->inicio <= $item->termino) {
                $newDate = strtotime('+0 hour', strtotime($item->inicio));
                $newDate=strtotime('+'.$minutos.'minute',$newDate);
                $newDate = date('H:i:s', $newDate);
                $temp = $item->inicio . " - " . $newDate;
                $item->inicio = $newDate;

                if($newDate> $item->termino){

                }
                else{
                    array_push($intervalo, $temp);
                }

            }
            array_push($intervalosContainer, $intervalo);
        }        
        // dd($intervalosContainer);
        return view('oficina.profesHorario.addHour', compact('jurado', 'horarios','intervalosContainer'));
    }
        public function setHorarioJurado(Request $request){
            $idDocente = $request->get('idDoc');
        }

}
