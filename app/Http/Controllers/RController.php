<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportsFolders\Rchart;

/**
 * Description of ReportController
 *
 * @author davidcallizaya
 */
class RController extends Controller
{
    const FORMAT = '"1400*1811"';

    public function chart($id)
    {
        $variable = Rchart::where('id', '=', $id)->first();
        if (!$variable) return '';
        return $this->fromR($variable->id, $variable->r_code);
    }

    private function fromR($id, $code)
    {
        $target0 = realpath(storage_path('app/public')) . '/r' . $id . '.png';
        $target = escapeshellarg($target0);
        $source0 = realpath(storage_path('app/public')) . '/r' . $id . '.R';
        $source = escapeshellarg($source0);
        file_put_contents($source0, $code);
        $cmd = env('R_PATH') . " $source $target";
        exec($cmd);

        $im = imagecreatefrompng($target0);
        header('Content-Type: image/png');

        imagepng($im);
        imagedestroy($im);
        //return redirect('/storage/' . basename($target0));
    }
}
