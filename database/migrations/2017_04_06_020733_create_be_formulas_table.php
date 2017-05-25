<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeFormulasTable extends Migration
{
    public function up()
    {
        Schema::create('be_formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('formula')->nullable();
            $table->integer('origin_id')->unsigned();
            $table->integer('target_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('be_formulas');
    }
}
