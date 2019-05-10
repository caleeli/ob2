<?php

use Illuminate\Foundation\Inspiring;
use App\Models\ReportsFolders\Variable;
use App\Models\ReportsFolders\Dimension;
use App\Models\ReportsFolders\Domain;
use App\Models\ReportsFolders\Family;
use App\Models\UserAdministration\Asignacion;
use Carbon\Carbon;

/*
  |--------------------------------------------------------------------------
  | Console Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of your Closure based console
  | commands. Each Closure is bound to a command instance allowing a
  | simple approach to interacting with each command's IO methods.
  |
 */

Artisan::command('inspire',
                 function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command(
    'install',
    function () {
    try {
        DB::statement('CREATE DATABASE '.env('DB_DATABASE'));
    } catch (Exception $e) {
        echo $e->getMessage()."\n";
        if ($this->choice('Continue?', ['yes', 'no'], 1)==='no') {
            return;
        }
        Artisan::call('migrate:reset');
    }
    Artisan::call('migrate', ['--seed' => true]);
})->describe('Instala la aplicacion de 0');


Artisan::command('diaconia',
                 function () {
    \App\Models\UserAdministration\Tarea::truncate();
    Asignacion::truncate();
    $query = DB::connection('mysql')->select("SELECT
        concat('REV-', prmprnpre) cod_tarea,
        concat(prmprnpre, ' - ', gbagenomb) nombre_tarea, 
        concat(prtcrdesc, ' | Agencia: ', agencia, ' | ', gbciidesc) descripcion, 
        prtcrdesc,
        '', 
        '', 
        'Pendiente', 
        0, 
        'Media', 1, 1,1,1,1, now(), now(), null, 1, 1, 3, null, 2018,'EDC', '{}'
        FROM emprender.`operaciones`");
    $ttl = 300;
    foreach($query as $row) {
        $tipos = [
            'EDC' => ['CREDITO INDIVIDUAL', 'CREDITO INDIVIDUAL 4001 A 6000', 'CREDITO INDIVIDUAL 2000 A 3000', 'CREDITO INDIVIDUAL KIVA', 'CREDITO INDIVIDUAL REPROGRAMADO'],
            'AUD' => ['CREDITO VELOZ', ''], 
            'SUP' => ['BANCO COMUNAL'], 
            'RDI' => ['CREDITO DE TEMPORADA'], 
            'COD' => ['CREDIESTUDIO'], 
            'EIU' => ['BANCO COMUNAL REPROGRAMADO'], 
            'EIP' => ['CREDITO SOLIDARIO'], 
            'SYD' => ['BANCO COMUNAL KIVA'], 
            'TAD' => ['CREDITO OPORTUNO'], 
        ];
        $tipo = 'EDC';
        foreach($tipos as $tt => $t) {
            if (in_array(trim($row->prtcrdesc), $t)) {
                $tipo = $tt;
                break;
            }
        }
        $diasOtorgados = random_int(1,10);
        $tarea = new \App\Models\UserAdministration\Tarea([
            'cod_tarea' => $row->nombre_tarea,
            'nombre_tarea' => $row->nombre_tarea,
            'descripcion' => $row->descripcion,
            'estado' => 'Pendiente',
            'avance' => random_int(0,100),
            'prioridad' => randomElement(['Media', 'Alta', 'Baja']),
            'usuario_id' => 1,
            'revisor1_id' => 1,
            'aprobacion1_id' => 1,
            'revisor2_id' => 1,
            'aprobacion2_id' => 1,
            'creador_id' => 1,
            'usuario_abm_id' => 1,
            'dias_otorgados' => $diasOtorgados,
            'gestion' => randomElement(['2017', '2018']),
            'tipo' => $tipo,
            'datos' => [],
        ]);
        $tarea->created_at = Carbon::now()->subDays(random_int(0,$diasOtorgados));
        $tarea->save();
        $asignacion = new Asignacion([
            'user_id' => 1,
            'nro_asignacion' => 1,
            'dias_plazo' => $diasOtorgados,
        ]);
        $tarea->asignaciones()->saveMany([$asignacion]);
        $ttl--;
        if (!$ttl) break;
    }
})->describe('Carga datos para diaconia');

function randomElement($items) {
    return $items[array_rand($items)];
}
