<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiapositivaHojaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diapositiva_hoja', function (Blueprint $table) {
            $table->integer('hoja_id')->unsigned();
            $table->foreign('hoja_id')->references('id')->on('hojas');
            $table->integer('diapositiva_id')->unsigned();
            $table->foreign('diapositiva_id')->references('id')->on('diapositivas');
            $table->integer('evaluacion')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diapositiva_hoja');
    }
}
