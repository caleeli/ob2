<?php

use Illuminate\Foundation\Inspiring;

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

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('loadImages', function () {
    ini_set('memory_limit', '500M');
    $quality = 82;
    $name = 1;
    foreach (glob('/home/david/Downloads/*.jpg') as $filename) {
        $info = getimagesize($filename);
        $src_w = $info[0];
        $src_h = $info[1];
        $source = imagecreatefromstring(file_get_contents($filename));
        $dst_w = $src_w < $src_h ? 760 : ceil(514 * $src_w / $src_h);
        $dst_h = $src_w >= $src_h ? 514 : ceil(760 * $src_h / $src_w);
        $dest = imagecreatetruecolor($dst_w, $dst_h);
        imagecopyresampled($dest, $source, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        imagejpeg(
            $dest,
            "/home/david/www/be/public/images/variables/" . $name . '.jpg',
            $quality
        );
        $name++;
    }
    foreach (glob('/home/david/Downloads/*.png') as $filename) {
        $info = getimagesize($filename);
        $src_w = $info[0];
        $src_h = $info[1];
        $source = imagecreatefromstring(file_get_contents($filename));
        $dst_w = $src_w < $src_h ? 760 : ceil(514 * $src_w / $src_h);
        $dst_h = $src_w >= $src_h ? 514 : ceil(760 * $src_h / $src_w);
        $dest = imagecreatetruecolor($dst_w, $dst_h);
        imagecopyresampled($dest, $source, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        imagejpeg(
            $dest,
            "/home/david/www/be/public/images/variables/" . $name . '.jpg',
            $quality
        );
        $name++;
    }
})->describe('Display an inspiring quote');

Artisan::command('be:analiza', function () {
    $conn = DB::connection('datos');
    $variables = $conn->select(
        DB::raw('
            select distinct id_variable, nombre_variable_estadistica
            from valores_produccion
            left join variables_estadisticas on (valores_produccion.id_variable=variables_estadisticas.id_variable_estadistica)
        '),
        []
    );
    foreach ($variables as $var) {
        echo "(", $var->id_variable, ") ", $var->nombre_variable_estadistica, "\n";
        $cols = $conn->select(
            DB::raw('
            select *
            from valores_produccion
            limit 1')
        )[0];
        unset($cols->id_valor);
        unset($cols->id_variable);
        unset($cols->valor_cargado);
        unset($cols->defecto_valor_cargado);
        foreach ($cols as $c => $v) {
            $vals = $conn->select(
                DB::raw('
                select distinct ' . $c . '
                from valores_produccion
                where id_variable=?'),
                [
                    $var->id_variable
                ]
            );
            if ($vals[0]->$c || count($vals) > 1) {
                echo "    $c: ",count($vals),"\n";
            }
        }
        //break;
    }
})->describe('Analiza las variables');
