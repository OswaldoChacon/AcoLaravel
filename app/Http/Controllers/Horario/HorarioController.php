<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Horario;

use App\Docente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Horarioforo;
use DB;
use Illuminate\Support\Facades\Crypt;
use App\Foro;
use App\ProyectoForo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use PDF;
use Maatwebsite\Excel\Concerns\FromView;

use App\GenerarHorario\Maestros;
use App\GenerarHorario\Problema;
use App\GenerarHorario\Main;
use Symfony\Component\VarDumper\VarDumper;


class HorarioController extends Controller
{
    //

    public function index()
    {
        return view('oficina.horarios.horarios');
    }
    public function addHourForo(Request $request, $id)
    {
        $data = array();
        $id = Crypt::decrypt($id);
        $fecha = count($request->fecha, COUNT_RECURSIVE);
        // dd($request);
        $insertarbool = true;
        $rules = [
            'h_inicio.*' => 'required',
            'h_end.*' => 'required|after:h_inicio.*',
            'fecha.*' => 'required',
            'b_inicio.*' => 'required',
            'b_end.*' => 'required|after:b_inicio.*',
            'duracion.*' => 'required'
        ];
        $messages = [
            'h_inicio.*.required' => 'Campo necesario',
            'h_end.*.required' => 'Coloca una hora adecuada',
            'fecha.*.required' => 'El evento no puede terminar antes que la hora de inicio',
            'h_end.*.after' => 'La hora fin debe ser superior a inicio',
        ];
        $this->validate($request, $rules, $messages);
        for ($i = 0; $i < $fecha; $i++) {
            $countFechas = Horarioforo::where('fecha_foro', '=', $request->fecha[$i])
                ->where('id_foro', '=', $id)
                ->count();
            $dayOfWeek = date("l", strtotime($request->fecha[$i]));
            if ($countFechas > 0 || $dayOfWeek == 'Saturday' || $dayOfWeek == 'Sunday') {
                $data[$i] = [
                    'id_foro' => $id,
                    "fecha" => $request->fecha,
                    "h_in" => $request->h_inicio,
                    "h_end" => $request->h_end
                ];
                //return back()->with('mensaje1', 'Horario NO registrado la fecha es repetida o es fin de semana');
                // mandar mensaje de los registros que no se guardaron
            } else {
                DB::table('horarioforos')->insert([
                    [
                        'id_foro' => $id,
                        'horario_inicio' => $request->h_inicio[$i],
                        'horario_termino' => $request->h_end[$i],
                        'fecha_foro' => $request->fecha[$i],
                    ],
                ]);
                return back()->with('mensaje', 'Horario del foro registrado');
            }
        }
        $id = Crypt::encrypt($id);
        return redirect("configurarForo/$id");
    }
    public function generarHorario(Request $request)
    {
        $rules = [
            'alpha' => 'required|numeric|max:1|not_in:0',
            'beta' => 'required|numeric|not_in:0',
            'Q' => 'required',
            'evaporation' => 'required',
            'iterations' => 'required',
            'ants' => 'required|numeric|min:2',
            'estancado' => 'required|numeric|not_in:0',
            // 't_max' => 'required|numeric|not_in:0',
            't_minDenominador' => 'required|numeric|not_in:0'
        ];
        $messages = [
            'alpha.max' => 'Alfa no debe ser mayor a 1',
            'alpha.not_in' => 'Alfa no debe ser 0',
            'alpha.required' => 'El campo alfa es requerido',
            'beta.required' => 'El campo beta es requerido',
            'Q.required' => 'El campo Q es requerido',
            'evaporation.required' => 'El campo Evaporación es requerido',
            'iterations.required' => 'El campo número de iteraciones es requerido',
            'ants.required' => 'El campo cantidad de hormigas es requerido',
            'ants.min' => 'Debe haber al menos dos hormigas en el algoritmo',
            'estancado.required' => 'El campo estacando es requerido',
            // 't_max.required' => 'El campo de T_max es requerido',
            // 't_max.not_in' => 'El campo de T_max no debe ser 0',
            't_minDenominador.not_in' => 'El campo de t_minDenominador no debe ser 0'
        ];
        $this->validate($request, $rules, $messages);
        // Proyectos participantes
        $proyectos = ProyectoForo::where('participa', 1)->get();
        //receso
        $receso = DB::table('horariobreak')->select('horariobreak.posicion')
            ->join('horarioforos', 'horariobreak.id_horarioforo', '=', 'horarioforos.id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', '=', 1)->get()->toArray();
        //proyectos ya con los maestros asociados verificar
        $proyectos_maestros = DB::table('jurados')->select('proyectos.id_proyecto', 'proyectos.titulo', DB::raw('group_concat( Distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as maestros'))
            ->join('docentes', 'jurados.id_docente', '=', 'docentes.id')
            ->join('proyectos', 'jurados.id_proyecto', '=', 'proyectos.id')
            ->where('proyectos.participa', 1)
            ->groupBy('proyectos.titulo')
            ->get()->each(function ($query) {
                $query->maestros = explode(",", $query->maestros);
            });
        // maestros con sus espacios de tiempo
        $maestro_et_FIX = DB::table('horariodocentes')->select(DB::raw('group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as nombre'), DB::raw('group_concat(horariodocentes.posicion) as horas'))
            ->rightJoin('docentes', 'horariodocentes.id_docente', '=', 'docentes.id')
            ->groupBy('nombre')
            ->get()->each(function ($query) {
                // quite arrayfilter para solucionar que no agarra el 0
                // $integerIDs = array_map('intval', explode(',', $string));
                // $query->horas = array_filter(array_map('intval',explode(",", $query->horas)),function($value) {
                $query->horas = array_filter(explode(",", $query->horas), function ($value) {
                    return ($value !== null && $value !== false && $value !== '');
                });
            });
        $maestro_et = DB::table('horariodocentes')
            ->select(DB::raw('group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as nombre'), DB::raw('count(hora) as cantidad'), DB::raw('group_concat(horariodocentes.posicion) as horas'))
            ->join('docentes', 'horariodocentes.id_docente', '=', 'docentes.id')
            ->join('horarioforos', 'horariodocentes.id_horarioforos', '=', 'horarioforos.id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->groupBy('id_docente')
            ->orderBy('cantidad')->get()->each(function ($query) {
                // quite arrayfilter para solucionar que no agarra el 0
                // $integerIDs = array_map('intval', explode(',', $string));
                // $query->horas = array_filter(array_map('intval',explode(",", $query->horas)),function($value) {
                $query->horas = array_filter(explode(",", $query->horas), function ($value) {
                    return ($value !== null && $value !== false && $value !== '');
                });
            });
        //dd($maestro_et,$cantidadETMaestros,$proyectos_maestros);
        //espacios de tiempo
        $horarios = DB::table('horarioforos')
            ->select('horario_inicio as inicio', 'horario_termino as termino', 'fecha_foro as fecha', 'horarioforos.id as id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->get();
        // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //
        $min = DB::table('foros')->select('duracion as minutos')->where('acceso', '=', 1)->get();
        // dd($horarios[0]->fecha);
        $minutos = $min[0]->minutos;
        $longitud = count($horarios);
        $temp = " ";
        $temp2 = " ";
        $intervalosContainer = array();
        $testTable = array();
        foreach ($horarios as $item) {
            $intervalo = array();
            while ($item->inicio <= $item->termino) {
                $newDate = strtotime('+0 hour', strtotime($item->inicio));
                $newDate = strtotime('+' . $minutos . 'minute', $newDate);
                $newDate = date('H:i:s', $newDate);
                $temp = $item->fecha . "" . $item->inicio . " - " . $newDate;
                $item->inicio = $newDate;
                if ($newDate > $item->termino) { } else {
                    array_push($intervalo, $temp);
                }
            }
            $testTable[] = $intervalo[sizeof($intervalo) - 1];
            array_push($intervalosContainer, $intervalo);
        }
        $intervalosUnion = array();
        foreach ($intervalosContainer as $intervaloTotal) {
            foreach ($intervaloTotal as $itemIntervaloTotal) {
                $intervalosUnion[] = $itemIntervaloTotal;
            }
        }
        //Salones
        $salones = Foro::where('acceso', 1)->get()->first();
        $main = new Main($proyectos_maestros, $maestro_et, $intervalosUnion, $request->alpha, $request->beta, $request->Q, $request->evaporation, $request->iterations, $request->ants, $request->estancado,  $request->t_minDenominador, $salones->num_aulas, $receso);
        //validacion ultima
        $cantidadProyectosMA = DB::table('jurados')->select(DB::raw('count(id_docente) as cantidad, group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as nombre'))
            //DB::raw('group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.maternos) as nombre')
            ->join('docentes', 'jurados.id_docente', '=', 'docentes.id')
            ->join('proyectos', 'jurados.id_proyecto', '=', 'proyectos.id')
            ->where('proyectos.participa', 1)
            ->groupBy('id_docente')
            ->orderBy('cantidad')->get();

        $cantidadETMaestros = DB::select('select id_docente, count(hora) as cantidad from horariodocentes,docentes,horarioforos,foros where horariodocentes.id_docente = docentes.id and horariodocentes.id_horarioforos = horarioforos.id and horarioforos.id_foro = foros.id and foros.acceso = 1 group by id_docente order by cantidad asc');
        //Nuevo 05 dic
        $cantidadMaestro_Jurado = DB::select('SELECT jurados.* FROM jurados inner join proyectos on jurados.id_proyecto=proyectos.id INNER join foros on proyectos.id_foro=foros.id where foros.acceso=1 and proyectos.participa=1 group by jurados.id_docente');
        $horarioDocentes = DB::select('SELECT horariodocentes.* FROM `horariodocentes` inner join horarioforos on horariodocentes.id_horarioforos=horarioforos.id inner join foros on horarioforos.id_foro=foros.id group by id_docente');
        $rr = 0;
        // if ($horarioDocentes < $cantidadMaestro_Jurado  || $cantidadMaestro_Jurado < $horarioDocentes || $cantidadMaestro_Jurado==null || $horarioDocentes== null) {
        error_log($rr);            
        if ($rr == 0) {
            // count($cantidadMaestro_Jurado) == 0  count($horarioDocentes) == 0
            // dd($horarioDocentes,$cantidadMaestro_Jurado);            
            return response()->noContent();
        }
        //Nuevo 05 dic
        $maestro_foro = $salones->num_maestros;
        if ($main->problema->eventos[0]->sizeComun == 0) {
            return response()->noContent();
        }
        foreach ($main->problema->eventos as $evento) {
            //dd($evento,sizeof($evento->maestroList));
            $maestro_evento = sizeof($evento->maestroList);
            if ($maestro_evento < $maestro_foro) {
                return response()->noContent();
            }
        }
        $main->start();
        $matrizSolucion = $main->matrizSolucion;
        $resultado_aux = array();
        $resultadoItem = array();
        $resultado = array();
        $resul = array();
        foreach ($matrizSolucion as $key => $items) {
            for ($i = 0; $i < sizeof($items); $i++) {
                $resul[$i] = [];
            }
            foreach ($items as $keyItems => $item) {
                unset($aux);
                $aux = array_filter(explode(",", $item), function ($value) {
                    return ($value !== null && $value !== false && $value !== '');
                });
                $resul[$keyItems] = $aux;
            }
            $resultado_aux[$key] = $resul;
            unset($resul);
        }
        $indice = 0;
        $tituloLlave = array();
        foreach ($resultado_aux as $key => $item) {
            $tituloLlave = array();
            foreach ($item as $keyItem => $itemItems) {
                if (sizeof($itemItems) > 1) {
                    $temporalLlave = $itemItems[0];
                    unset($itemItems[0]);
                    $tituloLlave[$temporalLlave] = $itemItems;
                } else {
                    $tituloLlave[$keyItem] = $itemItems;
                }
            }
            if ($key == $testTable[$indice]) {
                $resultadoItem[str_replace($horarios[$indice]->fecha, '', $key)] = $tituloLlave;
                $resultado[$horarios[$indice]->fecha] = $resultadoItem;
                $indice += 1;
                $resultadoItem = array();
            } else {
                $resultadoItem[str_replace($horarios[$indice]->fecha, '', $key)] = $tituloLlave;
            }
        }

        DB::table('horariogenerado')
            ->delete();
        DB::statement('ALTER TABLE horariogenerado AUTO_INCREMENT =1');

        //database
        $testFinal2 = array();
        $testFinal = array();
        foreach ($resultado as $date => $dates) {
            foreach ($dates as $hour => $hours) {
                $cont = 0;
                foreach ($hours as $event => $events) {
                    // $cont= 0;
                    // $cont++;
                    if ($events != null && sizeof($events) > 1) {
                        $cont++;
                        // dd($hours,$event,$events,$cont);
                        foreach ($events as $keyItem => $item) {
                            $project = DB::table('proyectos')->select('proyectos.id as id')
                                ->join('foros', 'proyectos.id_foro', '=', 'foros.id')
                                ->where('proyectos.titulo', '=', $event)->where('foros.acceso', 1)->first();
                            $docentes = DB::TABLE('docentes')->select('id')
                                ->where(DB::raw("CONCAT(prefijo,' ',nombre, ' ', paterno,' ', materno)"), '=', $item)->first();
                            array_push($testFinal, $date, $hour, $project->id, $docentes->id, $cont);
                            array_push($testFinal2, $testFinal);
                            $testFinal = array();
                        }
                    }
                }
            }
        }
        foreach ($testFinal2 as $registro) {
            DB::table('horariogenerado')->insert([
                [
                    'fecha' => $registro[0],
                    'hora' => $registro[1],
                    'id_proyecto' => $registro[2],
                    'id_docente' => $registro[3],
                    'salon' => $registro[4],
                ],
            ]);
        }
        return $resultado;
    }
    public function savePDF(Request $request)
    {
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('public')->put($nombre,  \File::get($file));
    }
    public function generarHorarioView()
    {
        $salones = Foro::select('num_aulas')->where('acceso', 1)->get()->first();
        //$salones = $salones->num_aulas;
        $proyectos_maestros = DB::table('jurados')->select('proyectos.id', 'proyectos.titulo', DB::raw('group_concat( Distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as maestros'))
            ->join('docentes', 'jurados.id_docente', '=', 'docentes.id')
            ->join('proyectos', 'jurados.id_proyecto', '=', 'proyectos.id')
            ->where('proyectos.participa', 1)
            ->groupBy('proyectos.titulo')
            ->get()->each(function ($query) {
                $query->maestros = explode(",", $query->maestros);
            });
        $maestrosTable = sizeof($proyectos_maestros[0]->maestros);
        return view('oficina.horarios.generarHorario', compact('maestrosTable', 'salones'));
    }
    public function proyectosHorarioMaestros()
    {
        $horarios = DB::table('horarioforos')
            ->select('horario_inicio as inicio', 'horario_termino as termino', 'fecha_foro as fecha', 'horarioforos.id as id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->get();

        // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //
        $min = DB::table('foros')->select('duracion as minutos')->where('acceso', '=', 1)->get();
        //dd(sizeof($min));
        if (sizeof($min) == 0) {
            Session::flash('mesage', "DEBE TENER ACTIVADO EL FORO AL CUAL DESEA GENERAR EL HORARIO, PARA PODER ASIGNAR HORARIO DISPONIBLE A LOS DOCENTES PARTICIPANTES ");
            Session::flash('alert-class', 'alert-danger');
        } else { }
        $minutos = $min[0]->minutos;
        $longitud = count($horarios);
        $temp = " ";
        $temp2 = " ";
        $intervalosContainer = array();
        $testTable = array();
        foreach ($horarios as $item) {
            $intervalosContainer[$item->fecha] = [];
        }
        $indice = 0;
        foreach ($horarios as $item) {
            $intervalo = array();
            while ($item->inicio < $item->termino) {
                $intervalo[$indice] = [];
                $newDate = strtotime('+0 hour', strtotime($item->inicio));
                $newDate = strtotime('+' . $minutos . 'minute', $newDate);
                $newDate = date('H:i:s', $newDate);
                $temp = $item->inicio . " - " . $newDate;
                $item->inicio = $newDate;
                if ($newDate > $item->termino) { } else {
                    $intervalo[$indice] = $temp;
                }
                $indice++;
            }
            $testTable[] = $intervalo[$indice - 1];
            $intervalosContainer[$item->fecha] = $intervalo;
        }
        foreach ($intervalosContainer as $intervaloTotal) {
            foreach ($intervaloTotal as $itemIntervaloTotal) {
                $intervalosUnion[] = $itemIntervaloTotal;
            }
        }
        $proyectos_maestros = DB::table('jurados')->select('proyectos.id_proyecto', 'proyectos.titulo', DB::raw('group_concat( Distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as maestros'))
            ->join('docentes', 'jurados.id_docente', '=', 'docentes.id')
            ->join('proyectos', 'jurados.id_proyecto', '=', 'proyectos.id')
            ->where('proyectos.participa', 1)
            ->groupBy('proyectos.titulo')
            ->orderBy('proyectos.id')
            ->get()->each(function ($query) {
                $query->maestros = explode(",", $query->maestros);
            });
        $maestro_et = DB::table('horariodocentes')->select(DB::raw('group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as nombre'), DB::raw('group_concat(horariodocentes.posicion) as horas'))
            ->rightJoin('docentes', 'horariodocentes.id_docente', '=', 'docentes.id')
            ->groupBy('nombre')
            ->get()->each(function ($query) {
                $query->horas = array_filter(explode(",", $query->horas), function ($value) {
                    return ($value !== null && $value !== false && $value !== '');
                });
            });
        $problema = new Problema($proyectos_maestros, $maestro_et, []);
        $proyectos = $problema->eventos;

        $cantidadProyectosMA = DB::table('jurados')->select(DB::raw('count(id_docente) as cantidad, group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as nombre'))
            //DB::raw('group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.maternos) as nombre')
            ->join('docentes', 'jurados.id_docente', '=', 'docentes.id')
            ->join('proyectos', 'jurados.id_proyecto', '=', 'proyectos.id')
            ->where('proyectos.participa', 1)
            ->groupBy('id_docente')
            ->orderBy('cantidad')->get();
        //dd($cantidadProyectosMA);
        //select DISTINCT id_docente, count(id_docente),group_concat( Distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno)
        //from `jurados` inner join `docentes` on `jurados`.`id_docente` = `docentes`.`id` inner join `proyectos` on `jurados`.`id_proyecto` = `proyectos`.`id` 
        //where `proyectos`.`participa` = 1 group by id_docente order by id_docente

        // dd($proyectos);
        // dd($intervalosContainer);
        $horarios = DB::table('horarioforos')
            ->select('horario_inicio as inicio', 'horario_termino as termino', 'fecha_foro as fecha', 'horarioforos.id as id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->get();
        // dd($proyectos);
        return view('oficina.horarios.proyectos', compact('proyectos', 'intervalosContainer', 'cantidadProyectosMA'));
    }
    public function actualizarHorarioForo(Request $request)
    {
        $fecha = $request->get('fecha');
        $inicio = $request->get('inicio');
        $termino = $request->get('termino');
        $idHorario = $request->get('idHorario');

        $hf = DB::table('horarioforos')
            ->where('id', $idHorario)->get();

        if (count($hf) > 0) {
            DB::table('horarioforos')
                ->where('id', $hf[0]->id)
                ->update(['fecha_foro' => $fecha, 'horario_inicio' => $inicio, 'horario_termino' => $termino]);
        }

        $hbreak = DB::table('horariobreak')->select(
            'horariobreak.id as id',
            'horariobreak.id_horarioforo as id_horarioforo',
            'horarioforos.id as idhf'
        )
            ->join('horarioforos', 'horariobreak.id_horarioforo', '=', 'horarioforos.id')
            ->where('id_horarioforo', $idHorario)->get();

        foreach ($hbreak as $hb) {
            $deletes = DB::table('horariobreak')
                ->where('id', $hb->id)
                ->delete();
        }

        $hdocentes = DB::table('horariodocentes')->select(
            'horariodocentes.id as id',
            'horariodocentes.id_horarioforos as id_horarioforos',
            'horarioforos.id as idhf'
        )
            ->join('horarioforos', 'horariodocentes.id_horarioforos', '=', 'horarioforos.id')
            ->where('id_horarioforos', $idHorario)->get();

        foreach ($hdocentes as $hd) {
            $deletes = DB::table('horariodocentes')
                ->where('id', $hd->id)
                ->delete();
        }
    }

    public function borrarHorarioForo(Request $request)
    {
        $idHorario = $request->get('idHorario');

        $horariof = DB::table('horarioforos')->select('id as id')
            ->where('id', $idHorario)->get();
        if (count($horariof) > 0) {
            $deletes = DB::table('horarioforos')
                ->where('id', $horariof[0]->id)
                ->delete();
        }
        $hbreak = DB::table('horariobreak')->select(
            'horariobreak.id as id',
            'horariobreak.id_horarioforo as id_horarioforo',
            'horarioforos.id as idhf'
        )
            ->join('horarioforos', 'horariobreak.id_horarioforo', '=', 'horarioforos.id')
            ->where('id_horarioforo', $idHorario)->get();

        foreach ($hbreak as $hb) {
            $deletes = DB::table('horariobreak')
                ->where('id', $hb->id)
                ->delete();
        }

        $hdocentes = DB::table('horariodocentes')->select(
            'horariodocentes.id as id',
            'horariodocentes.id_horarioforos as id_horarioforos',
            'horarioforos.id as idhf'
        )
            ->join('horarioforos', 'horariodocentes.id_horarioforos', '=', 'horarioforos.id')
            ->where('id_horarioforos', $idHorario)->get();

        foreach ($hdocentes as $hd) {
            $deletes = DB::table('horariodocentes')
                ->where('id', $hd->id)
                ->delete();
        }
    }
}
