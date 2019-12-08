<?php
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