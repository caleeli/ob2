<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DBDumpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nano:dbdump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $tables = [];

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
        $f = fopen('dump.php', 'w');
        fwrite($f, "<?php\n");
        foreach ($this->tables as $table) {
            try {
                $data = DB::select("select * from $table");
                if ($data) {
                    fwrite($f,
                           "try{DB::table('$table')->insert(".str_replace('stdClass::__set_state',
                                                                      '',
                                                                      var_export($data,
                                                                                 true)).");}catch(\\Exception \$e){echo \$e->getMessage(),\"\\n\";}\n");
                }
            } catch (\Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }
    }

    private function getTableName($filename)
    {
        $content = file_get_contents($filename);
        $match = [];
        preg_match('/protected\s+\$table\s+=\s+[\'"](\w+)[\'"]/', $content,
                   $match);
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
}
