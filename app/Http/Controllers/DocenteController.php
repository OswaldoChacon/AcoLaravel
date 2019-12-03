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
use App\Alumno;
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
    return view('docentes.horariogeneradoDocente',compact('horario','name'));

  }
}
