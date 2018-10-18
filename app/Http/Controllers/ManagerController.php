<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{

    public function index()
    {
        return view('manager');
    }

    public function restoreBK(Request $request)
    {
        set_time_limit(-1);
        $url = $request->input('url');
        $password = $request->input('password');
        if ($password!=env('DB_PASSWORD')) {
            abort(422, 'Contraseña inválida');
        }
        //copy($url, base_path('backup.tar.gz'));
        chdir(base_path());
        passthru('tar xfz backup.tar.gz ./  2>&1');
        passthru('psql ' . env('DB_DATABASE') . ' < backup/backup.pgsql  2>&1');
    }
}
