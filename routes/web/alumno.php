<?php
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