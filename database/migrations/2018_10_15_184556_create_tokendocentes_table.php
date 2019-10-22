<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokendocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokendocentes', function (Blueprint $table) {
            $table->increments('id');
              $table->string('token')->unique();;
            $table->integer('uso');
            // $table->string('id_usuario');
            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokendocentes');
    }
}
