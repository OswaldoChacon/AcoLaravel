<?php
Route::delete('LineaDeInvestigacioneliminar/{id}','OficinaController@LineaDeInvestigacioneliminar');
Route::put('/LineaDeInvestigacioneditar','OficinaController@LineaDeInvestigacioneditar');
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
Route::post('numMaestros/{id}', 'OficinaController@numMaestros')->name('numMaestros');
Route::post('/configurarForoAtributos/{id}', 'OficinaController@configurarForoAtributos');
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
Route::get('/archivoForo/{id}', 'OficinaController@archivoForo')->name('archivoForo');
Route::get('/archivoForo1/{id}', 'OficinaController@archivoForo1')->name('archivoForo');
Route::get('/archivoForo2/{id}', 'OficinaController@archivoForo2')->name('archivoForo');
Route::get('/jurado/{id}', 'OficinaController@jurado')->name('jurado');
Route::get('/cerrar/{id}', 'OficinaController@cerrar')->name('cerrar');
Route::get('/evento_et', function () {
    return view('oficina.horarios.eventoET');
});
Route::get('/generarHorario', 'Horario\HorarioController@generarHorarioView');
// function () {
//     $salones = Foro::select('num_aulas')->where('acceso', 1)->get()->first();
//     // dd($salones);
//     return view('oficina.horarios.generarHorario');
// });
