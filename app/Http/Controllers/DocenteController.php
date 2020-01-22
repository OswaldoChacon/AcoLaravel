<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
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
use App\Tipo_cambio;
use App\Alumno;
use App\Juradotwo;
use Auth;
use DB;


use App\ProyectoForoAlumno;

class DocenteController extends Controller
{

  public function __construct()
	{
        $this->middleware('auth:docentes');

	}
     public function index()
    {
       $notificacione=Notificacione::where('id_alumno_recibe',Auth::guard('docentes')->user()->id)->count();
      //  ->where('envio',2)
        return view('docentes.docente',compact('notificacione'));

    }
    public function registaralumno()
    {
      $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->count();
    	return view('docentes.registaralumno',compact('notificacione'));
    }
    public function profes(Request $request)
    {
       $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->count();
      $doc=Docente::all();
       $validator = $this->validate(request(),[
        'tokenN' => 'required',
      ]);
        $tokenN=$request->tokenN;
       if ($tokenN!=0) {
          return view('docentes.dartokenAlumno',compact('tokenN','doc','notificacione'));
       }
       else
       {
        return view('docentes.registaralumno',compact('notificacione'));
       }


    }

    public function dartokenAlumnoP(Request $request)
    {
      $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->count();
        $doc=Docente::all();
        $nocontrol=count($request->nocontrol, COUNT_RECURSIVE);
        $uso=0;
        $con=0;
         for ($i=0; $i <$nocontrol ; $i++)
         {
          $token=Tokenalumno::where('numerocontrol',$request->nocontrol[$i])->first();
           if($token==null)
              {
                if($request->nocontrol[$i]!=null)
                {
               DB::table('tokenalumnos')->insert([
               ['numerocontrol'=>$request->nocontrol[$i],
               'uso'=>$uso,
                'profe'=>Auth::guard('docentes')->user()->id,
                'grupo'=>$request->grupo,],
                ]);
             }

             }else
             {
               $con++;
              $error[$i]=$token->numerocontrol;
              $errors = implode("-", $error);
             }
         }
         if($con>0)
         {
           $tokenN=count($request->nocontrol, COUNT_RECURSIVE)-$con;
          Session::flash('message',$errors);
         return view('docentes.dartokenAlumno',compact('tokenN','doc','notificacione'));
         }
         else
         {
          Session::flash('message',"Usuarios Registrados");
           return redirect("registaralumno");
         }
    }


     public function editar($id)
    {
       $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->count();
      $docente = Docente::find($id);
      return view('docentes.editar',compact('docente','notificacione'));
    }

     public function guardar(Request $request , $id)
    {

      $validator = $this->validate(request(),[
        'name' => 'required',
        'email' => 'email|required',
        'nombre' => 'required',
        'paterno' => 'required',
        'materno' => 'required',
        'prefijo' => 'required',
        'password' => 'required',
      ]);


      $docente = Docente::find($id);
      $docente->name = $request->name;
      $docente->email = $request->email;
      $docente->nombre = $request->nombre;
      $docente->paterno = $request->paterno;
      $docente->materno = $request->materno;
      $docente->prefijo = $request->prefijo;
      $docente->password = Hash::make($request->password);
      $docente->save();

       return view ('docentes.docente', compact('docente'));
    }

    public function notificaciones()
    {
      $alumno=Alumno::all();
      $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();
      $noticia= Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get();
        return view('docentes.notificacion',compact('notificacione','noticia','alumno'));
    }

    public function confirmar($id)
    {
      $id =Crypt::decrypt($id);
      $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();
      $proyectoForoAlumno = Notificacione::find($id);
       $Proyecto = ProyectoForo::find($proyectoForoAlumno->id_proyecto);
        $Proyecto->assesor=$proyectoForoAlumno->id_alumno;
        $Proyecto->save();
        $proyectoForoAlumno = Notificacione::find($id)->delete();

        return redirect("docente");
    }


     public function proyectoDocentes()
    {
      $Proyecto= Proyecto::where('id_asesor',2);
      $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();
        return view('docentes.proyectosForo',compact('notificacione','ProyectoForo'));
    }


    public function proyectoDescripcionDocente($id)
    {
      $id =Crypt::decrypt($id);
      $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();
       $pro=ProyectoForo::where('id',$id)->first();
     $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
      $alumnoenproyecto = ProyectoForoAlumno::all();
      $alumno = alumno::all();
      $docente = Docente::all();
       $Forodoncente=Forodoncente::all();
      $foro=Foro::find($ProyectoForoAlumno->id_foro);
      $proyectoForo=ProyectoForo::find($pro->id);
      return view('docentes.proyectoDescripcion',compact('foro','proyectoForo','ProyectoForoAlumno','notificacione','alumnoenproyecto','alumno','docente','Forodoncente'));

    }

    public function archivo($id)
    {
       $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();
       $user = Archivo::where('id_proyecto',$id)->first();
       if ($user!=null)
        {
          $archivo=$user->archivo;
       $public_path = public_path();
       $url = '/storage/'.$archivo;
         # code...
     //verificamos si el archivo existe y lo retornamos
       return view('docentes.documento',compact('archivo','notificacione','url'));
      }
      else
      {
          return view('docentes.docente',compact('notificacione'));
      }
     }
     public function archivo1($id)
    {
       $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();
       $user = Archivo::where('id_proyecto',$id)->first();
       if ($user!=null)
        {
       $archivo1=$user->archivo1;
       $public_path = public_path();
       $url = '/storage/'.$archivo1;
     //verificamos si el archivo existe y lo retornamos

       return view('docentes.documento1',compact('archivo1','notificacione','url'));
        }
        else
      {
          return view('docentes.docente',compact('notificacione'));
      }
     }
     public function archivo2($id)
    {
       $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();
       $user = Archivo::where('id_proyecto',$id)->first();
       if ($user!=null)
        {
       $archivo2=$user->archivo2;
       $public_path = public_path();
       $url = '/storage/'.$archivo2;
     //verificamos si el archivo existe y lo retornamos

       return view('docentes.documento2',compact('archivo2','notificacione','url'));
        }
        else
      {
          return view('docentes.docente',compact('notificacione'));
      }

     }

  public function showprojects()
  {
      $docente = Docente::where('id', Auth::guard('docentes')->user()->id)->first();

      $notificacione=Notificacione::where('id_alumno',Auth::guard('docentes')->user()->id)->where('envio',2)->get()->count();

      return view('docentes.index', compact('notificacione', 'docente'));
  }
  public function horario(){
    $docente = Auth::id();
    $name= DB::table('docentes')->select('prefijo','nombre','paterno','materno')->where('id',$docente)->first();
    $horario= DB::table('horariogenerado')->select('horariogenerado.fecha','horariogenerado.hora','horariogenerado.id_proyecto','horariogenerado.salon',
    'proyectos.id as idp',
    'proyectos.id_proyecto as idpp'
    )
    ->join('proyectos','horariogenerado.id_proyecto','=','proyectos.id')
    ->where('id_docente',$docente)->get();
    if ($horario == null){
        Session::flash('mensages', "AÚN NO TIENE UN HORARIO ASIGNADO PARA SU PARTICIPACIÓN ");
        Session::flash('alert-class', 'alert-warning');
    }
    // dd($horario);
    // dd($horario);
    return view('docentes.horariogeneradoDocente',compact('horario','name'));

  }




  public function obtenerProyectos(){
    
   // $foros = DB::table('foros')->get();
    $foros=Foro::all();
    $docente =Auth::id();

    
    //dd($docente);
    
    $idp =  DB::table('jurados')->select('id_proyecto')->where('id_docente','=',$docente)->first();
    $idp2 = DB::table('jurados')->where('id_docente','=',$docente)->get();
    $nombreProyecto = DB::table('proyectos')->select('id','titulo')->get();
    
    $proyectos=Foro::all();

   // $idp2 = DB::table('jurados')->select('id_proyecto')->where('id_docente',$docente)->get();
 
    //$proyectos = ProyectoForo::all();
   //dd($idp2);
   //$user = User::find(Auth()->user()->id);
   $bar2 = (array) $idp2;  // hasta aqui obtengo los ids de los prouyectos que tiene el docente
   //dd($bar2);
   $proyectos = ProyectoForo::all();
   //$proyectos = DB::table('proyectos')->select('id','titulo')->where('id',$idp2)->get();
   //$proyectos = ProyectoForo::where('id',$idp2)->get();
  // $alumnoss=ProyectoForoAlumno::where('id_alumno',$id)->first();
 //dd($proyectos);
    //dd($bar2);
  //dd($proyectos);
    //dd($idp2nuevo);
    
    //dd($alvp);
  
 //dd($alvp);
    $name=DB::table('docentes')->select('prefijo','nombre','paterno','materno')->where('id',$docente)->first();

    //  dd($name);
   //retornaria a return view('seminario.jurados.vistaproyectoDoc',compact('foros'));
    return view('docentes.vistaProyectosDoc',compact('name','foros','idp2','proyectos','idp','nombreProyecto'));

  }


  public function datelleSeguimiento(Request $request, $id_pro){
    
    // $foros = DB::table('foros')->get();
    //$inputs=Input::all();
    //$escritor_id = $inputs['id_pro'];
   
    
    //dd($id_pro);
     $foros=Foro::all();
     $docente =Auth::id();
   


     
     $idp =  DB::table('jurados')->select('id_proyecto')->where('id_docente','=',$docente)->first();
     $idp2 = DB::table('jurados')->where('id_docente','=',$docente)->get();
    $bar2 = (array) $idp2;  // hasta aqui obtengo los ids de los prouyectos que tiene el docente
    //dd($bar2);
    //$idp3=DB::table('proyectos')
    $proyectos = ProyectoForo::all();

     $name=DB::table('docentes')->select('prefijo','nombre','paterno','materno')->where('id',$docente)->first();
     $proyecto = DB::table('proyectos')->where('id','=',$id_pro)->get();
     $alumno = DB::table('alumnos')->where('id_proyecto','=',$id_pro)->get();

     $consultarResi = DB::table('residencias')->select('id','id_alumno','lugar','solicitado')->where('id',$id_pro)->first();
  
     //dd($proyecto);
     
     return view('docentes.detalleSegui',compact('name','foros','idp2','proyectos','idp','proyecto','alumno','consultarResi'));
 
   }
 
   public function notificacionesCambios()
    {
       
      $uso=0;
      $docente =Auth::id();
      $tipocambio =DB::table('tipo_cambios')->select('id_tipocambio','nombre_cambio')->get();
     //dd($tipocambio);
   //  $proyecto = DB::table('proyectos')->where('id_asesor','=',$docente)->get();
      $proyecto = DB::table('proyectos')->select('id')->where('id_asesor','=',$docente)->get()->toArray(); 
    //dd($proyecto);

     


      $con = DB::table('proyectos')->select('id')->where('id_asesor',$docente)->get();
      $bar2 = (array) $proyecto; 
     //dd($bar2);
      //tengo que obtener el id del docente y buscarlo a que proyecto pertenece al saber que proyecto es 
      // debo buscar en la tabla bitacoras el tipo de resolucion que tiene si tiene 0 me debe mostrar la notificacion
      //y yo al aceptar se guarda los datos en la tabla aceptacion_asesor
      //por cambio solo debe aparecer una respuesta de assor.(en cuestion de alumno este debe checar cuantos partisipantes hay y abace de eso cuantas respuestabas deben haber para que se pueda mostrar la notificacion a la oficina )
  
     $control= DB::table('bitacoras')->select('id_proyecto')->where('resolucion','=',$uso)->get()->toArray(); 
     $datos= DB::table('bitacoras')->select('id_proyecto','motivo')->where('resolucion','=',$uso)->get();
    
   
    
    
     $datosProyectos= DB::table('bitacoras')->select('id_proyecto','motivo','id_tipocambio')->where('id_asesor','=',$docente)->get();

     $datosidtipo= DB::table('bitacoras')->select('id_tipocambio')->where('id_asesor','=',$docente)->get();

     //dd($datosidtipo, $datosProyectos);
  
  
  
  
  
  
  
     // $control= DB: $datosProyectos:table('bitacoras')->select('motivo','id_proyecto','id_tipocambio')->where('id_proyecto','=',$proyecto)->get();
    // $bar3 = (array) $control; 
     $variable = (array) $control; 
    //dd( $datosProyectos);
    //dd($proyecto,$control);

   // $articulos = array();
   // $articulos2 = array();
    $articulos[] = $control;
    $articulos2[] = $proyecto;
    //dd($articulos,$articulos2);
    $bar2 = (array) $articulos; 
    $bar3 = (array) $articulos2; 
  // $result = array_intersect($bar2, $bar3);
 
    //$bar = (array) $result; 
  //  dd($bar2,$bar3);


        return view('docentes.notificacionesCambios',compact('control','proyecto','bar2','bar3','datos','datosProyectos','tipocambio'));
    }


    public function datellSolicitudCambios(Request $request, $id_pro){
    
      // $foros = DB::table('foros')->get();
      //$inputs=Input::all();
      //$escritor_id = $inputs['id_pro'];
      $datos= DB::table('bitacoras')->select('id_proyecto','motivo','dato_anterior','dato_nuevo')->where('id_proyecto','=',$id_pro)->get();
      
      //dd($datos);
    
    
       
       
       return view('docentes.detalleSolicitudCambios',compact('datos'));
    
     }

}
