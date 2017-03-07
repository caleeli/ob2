<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DBImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nano:dbimport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::select('SET FOREIGN_KEY_CHECKS=0');
        require './dump.php';
        DB::select('SET FOREIGN_KEY_CHECKS=1');
    }
}
