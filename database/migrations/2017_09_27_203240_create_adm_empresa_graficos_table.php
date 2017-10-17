<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmEmpresaGraficosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_empresa_graficos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('informes_auditoria')->nullable();
            $table->text('datos')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_empresa_graficos');
    }
}
