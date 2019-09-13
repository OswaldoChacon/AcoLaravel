<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForoDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forodoncentes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_foro');
            $table->foreign('id_foro')->references('id')->on('foros');
            $table->unsignedInteger('id_profe');
            $table->foreign('id_profe')->references('id')->on('docentes');
            $table->string('n_profe');
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
        Schema::dropIfExists('foro_docentes');
    }
}
