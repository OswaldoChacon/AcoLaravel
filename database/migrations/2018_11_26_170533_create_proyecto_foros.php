<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoForos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_Foros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_foro');//->nullable();
            $table->foreign('id_foro')->references('id')->on('foros');
            $table->string('titulo');
            $table->string('objetivo');
            $table->string('linea');
            $table->string('area');
            $table->string('assesor')->nullable();
            $table->string('nombre_de_empresa');
            $table->string('calificacion')->nullable();
            $table->unsignedInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->integer('seminario_id')->unsigned();//->nullable();
            $table->foreign('seminario_id')->references('id')->on('seminarios');
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
        Schema::dropIfExists('proyecto_Foros');
    }
}
