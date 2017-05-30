<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeReportsTable extends Migration
{
    public function up()
    {
        Schema::create('be_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('variables')->nullable();
            $table->string('aggregator')->nullable();
            $table->string('rows')->nullable();
            $table->string('cols')->nullable();
            $table->string('chart_type')->nullable();
            $table->string('filter')->nullable();
            $table->integer('folder_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('be_reports');
    }
}
