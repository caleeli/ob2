<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmFideicomisosTable extends Migration
{
    public function up()
    {
        Schema::create('adm_fideicomisos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('decreto')->nullable();
            $table->string('financiador')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_fideicomisos');
    }
}
