<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurados', function (Blueprint $table) {
            $table->unsignedInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes');
            $table->unsignedInteger('proyectoforo_id');
            $table->foreign('proyectoforo_id')->references('id')->on('proyecto_foros');
            $table->unsignedInteger('hoja_id');
            $table->foreign('hoja_id')->references('id')->on('hojas');
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
        Schema::dropIfExists('jurados');
    }
}
