<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepfolFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('repfol_families', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('main_unit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('repfol_families');
    }
}
