<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorarioforosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarioforos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_foro');
            $table->foreign('id_foro')->references('id')->on('foros');
            $table->string('dia');
            $table->time('horario_inicio');
            $table->time('horario_termino');
            $table->date('fecha_foro');
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
        Schema::dropIfExists('horarioforos');
    }
}
