<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmClasificacionEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('adm_clasificacion_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clasificacion')->nullable();
            $table->string('conteo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_clasificacion_empresas');
    }
}
