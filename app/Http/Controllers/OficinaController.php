<?php

namespace App\Http\Controllers;

use App\Horarioforo;
use App\Alumno;
use App\Archivo;
use App\Aredeconocimiento;
use App\Docente;
use App\Foro;
use App\Forodoncente;
use App\Hoja;
use App\Horariodocente;
use App\Jurado;
use App\Lineadeinvestigacion;
use App\ProyectoForo;
use App\ProyectoForoAlumno;
use App\Tokenalumno;
use App\Tokendocente;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mail;
use SebastianBergmann\Environment\Console;

class OficinaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    return view('oficina.oficina');
  }
  public function tokenAlumno()
  {
    $tokealumno = Tokenalumno::all();
    return view('oficina.tokenAlumno', compact('tokealumno'));
  }

  public function tokenProfe()
  {
    $tokendocente = Tokendocente::all();
    return view('oficina.tokenProfe', compact('tokendocente'));
  }
  public function alumno(Request $request)
  {
    $doc = Docente::all();
    $validator = $this->validate(request(), [
      'tokenN' => 'required',
    ]);

    $tokenN = $request->tokenN;
    if ($tokenN != 0) {

      return view('oficina.dartokenAlumno', compact('tokenN', 'doc'));
    } else {
      $tokealumno = Tokenalumno::all();
      return view('oficina.tokenAlumno', compact('tokealumno'));
    }
  }
  public function alumnos()
  {
    $alumnos = Alumno::all();
    return view('oficina.alumnos', compact('alumnos'));
  }

  public function profes()
  {  
    $profes = DB::table('docentes')->select('docentes.*')        
    ->selectRaw('group_concat(horariodocentes.fecha) as fechas,
    group_concat(horariodocentes.hora_entrada) as hora_entrada,
    group_concat(horariodocentes.hora_salida) as hora_salida,
    count(horariodocentes.hora_salida) as numberFechas')    
    ->leftjoin('horariodocentes','docentes.id','=','horariodocentes.id_docente')    
    ->groupBy('docentes.id')  
    ->get();
    
    // codigo extra
    foreach($profes as $profe)
    {
      $profe->fechas = explode(',',$profe->fechas);
      $profe->hora_entrada = explode(',',$profe->hora_entrada);
      $profe->hora_salida = explode(',',$profe->hora_salida);
    }   
    return view('oficina.profesores', compact('profes'));    
  }
  public function profe(Request $request)
  {
    $validator = $this->validate(request(), [
      'tokenN' => 'required',
    ]);
    $tokenN = $request->tokenN;
    if ($tokenN != 0) {
      return view('oficina.dartokenProfe', compact('tokenN'));
    } else {
      $tokendocente = Tokendocente::all();
      return view('oficina.tokenProfe', compact('tokendocente'));
    }
  }

  public function dartokenAlumno(Request $request)
  {
    $doc = Docente::all();
    $nocontrol = count($request->nocontrol, COUNT_RECURSIVE);
    $uso = 0;
    $con = 0;
    for ($i = 0; $i < $nocontrol; $i++) {
      $token = Tokenalumno::where('numerocontrol', $request->nocontrol[$i])->first();
      if ($token == null) {
        if ($request->nocontrol[$i] != null) {
          DB::table('tokenalumnos')->insert([
            [
              'numerocontrol' => $request->nocontrol[$i],
              'uso' => $uso,
              'profe' => $request->profe,
              'grupo' => $request->grupo,
            ],
          ]);
        }
      } else {
        $con++;
        $error[$i] = $token->numerocontrol;
        $errors = implode("-", $error);
      }
    }
    if ($con > 0) {
      $tokenN = count($request->nocontrol, COUNT_RECURSIVE) - $con;
      Session::flash('message', $errors);
      return view('oficina.dartokenAlumno', compact('tokenN', 'doc'));
    } else {
      Session::flash('message', "Usuarios Registrados");
      return redirect("tokenAlumno");
    }
  }


  public function dartokenProfe(Request $request)
  {
    $email = count($request->emails, COUNT_RECURSIVE);
    $uso = 0;
    $con = 0;
    for ($i = 0; $i < $email; $i++) {
      $token = Tokendocente::where('id_usuario', $request->emails[$i])->first();
      if ($token == null) {
        if ($request->emails[$i] != null) {
          DB::table('tokendocentes')->insert([
            [
              'token' => Str::random(),
              'uso' => $uso,
              'id_usuario' => $request->emails[$i],
            ],
          ]);
          $correo = $request->emails[$i];
          $data = array(
            'name' => 'Registro de Docentes',
          );
          Mail::send('oficina.enviar', $data, function ($message) use ($correo) {
            $message->from('ricardonarvaez13@gmail.com', 'Registro de Docentes');
            $message->to($correo)->subject('Pagina de registro');
          });
        }
      } else {
        $con++;
        $error[$i] = $token->id_usuario;
        $errors = implode("    ---    ", $error);
      }
    }
    if ($con > 0) {
      $tokenN = count($request->emails, COUNT_RECURSIVE) - $con;
      Session::flash('message', $errors);
      return view('oficina.dartokenProfe', compact('tokenN'));
    } else {
      Session::flash('message', "Usuarios Registrados");
      $tokendocente = Tokendocente::all();
      return redirect("tokenProfe");
    }
  }

  public function editar($id)
  {
    $id = Crypt::decrypt($id);
    $user = User::find($id);
    return view('oficina.editar', compact('user'));
  }
  // 
  // 
  // 
  // 
  public function guardar(Request $request, $id)
  {

    $validator = $this->validate(request(), [
      'name' => 'required',
      'email' => 'email|required',
      'nombre' => 'required',
      'paterno' => 'required',
      'materno' => 'required',
      'prefijo' => 'required',
      'password' => 'required',
    ]);


    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->nombre = $request->nombre;
    $user->paterno = $request->paterno;
    $user->materno = $request->materno;
    $user->prefijo = $request->prefijo;
    $user->password = Hash::make($request->password);
    $user->save();
    return view('oficina.oficina');
  }

  public function lineaDeInvetigacion(Request $request)
  {
    $lineadeinvestigacion = Lineadeinvestigacion::all();
    return view('oficina.lineadeinvestigacion', compact('lineadeinvestigacion'));
  }

  public function lineaDeInvetigacionguardar(Request $request)
  {
    $validator = $this->validate(request(), [
      'clave' => 'required',
      'linea' => 'required',
    ]);

    $linea1 = Lineadeinvestigacion::where('clave', $request->clave)->first();
    $linea2 = Lineadeinvestigacion::where('clave', $request->clave)->first();
    if ($linea1 == null && $linea2 == null) {

      DB::table('lineadeinvestigacions')->insert([
        [
          'clave' => $request->clave,
          'linea' => $request->linea,
        ]
      ]);

      Session::flash('message1', "Linea de Investigacion Registrados");
      $lineadeinvestigacion = Lineadeinvestigacion::all();
      return view('oficina.lineadeinvestigacion', compact('lineadeinvestigacion'));
    } else {
      Session::flash('message', "Linea ya existentes");
      $lineadeinvestigacion = Lineadeinvestigacion::all();
      return view('oficina.lineadeinvestigacion', compact('lineadeinvestigacion'));
    }
  }


  public function areadeconocimiento(Request $request)
  {
    $areadeconocimiento = Aredeconocimiento::all();
    $lineadeinvestigacion = Lineadeinvestigacion::all();
    return view('oficina.areadeconocimiento', compact('lineadeinvestigacion', 'areadeconocimiento'));
  }

  public function areadeconocimientoguardar(Request $request)
  {
    $validator = $this->validate(request(), [
      'area' => 'required',
    ]);
    if ($request->select != null) {
      DB::table('aredeconocimientos')->insert([
        [
          'linea' => $request->select,
          'areade' => $request->area,
        ]
      ]);

      $areadeconocimiento = Aredeconocimiento::all();
      $lineadeinvestigacion = Lineadeinvestigacion::all();
      return view('oficina.areadeconocimiento', compact('lineadeinvestigacion', 'areadeconocimiento'));
    } else {
      $areadeconocimiento = Aredeconocimiento::all();
      $lineadeinvestigacion = Lineadeinvestigacion::all();
      return view('oficina.areadeconocimiento', compact('lineadeinvestigacion', 'areadeconocimiento'));
    }
  }
  public function crearForo(Request $request)
  {
    return view('oficina.foros.crearForo');
  }
  public function guardarForo(Request $request)
  {
    $validator = $this->validate(request(), [
      'noforo' => 'required',
      'titulo' => 'required',
      'periodo' => 'required',
      'anoo' => 'required',
    ]);
    $doc = Docente::all();
    $tama = count($doc, COUNT_RECURSIVE);
    $user = User::find(1);
    $user1 = $user->prefijo . '  ' . $user->nombre . '  ' . $user->paterno . '  ' . $user->materno;
    $foro = Foro::where('noforo', $request->noforo)->first();
    if ($foro == null) {
      $acc = Foro::where('acceso', 1)->first();
      if ($acc != null) {
        $acc->acceso = 0;
        $acc->save();
      }
      for ($i = 0; $i < $tama; $i++) {
        $docenteacceso = Docente::where('acceso', 1)->first();
        if ($docenteacceso != null) {
          $docenteacceso->acceso = 0;
          dd($docenteacceso);
          $docenteacceso->save();
        }
      }
      DB::table('foros')->insert([
        [
          'noforo' => $request->noforo,
          'titulo' => $request->titulo,
          'periodo' => $request->periodo,
          'anoo' => $request->anoo,
          'oficina' => $user1,
          'acceso' => 1,
          'accesosecundario' => 1,

        ],
      ]);
      Session::flash('message', "Foro Creado");
      $foro = Foro::all();
      return view('oficina.foros', compact('foro'));
    } else {
      Session::flash('message', "Numero de foro ya existentes");
      return view('oficina.foros.crearForo');
    }
  }

  public function foros()
  {
    $foro = Foro::all();
    return view('oficina.foros', compact('foro'));
  }
  public function configurarForo($id)
  {
    $id = Crypt::decrypt($id);
    $docente = Docente::all();
    $foro = Foro::find($id);
    $horarioForo = $foro->forohoras()->where('id_foro', $id)->get();
    $forodoncente = Forodoncente::all();
    // $horarioForo = 
    return view('oficina.foros.configurarForo', compact('foro', 'docente', 'forodoncente', 'horarioForo'));
  }

  public function agregarProfeAforo(Request $request, $id)
  {
    $id = Crypt::decrypt($id);
    $docentes = Docente::find($request->maestro);
    $foro = Foro::find($id);
    DB::table('forodoncentes')->insert([
      [
        'id_foro' => $foro->noforo,
        'id_profe' => $request->maestro,
        'n_profe' => $docentes->nombre . ' ' . $docentes->paterno . ' ' . $docentes->materno,
      ]
    ]);
    $docentes->acceso = 1;
    $docentes->save();
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");
  }
  public function activar($id)
  {
    $id = Crypt::decrypt($id);
    $activar = Foro::find($id);
    $activar->accesosecundario = 1;
    $activar->save();
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");
  }
  public function desactivar($id)
  {
    $id = Crypt::decrypt($id);
    $doc = Docente::all();
    $tama = count($doc, COUNT_RECURSIVE);
    $activar = Foro::find($id);
    $activar->acceso = 0;
    $activar->accesosecundario = 0;
    $activar->save();

    $docenteacceso = Docente::where('acceso', 1)->first();
    if ($docenteacceso != null) {
      $docenteacceso->acceso = 0;
      $docenteacceso->save();
    }
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");
  }

  public function proyecto($id)
  {

    $id = Crypt::decrypt($id);
    $proyectoForo = ProyectoForo::all();
    $docentes = Docente::all();
    return view('oficina.proyectosForo', compact('proyectoForo', 'id', 'docentes'));
  }

  public function proyectoDescripcion($id)
  {
    $id = Crypt::decrypt($id);
    $pro = ProyectoForo::where('id', $id)->first();
    $proyectoForo = ProyectoForo::find($id);
    $foro = Foro::find($proyectoForo->id_foro);
    $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    $alumnoenproyecto = ProyectoForoAlumno::all();
    $alumno = alumno::all();
    $docente = Docente::all();
    $Forodoncente = Forodoncente::all();
    $foro = Foro::find($ProyectoForoAlumno->id_foro);
    $proyectoForo = ProyectoForo::find($pro->id);
    //return view('oficina.proyectoDescripcion',compact('foro','proyectoForo','ProyectoForoAlumno','notificacione','alumnoenproyecto','alumno','docente','Forodoncente'));
    return view('oficina.proyectoDescripcion', compact('foro', 'proyectoForo', 'ProyectoForoAlumno', 'alumnoenproyecto', 'alumno', 'docente', 'Forodoncente'));
  }
  public function actulizar(Request $r, $id)
  {
    $id = Crypt::decrypt($id);
    $activar = Foro::find($id);
    $activar->no_alumnos = $r->no_alumnos;
    $activar->no_profesores = $r->no_profesores;
    $activar->save();
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");
  }

  public function archivoForo($id)
  {
    $user = Archivo::where('id_proyecto', $id)->first();
    if ($user != null) {
      $archivo = $user->archivo;
      $public_path = public_path();
      $url = '/storage/' . $archivo;
      //verificamos si el archivo existe y lo retornamos

      return view('oficina.documento', compact('archivo', 'notificacione', 'url'));
    } else {
      Session::flash('message', "Documentacion vacio");
      return redirect("/");
    }
  }

  public function archivoForo1($id)
  {
    $user = Archivo::where('id_proyecto', $id)->first();
    if ($user != null) {
      $archivo = $user->archivo1;
      $public_path = public_path();
      $url = '/storage/' . $archivo;
      //verificamos si el archivo existe y lo retornamos

      return view('oficina.documento', compact('archivo', 'notificacione', 'url'));
    } else {
      Session::flash('message', "Documentacion vacio");
      return redirect("/");
    }
  }
  public function archivoForo2($id)
  {
    $user = Archivo::where('id_proyecto', $id)->first();
    if ($user != null) {
      $archivo = $user->archivo2;
      $public_path = public_path();
      $url = '/storage/' . $archivo;
      //verificamos si el archivo existe y lo retornamos

      return view('oficina.documento', compact('archivo', 'notificacione', 'url'));
    } else {
      Session::flash('message', "Documentacion vacio");
      return redirect("/");
    }
  }



  public function jurado($id)
  {
    $docente = Docente::all();
    $user = ProyectoForo::where('id', $id)->first();

    return view('oficina.jurado', compact('user', 'docente'));
  }


  public function agregarProfeAforoJurado(Request $request, $id)
  {
    $jurado = new Jurado;
    $jurado->id_proyecto = $id;
    $jurado->id_docente = $request->maestro;
    $jurado->save();
    return redirect("/");
  }

  public function cerrar($id)
  {
    $alumno = Alumno::where('acceso', 0)->get();
    if ($alumno != null) {
      foreach ($alumno as $v) {
        $a = Alumno::find($v->id);
        $a->acceso = 1;
        $a->save();
      }
    }
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");
  }
}
