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
    const FORMAT = '"1200*1552"';

    public function report(Request $request)
    {
        $path = $request->input('path');
        return $this->toPDF(env('APP_URL') . $path);
    }

    public function pdf(Request $request)
    {
        $url = $request->input('url');
        return $this->toPDF($url);
    }

    private function toPDF($url)
    {
        $url1 = escapeshellarg($url);
        $rasterize = escapeshellarg(base_path('bin/rasterize.js'));
        $target0 = storage_path(uniqid('rep') . '.pdf');
        $target = escapeshellarg($target0);
        $format = self::FORMAT;
        $cmd = env('PHANTOMJS') . " $rasterize $url1 $target $format";
        exec($cmd);
        return response()->file($target0);
    }
}
