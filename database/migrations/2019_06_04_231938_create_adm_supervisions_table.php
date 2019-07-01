<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmSupervisionsTable extends Migration
{
    public function up()
    {
        Schema::create('adm_supervisiones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_supervision')->nullable();
            $table->text('documento')->nullable();
            $table->text('informes')->nullable();
            $table->text('anexos')->nullable();
            $table->text('nota_emitida')->nullable();
            $table->string('gestion')->nullable();
            $table->string('detalle')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->integer('owner2_id')->unsigned()->nullable();
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_supervisiones');
    }
}
