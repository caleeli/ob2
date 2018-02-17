<?php

namespace App\Http\Controllers;

use App\GDrive;
use App\Models\UserAdministration\HojaTrabajo;

class VueEditorController extends Controller
{

    public function edit($templeta, HojaTrabajo $hojaTrabajo = null)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $templeta);
        return view('hoja_trabajo', ['document' => $gTemplate->parse($hojaTrabajo)]);
    }

    public function index($path)
    {
        $drive = new GDrive;
        return response()->json($drive->files($path));
    }
}
