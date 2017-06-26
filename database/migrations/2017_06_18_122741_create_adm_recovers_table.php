<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmRecoversTable extends Migration
{
    public function up()
    {
        Schema::create('adm_recovers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->string('key');
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_recovers');
    }
}
