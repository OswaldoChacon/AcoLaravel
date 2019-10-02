<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Horario;

use App\Docente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Horario;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use DB;

class addHourController extends Controller
{
    public function agregarHorarios($id)
    {
        $docente = Docente::findOrFail($id);
        return view('oficina.profesHorario.addHour', compact('docente'));
    }
    public function addHourDocente(Request $request, $id)
    {
        $horas = count($request->h_entrada, COUNT_RECURSIVE);
        for ($i = 0; $i < $horas; $i++) {
            // $token = Tokendocente::where('id_usuario', $request->emails[$i])->first();
            // if ($token == null) {
            // if ($request->emails[$i] != null) {
            DB::table('horariodocentes')->insert([
                [
                    'id_docente' => 1,
                    'dia'=>1,
                    'hora_entrada' => $request->h_entrada[$i],
                    'hora_salida' => $request->h_salida[$i],
                    'fecha' => $request->fecha[$i],
                ],
            ]);
        }
        $id = Crypt::encrypt($id);
        return redirect("profes/horarios/$id");

    }
}
