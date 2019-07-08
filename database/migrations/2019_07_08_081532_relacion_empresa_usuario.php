<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionEmpresaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_user', function (Blueprint $table) {
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('empresa_id')->references('id')->on('adm_empresas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('adm_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_user');
    }
}
