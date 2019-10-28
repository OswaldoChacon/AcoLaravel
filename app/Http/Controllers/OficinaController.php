<?php

namespace App\Http\Controllers;

use App\Horarioforo;
use Auth;
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
    $doc = Forodoncente::select('docentes.id','docentes.prefijo','docentes.nombre','docentes.paterno','docentes.materno')
    ->join('foros','forodoncentes.id_foro','=','foros.id')
    ->join('docentes','forodoncentes.id_docente','=','docentes.id')
    ->where('foros.acceso',1)->get();

    //  dd($doc[0]->nombre);
    // aqui va los
    return view('oficina.tokenAlumno', compact('tokealumno','doc'));
  }
  public function cleanScreen(){
    $tokealumno = Tokenalumno::all();
    foreach($tokealumno as $t){

            $inactivo =Tokenalumno::find($t->id);
            $inactivo->ver=0;
            $inactivo->save();
    }
    return redirect()->route('tokenAlumno');
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
    $profes = Docente::all();
    return view('oficina.profesores', compact('profes'));
  }
  public function profe(Request $request)
  {
    $validator = $this->validate(request(), [
      'tokenN' => 'required',
    ]);
    $tokenN = $request->tokenN;
    if ($tokenN != 0) {
      return view('oficina.dartokenProfe',compact('tokenN'));
      // return redirect()->route('dartokenProfe');
      // return redirect()->route('profe');
    } else {
      $tokendocente = Tokendocente::all();
      //return redirect()->route('/profe',$tokendocente);
      return redirect()->route('oficina');
      //view('oficina.tokenProfe', compact('tokendocente'));
    }
  }
  public function enviaHorario(Request $request){
    $fechaForos = $request->get('fechasForo');
    $fechaInicio = $request->get('fechasInicio');
    $fechaTermino = $request->get('fechasTermino');
    foreach($fechaForos as $key => $item){
      DB::table('horariodocentes')->insert([
        [
          'hora_entrada' => $fechaInicio[$key],
          'hora_salida' => $fechaTermino[$key],
          'fecha' => $fechaForos[$key],
          'id_docente' => $request->get('idDocente'),
        ],
      ]);
    }
  }
  public function dartokenAlumno(Request $request)
  {
    //  dd($request->profe);
    $doc = Docente::all();
    $nocontrol = count($request->nocontrol, COUNT_RECURSIVE);
    $uso = 0;
    $con = 0;
    // $idprofe =  DB::table('docentes')->select('id')
    // ->where(DB::raw('CONCAT(prefijo," ",nombre," ",paterno," ", materno) '),'=',$request->profe)
    // ->get();

    $idprofe = Forodoncente::select('forodoncentes.id_docente')
    ->join('foros','forodoncentes.id_foro','=','foros.id')
    ->join('docentes','forodoncentes.id_docente','=','docentes.id')
    ->where('foros.acceso',1)
    ->where('forodoncentes.id_docente',$request->profe)->get();
    // dd($doc);
    // $doc = Forodoncente::select('forodoncentes.id','docentes.prefijo','docentes.nombre','docentes.paterno','docentes.materno')
    // ->join('foros','forodoncentes.id_foro','=','foros.id')
    // ->join('docentes','forodoncentes.id_docente','=','docentes.id')
    // ->where('foros.acceso',1)->get();
    // dd($idprofe[0]->id_docente);
    //dd($idprofe);
    for ($i = 0; $i < $nocontrol; $i++) {
      $token = Tokenalumno::where('numerocontrol', $request->nocontrol[$i])->first();

      if ($token == null) {
        if ($request->nocontrol[$i] != null) {
          DB::table('tokenalumnos')->insert([
            [
              'numerocontrol' => $request->nocontrol[$i],
              'uso' => $uso,
              'id_profe_taller' => $idprofe[0]->id_docente,
              'grupo' => $request->grupo,
              'ver'=>1
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
    $numerocontrol = count($request->nocontrol, COUNT_RECURSIVE);
    // dd($email);
    $uso = 0;
    $con = 0;
    for ($i = 0; $i < $numerocontrol; $i++) {
      $token = Tokendocente::where('matricula', $request->nocontrol[$i])->first();
      if ($token == null) {
        if ($request->nocontrol[$i] != null) {
          DB::table('tokendocentes')->insert([
            [
              'token' => Str::random(),
              'uso' => $uso,
              'matricula' => $request->nocontrol[$i],
              'id_user'=> 1
            ],
          ]);
          $correo = $request->nocontrol[$i];
          $data = array(
            'name' => 'Registro de Docentes',
          );
          // Correo smtp
        }
      } else {
        $con++;
        $error[$i] = $token->id_usuario;
        $errors = implode("    ---    ", $error);
      }
    }
    if ($con > 0) {
      $tokenN = count($request->nocontrol, COUNT_RECURSIVE) - $con;
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
    $linea2 = Lineadeinvestigacion::where('linea', $request->clave)->first();
    if ($linea1 == null && $linea2 == null) {

      DB::table('lineadeinvestigacions')->insert([
        [
          'clave' => $request->clave,
          'linea' => $request->linea,
        ]
      ]);
      Session::flash('message1', "Linea de Investigacion Registrado");
    } else {
      Session::flash('message', "Linea de investigación ya existente");
    }
    // $lineadeinvestigacion = Lineadeinvestigacion::all();
    return redirect()->route('lineaDeInvetigacion');
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
    // $user = User::find(1);
    $user = User::find(Auth()->user()->id);
    // $docente = Docente::where('id', Auth::guard('docentes')->user()->id)->first();
    // $user1 = $user->prefijo . '  ' . $user->nombre . '  ' . $user->paterno . '  ' . $user->materno;
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
         // dd($docenteacceso);
          $docenteacceso->save();
        }
      }
      DB::table('foros')->insert([
        [
          'noforo' => $request->noforo,
          'titulo' => $request->titulo,
          'periodo' => $request->periodo,
          'anoo' => $request->anoo,
          'lim_alumnos' => 0,
          'duracion' => 0,
          'acceso' => 0,
          'id_user' => $user->id,
        ],
      ]);
      Session::flash('message', "Foro Creado");
      $foro = Foro::all();
      return view('oficina.foros', compact('foro'));
    } else {
      Session::flash('message', "Numero de foro ya existentes");
      return redirect()->route('crearForo');
    }
  }

  public function foros()
  {
    $foro = Foro::all();
    return view('oficina.foros', compact('foro'));
  }
  public function configurarForo($id_foro)
  {
    $docente = Docente::all();
    // $docent = Docente::find($id);
    $user = User::find(Auth()->user()->id);

    $name_jefe = $user->prefijo . '  ' . $user->nombre . '  ' . $user->paterno . '  ' . $user->materno;
    $id_foro = Crypt::decrypt($id_foro);
    $foro = Foro::find($id_foro);
    $horarioForo = Horarioforo::all();

    //$f = Forodoncente::find($docent)->where('id_foro',$id_foro);



    // $docente = Forodoncente::select('docentes.id','docentes.prefijo','docentes.nombre','docentes.paterno','docentes.materno')
    // ->join('foros','forodoncentes.id_foro','=','foros.id')
    // ->join('docentes','forodoncentes.id_docente','=','docentes.id')
    // ->where('foros.acceso',1)->get();

    //dd($doc);
    //$forodoncente = DB::table('docentes')->select('id as id','prefijo as prefijo','nombre as nombre','paterno as paterno','materno as materno')->get();

    return view('oficina.foros.configurarForo', compact('foro', 'docente', 'horarioForo', 'name_jefe'));
  }

  public function agregarProfeAforo(Request $request, $id)
  {
    $id = Crypt::decrypt($id);
    $docentes = Docente::find($request->maestro);
    $foro = Foro::find($id);
    DB::table('forodoncentes')->insert([
      [
        'id_foro' => $foro->id,
        'id_docente' => $request->maestro
      ]
    ]);
    $docentes->acceso = 1;
    $docentes->save();
    $id = Crypt::encrypt($id);
    return back();
  }
  public function activar($id)
  {
    //   $nombredocentes = DB::
    // $nombredocentes = DB::table('forodocentes')->('CONCAT(prefijo," ",nombre," ",paterno," ", materno) ')
    // $idprofe =  DB::table('docentes')->select('id')
    // ->where(DB::raw('CONCAT(prefijo," ",nombre," ",paterno," ", materno) '),'=',$request->profe)
    // ->get();
    $id = Crypt::decrypt($id);

    $a= DB::table('foros')->where('acceso','=',1)->get();

    $doc = Docente::all();
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");

    if(count($a) > 0)
    {
        foreach($a as $item){
            $inactivo =Foro::find($item->id);
            $inactivo->acceso=0;
            $inactivo->save();
        }
    }

    $activar = Foro::find($id);
    $activar->acceso = 1;
    $activar->save();

    $docenteacceso = Docente::where('acceso', 0)->first();
    if ($docenteacceso != null) {
      $docenteacceso->acceso = 1;
      $docenteacceso->save();
    }

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
    $proyectoForo = ProyectoForo::all()-> where('id_foro',$id);
    $numforo= DB::table('foros')->select('noforo')->where('id',$id)->get();
    $noforo= $numforo[0]->noforo;
    $docentes = Docente::all();
    return view('oficina.proyectosForo', compact('proyectoForo', 'noforo','id', 'docentes'));
  }

  public function proyectoDescripcion($id)
  {
    $id = Crypt::decrypt($id);
    $pro = ProyectoForo::where('id', $id)->first();
    $proyectoForo = ProyectoForo::find($id);
    $infoProyecto = DB::table('proyectos')
    ->select(
        'proyectos.id as IdProyecto',
        'proyectos.id_foro as IdForo',
        'proyectos.titulo as ProyectoTitulo',
        'proyectos.nombre_de_empresa as Empresa',
        'proyectos.objetivo as Objetivo',
        'lineadeinvestigacions.clave as ClaveLineaInvestigacion',
        'lineadeinvestigacions.linea as LineaInvestigacion',
        'aredeconocimientos.clave as ClaveAreaConocimiento',
        'aredeconocimientos.areade as AreaConocimiento',
        'docentes.prefijo as PrefijoDocente',
        'docentes.paterno as PaternoDocente',
        'docentes.materno as MaternoDocente',
        'docentes.nombre as NombreDocente',
        'alumnos.id as IdAlumno',
        'alumnos.paterno as PaternoAlumno',
        'alumnos.materno as MaternoAlumno',
        'alumnos.nombre as NombreAlumno'
    )
    ->join('lineadeinvestigacions','proyectos.lineadeinvestigacion_id','=','lineadeinvestigacions.id')
    ->join('aredeconocimientos','proyectos.aredeconocimiento_id','=','aredeconocimientos.id')
    ->join('docentes','proyectos.id_asesor','=','docentes.id')
    ->join('alumnos','proyectos.id','=','alumnos.id_proyecto')
    ->where('proyectos.id',$id)
    ->get();

    $docentesDeTaller = [];
    foreach($infoProyecto as $item){
        $docenteTaller = DB::table('docentes')
        ->select(
            'docentes.id as IdDocente',
            'docentes.prefijo as PrefijoDocente',
            'docentes.paterno as PaternoDocente',
            'docentes.materno as MaternoDocente',
            'docentes.nombre as NombreDocente'
        )
        ->join('tokenalumnos','tokenalumnos.id_profe_taller','=','docentes.id')
        ->join('alumnos','alumnos.tokenalumnos_id','=','tokenalumnos.id')
        ->where('alumnos.id',$item->IdAlumno)
        ->get();
        array_push($docentesDeTaller, $docenteTaller);
    }

    $jefeDepartamento = DB::table('users')
    ->select(
        'users.prefijo as Prefijo',
        'users.paterno as Paterno',
        'users.materno as Materno',
        'users.nombre as Nombre'
    )
    ->join('foros','foros.id_user','=','users.id')
    ->where('foros.id',$infoProyecto[0]->IdForo)
    ->first();
    // dd($docentesDeTaller);
    $foro = Foro::find($proyectoForo->id_foro);
    // $ProyectoForoAlumno = ProyectoForoAlumno::find($id);
    // $alumnoenproyecto = ProyectoForoAlumno::all();
    // $alumno = alumno::all();
    // $docente = Docente::all();
    // $Forodoncente = Forodoncente::all();
    // // $foro = Foro::find($ProyectoForoAlumno->id_foro);
    // $proyectoForo = ProyectoForo::find($pro->id);
    //return view('oficina.proyectoDescripcion',compact('foro','proyectoForo','ProyectoForoAlumno','notificacione','alumnoenproyecto','alumno','docente','Forodoncente'));
    return view('oficina.proyectoDescripcion', compact('id','pro','proyectoForo','infoProyecto','docentesDeTaller','jefeDepartamento','foro'));
  }
  public function getProyectosForo(Request $request){
    $idForo = $request->get('idForo');
    $proyectos_aceptados = DB::table('proyectos')
    ->where('participa',1)
    ->where('id_foro',$idForo)
    ->get();
    return $proyectos_aceptados;
}

  public function actulizar(Request $r, $id)
  {

    $id = Crypt::decrypt($id);
    $activar = Foro::find($id);
    $activar->lim_alumnos = $r->no_alumnos;
    // $activar->no_profesores = $r->no_profesores;
    $activar->save();
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");
  }

  public function actualizarDuracion(Request $request, $id)
  {
    $id = Crypt::decrypt($id);
    $duracio = Foro::find($id);
    $duracio->duracion=$request->duracion;
    $duracio->save();
    $id = Crypt::encrypt($id);
    return redirect("configurarForo/$id");
  }
  public function numAulas(Request $requ, $id)
  {
    $id = Crypt::decrypt($id);
    $numerodeaulas = Foro::find($id);
    $numerodeaulas->num_aulas=$requ->numAulas;
    $numerodeaulas->save();
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
