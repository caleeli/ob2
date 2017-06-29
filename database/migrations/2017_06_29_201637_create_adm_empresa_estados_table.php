<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmEmpresaEstadosTable extends Migration
{
    public function up()
    {
        DB::statement('CREATE VIEW adm_empresa_estados AS select max(adm_estado_financieros.id) as id, adm_empresas.id as empresa_id, nombre_empresa, gestion from adm_estado_financieros left join adm_empresas on (adm_estado_financieros.empresa_id=adm_empresas.id) group by adm_empresas.id, gestion');
    }


    public function down()
    {
        Schema::dropIfExists('adm_empresa_estados');
    }
}
