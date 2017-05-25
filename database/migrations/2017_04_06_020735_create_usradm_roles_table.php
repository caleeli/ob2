<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsradmRolesTable extends Migration
{
    public function up()
    {
        Schema::create('usradm_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('usradm_roles');
    }
}
