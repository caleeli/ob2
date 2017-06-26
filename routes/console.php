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
