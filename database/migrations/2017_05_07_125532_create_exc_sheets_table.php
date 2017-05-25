<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcSheetsTable extends Migration
{
    public function up()
    {
        Schema::create('exc_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->nullable();
            $table->string('name')->nullable();
            $table->string('rows')->nullable();
            $table->string('cols')->nullable();
            $table->string('to_load')->nullable();
            $table->integer('load_order')->nullable();
            $table->string('process')->nullable();
            $table->integer('capture_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('exc_sheets');
    }
}
