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
