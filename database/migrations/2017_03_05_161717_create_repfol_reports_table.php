<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepfolReportsTable extends Migration
{
    public function up()
    {
        Schema::create('repfol_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('table')->nullable();
            $table->string('aggregator')->nullable();
            $table->string('measure')->nullable();
            $table->string('rows')->nullable();
            $table->string('cols')->nullable();
            $table->integer('folder_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('repfol_reports');
    }
}
