<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsradmLoginsTable extends Migration
{
    public function up()
    {
        Schema::create('usradm_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('token');
            Schema::table('usradm_users', function (Blueprint $table) {
                $table->index(["username","password"]);
            });
            $table->foreign(["username","password"])->references(["username","password"])->on('usradm_users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('usradm_logins');
    }
}
