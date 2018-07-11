<?php

namespace App;

/**
 * Description of ToPDF
 *
 */
class ToPDF {

    const FORMAT = '"1064*1377"';

    public static function toPDF($url, $target0, $format = null) {
        $url1 = escapeshellarg($url);
        $rasterize = escapeshellarg(base_path('bin/rasterize.js'));
        //$target0 = storage_path('app/public/report/' . uniqid('rep') . '.pdf');
        $target = escapeshellarg($target0);
        $format = !empty($format) ? '"' . $format . '"' : self::FORMAT;
        $cmd = env('PHANTOMJS') . " $rasterize $url1 $target $format";
        exec($cmd);
    }

}
