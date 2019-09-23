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
        $date = "2012-01-21";
        //Get the day of the week using PHP's date function.        
        //dd($dayOfWeek);
        $fecha = count($request->fecha, COUNT_RECURSIVE);
        $insertarbool = true;
        $rules = [
            'h_inicio.*' => 'required',
            'h_end.*' => 'required|after:h_inicio.*',
            'fecha.*' => 'required',
        ];
        $messages = [
            'h_inicio.*.required' => 'Campo necesario',
            'h_end.*.required' => 'Coloca una hora adecuada',
            'fecha.*.required' => 'El evento no puede terminar antes que la hora de inicio',
            'h_end.*.after' => 'La hora fin debe ser superior a inicio'
        ];
        $this->validate($request, $rules, $messages);

        for ($i = 0; $i < $fecha; $i++) {
            $countFechas = Horarioforo::where('fecha_foro', '=', $request->fecha[$i])
                ->where('id_foro', '=', $id)
                ->count();
            $dayOfWeek = date("l", strtotime($request->fecha[$i]));
            if ($countFechas > 0) {
                $insertarbool = false;
            } else {
                $insertarbool = true;
            }
        }
        if ($insertarbool == true) {
            for ($i = 0; $i < $fecha; $i++) {
                DB::table('horarioforos')->insert([
                    [
                        'id_foro' => $id,
                        'horario_inicio' => $request->h_inicio[$i],
                        'horario_termino' => $request->h_end[$i],
                        'fecha_foro' => $request->fecha[$i],
                    ],
                ]);
            }
        }
        return back()->with('mensaje', 'Horario del foro registrado');
        $id = Crypt::encrypt($id);
        return redirect("configurarForo/$id");
    }
}
