<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmContratacionsTable extends Migration
{
    public function up()
    {
        Schema::create('contrataciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_firma')->nullable();
            $table->text('informe_scep')->nullable();
            $table->text('nota')->nullable();
            $table->string('gestion')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->integer('uai_elaborado_por_id')->unsigned()->nullable();
            $table->integer('evcon_elaborado_por_id')->unsigned()->nullable();
            $table->integer('evcon_supervisor_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('contrataciones');
    }
}
