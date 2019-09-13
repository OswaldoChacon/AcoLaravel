<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHojaResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoja_resume', function (Blueprint $table) {
            $table->unsignedInteger('hoja_id');
            $table->foreign('hoja_id')->references('id')->on('hojas');
            $table->unsignedInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('resumes');
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
        Schema::dropIfExists('hoja_resume');
    }
}
