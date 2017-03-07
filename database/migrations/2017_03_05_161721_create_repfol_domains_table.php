<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepfolDomainsTable extends Migration
{
    public function up()
    {
        Schema::create('repfol_domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('synonyms')->nullable();
            $table->integer('dimension_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('repfol_domains');
    }
}
