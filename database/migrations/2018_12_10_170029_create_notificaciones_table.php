<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
             $table->increments('id');
             $table->unsignedInteger('id_foro');
             $table->foreign('id_foro')->references('id')->on('foros');
             $table->unsignedInteger('id_proyecto');
             $table->foreign('id_proyecto')->references('id')->on('proyectos');
             $table->string('alumno_envio');
             $table->unsignedInteger('id_alumno');
             $table->foreign('id_alumno')->references('id')->on('alumnos');
             $table->string('titulo');
             $table->string('foro');
             $table->string('objetivo');
             $table->string('envio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}
