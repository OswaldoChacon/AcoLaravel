<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Residencia;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Tokenalumno;
use App\ProyectoForo;
use App\Forodoncente;
use App\Lineadeinvestigacion;
use App\Aredeconocimiento;
use App\Notificacione;
use App\Docente;
use App\Archivo;
use App\Foro;
use App\Alumno;
use App\Juradotwo;
use Auth;
use DB;


use App\ProyectoForoAlumno;

class CoordinadorController extends Controller
{

  public function __construct()
	{
        $this->middleware('auth');

	}
     public function index()
    {
        return view('Coordinador.coordinador');
    }


    public function solicitudesAprobadas()
{
  $uso=1;
  
  $control2= DB::table('residencias')->select('id','id_proyectos','id_alumno','periodo_residencia')->where('solicitado',$uso)->get();
  
  
  //dd($control2);
    return view('Coordinador.aprobados',compact('control2'));
}

    
    public function solicitudesResibidas()
    {
      $uso=0;
      
      $control= DB::table('residencias')->select('id','id_proyectos','id_alumno','periodo_residencia')->where('solicitado',$uso)->get();
      
      
      //dd($control);
        return view('Coordinador.solicitudes',compact('control'));
    }

    public function datelleSeguimientoResi(Request $request, $id, $id_proyectos){

      
      $datos =  DB::table('residencias')->select('id','id_proyectos','lugar','periodo_residencia','id_alumno')->where('id','=',$id)->first();
 
      $datosProyecto =  DB::table('proyectos')->select('id','titulo','nombre_de_empresa','id_asesor')->where('id','=',$id_proyectos)->first();
     
      $alumno =  DB::table('alumnos')->select('id','nocontro','nombre','paterno','materno')->where('id_proyecto','=',$id_proyectos)->first();
  
      $datosAsesor =  DB::table('proyectos')->select('id_asesor')->where('id','=',$id)->first();
      $bar1 = (array) $datosAsesor;
     
     $datosAsesorG=  DB::table('docentes')->select('matricula','nombre','paterno','materno','prefijo')->where('id','=',$bar1)->first();
    //dd($datosAsesorG);
     $bar2 = (array) $datosAsesorG;
     //dd($bar2);
       
      return view('Coordinador.detalleSolicitud',compact('datos','datosProyecto','alumno','datosAsesorG'));
  
    }



    public function AceptarResidencia(Request $request, $id)
{
  $estado=$request->input('estado');
 $var = 1;
  //dd($estado);
 // dd($request->all());
 //aqui va el metodo para modificar los datos de la tabla residencia se esta trabajando

 $resi= Residencia::find($id);
 $resi->solicitado=$var;
 //dd($resi);
 $resi->save();

  //return 'completado';
  $uso=0;
      
  $control= DB::table('residencias')->select('id','id_proyectos','id_alumno','periodo_residencia')->where('solicitado',$uso)->get();
  
  
  //dd($control);
    return view('Coordinador.solicitudes',compact('control'));
}

public function datelleSeguimiento(Request $request, $id_pro){
    
  // $foros = DB::table('foros')->get();
  //$inputs=Input::all();
  //$escritor_id = $inputs['id_pro'];
 
  
  //dd($id_pro);
   $foros=Foro::all();
  
 
   $datos =  DB::table('residencias')->select('id','id_proyectos','lugar','periodo_residencia','id_alumno')->where('id_proyectos','=',$id_pro)->first();
 
   $datosProyecto =  DB::table('proyectos')->select('id','titulo','nombre_de_empresa','id_asesor')->where('id','=',$id_pro)->first();
  
   $alumno =  DB::table('alumnos')->select('id','nocontro','nombre','paterno','materno')->where('id_proyecto','=',$id_pro)->first();

   $datosAsesor =  DB::table('proyectos')->select('id_asesor')->where('id','=',$id_pro)->first();
   $bar1 = (array) $datosAsesor;
  
  $datosAsesorG=  DB::table('docentes')->select('matricula','nombre','paterno','materno','prefijo')->where('id','=',$bar1)->first();
 //dd($datosAsesorG);
  $bar2 = (array) $datosAsesorG;

   
   
   return view('Coordinador.vistaAceptados',compact('datos','datosProyecto','alumno','datosAsesorG'));

 }
  


}
