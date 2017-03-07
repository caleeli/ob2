<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepfolVariablesTable extends Migration
{
    public function up()
    {
        Schema::create('repfol_variables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('repfol_variables');
    }
}
