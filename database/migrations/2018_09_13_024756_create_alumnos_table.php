<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\QueryException;


class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->unsignedInteger('id_profe');
            $table->foreign('id_profe')->references('id')->on('docentes');
            $table->string('grupo')->nullable();
            $table->string('password');
            $table->string('acceso');
            $table->string('nocontrol')->unique();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
