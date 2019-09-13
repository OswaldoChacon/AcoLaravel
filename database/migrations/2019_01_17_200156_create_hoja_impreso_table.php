<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojaImpresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voids
     */
    public function up()
    {
        Schema::create('hoja_impreso', function (Blueprint $table) {
            $table->unsignedInteger('hoja_id');
            $table->foreign('hoja_id')->references('id')->on('hojas');
            $table->unsignedInteger('impreso_id');
            $table->foreign('impreso_id')->references('id')->on('impresos');
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
        Schema::dropIfExists('hoja_impreso');
    }
}
