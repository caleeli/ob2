<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginsTable extends Migration
{
    public function up()
    {
        Schema::create('usradm_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('timestamp')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('login');
    }
}
