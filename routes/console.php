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

Artisan::command(
    'install',
    function () {
    try {
        DB::statement('CREATE DATABASE '.env('DB_DATABASE'));
    } catch (Exception $e) {
        echo $e->getMessage()."\n";
        if ($this->choice('Continue?', ['yes', 'no'], 1)==='no') {
            return;
        }
        Artisan::call('migrate:reset');
    }
    Artisan::call('migrate', ['--seed' => true]);
})->describe('Instala la aplicacion de 0');

Artisan::command(
    'backup',
    function () {
// How to connect to the process
    $descriptorspec = array(
        0 => array("pipe", "r"),
        1 => array("pipe", "w")
    );

// Create connection
    $process = proc_open("pg_dump -U ".env('DB_USERNAME')." -h 127.0.0.1 --password ".env('DB_DATABASE'), $descriptorspec, $pipes);
    if (!is_resource($process)) {
        die('Could not execute pg_dump');
    }

// Sleep & send something to it:
    sleep(1);
    fwrite($pipes[0], env('DB_PASSWORD').'\n');

// You can read the output through the handle $pipes[1].
// Reading 1 byte looks like this:
    $result = fread($pipes[1], 1);
    echo $result;
// Close the connection to the process
// This most likely causes the process to stop, depending on its signal handlers
    proc_close($process);
})->describe('backup');
