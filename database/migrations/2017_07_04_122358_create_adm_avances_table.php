<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmAvancesTable extends Migration
{
    public function up()
    {
        Schema::create('adm_avances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('avance')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('tarea_id')->unsigned()->nullable();
            $table->integer('asignacion_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('usuario_abm_id')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_avances');
    }
}
