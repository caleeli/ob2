<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeVariablesTable extends Migration
{
    public function up()
    {
        Schema::create('be_variables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('aggregator')->nullable();
            $table->string('rows')->nullable();
            $table->string('cols')->nullable();
            $table->string('filter')->nullable();
            $table->string('information_source')->nullable();
            $table->text('file')->nullable();
            $table->string('periodicity')->nullable();
            $table->string('source_link')->nullable();
            $table->string('chart_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('be_variables');
    }
}
