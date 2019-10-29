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


use App\GenerarHorario\Maestros;
use App\GenerarHorario\Problema;


class HorarioController extends Controller
{
    //
    public function index()
    {
        return view('oficina.horarios.horarios');
    }
    public function addHourForo(Request $request, $id)
    {

        // $duracion= Horarioforo::find($id);
        // $duracion->duracion = $request->duracion;
        // $duracion=save();
        // return redirect("configurarForo/$id");


        // dd($request);
        //Get the day of the week using PHP's date function.
        //dd($dayOfWeek);
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
            'b_inicio.*.required' => 'Campo necesario',
            'b_end.*.required' => 'Coloca una hora adecuada',
            'h_end.*.after' => 'La hora fin debe ser superior a inicio',
            'duracion.*' => 'Debe de llenar este campo'
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
                    "fecha" => $request->fecha[$i],
                    "h_in" => $request->h_inicio[$i],
                    "h_end" => $request->h_end[$i],
                    'inicio_break' => $request->b_inicio[$i],
                    'fin_break' => $request->b_end[$i],

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
                        'inicio_break' => $request->b_inicio[$i],
                        'fin_break' => $request->b_end[$i],

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
            'q' => 'required',
            'evaporation' => 'required',
            'iterations' => 'required',
            'ants' => 'required|numeric|not_in:0',  
            'estancado' => 'required|numeric|not_in:0',
            't_max' => 'required|numeric|not_in:0'
        ];
        $messages = [
            'alpha.max' => 'Alfa no debe ser mayor a 1',
            'alpha.not_in' => 'Alfa no debe ser 0',
            'alpha.required' => 'El campo alfa es requerido',
            'beta.required' => 'El campo beta es requerido',
            'q.required' => 'El campo Q es requerido',
            'evaporation.required' => 'El campo Evaporación es requerido',
            'iterations.required' => 'El campo número de iteraciones es requerido',
            'ants.required' => 'El campo cantidad de hormigas es requerido',
            'estancado.required' => 'El campo estacando es requerido',
            't_max.required' => 'El campo de T_max es requerido',
            't_max.not_in' => 'El campo de T_max no debe ser 0',
            
        ];
        // $this->validate($request, $rules,$messages);
        // Proyectos participantes
        $proyectos = ProyectoForo::where('participa',1)->get();
        // $maestros = Docente::select('proyectos.titulo','docentes.nombre')
        // ->join('jurados','jurados.id_docente','=','docentes.id')
        // ->join('proyectos','jurados.id_docente','=','proyectos.id')
        // ->get();

        //proyectos ya con los maestros asociados verificar
        $proyectos_maestros = DB::table('jurados')->select('proyectos.id','proyectos.titulo',DB::raw('group_concat( Distinct docentes.nombre) as maestros'))
        // DB::raw('group_concat(horariodocentes.hora) as horas'))
        ->join('docentes','jurados.id_docente','=','docentes.id')
        ->join('proyectos','jurados.id_proyecto','=','proyectos.id')   
        // ->leftJoin('horariodocentes','jurados.id_docente','=','horariodocentes.id_docente')
        ->where('proyectos.participa',1)
        ->groupBy('proyectos.titulo')        
        // ->distinct('maestros')
        ->get()->each(function($query){
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
        $maestro_et = DB::table('horariodocentes')->select('docentes.nombre',DB::raw('group_concat(horariodocentes.hora) as horas'))
        ->rightJoin('docentes','horariodocentes.id_docente','=','docentes.id')
        ->groupBy('docentes.nombre')
        ->get()->each(function($query){
            $query->horas = array_filter(explode(",", $query->horas));
        });
              

        // dd($maestro_et);
        $foros = Foro::all();        
        $ants = new Problema($proyectos_maestros,$maestro_et);
        dd($ants->getListMaestros());
        // $ants->setHorario(array(1,2,3,));        
        
        // dd($ants);
        return redirect('/generarHorario');        
    }    
}
