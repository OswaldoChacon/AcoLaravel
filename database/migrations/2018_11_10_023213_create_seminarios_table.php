<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeminariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->integer('numeroSeminario');
            $table->string('periodo');
            $table->integer('anio');
            $table->unsignedInteger('foro_id');
            $table->foreign('foro_id')->references('id')->on('foros');

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
        Schema::dropIfExists('seminarios');
    }
}
