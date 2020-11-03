<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmEstadoFinancierosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_estado_financieros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_estado_financiero')->nullable();
            $table->string('informes_auditoria')->nullable();
            $table->string('gestion')->nullable();
            $table->text('archivo')->nullable();
            $table->text('grafico_texto')->nullable();
            $table->string('grafico_valores')->nullable();
            $table->string('prefix')->nullable();
            $table->text('tablas')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('usuario_abm_id')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_estado_financieros');
    }
}
