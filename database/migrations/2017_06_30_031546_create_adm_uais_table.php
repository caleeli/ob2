<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmUaisTable extends Migration
{
    public function up()
    {
        Schema::create('adm_uais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_uai')->nullable();
            $table->string('gestion_uai')->nullable();
            $table->string('estructura_uai')->nullable();
            $table->string('tipo_de_informes')->nullable();
            $table->text('informes_emitidos_scep')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_uais');
    }
}
