<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmAdjuntosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_adjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('archivo')->nullable();
            $table->integer('tarea_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_adjuntos');
    }
}
