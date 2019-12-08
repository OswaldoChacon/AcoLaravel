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







// Route::get('Jprojects/get-proyectos-foro', 'OficinaController@getProyectosForo');








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
Route::get('/horarios', 'Horario\HorarioProyectosController@index');
Route::get('horarios/get-proyectos-foro-horario', 'Horario\HorarioProyectosController@getProyectosForo');
Route::get('addHour', 'Horario\HorarioJuradoController@index');
Route::get('profes/horarios/{id}', 'Horario\addHourController@agregarHorarios')->name('horariomaestro');
Route::get('Jprojects/get-proyectos-foro', 'OficinaController@getProyectosForo');


Route::post('foros/editarHorario', 'Horario\HorarioController@actualizarHorarioForo')->name('actualizarHorarioForo');

Route::post('foros/borrarHorario', 'Horario\HorarioController@borrarHorarioForo')->name('borrarHorarioForo');


Route::get('foros/horarioBreak/{id}', 'OficinaController@horarioBreak');
Route::post('foros/horarioBreak', 'OficinaController@setHorarioBreak')->name('setHorarioBreak');

// Route::get('horarioGenerado/{maestros}/{salones}/{resultado}','Horario\HorarioController@horarioGenerado');
Route::get('horarioGenerado', function () {
    return view('oficina.horarios.horarioGenerado');
});

Route::get('proyectosJurado', 'Horario\HorarioController@proyectosHorarioMaestros');

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


//mis rutas sunny
Route::get('EstadoDeProyectoAlumno/{id}','AlumnoController@EstadoDeProyectoAlumno')->name('EstadoDeProyectoAlumno');
Route::get('registroIr/{id}', 'AlumnoController@registroIr');
Route::get('detalleSeminario', 'AlumnoController@detalleSeminario');
Route::get('solicitarResidencia/{id}', 'AlumnoController@solicitarResidencia');
//rutas de oficina
Route::get('se', 'OficinaController@editarParticipa2');

Route::get('jurados/prueba', 'JuradosController@projectsSegui')->name('juradosprojects2');
//Route::get('horariosalv/get-proyectos-foro-horario', 'Horario\seguiController@getProyectosForo2');
//rutas de docente
//Route::get('proyectosDoc','DocenteController@obtenerProyectos')->name('proyectosDoc');
Route::get('docentes/proyectosDoc','DocenteController@obtenerProyectos')->name('proyectosDoc');

//Route::get('jurados/pruebaj','JuradosController@projectsSeguiDoc')->name('proyectosDoc');
//asi quedaria hay que probar mañana para que en la vista proyectos 2 valla @extends('seminario.layout')




//Route::get('jurados/pruebaj','JuradosController@projectsSeguiDoc')->name('proyectosDoc');

//Route::get('horariosalv2/get-proyectos-foro-horario', 'Horario\seguiDocenteController@getProyectosForo2n');
//Route::get('jurados/prueba', 'JuradosController@projectsSegui')->name('juradosprojects2');
