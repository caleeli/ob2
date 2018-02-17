<?php

namespace App\Http\Controllers;

use App\GDrive;

class VueEditorController extends Controller
{

    public function edit($id)
    {
        $drive = new GDrive;
        $gTemplate = new \App\GTemplate($drive, $id);
        return view('hoja_trabajo', ['document' => $gTemplate->parse()]);
    }

    public function index($path)
    {
        $drive = new GDrive;
        return response()->json($drive->files($path));
    }

}
