<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Archivo;
use App\Aredeconocimiento;
use App\Docente;
use App\Foro;
use App\Forodoncente;
use App\Hoja;
use App\Lineadeinvestigacion;
use App\Notificacione;
use App\ProyectoForo;
use App\ProyectoForoAlumno;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Console;
use \PDF;
use DB;
use Illuminate\Support\Facades\Session;
use Storage;


class AlumnoController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:alumnos');
  }
  public function index()
  {
    $notificacione =0;// Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->count();
    return view('alumno.alumno', compact('notificacione'));

  }

  public function editar($id)
  {
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->count();
    $id = Crypt::decrypt($id);
    $alumno = Alumno::find($id);
    return view('alumno.editar', compact('alumno', 'notificacione'));
  }
  public function guardar(Request $request, $id)
  {
    $id = Crypt::decrypt($id);

    $validator = $this->validate(request(), [
      'name' => 'required',
      'email' => 'email|required',
      'nombre' => 'required',
      'paterno' => 'required',
      'materno' => 'required',
      'password' => 'required',
    ]);

    $alumno = Alumno::find($id);
    $alumno->name = $request->name;
    $alumno->email = $request->email;
    $alumno->nombre = $request->nombre;
    $alumno->paterno = $request->paterno;
    $alumno->materno = $request->materno;
    $alumno->acceso = $alumno->acceso;
    $alumno->nocontro = $alumno->nocontro;
    $alumno->password = Hash::make($request->password);
    $alumno->save();
    return view('alumno.alumno');
  }

  public function registraProyecto()
  {
    $notificacione = 0;//Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->count();
    $forodoncente = Forodoncente::all();
    $docente = Docente::all();
    $alumno = Alumno::all();
    $lineadeinvestigacion = Lineadeinvestigacion::all();
    $aredeconocimiento = Aredeconocimiento::all();
    $foro = Foro::where('acceso', 1)->first();
    /* if ($foro->periodo=="Enero-Junio") {
           $perio='-01';
         }
         if ($foro->periodo=="Agosto-Diciembre") {
           $perio='-02';
         }
         $resultado = substr($foro->anoo, 2, 2).$perio;
         echo $resultado; // imprime "ue"*/
    //echo foro;
    //return view('alumno.registraProyecto',compact('foro','docente','lineadeinvestigacion','aredeconocimiento','forodoncente','ni','alumno','idalumno1','notificacione'));
    return view('alumno.registraProyecto', compact('foro', 'docente', 'lineadeinvestigacion', 'aredeconocimiento', 'forodoncente', 'alumno', 'notificacione'));
  }
  public function RegistarProyecto(Request $request, $id)
  {

    $validator = $this->validate(request(), [
      'titulo' => 'required',
      'objetivo' => 'required',
      'categorias' => 'required',
      'productos' => 'required',
      'empresa' => 'required',
    ]);

    $alumno = Alumno::where('nombre', Auth::guard('alumnos')->user()->nombre)->first();
    $alumno->acceso = 1;
    $alumno->save();

    $foro =Foro::find($id);
    $proyectoForo = ProyectoForo::all();
    $ProyectoForo = new ProyectoForo;
    $ProyectoForo->id_foro = $foro->id;
    $ProyectoForo->titulo = $request->titulo;
    $ProyectoForo->objetivo = $request->objetivo;
    $ProyectoForo->lineadeinvestigacion_id = $request->categorias;
    if ($request->id_input != null) {
      $ProyectoForo->aredeconocimiento_id = $request->id_input;
    } else {
      $ProyectoForo->aredeconocimiento_id = $request->productos;
    }
    $ProyectoForo->id_asesor=$request->assesor;
// dd($request->assesor);

    $ProyectoForo->nombre_de_empresa = $request->empresa;
    // $ProyectoForo->seminario_id = $foro->id;
    // $ProyectoForo->alumno_id = $alumno->id;
    $prefijo=DB::table('foros')->select('prefijo_proyecto')->where('id',$id)->first();
    $p=$prefijo->prefijo_proyecto;

    $numproyectos= DB::table('proyectos')->where('id_foro',$id)->get();
    $contador=count($numproyectos);

    if($contador>0)
    {
      $contador++;

      if($contador < 10)
      {
        strval($contador);
        $temp= " 0 " . $contador;
      }
      else{
        strval($contador);
        $temp=$contador;
      }

    }
    else{
      $contador=1;
      strval($contador);
      $temp= " 0 " . $contador;
    }

    $id_proyecto=$p . $temp;
    $ProyectoForo->id_proyecto=$id_proyecto;

    $ProyectoForo->save();

    $alum = Auth::id();

    $proyecto= DB::TABLE('proyectos')->select('id')->where('id_proyecto',$id_proyecto)->first();
    $pro=$proyecto->id;

     DB::table('alumnos')
                ->where('id', $alum)
                ->update(['id_proyecto' => $pro]);

    // $alumnos = count($request->alumno, COUNT_RECURSIVE);
    // for ($i = 0; $i < $alumnos; $i++) {
    //   if ($request->alumno[$i] != 'alumos') {
    //     $Notificacione = new Notificacione;
    //     $Notificacione->id_foro = $foro->id;
    //     $Notificacione->alumno_envio = Auth::guard('alumnos')->user()->id;
    //     $Notificacione->id_proyecto = $ProyectoForo->id;
    //     $Notificacione->id_alumno = $request->alumno[$i];
    //     $Notificacione->titulo = $request->titulo;
    //     $Notificacione->foro = $foro->noforo;
    //     $Notificacione->objetivo = $request->objetivo;
    //     $Notificacione->envio = 1;
    //     $Notificacione->save();
    //   }
    // }

    // $Notificacione = new Notificacione;
    // $Notificacione->id_foro = $foro->id;
    // $Notificacione->alumno_envio = Auth::guard('alumnos')->user()->id;
    // $Notificacione->id_proyecto = $ProyectoForo->id;
    // $Notificacione->id_alumno = $request->assesor;
    // $Notificacione->titulo = $request->titulo;
    // $Notificacione->foro = $foro->noforo;
    // $Notificacione->objetivo = $request->objetivo;
    // $Notificacione->envio = 2;
    // $Notificacione->save();

    // $ProyectoForoAlumno = new ProyectoForoAlumno;
    // $ProyectoForoAlumno->id_foro = $foro->id;
    // $ProyectoForoAlumno->id_proyecto = $ProyectoForo->id;
    // $ProyectoForoAlumno->id_alumno = $alumno->id;
    // $ProyectoForoAlumno->titulo = $request->titulo;
    // $ProyectoForoAlumno->foro = $foro->noforo;
    // $ProyectoForoAlumno->objetivo = $request->objetivo;
    // $ProyectoForoAlumno->save();
    Session::flash('mensage', "Proyecto Registrado");
            Session::flash('alert-class', 'alert-success');
    return back();
  }


  public function byFoundation($id)
  {
    return Aredeconocimiento::where('linea', $id)->get();
  }

  public function descarga($id)
  {

    $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    $alumnoenproyecto = ProyectoForoAlumno::all();
    $alumno = alumno::all();
    $docente = Docente::all();
    $Forodoncente = Forodoncente::all();
    $foro = Foro::find($ProyectoForoAlumno->id_foro);
    $proyectoForo = ProyectoForo::find($ProyectoForoAlumno->id_proyecto);
    $pdf = PDF::loadView('pdf.registrodeforo', compact('foro', 'proyectoForo', 'ProyectoForoAlumno', 'notificacione', 'alumnoenproyecto', 'alumno', 'docente', 'Forodoncente'));
    return $pdf->download('registrodeforo.pdf');
  }

  public function proyectoAlumno($id)
  {
    // $id = Crypt::decrypt($id);
    $alumno = Auth::id();
    // $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->count();
    // $ProyectoForoAlumno = ProyectoForoAlumno::all();
    // $alumnoss = ProyectoForoAlumno::where('id_alumno', $id)->first();
    $proyect= DB::TABLE('alumnos')->select('id_proyecto')->where('id',$alumno)->first();
    $p=$proyect->id_proyecto;
    $proyecto= db::table('proyectos')->where('id',$p)->get();
    $idforo= db::table('proyectos')->select('id_foro')->where('id',$p)->first();
    $idf=$idforo->id_foro;
    $foro =db::table('foros')->select('noforo')->where('id',$idf)->first();


    return view('alumno.proyectosForo', compact('proyecto', 'alumno','foro'));
  }
  public function proyectoDescripcionAlumno($id)
  {
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get()->count();
    $id = Crypt::decrypt($id);
    $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    $alumnoenproyecto = ProyectoForoAlumno::all();
    $alumno = alumno::all();
    $docente = Docente::all();
    $foro = Foro::find($ProyectoForoAlumno->id_foro);
    $proyectoForo = ProyectoForo::find($ProyectoForoAlumno->id_proyecto);
    $Forodoncente = Forodoncente::all();
    return view('alumno.proyectoDescripcion', compact('foro', 'proyectoForo', 'ProyectoForoAlumno', 'notificacione', 'alumnoenproyecto', 'alumno', 'docente', 'Forodoncente'));
  }

  public function notificaciones()
  {
    $alumno = Alumno::all();
    $notificacione = 0;//Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get()->count();
    $noticia = 0;//Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get();
    return view('alumno.notificacion', compact('notificacione', 'noticia', 'alumno'));
  }

  public function confirmar($id)
  {
    $id = Crypt::decrypt($id);
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get()->count();

    $proyectoForoAlumno = Notificacione::find($id);
    $ProyectoForoAlumno = new ProyectoForoAlumno;
    $ProyectoForoAlumno->id_foro = $proyectoForoAlumno->id_foro;
    $ProyectoForoAlumno->id_proyecto = $proyectoForoAlumno->id_proyecto;
    $ProyectoForoAlumno->id_alumno = $proyectoForoAlumno->id_alumno;
    $ProyectoForoAlumno->titulo = $proyectoForoAlumno->titulo;
    $ProyectoForoAlumno->foro = $proyectoForoAlumno->foro;
    $ProyectoForoAlumno->objetivo = $proyectoForoAlumno->objetivo;
    $ProyectoForoAlumno->save();
    $alumno = Alumno::where('nombre', Auth::guard('alumnos')->user()->nombre)->first();
    $alumno->acceso = 1;
    $alumno->save();

    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->delete();

    return redirect("alumno");
  }

  public function proyectosubir($id)
  {
    $id = Crypt::decrypt($id);
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get()->count();
    $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    $foro = Foro::find($ProyectoForoAlumno->id_foro);
    $proyectoForo = ProyectoForo::find($ProyectoForoAlumno->id_proyecto);
    return view('alumno.subirProcolo', compact('foro', 'proyectoForo', 'ProyectoForoAlumno', 'notificacione'));
  }


  public function SubirProtocolo($id)
  {
    $id = Crypt::decrypt($id);
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get()->count();
    $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    $foro = Foro::find($ProyectoForoAlumno->id_foro);
    $proyectoForo = ProyectoForo::find($ProyectoForoAlumno->id_proyecto);
    return view('alumno.SubirProtocolo', compact('foro', 'proyectoForo', 'ProyectoForoAlumno', 'notificacione'));
  }


  public function SubirDiapositiva($id)
  {
    $id = Crypt::decrypt($id);
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get()->count();
    $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    $foro = Foro::find($ProyectoForoAlumno->id_foro);
    $proyectoForo = ProyectoForo::find($ProyectoForoAlumno->id_proyecto);
    return view('alumno.SubirDiapositiva', compact('foro', 'proyectoForo', 'ProyectoForoAlumno', 'notificacione'));
  }


  public function SubirSeminario($id)
  {
    $id = Crypt::decrypt($id);
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->get()->count();
    $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    $foro = Foro::find($ProyectoForoAlumno->id_foro);
    $proyectoForo = ProyectoForo::find($ProyectoForoAlumno->id_proyecto);
    return view('alumno.SubirSeminario', compact('foro', 'proyectoForo', 'ProyectoForoAlumno', 'notificacione'));
  }

  public function save(Request $request, $id)
  {

    $validator = $this->validate(request(), [
      'protocolo' => 'required',
    ]);

    $id = Crypt::decrypt($id);

    $archivo = Archivo::where('id_proyecto', $id)->first();

    //obtenemos el campo file definido en el formulario
    $file = $request->file('protocolo');

    //obtenemos el nombre del archivo
    $nombre = $id . time() . $file->getClientOriginalName();

    if ($archivo == null) {
      $Archivo_foro = new Archivo;
      $Archivo_foro->id_proyecto = $id;
      $Archivo_foro->archivo = $nombre;
      $Archivo_foro->save();
      //indicamos que queremos guardar un nuevo archivo en el disco local
      \Storage::disk('pdfOficina')->put($nombre,  \File::get($file));
    } else {
      $archivo->archivo = $nombre;
      $archivo->save();
      \Storage::disk('pdfOficina')->put($nombre,  \File::get($file));
    }

    return redirect("alumno");
  }

  public function save1(Request $request, $id)
  {

    $validator = $this->validate(request(), [
      'protocolo' => 'required',
    ]);

    $id = Crypt::decrypt($id);
    $archivo = Archivo::where('id_proyecto', $id)->first();


    //obtenemos el campo file definido en el formulario
    $file = $request->file('protocolo');

    //obtenemos el nombre del archivo
    $nombre = $id . time() . $file->getClientOriginalName();

    //indicamos que queremos guardar un nuevo archivo en el disco local

    if ($archivo == null) {
      $Archivo_foro = new Archivo;
      $Archivo_foro->id_proyecto = $id;
      $Archivo_foro->archivo1 = $nombre;
      $Archivo_foro->save();
      \Storage::disk('pdfOficina')->put($nombre,  \File::get($file));
    } else {
      $archivo->archivo1 = $nombre;
      $archivo->save();
      \Storage::disk('pdfOficina')->put($nombre,  \File::get($file));
    }


    return redirect("alumno");
  }

  public function save2(Request $request, $id)
  {

    $validator = $this->validate(request(), [
      'protocolo' => 'required',
    ]);

    $id = Crypt::decrypt($id);
    $archivo = Archivo::where('id_proyecto', $id)->first();


    //obtenemos el campo file definido en el formulario
    $file = $request->file('protocolo');

    //obtenemos el nombre del archivo
    $nombre = $id . time() . $file->getClientOriginalName();



    if ($archivo == null) {
      $Archivo_foro = new Archivo;
      $Archivo_foro->id_proyecto = $id;
      $Archivo_foro->archivo2 = $nombre;
      $Archivo_foro->save();
      //indicamos que queremos guardar un nuevo archivo en el disco local
      \Storage::disk('pdfOficina')->put($nombre,  \File::get($file));
    } else {
      $archivo->archivo2 = $nombre;
      $archivo->save();
      //indicamos que queremos guardar un nuevo archivo en el disco local
      \Storage::disk('pdfOficina')->put($nombre,  \File::get($file));
    }

    return redirect("alumno");
  }
  public function dictamen()
  {
    $proyectos = ProyectoForo::all();

    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->count();

    $vista = true;

    return view('alumno.dictamen', compact('proyectos', 'notificacione', 'vista'));
  }

  public function download()
  {
    $proyectos = ProyectoForo::all();
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->count();
    $pdf = \PDF::loadView('alumno.dictamenDownload', compact('proyectos', 'notificacione'));

    return $pdf->download();
  }

  public function mostrarEvaluacion($id)
  {
    $hoja = Hoja::findOrFail($id);
    $notificacione = Notificacione::where('id_alumno', Auth::guard('alumnos')->user()->id)->where('envio', 1)->count();

    return view('alumno.mostrarEvaluacion', compact('notificacione', 'hoja'));
  }
  public function horario(){

    $alumno = Auth::id();
    $name= DB::table('alumnos')->select('nombre','paterno','materno','id_proyecto')->where('id',$alumno)->first();
    
    $idproyecto=DB::table('alumnos')->select('id_proyecto')->where('id',$alumno)->first();
    $id=$idproyecto->id_proyecto;
    $clave=DB::table('proyectos')->select('id_proyecto')->where('id',$id)->first();
    $id_prefijo=$clave->id_proyecto;
    // dd($id_prefijo);

    // dd($id);
    $horario= DB::table('horariogenerado')->select('fecha','hora','salon')->where('id_proyecto',$id)->first();
    // dd($horario);
    return view('alumno.horariogeneradoAlumno',compact('horario','name','id_prefijo'));

  }


//sunny

public function EstadoDeProyectoAlumno($id)
{

  $alumno = Auth::id();
  
  $name= DB::table('alumnos')->select('nombre','paterno','materno','id_proyecto')->where('id',$alumno)->first();
  //dd($name);
  $control= DB::table('alumnos')->select('nocontro','id_proyecto','nombre','paterno','materno','id_proyecto')->where('id',$alumno)->first();
  
  $idp =  DB::table('alumnos')->select('id_proyecto')->where('id','=',$alumno)->first();
  //var_dump( $idp );
  //$stm->bindValue(":id",$rut);
  $bar = (array) $idp; 

  //$gsent->fetchColumn();
 // dd($idp);
 $jurado = DB::table('jurados')->select('id')->where('id_proyecto',$bar)->get();
 //dd($jurado);

  $proyectos = DB::table('proyectos')->select('titulo')->where('id',$bar)->first();
 
  //$proyectos = DB::table('proyectos')->select('id')->where('id_proyecto',$alumno)->first();

  //dd($proyectos);
  return view('alumno.estadoAlumno',compact('alumno','name','control','proyectos','jurado'));
}

public function solicitarResidencia($id)
{

  $alumno = Auth::id();
  
  $name= DB::table('alumnos')->select('nombre','paterno','materno','id_proyecto')->where('id',$alumno)->first();
  //dd($name);
  $control= DB::table('alumnos')->select('nocontro','id_proyecto','nombre','paterno','materno','id_proyecto')->where('id',$alumno)->first();
  
  $idp =  DB::table('alumnos')->select('id_proyecto')->where('id','=',$alumno)->first();
  //var_dump( $idp );
  //$stm->bindValue(":id",$rut);
  $bar = (array) $idp; 

  //$gsent->fetchColumn();
 // dd($idp);
 $jurado = DB::table('jurados')->select('id')->where('id_proyecto',$bar)->get();
 //dd($jurado);

  $proyectos = DB::table('proyectos')->select('titulo')->where('id',$bar)->first();
  $asesor = DB::table('proyectos')->select('id_asesor')->where('id',$bar)->first();
  $bar2 = (array) $asesor; 
  $asesorP = DB::table('docentes')->select('prefijo','nombre','paterno','materno')->where('id',$bar2)->first();
  //dd($asesorP);
  
  //$proyectos = DB::table('proyectos')->select('id')->where('id_proyecto',$alumno)->first();

  //dd($proyectos);
  return view('alumno.solicitarResidencia',compact('alumno','name','control','proyectos','jurado','asesor','asesorP'));
}


public function EstadoDeProyectoAlumno2($id)
{
  $notificacione=Notificacione::where('id_alumno',Auth::guard('alumnos')->user()->id)->where('envio',1)->get()->count();
  $id =Crypt::decrypt($id);
  //$ProyectoForoAlumno = ProyectoForoAlumno::find($id);
  $ProyectoForoAlumno = ProyectoForoAlumno::where('id_alumno', '=', $id)->first();
  $alumnoenproyecto = ProyectoForoAlumno::all();
  $alumno = alumno::all();
  $docente = Docente::all();
 // $docente = Docente::find($id);
  $foro=Foro::find($ProyectoForoAlumno->id_foro);
  $proyectoForo=ProyectoForo::find($ProyectoForoAlumno->id_proyecto);
  $Forodoncente=Forodoncente::all();


  $proyectos = ProyectoForo::all();
  //dd($proyectoForo);
  return view('alumno.estadoAlumno',compact('foro','proyectoForo','ProyectoForoAlumno','notificacione','alumnoenproyecto','alumno','docente','Forodoncente','proyectos'));
}


public function registroIr($id)
{
  $id =Crypt::decrypt($id);
  $notificacione=Notificacione::where('id_alumno',Auth::guard('alumnos')->user()->id)->where('envio',1)->count();
  $ProyectoForoAlumno = ProyectoForoAlumno::all();
  $alumnoss=ProyectoForoAlumno::where('id_alumno',$id)->first();
  return view('alumno.proyectosForo',compact('ProyectoForoAlumno','alumnoss','notificacione'));

}



public function detalleSeminario($id)
{

  $proyectos = ProyectoForo::all();

    $notificacione=Notificacione::where('id_alumno',Auth::guard('alumnos')->user()->id)->where('envio',1)->count();

    $vista = true;

    return view('alumno.dictamen', compact('proyectos', 'notificacione', 'vista'));
  
}





}
