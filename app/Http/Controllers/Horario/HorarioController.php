<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Horario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Horarioforo;
use DB;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

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
        $fecha = count($request->fecha, COUNT_RECURSIVE);
        $insertarbool = true;
        $rules = [
            'h_inicio.*' => 'required',
            'h_end.*' => 'required|after:h_inicio.*',
            'fecha.*' => 'required',
            'b_inicio.*' =>'required',
            'b_end.*' =>'required|after:b_inicio.*',
            'duracion.*'=>'required'
        ];
        $messages = [
            'h_inicio.*.required' => 'Campo necesario',
            'h_end.*.required' => 'Coloca una hora adecuada',
            'fecha.*.required' => 'El evento no puede terminar antes que la hora de inicio',
            'h_end.*.after' => 'La hora fin debe ser superior a inicio',
            'b_inicio.*.required' => 'Campo necesario',
            'b_end.*.required' => 'Coloca una hora adecuada',
            'h_end.*.after' => 'La hora fin debe ser superior a inicio',
            'duracion.*'=>'Debe de llenar este campo'
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
                    "fecha"=>$request->fecha[$i],
                    "h_in"=>$request->h_inicio[$i],
                    "h_end"=>$request->h_end[$i],
                    'inicio_break'=>$request->b_inicio[$i],
                    'fin_break'=>$request->b_end[$i],

                ];
                 //return back()->with('mensaje1', 'Horario NO registrado la fecha es repetida o es fin de semana');
                // mandar mensaje de los registros que no se guardaron
            }
            else {
                DB::table('horarioforos')->insert([
                    [
                        'id_foro' => $id,
                        'horario_inicio' => $request->h_inicio[$i],
                        'horario_termino' => $request->h_end[$i],
                        'fecha_foro' => $request->fecha[$i],
                        'inicio_break'=>$request->b_inicio[$i],
                        'fin_break'=>$request->b_end[$i],

                    ],
                ]);
                return back()->with('mensaje', 'Horario del foro registrado');
            }
        }
        // dd($data);
        $id = Crypt::encrypt($id);
        return redirect("configurarForo/$id");
    }
}
