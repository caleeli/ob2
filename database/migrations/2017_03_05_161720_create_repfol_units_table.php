<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepfolUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('repfol_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('family_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('repfol_units');
    }
}
