<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmLafirmasTable extends Migration
{
    public function up()
    {
        Schema::create('adm_firmas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_firma')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_firmas');
    }
}
