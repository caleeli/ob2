<?php

use Illuminate\Foundation\Inspiring;
use App\Models\ReportsFolders\Variable;
use App\Models\ReportsFolders\Dimension;
use App\Models\ReportsFolders\Domain;
use App\Models\ReportsFolders\Family;

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

Artisan::command('loadImages',
                 function () {
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
        imagecopyresampled($dest, $source, 0, 0, 0, 0, $dst_w, $dst_h, $src_w,
                           $src_h);
        imagejpeg(
            $dest, "/home/david/www/be/public/images/variables/".$name.'.jpg',
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
        imagecopyresampled($dest, $source, 0, 0, 0, 0, $dst_w, $dst_h, $src_w,
                           $src_h);
        imagejpeg(
            $dest, "/home/david/www/be/public/images/variables/".$name.'.jpg',
            $quality
        );
        $name++;
    }
})->describe('Display an inspiring quote');

Artisan::command('be:analiza',
                 function () {
    /* @var $variable \App\Models\ReportsFolders\Variable */
    /* @var $dimension \App\Models\ReportsFolders\Dimension */
    /* @var $pdo \PDO */
    $variables = [];
    $dimensions = [];
    $families = [];
    $domains = [];
    $conn = DB::connection('datos');
    $variablesQ = $conn->select(
        DB::raw('
            select distinct id_variable, nombre_variable_estadistica, desc_variable_estadistica, tipo_variable_estadistica
            from valores_produccion
            left join variables_estadisticas on (valores_produccion.id_variable=variables_estadisticas.id_variable_estadistica)
            order by id_variable
        '), []
    );
    foreach ($variablesQ as $var) {
        echo "(", $var->id_variable, ") ", $var->nombre_variable_estadistica, "\n";
        //create load variable
        $variable = Variable::firstOrNew([
                'id' => $var->id_variable,
        ]);
        if (!$variable->exists) {
            $variable->id = $var->id_variable;
            $variable->name = $var->nombre_variable_estadistica;
            $variable->description = $var->desc_variable_estadistica;
            $variable->image = searchSaveImage($var->desc_variable_estadistica);
            $variable->save();
        } elseif (empty($variable->image)) {
            $variable->image = searchSaveImage($var->desc_variable_estadistica);
            $variable->save();
        }
        //select columns
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
                select distinct '.$c.'
                from valores_produccion
                where id_variable=?'),
                        [
                $var->id_variable
                ]
            );
            if ($vals[0]->$c || count($vals) > 1) {
                echo "    $c: ", count($vals), "\n";
                $dim = $conn->select(
                        DB::raw('
                        SELECT * FROM variables_estadisticas_dimensiones
                        where id_variable_estadistica=? and atributo_tabla_origen=?
                    '),
                                [
                        $var->id_variable,
                        $c,
                        ]
                    )[0];
                if (!isset($dimensions[$var->id_variable.';'.$c])) {
                    $dimensions[$var->id_variable.';'.$c] = Dimension::firstOrNew([
                            "name"   => $dim->nombre_dimension,
                            "column" => $c,
                    ]);
                    if (!$dimensions[$var->id_variable.';'.$c]->exists) {
                        $dimensions[$var->id_variable.';'.$c]->save();
                    }
                }
                if (!isset($families[$var->tipo_variable_estadistica])) {
                    $families[$var->tipo_variable_estadistica] = Family::firstOrNew([
                            "name" => $var->tipo_variable_estadistica,
                    ]);
                    if (!$families[$var->tipo_variable_estadistica]->exists) {
                        $families[$var->tipo_variable_estadistica]->save();
                    }
                }
                $dimension = $dimensions[$var->id_variable.';'.$c];
                $family = $families[$var->tipo_variable_estadistica];
                if (!$variable->dimensions->contains($dimension->id)) {
                    $variable->dimensions()->attach($dimension);
                }
                $dimension->family()->associate($family);
                foreach ($vals as $val) {
                    if (is_numeric($val->$c)) {
                        continue;
                    }
                    if (!isset($domains[$dimension->id][$val->$c])) {
                        $domains[$dimension->id][$val->$c] = Domain::firstOrNew([
                                "name" => $val->$c,
                                "dimension_id" => $dimension->id,
                        ]);
                        if (!$domains[$dimension->id][$val->$c]->exists) {
                            $domains[$dimension->id][$val->$c]->save();
                        }
                    }
                    if (!$dimension->domains->contains($domains[$dimension->id][$val->$c]->id)) {
                        $dimension->domains()->save($domains[$dimension->id][$val->$c]);
                    }
                }
            }
        }
    }
})->describe('Analiza las variables');

function searchSaveImage($description, $quality = 82)
{
    $filename = public_path('images/variables/'.md5($description).'.jpg');
    if (file_exists($filename)) {
        return substr($filename, strlen(public_path('images/variables/')));
    }
    $dom = new DOMDocument;
    //@$dom->loadHTMLFile('http://www.bing.com/images/search?&q='.urlencode($description).'&qft=+filterui:license-L2_L3&FORM=R5IR45');
    @$dom->loadHTMLFile('http://www.bing.com/images/search?cw=1280&ch=599&q='.urlencode($description.' Bolivia').'&qft=+filterui:photo-photo+filterui:aspect-square&FORM=R5IR37');
    foreach ($dom->getElementsByTagName('a') as $img) {
        if ($img->getAttribute('class') === 'thumb' && strpos($img->getAttribute('href'),
                                                                                 'http')
            === 0) {
            dump($img->getAttribute('href'));
            try {
                $source = imagecreatefromstring(file_get_contents($img->getAttribute('href')));
            } catch (\Exception $expection) {
                continue;
            }
            $src_w = imagesx($source);
            $src_h = imagesy($source);
            if ($src_w < 514 || $src_h < 514) {
                continue;
            }
            $dst_w = $src_w < $src_h ? 760 : ceil(514 * $src_w / $src_h);
            $dst_h = $src_w >= $src_h ? 514 : ceil(760 * $src_h / $src_w);
            $dest = imagecreatetruecolor($dst_w, $dst_h);
            imagecopyresampled($dest, $source, 0, 0, 0, 0, $dst_w, $dst_h,
                               $src_w, $src_h);
            imagejpeg($dest, $filename, $quality);
            return substr($filename, strlen(public_path('images/variables/')));
        }
    }
    return rand(1, 42).'.jpg';
}
Artisan::command(
    'install',
    function () {
    Artisan::call('migrate', ['--seed' => true]);
    \App\Models\Connections\Connection::create([
        'name'     => 'datos',
        'driver'   => $this->choice('driver',
                                    ["pgsql" => "pgsql", "mysql" => "mysql"],
                                    'pgsql'),
        'host'     => $this->ask('host'),
        'port'     => $this->ask('port ["5432","3306"]', '5432'),
        'database' => $this->ask('database'),
        'username' => $this->ask('username'),
        'password' => $this->secret('password'),
        'charset'  => 'utf-8',
    ]);
    Artisan::call('be:analiza', []);
})->describe('Instala la aplicacion de 0');
