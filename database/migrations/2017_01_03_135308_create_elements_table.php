<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    public function up()
    {
        Schema::create('undefined_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('script')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('element');
    }
}
