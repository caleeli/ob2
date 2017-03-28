<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeDimensionsTable extends Migration
{
    public function up()
    {
        Schema::create('be_dimensions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('column')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('be_dimensions');
    }
}
