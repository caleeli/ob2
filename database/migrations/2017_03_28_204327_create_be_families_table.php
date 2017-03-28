<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('be_families', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('main_unit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('be_families');
    }
}
