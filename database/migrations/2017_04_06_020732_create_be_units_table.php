<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('be_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('family_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('be_units');
    }
}
