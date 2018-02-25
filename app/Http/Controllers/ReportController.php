<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Description of ReportController
 *
 * @author davidcallizaya
 */
class ReportController extends Controller
{
    const FORMAT = '"1064*1377"';

    public function report(Request $request)
    {
        $path = $request->input('path');
        $format = $request->input('format', null);
        return $this->toPDF(env('APP_URL') . $path, $format);
    }

    public function pdf(Request $request)
    {
        $url = $request->input('url');
        $format = $request->input('format', null);
        return $this->toPDF($url, $format);
    }

    private function toPDF($url, $format=null)
    {
        $url1 = escapeshellarg($url);
        $rasterize = escapeshellarg(base_path('bin/rasterize.js'));
        $target0 = storage_path('app/public/report/' . uniqid('rep') . '.pdf');
        $target = escapeshellarg($target0);
        $format = !empty($format)
            ? '"'.$format.'"'
            : self::FORMAT;
        $cmd = env('PHANTOMJS') . " $rasterize $url1 $target $format";
        exec($cmd);
        return redirect('/storage/report/' . basename($target0));
    }
}
