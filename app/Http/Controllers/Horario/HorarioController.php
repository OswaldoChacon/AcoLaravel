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
                    "h_end" => $request->h_end,
                    // 'inicio_break' => $request->b_inicio[$i],
                    // 'fin_break' => $request->b_end[$i],

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
                        // 'inicio_break' => $request->b_inicio[$i],
                        // 'fin_break' => $request->b_end[$i],

                    ],
                ]);
                return back()->with('mensaje', 'Horario del foro registrado');
            }
        }
        // dd($data);
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
        // dd("pp");

        // $this->validate($request, $rules,$messages);
        // Proyectos participantes
        $proyectos = ProyectoForo::where('participa', 1)->get();

        //receso
        $receso = DB::table('horariobreak')->select('horariobreak.posicion')
            ->join('horarioforos', 'horariobreak.id_horarioforo', '=', 'horarioforos.id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', '=', 1)->get()->toArray();

        // $test = DB::table('horariobreak')->select('posicion')->get()->toArray();
        // dd($test,$receso);
        // dd("array",$receso);



        //proyectos ya con los maestros asociados verificar
        $proyectos_maestros = DB::table('jurados')->select('proyectos.id', 'proyectos.titulo', DB::raw('group_concat( Distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as maestros'))
            ->join('docentes', 'jurados.id_docente', '=', 'docentes.id')
            ->join('proyectos', 'jurados.id_proyecto', '=', 'proyectos.id')
            ->where('proyectos.participa', 1)
            ->groupBy('proyectos.titulo')
            ->get()->each(function ($query) {
                $query->maestros = explode(",", $query->maestros);
            });
        //solo maestros participantes a un proectos
        // $maestros_participantes = DB::table('jurados')->select('jurados.id','docentes.id as iddocente','docentes.nombre')
        // ->join('docentes','jurados.id_docente','=','docentes.id')
        // ->join('proyectos','jurados.id_proyecto','=','proyectos.id')
        // ->where('proyectos.participa',1)
        // ->groupBy('jurados.id_docente')
        // ->orderBy('jurados.id','asc')
        // ->get();

        // maestros con sus espacios de tiempo
        $maestro_et = DB::table('horariodocentes')->select(DB::raw('group_concat(distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as nombre'), DB::raw('group_concat(horariodocentes.posicion) as horas'))
            ->rightJoin('docentes', 'horariodocentes.id_docente', '=', 'docentes.id')
            ->groupBy('nombre')
            ->get()->each(function ($query) {
                // dd($query);
                // quite arrayfilter para solucionar que no agarra el 0
                // $integerIDs = array_map('intval', explode(',', $string));
                // $query->horas = array_filter(array_map('intval',explode(",", $query->horas)),function($value) {
                $query->horas = array_filter(explode(",", $query->horas), function ($value) {
                    return ($value !== null && $value !== false && $value !== '');
                });
            });
        //espacios de tiempo
        $horarios = DB::table('horarioforos')
            ->select('horario_inicio as inicio', 'horario_termino as termino', 'fecha_foro as fecha', 'horarioforos.id as id')
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->get();
        // dd($proyectos_maestros);

        // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //
        $min = DB::table('foros')->select('duracion as minutos')->where('acceso', '=', 1)->get();
        // dd($horarios[0]->fecha);
        $minutos = $min[0]->minutos;
        $longitud = count($horarios);
        $temp = " ";
        $temp2 = " ";
        $intervalosContainer = array();
        $testTable = array();
        // dd($horarios);
        foreach ($horarios as $item) {
            $intervalo = array();
            while ($item->inicio <= $item->termino) {
                $newDate = strtotime('+0 hour', strtotime($item->inicio));
                // dd($item->fecha);
                $newDate = strtotime('+' . $minutos . 'minute', $newDate);
                $newDate = date('H:i:s', $newDate);
                $temp = $item->fecha . "" . $item->inicio . " - " . $newDate;
                $temp2 = $item->inicio . " - " . $newDate;
                $item->inicio = $newDate;
                if ($newDate > $item->termino) { } else {
                    array_push($intervalo, $temp);
                }
            }
            // dd(($intervalo));
            $testTable[] = $intervalo[sizeof($intervalo) - 1];
            array_push($intervalosContainer, $intervalo);
        }
        // dd($testTable);
        $intervalosUnion = array();
        foreach ($intervalosContainer as $intervaloTotal) {
            foreach ($intervaloTotal as $itemIntervaloTotal) {
                $intervalosUnion[] = $itemIntervaloTotal;
            }
        }
        //Salones
        $salones = Foro::where('acceso', 1)->get()->first();
        $main = new Main($proyectos_maestros, $maestro_et, $intervalosUnion, $request->alpha, $request->beta, $request->Q, $request->evaporation, $request->iterations, $request->ants, $request->estancado,  $request->t_minDenominador, $salones->num_aulas, $receso);
        if ($main->problema->eventos[0]->sizeComun == 0) {
            return response()->noContent();
        }
        $main->start();
        $matrizSolucion = $main->matrizSolucion;

        $resultado_aux = array();
        $resultadoItem = array();
        $resultado = array();
        $resul = array();
        foreach ($matrizSolucion as $key => $items) {
            foreach ($items as $item) {
                unset($aux);
                $aux = array_filter(explode(",", $item), function ($value) {
                    return ($value !== null && $value !== false && $value !== '');
                });
                $resul[] = $aux;
            }
            // $resultado_aux[$key] = $resul;
            $resultado_aux[$key] = $resul;
            unset($resul);
        }
        // dd($resultado_aux);
        $indice = 0;
        $tituloLlave = array();
        foreach ($resultado_aux as $key => $item) {
            // dd("este es el item",$item,$key,$resultado_aux);     
            $tituloLlave = array();
            foreach ($item as $keyItem => $itemItems) {
                // dd($itemItems);                
                if(sizeof($itemItems) > 1){
                    // dd($resultado_aux,$itemItems[0]);
                    $temporalLlave = $itemItems[0];
                    // dd($temporalLlave,$itemItems);
                    unset($itemItems[0]);
                    $tituloLlave[$temporalLlave] = $itemItems;
                }          
                else{
                    $tituloLlave[$keyItem] = $itemItems;
                }      
            }
            if ($key == $testTable[$indice]) {
                // dd("este es el item",$item,$key);
                // if(strpos($key, $horarios[$indice]->fecha)){
                // $horarios[0]->fecha                
                
                // dd($tituloLlave,$resultado_aux,$key);
                $resultadoItem[str_replace($horarios[$indice]->fecha, '', $key)] = $tituloLlave;
                // dd($item);
                // array_push($resultado, $resultadoItem);
                $resultado[$horarios[$indice]->fecha] = $resultadoItem;
                $indice += 1;
                $resultadoItem = array();
            } else {               
                $resultadoItem[str_replace($horarios[$indice]->fecha, '', $key)] = $tituloLlave;
            }
        }        
        // dd($resultado);
        $maestrosTable = sizeof($proyectos_maestros[0]->maestros);
        // $pdf = PDF::loadView('oficina.horarios.horas',compact('resultado','maestrosTable'))->setPaper('L', 'landscape');
        // // ->save(public_path().'/horarios/horario.pdf');
        //   return $pdf->stream('testfile.pdf')                
        //        ->header('Content-Type','application/pdf');               
        // return view('oficina.horarios.horarioGenerado',compact('resultado','maestrosTable'));




        //database
        $testFinal2 = array();
        $testFinal = array();
        $testFinal3 = array();
        foreach ($resultado as $date => $dates) {
            foreach ($dates as $hour => $hours) {
                foreach ($hours as $event => $events) {
                    // dd(sizeof($events));
                    if ($events != null && sizeof($events) > 1) {
                        foreach ($events as $keyItem => $item) {
                            // $testFinal []= array_push()
                            // dd($date,$hour,$item,$events);
                            array_push($testFinal, $date, $hour, $event, $item);
                            array_push($testFinal2, $testFinal);                            
                            $testFinal = array();                            
                        }
                    }
                }
            }
        }
        dd($testFinal2,$matrizSolucion, $resultado);

        dd($resultado);
        return $resultado;
    }
    public function pdf()
    {
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'content' => 'Lore.'
        ];

        $pdf = PDF::loadView('oficina.horarios.horas', $data);
        return $pdf->stream('testfile.pdf')
            ->header('Content-Type', 'application/pdf');
        //   $pdf->render();
        //   $pdf->loadHTML($view);
        //   return $pdf->download('medium.pdf');
    }
    public function excel()
    { }

    public function savePDF(Request $request)
    {
        // dd($request);
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        // dd($nombre);
        \Storage::disk('public')->put($nombre,  \File::get($file));
    }
    public function generarHorarioView()
    {
        $salones = Foro::select('num_aulas')->where('acceso', 1)->get()->first();
        $salones = $salones->num_aulas;
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
        $proyectos_maestros = DB::table('jurados')->select('proyectos.id', 'proyectos.titulo', DB::raw('group_concat( Distinct docentes.prefijo," ",docentes.nombre," ",docentes.paterno," ",docentes.materno) as maestros'))
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
        // dd($proyectos);
        return view('oficina.horarios.proyectos', compact('proyectos'));
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
