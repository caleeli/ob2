<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('exc_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('dimension_name')->nullable();
            $table->string('capture')->nullable();
            $table->string('default_value')->nullable();
            $table->string('copia_inicio_fila')->nullable();
            $table->string('copia_inicio_columna')->nullable();
            $table->string('copia_fin_fila')->nullable();
            $table->string('copia_fin_columna')->nullable();
            $table->string('incremento_secuencia')->nullable();
            $table->string('direccion_incremento')->nullable();
            $table->string('pegado_inicio_fila')->nullable();
            $table->integer('repetir_pegado')->nullable();
            $table->integer('sheet_id')->unsigned();
            $table->integer('dimension_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('exc_details');
    }
}
