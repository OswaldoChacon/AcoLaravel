<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Registrar token para docente
Route::post('/profe', 'OficinaController@profe')->name('profe');

//Registrar token para alumno
Route::get('oficina','OficinaController@index')->name('oficina');
Route::get('tokenAlumno','OficinaController@tokenAlumno')->name('tokenAlumno');
Route::get('tokenProfe','OficinaController@tokenProfe')->name('tokenProfe');
Route::post('/alumnoT', 'OficinaController@alumno')->name('alumnoT');

Route::get('/','Auth\LoginController@showLoginFrom')->middleware('guest');
Route::post('login','Auth\LoginController@login')->name('login');
Route::get('logout','Auth\LoginController@logout')->name('logout');
Route::get('/editar/{id}','OficinaController@editar')->name('editar');
Route::post('/guardar/{id}','OficinaController@guardar')->name('guardar');
Route::post('dartokenProfe','OficinaController@dartokenProfe')->name('dartokenProfe');
Route::post('dartokenAlumno','OficinaController@dartokenAlumno')->name('dartokenAlumno');
Route::get('alumnos','OficinaController@alumnos')->name('alumnos');
Route::get('profes','OficinaController@profes')->name('profes');
Route::get('lineaDeInvetigacion','OficinaController@lineaDeInvetigacion')->name('lineaDeInvetigacion');
Route::post('lineaDeInvetigacionguardar','OficinaController@lineaDeInvetigacionguardar')->name('lineaDeInvetigacionguardar');
Route::get('areadeconocimiento','OficinaController@areadeconocimiento')->name('areadeconocimiento');
Route::post('areadeconocimientoguardar','OficinaController@areadeconocimientoguardar')->name('areadeconocimientoguardar');
Route::get('crearForo','OficinaController@crearForo')->name('crearForo');
Route::post('guardarForo','OficinaController@guardarForo')->name('guardarForo');
Route::get('foros','OficinaController@foros')->name('foros');
Route::get('configurarForo/{id}','OficinaController@configurarForo')->name('configurarForo');
Route::post('agregarProfeAforo/{id}','OficinaController@agregarProfeAforo')->name('agregarProfeAforo');
Route::get('/activar/{id}','OficinaController@activar')->name('activar');
Route::get('/desactivar/{id}','OficinaController@desactivar')->name('desactivar');
Route::get('proyecto/{id}','OficinaController@proyecto')->name('proyecto');
Route::get('proyectoDescripcion/{id}','OficinaController@proyectoDescripcion')->name('proyectoDescripcion');
Route::post('actulizar/{id}','OficinaController@actulizar')->name('actulizar');
Route::get('/archivoForo/{id}','OficinaController@archivoForo')->name('archivoForo');
Route::get('/archivoForo1/{id}','OficinaController@archivoForo1')->name('archivoForo');
Route::get('/archivoForo2/{id}','OficinaController@archivoForo2')->name('archivoForo');
Route::get('/jurado/{id}','OficinaController@jurado')->name('jurado');
Route::post('agregarProfeAforoJurado/{id}','OficinaController@agregarProfeAforoJurado')->name('agregarProfeAforoJurado');
Route::get('/cerrar/{id}','OficinaController@cerrar')->name('cerrar');

/*Route::get('sendemail',function(){
	$data = array(
		'name'=>'Curso de Laravel',agregarProfeAforoagregarProfeAforo
	);
	Mail::send('oficina.login',$data ,function($message){
		$message->from('ricardonarvaez13@gmail.com','curso de laravel');
		$message->to('ricardo-traka@hotmail.com')->subject('test email curso de laravel');
	});
	return 'tu email ha sido enviando correctamente ';
});*/


Route::get('/loginAlumno','AuthAlumno\LoginController@showLoginFrom')->name('loginAlumno');
Route::post('alumno','AuthAlumno\LoginController@login')->name('alumno');
Route::get('logoutAlumno','AuthAlumno\LoginController@logout')->name('logoutAlumno');
Route::get('alumno','AlumnoController@index')->name('alumnoLogin');
Route::get('registroAlumno','AuthAlumno\RegisterController@showLoginFrom')->name('registroAlumno');
Route::post('guardarAlumno','AuthAlumno\RegisterController@validator')->name('guardarAlumno');
Route::get('/editar/alumno/{id}','AlumnoController@editar')->name('editar');
Route::post('/guardar/alumno/{id}','AlumnoController@guardar')->name('guardar');
Route::get('registraProyecto','AlumnoController@registraProyecto')->name('registraProyecto');
Route::post('RegistarProyecto/{id}','AlumnoController@RegistarProyecto')->name('RegistarProyecto');
Route::get('productByCategory/{id}', 'AlumnoController@byFoundation');
Route::get('proyectoAlumno/{id}', 'AlumnoController@proyectoAlumno');
Route::get('proyectoDescripcionAlumno/{id}','AlumnoController@proyectoDescripcionAlumno')->name('proyectoDescripcionAlumno');
Route::get('descarga/{id}','AlumnoController@descarga')->name('descarga');
Route::get('notificaciones','AlumnoController@notificaciones')->name('notificaciones');
Route::get('confirmar/{id}','AlumnoController@confirmar')->name('confirmar');
Route::get('proyectosubir/{id}','AlumnoController@proyectosubir')->name('proyectosubir');
Route::post('SubirProtocolo/{id}','AlumnoController@SubirProtocolo')->name('SubirProtocolo');
Route::post('SubirDiapositiva/{id}','AlumnoController@SubirDiapositiva')->name('SubirDiapositiva');
Route::post('SubirSeminario/{id}','AlumnoController@SubirSeminario')->name('SubirSeminario');
Route::post('create/{id}', 'AlumnoController@save')->name('create');
Route::post('diapositiva/{id}', 'AlumnoController@save1')->name('diapositiva');
Route::post('Guardar/{id}', 'AlumnoController@save2')->name('Guardar');






Route::get('/loginDocente','AuthDocente\LoginController@showLoginFrom')->name('loginDocente');
Route::post('docente','AuthDocente\LoginController@login')->name('docente');
Route::get('logoutDocente','AuthDocente\LoginController@logout')->name('logoutDocente');
Route::get('docente','DocenteController@index')->name('docenteLogin');
Route::get('registroDocente','AuthDocente\RegisterController@showLoginFrom')->name('registroDocente');
Route::post('guardarDocente','AuthDocente\RegisterController@validator')->name('guardarDocente');
Route::get('registaralumno','DocenteController@registaralumno')->name('registaralumno');
Route::post('profes','DocenteController@profes')->name('profes');
Route::post('dartokenAlumnoP','DocenteController@dartokenAlumnoP')->name('dartokenAlumnoP');
Route::get('/editar/docente/{id}','DocenteController@editar')->name('editar');
Route::post('/guardar/docente/{id}','DocenteController@guardar')->name('guardar');
Route::get('notificacionesdocentes','DocenteController@notificaciones')->name('notificacionesdocentes');
Route::get('confirmardocentes/{id}','DocenteController@confirmar')->name('confirmardocentes');
Route::get('proyectosAsessorados','DocenteController@proyectoDocentes')->name('proyectosAsessorados');
Route::get('proyectoDescripcionDocente/{id}','DocenteController@proyectoDescripcionDocente')->name('proyectoDescripcionDocente');
Route::get('/archivo/{id}','DocenteController@archivo')->name('archivo');

Route::get('/archivo1/{id}','DocenteController@archivo1')->name('archivo');

Route::get('/archivo2/{id}','DocenteController@archivo2')->name('archivo');



// Rutas SEMINARIO GeremiasLE

// Route::post('seminario','PagesSeminarioController@seminario');
// Route::get('foros', function(){
// 	return \App\Foro::all();
// });

// Route::get('proyectos', function(){
// 	return \App\Seminario::with('proyectoforo')->get();
// });

Route::get('seminarios/projects/{id}', 'SeminariosController@projects')->name('projects');
Route::resource('seminarios', 'SeminariosController');

Route::get('jurados/projects/{id?}', 'JuradosController@projects')->name('juradosprojects');
Route::resource('jurados', 'JuradosController')->only(['edit', 'update', 'index']);

Route::get('evaluaciones/{id}/editDiapo', 'HojasController@editDiapo')->name('editDiapo');
Route::get('evaluaciones/{id}/editResumen', 'HojasController@editResumen')->name('editResumen');
Route::put('actualizar/{id}', 'HojasController@updateCalificacion')->name('actualizar');
Route::resource('evaluaciones', 'HojasController')->except(['store', 'create']);

Route::get('criterios', 'ImpresosController@criterios')->name('criterios');
Route::resource('impresos', 'ImpresosController')->except(['show', 'destroy']);
Route::resource('diapositivas', 'DiapositivasController')->except(['show', 'destroy']);
Route::resource('resumes', 'ResumesController')->except(['show', 'destroy']);

Route::get('showAssignedProject/{id}', 'HojasController@showAssignedProject')->name('showAssignedProject');
Route::post('CreateEvaluateProject/{id}', 'HojasController@CreateEvaluateProject')->name('CreateEvaluateProject');
Route::get('showEvaluation/{id}', 'HojasController@showEvaluation')->name('showEvaluation');

Route::get('sheets', 'EvidenciasController@index')->name('sheets');
Route::get('sheets/{id}', 'EvidenciasController@show')->name('sheets.show');
Route::delete('sheets/{id}', 'EvidenciasController@destroy')->name('sheets.destroy');

Route::get('dictamen', 'AlumnoController@dictamen')->name('dictamen');
// Route::get('showResults/{id}', 'AlumnoController@showResults')->name('showResults');
Route::get('download', 'AlumnoController@download')->name('download');
Route::get('downloadEvaluation/{id}', 'HojasController@downloadEvaluation')->name('downloadEvaluation');

Route::get('showprojects', 'DocenteController@showprojects')->name('showprojects');

Route::get('editSheets/{id}', 'EvidenciasController@editSheets')->name('editSheets');
Route::put('updateSheet/{id}', 'EvidenciasController@updateSheet')->name('updateSheet');
Route::get('editarImpreso/{id}', 'EvidenciasController@editarImpreso')->name('editarImpreso');
Route::get('editarDiapo/{id}', 'EvidenciasController@editarDiapo')->name('editarDiapo');
Route::get('editarResumen/{id}', 'EvidenciasController@editarResumen')->name('editarResumen');
Route::put('actualizarHoja/{id}', 'EvidenciasController@actualizarHoja')->name('actualizarHoja');

Route::get('showAssignedProjectEvaluation/{id}', 'HojasController@showAssignedProjectEvaluation')->name('showAssignedProjectEvaluation');

Route::get('mostrarEvaluacion/{id}', 'AlumnoController@mostrarEvaluacion')->name('mostrarEvaluacion');



// Route::get('horarios','Horario\HorarioController@index')->name('horarios');

// Acceso a la vista de horarios donde se creara todo lo de las hormigas
Route::get('horarios', function(){
	$foros = DB::table('foros')->where('accesosecundario','=',1)->get();	
	// dd($foro);
	return view('oficina.horarios.horarios',compact('foros'));
});

Route::get('profes/horarios/{id?}','Horario\addHourController@agregarHorarios')->name('horariomaestro');

Route::post('addHourForo/{id}','Horario\HorarioController@addHourForo')->name('addHourForo');

Route::post('addHourDocente/{id}','Horario\addHourController@addHourDocente')->name('addHourForo');
// Route::post('agregarProfeAforo/{id}','OficinaController@agregarProfeAforo')->name('agregarProfeAforo');









