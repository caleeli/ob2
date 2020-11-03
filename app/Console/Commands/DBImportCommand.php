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
        $this->findModels(app_path().'/Models');
        $tables = [];
        foreach ($this->tables as $table) {
            try {
                DB::statement("ALTER $table DISABLE TRIGGER ALL;");
                $tables[] = $table;
            } catch (\Throwable $t) {
            }
        }
        $code = file_get_contents('./dump.php');
        $code = preg_replace('/DB::table\(\'(\w+)\'\)->insert\(/', '\$this->chunkInsert("$1",', $code);
        eval('?>' . $code);
        foreach ($tables as $table) {
            try {
                DB::statement("ALTER $table ENABLE TRIGGER ALL;");
            } catch (\Throwable $t) {
                dump($t->getMessage());
            }
        }
    }

    private function getTableName($filename)
    {
        $content = file_get_contents($filename);
        $match = [];
        preg_match(
            '/protected\s+\$table\s+=\s+[\'"](\w+)[\'"]/',
            $content,
            $match
        );
        return @$match[1];
    }

    private function findModels($path)
    {
        foreach (glob("$path/*.php") as $f) {
            $table = $this->getTableName($f);
            if ($table) {
                $this->tables[] = $table;
            }
        }
        foreach (glob("$path/*", GLOB_ONLYDIR) as $d) {
            $this->findModels($d);
        }
    }

    function chunkInsert($table, $array)
    {
        $chunks = array_chunk($array, 1000, true);
        foreach ($chunks as $chunk) {
            DB::table($table)->insert($chunk);
        }
    }
}
