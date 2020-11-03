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
            $table->string('observaciones')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->string('detalle')->nullable();
            $table->string('representante_legal')->nullable();
            $table->integer('uai_elaborado_por')->unsigned()->nullable();
            $table->integer('evcon_elaborado_por')->unsigned()->nullable();
            $table->integer('evcon_supervisor')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('usuario_abm_id')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('contrataciones');
    }
}
