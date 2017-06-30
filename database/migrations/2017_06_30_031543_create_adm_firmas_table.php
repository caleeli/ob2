<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmFirmasTable extends Migration
{
    public function up()
    {
        Schema::create('adm_firmas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_firma')->nullable();
            $table->string('gestion')->nullable();
            $table->string('detalle')->nullable();
            $table->string('tipo_firma')->nullable();
            $table->string('representante_legal')->nullable();
            $table->string('socios')->nullable();
            $table->string('vigencia_certificado')->nullable();
            $table->text('documento_firma')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_firmas');
    }
}
