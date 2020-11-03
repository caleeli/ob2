<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmEmpresaClasificacionsTable extends Migration
{
    public function up()
    {
        //DB::statement('CREATE VIEW adm_empresa_clasificacions AS select clasificacion, count(*) conteo from adm_empresas group by clasificacion');
    }


    public function down()
    {
        //Schema::dropIfExists('adm_empresa_clasificacions');
    }
}
