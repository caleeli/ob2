<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmFirmasTable extends Migration
{
    public function up()
    {
        Schema::create('adm_evaluacion_consistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_firma')->nullable();
            $table->string('gestion')->nullable();
            $table->text('detalle')->nullable();
            $table->string('tipo_firma')->nullable();
            $table->string('representante_legal')->nullable();
            $table->string('socios')->nullable();
            $table->string('vigencia_certificado')->nullable();
            $table->text('documento_firma')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->text('informe_dictamen')->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->text('informes')->default('[]');
            $table->integer('representante_legal_id')->unsigned()->nullable();
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('usuario_abm_id')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_evaluacion_consistencias');
    }
}
