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
    const FORMAT = '"1400*1811"';

    public function report(Request $request)
    {
        $path = $request->input('path');
        $width = $request->input('width', null);
        return $this->toPDF(env('APP_URL') . $path, $width);
    }

    public function pdf(Request $request)
    {
        $url = $request->input('url');
        $width = $request->input('width', null);
        return $this->toPDF($url, $width);
    }

    private function toPDF($url, $width=null)
    {
        $url1 = escapeshellarg($url);
        $rasterize = escapeshellarg(base_path('bin/rasterize.js'));
        $target0 = storage_path('app/public/report/' . uniqid('rep') . '.pdf');
        $target = escapeshellarg($target0);
        $format = $width
            ? '"'.$width.'*'. ceil($width/8.5*11).'"'
            : self::FORMAT;
        $cmd = env('PHANTOMJS') . " $rasterize $url1 $target $format";
        exec($cmd);
        return redirect('/storage/report/' . basename($target0));
    }
}
