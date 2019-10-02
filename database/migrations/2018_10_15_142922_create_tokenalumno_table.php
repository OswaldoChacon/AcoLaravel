<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenalumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tokenalumnos');
        Schema::create('tokenalumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numerocontrol')->unique();
            $table->integer('uso');
            $table->unsignedInteger('id_usuario');//->nullable();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->integer('profe');
            $table->string('grupo')->nullable();
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
        Schema::dropIfExists('tokenalumno');
    }
}
