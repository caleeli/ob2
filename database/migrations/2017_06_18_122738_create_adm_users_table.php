<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmUsersTable extends Migration
{
    public function up()
    {
        Schema::create('adm_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->text('fotografia')->nullable();
            $table->integer('numero_ci')->nullable();
            $table->integer('tipo_doc_ci')->nullable();
            $table->integer('ext_doc')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->integer('cod_cliente')->nullable();
            $table->string('email')->nullable();
            $table->integer('role_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('usuario_abm_id')->nullable();
            $table->integer('posicion');
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_users');
    }
}
