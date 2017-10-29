<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmCargaEstadosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_carga_estados', function (Blueprint $table) {
            $table->increments('id');
            $table->text('files')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_carga_estados');
    }
}
