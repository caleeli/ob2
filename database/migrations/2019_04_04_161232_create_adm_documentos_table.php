<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('archivo');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_documentos');
    }
}
