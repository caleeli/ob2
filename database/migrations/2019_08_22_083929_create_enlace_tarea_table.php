<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnlaceTareaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlace_tarea', function (Blueprint $table) {
            $table->integer('tarea_id')->unsigned()->nullable();
            $table->integer('enlace_tarea_id')->unsigned()->nullable();
            $table->foreign('tarea_id')->references('id')->on('adm_tareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enlace_tarea');
    }
}
