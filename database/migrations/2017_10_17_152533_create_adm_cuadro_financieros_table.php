<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmCuadroFinancierosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_cuadro_financieros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->nullable();
            $table->string('contenido')->nullable();
            $table->string('grafico')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_cuadro_financieros');
    }
}
