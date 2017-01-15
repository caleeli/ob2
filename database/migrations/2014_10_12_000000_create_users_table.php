<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('usradm_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('user');
    }
}
