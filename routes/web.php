<?php

Route::get('criterios', 'ImpresosController@criterios')->name('criterios');
Route::resource('impresos', 'ImpresosController')->except(['show', 'destroy']);
Route::resource('diapositivas', 'DiapositivasController')->except(['show', 'destroy']);
Route::resource('resumes', 'ResumesController')->except(['show', 'destroy']);
Route::resource('seminarios', 'SeminariosController');
Route::get('seminarios/projects/{id}', 'SeminariosController@projects')->name('projects');



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						LOGIN CONTROLLER					/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////						USER (ADMIN)						/////////////////////////////////////////

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

/////////////////////////////////						DOCENTE								/////////////////////////////////////////
Route::post('docente', 'AuthDocente\LoginController@login')->name('docente');
Route::post('guardarDocente', 'AuthDocente\RegisterController@validator')->name('guardarDocente');

Route::get('/loginDocente', 'AuthDocente\LoginController@showLoginFrom')->name('loginDocente');
Route::get('logoutDocente', 'AuthDocente\LoginController@logout')->name('logoutDocente');
Route::get('registroDocente', 'AuthDocente\RegisterController@showLoginFrom')->name('registroDocente');

/////////////////////////////////						ALUMNO								/////////////////////////////////////////

Route::post('alumno', 'AuthAlumno\LoginController@login')->name('alumno');
Route::post('guardarAlumno', 'AuthAlumno\RegisterController@validator')->name('guardarAlumno');

Route::get('/loginAlumno', 'AuthAlumno\LoginController@showLoginFrom')->name('loginAlumno');
Route::get('logoutAlumno', 'AuthAlumno\LoginController@logout')->name('logoutAlumno');
Route::get('registroAlumno', 'AuthAlumno\RegisterController@showLoginFrom')->name('registroAlumno');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						OFICINA CONTROLLER					/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////						POST					/////////////////////////////////////////

Route::post('/profe', 'OficinaController@profe')->name('profe');
Route::post('/alumnoT', 'OficinaController@alumno')->name('alumnoT');
Route::post('/guardar/{id}', 'OficinaController@guardar')->name('guardar');
Route::post('dartokenProfe', 'OficinaController@dartokenProfe')->name('dartokenProfe');
Route::post('dartokenAlumno', 'OficinaController@dartokenAlumno')->name('dartokenAlumno');
Route::post('profes-envia-horario', 'OficinaController@enviaHorario');
Route::post('lineaDeInvetigacionguardar', 'OficinaController@lineaDeInvetigacionguardar')->name('lineaDeInvetigacionguardar');
Route::post('areadeconocimientoguardar', 'OficinaController@areadeconocimientoguardar')->name('areadeconocimientoguardar');
Route::post('guardarForo', 'OficinaController@guardarForo')->name('guardarForo');
Route::post('agregarProfeAforo/{id}', 'OficinaController@agregarProfeAforo')->name('agregarProfeAforo');
Route::post('agregarProfeAforoJurado/{id}', 'OficinaController@agregarProfeAforoJurado')->name('agregarProfeAforoJurado');
Route::post('actualizarDuracion/{id}', 'OficinaController@actualizarDuracion')->name('actualizarDuracion');
Route::post('numAulas/{id}', 'OficinaController@numAulas')->name('numAulas');
Route::post('numMaestros/{id}', 'OficinaController@numMaestros')->name('numMaestros');
Route::post('prefijoProyecto/{id}', 'OficinaController@prefijoProyecto')->name('prefijoProyecto');
/////////////////////////////////						GET					/////////////////////////////////////////

Route::get('oficina', 'OficinaController@index')->name('oficina');
Route::get('tokenAlumno', 'OficinaController@tokenAlumno')->name('tokenAlumno');
Route::get('tokenAlumno/clean-screen', 'OficinaController@cleanScreen');
Route::get('download', 'AlumnoController@download')->name('download');
Route::get('tokenProfe', 'OficinaController@tokenProfe')->name('tokenProfe');
Route::get('/editar/{id}', 'OficinaController@editar')->name('editar');
Route::get('alumnos', 'OficinaController@alumnos')->name('alumnos');
Route::get('profes', 'OficinaController@profes')->name('profes');
Route::get('lineaDeInvetigacion', 'OficinaController@lineaDeInvetigacion')->name('lineaDeInvetigacion');
Route::get('areadeconocimiento', 'OficinaController@areadeconocimiento')->name('areadeconocimiento');
Route::get('/', 'Auth\LoginController@showLoginFrom')->middleware('guest');
Route::get('configurarForo/{id_foro}', 'OficinaController@configurarForo')->name('configurarForo');
Route::get('eliminarForo/{id}', 'OficinaController@eliminarForo')->name('eliminarForo');
Route::get('crearForo', 'OficinaController@crearForo')->name('crearForo');
Route::get('foros', 'OficinaController@foros')->name('foros');
Route::get('/activar/{id}', 'OficinaController@activar')->name('activar');
Route::get('/desactivar/{id}', 'OficinaController@desactivar')->name('desactivar');
Route::get('proyecto/{id}', 'OficinaController@proyecto')->name('proyecto');
Route::get('proyectoDescripcion/{id}', 'OficinaController@proyectoDescripcion')->name('proyectoDescripcion');
Route::post('actulizar/{id}', 'OficinaController@actulizar')->name('actulizar');
Route::get('/archivoForo/{id}', 'OficinaController@archivoForo')->name('archivoForo');
Route::get('/archivoForo1/{id}', 'OficinaController@archivoForo1')->name('archivoForo');
Route::get('/archivoForo2/{id}', 'OficinaController@archivoForo2')->name('archivoForo');
Route::get('/jurado/{id}', 'OficinaController@jurado')->name('jurado');
Route::get('/cerrar/{id}', 'OficinaController@cerrar')->name('cerrar');

Route::get('/generarHorario', 'Horario\HorarioController@generarHorarioView');
// function () {
//     $salones = Foro::select('num_aulas')->where('acceso', 1)->get()->first();
//     // dd($salones);
//     return view('oficina.horarios.generarHorario');
// });


// Route::get('Jprojects/get-proyectos-foro', 'OficinaController@getProyectosForo');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						DOCENTE CONTROLLER					/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////						POST				/////////////////////////////////////////

Route::post('profes', 'DocenteController@profes')->name('profes');
Route::post('/guardar/docente/{id}', 'DocenteController@guardar')->name('guardar');
Route::post('dartokenAlumnoP', 'DocenteController@dartokenAlumnoP')->name('dartokenAlumnoP');

/////////////////////////////////						GET					/////////////////////////////////////////

Route::get('docente', 'DocenteController@index')->name('docenteLogin');
Route::get('horariogeneradoDocente','DocenteController@horario')->name('horariogeneradoDocente');
Route::get('/editar/docente/{id}', 'DocenteController@editar')->name('editar');
Route::get('registaralumno', 'DocenteController@registaralumno')->name('registaralumno');
Route::get('notificacionesdocentes', 'DocenteController@notificaciones')->name('notificacionesdocentes');
Route::get('confirmardocentes/{id}', 'DocenteController@confirmar')->name('confirmardocentes');
Route::get('proyectosAsessorados', 'DocenteController@proyectoDocentes')->name('proyectosAsessorados');
Route::get('proyectoDescripcionDocente/{id}', 'DocenteController@proyectoDescripcionDocente')->name('proyectoDescripcionDocente');
Route::get('showprojects', 'DocenteController@showprojects')->name('showprojects');
Route::get('/archivo/{id}', 'DocenteController@archivo')->name('archivo');
Route::get('/archivo1/{id}', 'DocenteController@archivo1')->name('archivo');
Route::get('/archivo2/{id}', 'DocenteController@archivo2')->name('archivo');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						ALUMNO CONTROLLER					/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////						POST				/////////////////////////////////////////

Route::post('/guardar/alumno/{id}', 'AlumnoController@guardar')->name('guardar');
Route::post('SubirProtocolo/{id}', 'AlumnoController@SubirProtocolo')->name('SubirProtocolo');
Route::post('SubirDiapositiva/{id}', 'AlumnoController@SubirDiapositiva')->name('SubirDiapositiva');
Route::post('SubirSeminario/{id}', 'AlumnoController@SubirSeminario')->name('SubirSeminario');
Route::post('create/{id}', 'AlumnoController@save')->name('create');
Route::post('diapositiva/{id}', 'AlumnoController@save1')->name('diapositiva');
Route::post('Guardar/{id}', 'AlumnoController@save2')->name('Guardar');
Route::post('RegistarProyecto/{id}', 'AlumnoController@RegistarProyecto')->name('RegistarProyecto');

/////////////////////////////////						GET					/////////////////////////////////////////
Route::get('horariogeneradoAlumno','AlumnoController@horario')->name('horariogeneradoAlumno');
Route::get('/editar/alumno/{id}', 'AlumnoController@editar')->name('editar');
Route::get('dictamen', 'AlumnoController@dictamen')->name('dictamen');
Route::get('alumno', 'AlumnoController@index')->name('alumnoLogin');
Route::get('registraProyecto', 'AlumnoController@registraProyecto')->name('registraProyecto');
Route::get('productByCategory/{id}', 'AlumnoController@byFoundation');
Route::get('proyectoAlumno/{id}', 'AlumnoController@proyectoAlumno');
Route::get('proyectoDescripcionAlumno/{id}', 'AlumnoController@proyectoDescripcionAlumno')->name('proyectoDescripcionAlumno');
Route::get('descarga/{id}', 'AlumnoController@descarga')->name('descarga');
Route::get('notificaciones', 'AlumnoController@notificaciones')->name('notificaciones');
Route::get('confirmar/{id}', 'AlumnoController@confirmar')->name('confirmar');
Route::get('proyectosubir/{id}', 'AlumnoController@proyectosubir')->name('proyectosubir');
Route::get('mostrarEvaluacion/{id}', 'AlumnoController@mostrarEvaluacion')->name('mostrarEvaluacion');




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						JURADOS CONTROLLER					/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::resource('jurados', 'JuradosController')->only(['edit', 'update', 'index']);
Route::post('jurados/update/{id}', 'JuradosController@update')->name('update');
/////////////////////////////////						POST				/////////////////////////////////////////
/////////////////////////////////						GET				/////////////////////////////////////////

Route::get('jurados/projects', 'JuradosController@projects')->name('juradosprojects');
Route::get('jurados/edit/{id}', 'JuradosController@edit');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						HOJAS CONTROLLER				/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::resource('evaluaciones', 'HojasController')->except(['store', 'create']);

/////////////////////////////////						POST				/////////////////////////////////////////

Route::post('CreateEvaluateProject/{id}', 'HojasController@CreateEvaluateProject')->name('CreateEvaluateProject');

/////////////////////////////////						GET				/////////////////////////////////////////

Route::get('showAssignedProjectEvaluation/{id}', 'HojasController@showAssignedProjectEvaluation')->name('showAssignedProjectEvaluation');
Route::get('evaluaciones/{id}/editDiapo', 'HojasController@editDiapo')->name('editDiapo');
Route::get('evaluaciones/{id}/editResumen', 'HojasController@editResumen')->name('editResumen');
Route::get('showAssignedProject/{id}', 'HojasController@showAssignedProject')->name('showAssignedProject');
Route::get('showEvaluation/{id}', 'HojasController@showEvaluation')->name('showEvaluation');
Route::get('downloadEvaluation/{id}', 'HojasController@downloadEvaluation')->name('downloadEvaluation');

/////////////////////////////////						PUT				/////////////////////////////////////////

Route::put('actualizar/{id}', 'HojasController@updateCalificacion')->name('actualizar');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						EVIDENCIAS CONTROLLER				/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////						POST				/////////////////////////////////////////
/////////////////////////////////						PUT				/////////////////////////////////////////

Route::put('actualizarHoja/{id}', 'EvidenciasController@actualizarHoja')->name('actualizarHoja');
Route::put('updateSheet/{id}', 'EvidenciasController@updateSheet')->name('updateSheet');

/////////////////////////////////						GET				/////////////////////////////////////////

Route::get('editSheets/{id}', 'EvidenciasController@editSheets')->name('editSheets');
Route::get('editarImpreso/{id}', 'EvidenciasController@editarImpreso')->name('editarImpreso');
Route::get('editarDiapo/{id}', 'EvidenciasController@editarDiapo')->name('editarDiapo');
Route::get('editarResumen/{id}', 'EvidenciasController@editarResumen')->name('editarResumen');
Route::get('sheets', 'EvidenciasController@index')->name('sheets');
Route::get('sheets/{id}', 'EvidenciasController@show')->name('sheets.show');

/////////////////////////////////						DELETE				/////////////////////////////////////////

Route::delete('sheets/{id}', 'EvidenciasController@destroy')->name('sheets.destroy');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////						HORARIOS CONTROLLER				/////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////						POST				/////////////////////////////////////////

Route::post('horarios/edit-participa', 'Horario\HorarioProyectosController@editarParticipa');
Route::post('addHourForo/{id}', 'Horario\HorarioController@addHourForo')->name('addHourForo');

// Route::post('/actualizarHorarioForo/{id}', 'Horario\HorarioController@addHourForo')->name('actualizarHorarioForo');
Route::post('addHourDocente/{id}', 'Horario\addHourController@addHourDocente')->name('addHourForo');

Route::post('/generarHorarioAnt', 'Horario\HorarioController@generarHorario');
Route::post('addHour/setHorarioJurado', 'Horario\HorarioJuradoController@setHorarioJurado');
/////////////////////////////////						GET				/////////////////////////////////////////
Route::get('horarios', 'Horario\HorarioProyectosController@index');
Route::get('horarios/get-proyectos-foro-horario', 'Horario\HorarioProyectosController@getProyectosForo');
Route::get('addHour', 'Horario\HorarioJuradoController@index');
Route::get('profes/horarios/{id?}', 'Horario\addHourController@agregarHorarios')->name('horariomaestro');
Route::get('Jprojects/get-proyectos-foro', 'OficinaController@getProyectosForo');


Route::post('foros/editarHorario', 'Horario\HorarioController@actualizarHorarioForo')->name('actualizarHorarioForo');

Route::post('foros/borrarHorario', 'Horario\HorarioController@borrarHorarioForo')->name('borrarHorarioForo');


Route::get('foros/horarioBreak/{id}', 'OficinaController@horarioBreak');
Route::post('foros/horarioBreak', 'OficinaController@setHorarioBreak')->name('setHorarioBreak');

// Route::get('horarioGenerado/{maestros}/{salones}/{resultado}','Horario\HorarioController@horarioGenerado');
Route::get('horarioGenerado', function () {
    return view('oficina.horarios.horarioGenerado');
});

Route::get('proyectos', 'Horario\HorarioController@proyectosHorarioMaestros');

Route::post('actualizarHorarioForo/{id}', 'Horario\HorarioController@actualizarHorarioForo')->name('actualizarHorarioForo');

Route::get('donwloadPDF','Horario\HorarioController@pdf')->name('donwloadPDF');

Route::post('guardarHorarioPDF','Horario\HorarioController@savePDF');

Route::get('/horario', function () {
    // $filepath = 'horario.pdf';
    // return response()->file(storage_path($filepath));
    $filename = 'horario.pdf';
    return response( Storage::disk('public')->get($filename), 200)
    ->header('Content-Type', Storage::disk('public')
        ->mimeType($filename)
    );

});

Route::get('horarioForo',function(){
    return view('oficina.horarios.horaForo');
});

Route::get('excel','Horario\HorarioController@excel');
// Route::get('horarios','Horario\HorarioController@index')->name('horarios');

// Acceso a la vista de horarios donde se creara todo lo de las hormigas
// Route::get('horarios', function(){
// 	$foros = DB::table('foros')->where('accesosecundario','=',1)->get();
// 	return view('oficina.horarios.horarios',compact('foros'));
// });

// Route::post('agregarProfeAforo/{id}','OficinaController@agregarProfeAforo')->name('agregarProfeAforo');
