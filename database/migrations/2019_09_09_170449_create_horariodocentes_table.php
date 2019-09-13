<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariodocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horariodocentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dia');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->date('fecha');
            $table->unsignedInteger('id_docente');
            $table->foreign('id_docente')->references('id')->on('docentes');
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
        Schema::dropIfExists('horariodocente');
    }
}
