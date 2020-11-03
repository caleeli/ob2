<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmAsignacionsTable extends Migration
{
    public function up()
    {
        Schema::create('tarea_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tarea_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('nro_asignacion')->default(1);
            $table->string('dias_plazo', 5)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tarea_user');
    }
}
