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
            $table->integer('usuario_id')->unsigned();
            $table->integer('asignacion_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_avances');
    }
}
