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
            $table->string('titular_uai')->nullable();
            $table->string('estructura_uai')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_uais');
    }
}
