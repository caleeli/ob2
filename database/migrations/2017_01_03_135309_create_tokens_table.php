<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    public function up()
    {
        Schema::create('undefined_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->integer('element_id')->unsigned()->nullable();
            $table->integer('element_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('token');
    }
}
