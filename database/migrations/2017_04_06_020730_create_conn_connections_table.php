<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnConnectionsTable extends Migration
{
    public function up()
    {
        Schema::create('conn_connections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('driver')->nullable();
            $table->string('host')->nullable();
            $table->string('port')->nullable();
            $table->string('database')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('charset')->nullable();
            $table->string('collation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('conn_connections');
    }
}
