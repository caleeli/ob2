<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CordovaPrepare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cordova:prepare {output} {apiServer}';

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
        $dst = realpath($this->argument('output'));
        $apiServer = $this->argument('apiServer');
        //passthru("gulp");
        $indexContent = file_get_contents($apiServer);
        $this->copyDir('public', $dst);
        file_put_contents(
            $dst . '/index.html',
            str_replace(
                [
                    "var API_SERVER = '';",
                    '"/js/app.js',
                    '"/css/app.css',
                ],
                [
                    "var API_SERVER = '$apiServer';",
                    '"js/app.js',
                    '"css/app.css',
                ],
                $indexContent
            )
        );
        unlink($dst.'/index.php');
    }

    /**
     * Copy dir
     * @param $src
     * @param $dst
     */
    private function copyDir($src, $dst)
    {
        if (!file_exists($dst)) {
            mkdir($dst);
        }
        $dir = opendir($src);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->copyDir($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}




