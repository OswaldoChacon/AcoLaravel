<?php

namespace App\Http\Controllers\Horario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class seguiController extends Controller
{
    public function index()
    {
        $foros = DB::table('foros')->get();

        return view('oficina.horarios.prueba2', compact('foros'));
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
