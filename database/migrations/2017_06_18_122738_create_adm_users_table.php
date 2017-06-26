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
            $table->text('avatar')->nullable();
            $table->integer('numero_ci');
            $table->integer('tipo_doc_ci');
            $table->integer('ext_doc')->nullable();
            $table->string('cod_estado_civil')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->integer('dep_cod')->nullable();
            $table->integer('cod_ciudad')->nullable();
            $table->integer('tipo_persona')->nullable();
            $table->integer('cod_nac')->nullable();
            $table->integer('nivel_edu')->nullable();
            $table->integer('cod_cliente')->nullable();
            $table->integer('fec_ven_cliente')->nullable();
            $table->string('email');
            $table->string('nro_dependientes')->nullable();
            $table->string('calificacion')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->date('fec_registro')->nullable();
            $table->date('hora_registro')->nullable();
            $table->string('cod_mun')->nullable();
            $table->string('cod_prov')->nullable();
            $table->string('cod_zona')->nullable();
            $table->string('unidad')->nullable();
            $table->integer('role_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('adm_users');
    }
}
