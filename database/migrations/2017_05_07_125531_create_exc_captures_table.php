<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcCapturesTable extends Migration
{
    public function up()
    {
        Schema::create('exc_captures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('part_of')->nullable();
            $table->text('file')->nullable();
            $table->string('temporal_table')->nullable();
            $table->text('imported_columns')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('exc_captures');
    }
}
