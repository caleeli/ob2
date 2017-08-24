<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('adm_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_empresa')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->string('corporacion')->nullable();
            $table->string('caracter')->nullable();
            $table->string('rubro')->nullable();
            $table->string('tipologia')->nullable();
            $table->string('detalle_empresa')->nullable();
            $table->string('sub_empresa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_empresas');
    }
}
