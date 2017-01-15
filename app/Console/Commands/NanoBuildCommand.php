<?php

namespace App\Console\Commands;

use V8Js;
use Illuminate\Console\Command;
use Artisan;

class NanoBuildCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nano:build';

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
        $v8 = new V8Js("PHP");
        $v8->createFolders = function($folders) {
            foreach ($folders as $folder) {
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
            }
        };
        $v8->var_export = function($value) {
            return var_export($value, true);
        };
        $v8->upper_camel_case = function($value) {
            return ucfirst(camel_case($value));
        };
        $v8->str_plural = function($value) {
            return str_plural($value);
        };
        $v8->snake_case = function($value) {
            return snake_case($value);
        };
        $v8->createClass = function($options) {
            $filename = $options->filename;
            $code = implode("\n",
                            [
                '<?php',
                ($options->namespace ? 'namespace '.$options->namespace.';' : ''),
                '',
                ($options->uses ? "use ".implode(";\nuse ", $options->uses).";\n"
                        : ''),
                '',
                'class '.$options->name.($options->extends ? ' extends '.$options->extends
                        : ''),
                '{',
                ($options->traits ? "    use ".implode(", ", $options->traits).";"
                        : ''),
                $this->parseProperties($options->properties),
                ($options->methods ? implode("\n\n", (array) $options->methods) : ''),
                '}',
            ]);
            file_put_contents($filename, $code);
            exec('vendor/bin/php-cs-fixer fix '.$filename .' > /dev/null 2>&1 & echo $!');
        };
        $v8->createMigration = function($name) {
            try {
                Artisan::call('make:migration', ['name' => snake_case($name)]);
            } catch (\Exception $e) {

            }
            return glob(base_path().'/database/migrations/*'.snake_case($name).'.php')[0];
        };
        $v8->log = function() {
            call_user_func_array('dump', func_get_args());
        };
        $v8->createFile = function($filename, $data) {
            file_put_contents($filename, $data);
        };
        foreach (glob(base_path().'/nano/base/*.js') as $filename) {
            $v8->executeString(file_get_contents($filename), $filename);
        }
        foreach (glob(base_path().'/nano/modules/*.js') as $filename) {
            $v8->executeString(file_get_contents($filename), $filename);
        }
    }

    protected function parseProperties($properties)
    {
        $res = [];
        foreach ((array) $properties as $name => $value) {
            if (is_object($value)) {
                $value = (array) $value;
            }
            $res[] = $name.' = '.var_export($value, true).';';
        }
        return $this->indent(implode("\n", $res), 4);
    }

    protected function indent($str, $spaces = 4)
    {
        $array = explode("\n", $str);
        foreach ($array as &$a) {
            $a = str_repeat(' ', $spaces).$a;
        }
        return implode("\n", $array);
    }
}
