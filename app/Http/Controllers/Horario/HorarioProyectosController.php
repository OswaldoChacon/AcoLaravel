<?php

namespace App\Http\Controllers\Horario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HorarioProyectosController extends Controller
{
    public function index()
    {
        $foros = DB::table('foros')->get();
        // $idForo = $request->get('idForo');
        $foroactivo= DB::table('foros')->select('id')->where('acceso',1)->first();
        $fa=$foroactivo->id;

        $proyectos_aceptados = DB::table('proyectos')
        ->where('aceptado',1)
        ->where('id_foro','=',$fa)
        ->get();
        // dd($proyectos_aceptados);
        // $checkeado= DB::table('proyectos')->select('participa')->where('participa',1);

        // return $proyectos_aceptados;

        return view('oficina.horarios.horarios', compact('foros','proyectos_aceptados'));
    }
    public function editarParticipa(Request $request){
        $id = $request->get('id');
        $value = $request->get('value');
        DB::table('proyectos')
            ->where('id', $id)
            ->update(['participa' => $value]);
    }
    public function getProyectosForo(Request $request){
        $idForo = $request->get('idForo');
        $proyectos_aceptados = DB::table('proyectos')
        ->where('aceptado',1)
        ->where('id_foro',$idForo)
        ->get();
        return $proyectos_aceptados;
    }

    public function getProyectosForo2(Request $request){
        $idForo = $request->get('idForo');
        $proyectos_aceptados = DB::table('proyectos')
        ->where('aceptado',1)
        ->where('id_foro',$idForo)
        ->get();
        return $proyectos_aceptados;
    }

}
