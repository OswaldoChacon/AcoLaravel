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
use SebastianBergmann\Environment\Console;
use lIluminate\Database\Query\save;


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
        $doc = Forodoncente::select('docentes.id', 'docentes.prefijo', 'docentes.nombre', 'docentes.paterno', 'docentes.materno')
            ->join('foros', 'forodoncentes.id_foro', '=', 'foros.id')
            ->join('docentes', 'forodoncentes.id_docente', '=', 'docentes.id')
            ->where('foros.acceso', 1)->get();


        //  dd($doc[0]->nombre);
        // aqui va los
        return view('oficina.tokenAlumno', compact('tokealumno', 'doc'));
    }
    public function cleanScreen()
    {
        $tokealumno = Tokenalumno::all();
        foreach ($tokealumno as $t) {

            $inactivo = Tokenalumno::find($t->id);
            $inactivo->ver = 0;
            $inactivo->save();
        }
        return redirect()->route('tokenAlumno');
    }
    public function tokenProfe()
    {
        $tokendocente = Tokendocente::all();
        return view('oficina.tokenProfe', compact('tokendocente'));
    }

    public function configurarForoAtributos(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        // dd($request);
        $foro = Foro::find($id);
        $foro->lim_alumnos = $request->no_alumnos;

        if ($foro->duracion != $request->duracion) {
            $horarioforos = DB::table('horarioforos')->select(
                'horarioforos.id as id',
                'foros.id as idf'
            )
                ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
                ->where('id_foro', $id)->get();

            foreach ($horarioforos as $hf) {
                $deletes = DB::table('horariodocentes')
                    ->where('id_horarioforos', $hf->id)
                    ->delete();
            }
        }

        $foro->duracion = $request->duracion;
        $foro->num_aulas = $request->numAulas;
        $foro->save();
        return redirect()->back();
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
            return view('oficina.dartokenProfe', compact('tokenN'));
            // return redirect()->route('dartokenProfe');
            // return redirect()->route('profe');
        } else {
            $tokendocente = Tokendocente::all();
            //return redirect()->route('/profe',$tokendocente);
            return redirect()->route('oficina');
            //view('oficina.tokenProfe', compact('tokendocente'));
        }
    }
    public function enviaHorario(Request $request)
    {
        $fechaForos = $request->get('fechasForo');
        $fechaInicio = $request->get('fechasInicio');
        $fechaTermino = $request->get('fechasTermino');
        foreach ($fechaForos as $key => $item) {
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
        $doc = Docente::all();
        $nocontrol = count($request->nocontrol, COUNT_RECURSIVE);
        $uso = 0;
        $con = 0;

        $idprofe = Forodoncente::select('forodoncentes.id_docente')
            ->join('foros', 'forodoncentes.id_foro', '=', 'foros.id')
            ->join('docentes', 'forodoncentes.id_docente', '=', 'docentes.id')
            ->where('foros.acceso', 1)
            ->where('forodoncentes.id_docente', $request->profe)->get();
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
                            'ver' => 1
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
        $user = User::find(Auth()->user()->id);
        for ($i = 0; $i < $numerocontrol; $i++) {
            $token = Tokendocente::where('matricula', $request->nocontrol[$i])->first();
            if ($token == null) {
                if ($request->nocontrol[$i] != null) {
                    DB::table('tokendocentes')->insert([
                        [
                            'token' => Str::random(),
                            'uso' => $uso,
                            'matricula' => $request->nocontrol[$i],
                            'id_user' => $user->id
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
        $ultimoforo = Foro::orderBy('noforo','desc')->get()->first();
        return view('oficina.foros.crearForo',compact('ultimoforo'));
    }
    public function guardarForo(Request $request)
    {
        $validator = $this->validate($request, [
            'noforo' => 'required',
            'titulo' => 'required',
            'periodo' => 'required',
            'anoo' => 'required',
        ]);
        //prefijo
        $prefijo = str_split($request->anoo);
        $prefijo = $prefijo[2] . $prefijo[3] ;
        if($request->periodo == "Agosto-Diciembre"){
            $prefijo = $prefijo."02-";
        }else{
            $prefijo = $prefijo."01-";
        }
        $user = User::find(Auth()->user()->id);
        // dd($user);
        $foro = Foro::where('noforo', $request->noforo)->first();
        $anoo = Foro::where('anoo', $request->anoo)->where('periodo',$request->periodo)->get();
        // dd($anoo,$request->periodo);

        if ($foro == null && count($anoo) == 0) {

            DB::table('foros')->insert([
                [
                    'noforo' => $request->noforo,
                    'titulo' => $request->titulo,
                    'periodo' => $request->periodo,
                    'anoo' => $request->anoo,
                    'lim_alumnos' => 0,
                    'duracion' => 0,
                    'acceso' => 0,
                    'num_aulas' => 0,
                    'num_maestros' => 0,
                    'id_user' => $user->id,
                ],
            ]);
            Session::flash('message', "Foro Creado");
            $foro = Foro::all();
            return redirect()->route('foros');
        } elseif($foro!=null) {
            Session::flash('message', "Numero de foro ya existente");
            return redirect()->route('crearForo');
        }
        elseif(count($anoo)>0){
            Session::flash('message', "Ya existe un foro con el mismo periodo y año");
            return redirect()->route('crearForo');
        }
    }

    public function foros()
    {
        $foro = Foro::all();
        return view('oficina.foros.foros', compact('foro'));
    }

    public function eliminarForo(Request $requ, $id)
    {
        $foro = Foro::find($id);

        $f = DB::table('foros')->where('id', $id)->first();
        if ($f != null) {
            $deletes = DB::table('foros')
                ->where('id', $f->id)
                ->delete();
        }
        return back();
    }


    public function configurarForo($id_foro)
    {
        $docente = DB::table('docentes')->where('acceso', 0)->get();
        $id_foro = Crypt::decrypt($id_foro);
        $foro = Foro::find($id_foro);
        $hForo = Horarioforo::all();
        // $horarioForo =DB::table('horarioforos')->where('id_foro',$id_foro)->get();

        $min = DB::table('foros')->select('duracion as minutos')->where('acceso', '=', 1)->get();
        if (count($min) > 0) {

            $minutos = $min[0]->minutos;
        } else {
            Session::flash('mesage', "DEBE TENER ACTIVADO EL FORO PARA ASIGNARLE SU HORARIO");
            Session::flash('alert-class', 'alert-danger');
        }

        $horariosForos = DB::table('horarioforos')
            ->select('horarioforos.horario_inicio', 'horarioforos.horario_termino', 'horarioforos.fecha_foro as fecha', 'horarioforos.id as id')
            // , 'horarioforos.horario_break as break'
            ->join('foros', 'horarioforos.id_foro', '=', 'foros.id')
            ->where('foros.acceso', 1)
            ->where('horarioforos.id_foro', $id_foro)
            ->get();

        $horariosdocentes = DB::table('horariodocentes')->where('disponible', 1)->get();

        $longitud = count($horariosForos);
        $temp = " ";
        $intervalosContainer = array();

        foreach ($horariosForos as $item) {
            $intervalo = array();
            $tempInicio = $item->horario_inicio;
            $tempTermino = $item->horario_termino;
            while ($tempInicio <= $tempTermino) {
                $newDate = strtotime('+0 hour', strtotime($tempInicio));
                $newDate = strtotime('+' . $minutos . 'minute', $newDate);
                $newDate = date('H:i:s', $newDate);
                $temp = $tempInicio . " - " . $newDate;
                $tempInicio = $newDate;

                if ($newDate > $tempTermino) { } else {
                    array_push($intervalo, $temp);
                }
            }
            array_push($intervalosContainer, $intervalo);
        }

        $user = DB::table('users')
            ->select(
                'users.prefijo as Prefijo',
                'users.paterno as Paterno',
                'users.materno as Materno',
                'users.nombre as Nombre'
            )
            ->join('foros', 'foros.id_user', '=', 'users.id')
            ->where('foros.id', $id_foro)
            ->first();
        $name_jefe = $user->Prefijo . '  ' . $user->Nombre . '  ' . $user->Paterno . '  ' . $user->Materno;
        $doc = DB::table('forodoncentes')
            ->select(
                'docentes.prefijo as prefijo',
                'docentes.nombre as nombre',
                'docentes.paterno as paterno',
                'docentes.materno as materno'
            )
            ->join('foros', 'forodoncentes.id_foro', '=', 'foros.id')
            ->join('docentes', 'forodoncentes.id_docente', '=', 'docentes.id')
            ->where('forodoncentes.id_foro', $id_foro)
            ->get();

        $horariobreak = DB::table('horariobreak')->select('id as id', 'id_horarioforo as id_hf', 'horario_break as horario_break', 'id_horarioforo as id_horarioforo')
            ->where('disponible', 1)
            ->get();

        return view('oficina.foros.configurarForo', compact('foro', 'docente', 'doc', 'horariosForos', 'name_jefe', 'intervalosContainer', 'horariosdocentes', 'horariobreak'));
    }

    public function agregarProfeAforo(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $docentes = Docente::find($request->maestro);
        $docente = Docente::find($request->id);
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
        $id = Crypt::decrypt($id);
        $a = DB::table('foros')->where('acceso', '=', 1)->get();

        $doc = DB::table('forodoncentes')->select(
            'forodoncentes.id_docente as id_docente',
            'docentes.id as idd'
        )
            ->join('docentes', 'forodoncentes.id_docente', '=', 'docentes.id')
            ->where('id_foro', $id)->get();

        if (count($a) > 0) {
            foreach ($a as $item) {
                $inactivo = Foro::find($item->id);
                $inactivo->acceso = 0;
                $inactivo->save();
            }
        }
        $activar = Foro::find($id);
        $activar->acceso = 1;
        $activar->save();

        if (count($doc) > 0) {
            foreach ($doc as $dc) {
                $acceso = Docente::find($dc->idd);
                $acceso->acceso = 1;
                $acceso->save();
            }
        }

        $id = Crypt::encrypt($id);
        //return redirect("configurarForo/$id");
        return redirect()->back();
    }
    public function desactivar($id)
    {
        $id = Crypt::decrypt($id);
        // $doc = Docente::all();
        // $tama = count($doc, COUNT_RECURSIVE);
        $activar = Foro::find($id);
        $activar->acceso = 0;
        $activar->save();
        $docente = Docente::find($id);

        $doc = DB::table('forodoncentes')->select(
            'forodoncentes.id_docente as id_docente',
            'docentes.id as idd'
        )
            ->join('docentes', 'forodoncentes.id_docente', '=', 'docentes.id')
            ->where('id_foro', $id)->get();


        if (count($doc) > 0) {
            foreach ($doc as $dc) {
                $acceso = Docente::find($dc->idd);
                $acceso->acceso = 0;
                $acceso->save();
            }
        }

        $id = Crypt::encrypt($id);
        // return redirect("configurarForo/$id");
        return redirect()->back();
    }

    public function proyecto($id)
    {

        $id = Crypt::decrypt($id);
        $proyectoForo = ProyectoForo::all()->where('id_foro', $id);
        $numforo = DB::table('foros')->select('noforo')->where('id', $id)->get();
        $noforo = $numforo[0]->noforo;
        $docentes = Docente::all();
        return view('oficina.proyectosForo', compact('proyectoForo', 'noforo', 'id', 'docentes'));
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
            ->join('lineadeinvestigacions', 'proyectos.lineadeinvestigacion_id', '=', 'lineadeinvestigacions.id')
            ->join('aredeconocimientos', 'proyectos.aredeconocimiento_id', '=', 'aredeconocimientos.id')
            ->join('docentes', 'proyectos.id_asesor', '=', 'docentes.id')
            ->join('alumnos', 'proyectos.id', '=', 'alumnos.id_proyecto')
            ->where('proyectos.id', $id)
            ->get();

        $docentesDeTaller = [];
        foreach ($infoProyecto as $item) {
            $docenteTaller = DB::table('docentes')
                ->select(
                    'docentes.id as IdDocente',
                    'docentes.prefijo as PrefijoDocente',
                    'docentes.paterno as PaternoDocente',
                    'docentes.materno as MaternoDocente',
                    'docentes.nombre as NombreDocente'
                )
                ->join('tokenalumnos', 'tokenalumnos.id_profe_taller', '=', 'docentes.id')
                ->join('alumnos', 'alumnos.tokenalumnos_id', '=', 'tokenalumnos.id')
                ->where('alumnos.id', $item->IdAlumno)
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
            ->join('foros', 'foros.id_user', '=', 'users.id')
            ->where('foros.id', $infoProyecto[0]->IdForo)
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
        return view('oficina.proyectoDescripcion', compact('id', 'pro', 'proyectoForo', 'infoProyecto', 'docentesDeTaller', 'jefeDepartamento', 'foro'));
    }
    public function getProyectosForo(Request $request)
    {
        $idForo = $request->get('idForo');
        $proyectos_aceptados = DB::table('proyectos')
            ->where('participa', 1)
            ->where('id_foro', $idForo)
            ->get();
        return $proyectos_aceptados;
    }



    public function numMaestros(Request $requ, $id)
    {

        $id = Crypt::decrypt($id);
        $numMaestros = Foro::find($id);
        $numMaestros->num_maestros = $requ->numMaestros;
        $numMaestros->save();

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
    public function setHorarioBreak(Request $break)
    {

        $idHorarioForo = $break->get('idHorarioForo');
        $hora = $break->get('hora');
        $disponible = $break->get('disponible');
        $posicion = $break->get('posicion');
        //        dd($break->all());
        $horariobreak = DB::table('horariobreak')
            ->where('id_horarioforo', $idHorarioForo)
            ->where('horario_break', $hora)
            ->where('posicion', $posicion)
            ->get();

        if (count($horariobreak) > 0) {
            $deletes = DB::table('horariobreak')
                ->where('id', $horariobreak[0]->id)
                ->delete();

        } else {
            DB::table('horariobreak')->insert([
                [
                    'id_horarioforo' => $idHorarioForo,
                    'horario_break' => $hora,
                    'disponible' => $disponible,
                    'posicion' => $posicion

                ],
            ]);

            $hb = DB::table('horariobreak')->select(
                'horariobreak.posicion as p',
                'horariobreak.id_horarioforo as id_hf',
                'horarioforos.id as idhf'
            )
                ->join('horarioforos', 'horariobreak.id_horarioforo', '=', 'horarioforos.id')
                ->where('disponible', 1)->get();

            if (count($hb) > 0) {
                foreach ($hb as $hd) {
                    $deletes = DB::table('horariodocentes')
                        ->where('id_horarioforos', $hd->id_hf)
                        ->where('posicion', $hd->p)
                        ->delete();
                }
            }
        }
    }

    public function projectsSegui()
    {

        // $proyectos = ProyectoForo::find($id)->where([
        //                     ['id_foro', '=', $id]
        //                 ])
        //                 ->get();
        $foros=Foro::all();

        return view('seminario.jurados.prueba',compact('foros'));
    }
}
