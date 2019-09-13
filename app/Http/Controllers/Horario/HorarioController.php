<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Horario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Horarioforo;
use DB;
use Illuminate\Support\Facades\Crypt;

class HorarioController extends Controller
{
    //
    public function index()
    {
        return view('oficina.horarios.horarios');
    }
    public function addHourForo(Request $request, $id)
    {
        $fecha = count($request->fecha, COUNT_RECURSIVE);
        for ($i = 0; $i < $fecha; $i++) {
            // $token = Tokendocente::where('id_usuario', $request->emails[$i])->first();
            // if ($token == null) {
            // if ($request->emails[$i] != null) {
            DB::table('horarioforos')->insert([
                [
                    'id_foro' => 1,
                    'horario_inicio' => $request->h_inicio[$i],
                    'horario_termino' => $request->h_end[$i],
                    'fecha_foro' => $request->fecha[$i],
                ],
            ]);
        }
        // $forohorario = new horarioforo;
        // // $forohorario = $request->all()->except('id_diaForo');        
        // $forohorario->fecha_foro = $request->fecha;
        // $forohorario->horario_inicio = $request->h_inicio;
        // $forohorario->horario_termino = $request->h_end;        
        // $forohorario->id_foro = $id;
        // $forohorario->save();
        $id = Crypt::encrypt($id);


        return redirect("configurarForo/$id");
    }
}
