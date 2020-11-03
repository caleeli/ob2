<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmHojaTrabajosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_hoja_trabajos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->nullable();
            $table->string('templeta')->nullable();
            $table->string('gestion')->nullable();
            $table->text('valores')->default('{}')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('usuario_abm_id')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_hoja_trabajos');
    }
}
