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
        $menues = [];
        $v8 = new V8Js("PHP");
        $v8->createFolders = function($folders) {
            foreach ($folders as $folder) {
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
            }
        };
        $v8->var_export = function($value, $indent = '', $indentFirst = false) use($v8) {
            $simpleArray = is_array($value) &&
                array_keys($value) === array_keys(array_keys($value));
            if ($simpleArray) {
                $str = "[".($value?"\n":"");
                foreach ($value as $v) {
                    $str.=call_user_func($v8->var_export,$v, '    ', true).",\n";
                }
                $str.="]";
            } elseif(is_array($value)) {
                $str = "[".($value?"\n":"");
                foreach ($value as $k => $v) {
                    $str.="    ".var_export($k, true).
                        " => ".
                        call_user_func($v8->var_export,$v, '    ', false).",\n";
                }
                $str.="]";
            } else {
                $str=var_export($value,true);
            }
            return call_user_func($v8->indent, $str, $indent, $indentFirst);
        };
        $v8->indent = function($code, $tab, $firstLine = true) {
            $lines = explode("\n", $code);
            foreach ($lines as $i => &$line) {
                if (($i == 0 && $firstLine) || ($i > 0)) {
                    $line = $tab.$line;
                }
            }
            return implode("\n", $lines);
        };
        $v8->upper_camel_case = function($value) {
            return ucfirst(camel_case($value));
        };
        $v8->camel_case = function($value) {
            return camel_case($value);
        };
        $v8->str_plural = function($value) {
            return str_plural($value);
        };
        $v8->snake_case = function($value) {
            return snake_case($value);
        };
        $v8->registerMenu = function($menuDef, $module) use(&$menues) {
            $menues[$module] = $menuDef;
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
                        : '').(!empty($options->implements) ? " implements ".implode(", ", $options->implements):""),
                '{',
                ($options->traits ? "    use ".implode(", ", $options->traits).";"
                        : ''),
                $this->parseProperties($options->properties),
                ($options->methods ? implode("\n\n", (array) $options->methods) : ''),
                '}',
            ]);
            if (!file_exists(dirname($filename))) {
                mkdir(dirname($filename), 0777, true);
            }
            file_put_contents($filename, $code);
            exec('vendor/bin/php-cs-fixer fix '.$filename.' > /dev/null 2>&1 & echo $!');
        };
        $v8->createMigration = function($name) {
            try {
                if (isset(glob(base_path().'/database/migrations/*'.snake_case($name).'.php')[0])) {
                    return glob(base_path().'/database/migrations/*'.snake_case($name).'.php')[0];
                }
                Artisan::call('make:migration', ['name' => snake_case($name)]);
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
            return glob(base_path().'/database/migrations/*'.snake_case($name).'.php')[0];
        };
        $v8->registerListener = function($eventClass, $listenerClass) use($v8){
            $filename = app_path('Providers/EventServiceProvider.php');
            $code = file_get_contents($filename);
            if (preg_match('/protected \$listen\s*=\s*([^;]+);/', $code, $match,
                           PREG_OFFSET_CAPTURE)) {
                $i = $match[1][1];
                $string = $match[1][0];
                $length = strlen($string);
                eval('$array='.$string.';');
                if (!isset($array[$eventClass]) || array_search($listenerClass, $array[$eventClass]) === false) {
                    $array[$eventClass][] = $listenerClass;
                    $code = substr($code, 0, $i).
                        trim(call_user_func($v8->var_export,$array, '    ', false)).
                        //trim(str_replace(['{','}',':',',','[',']'],["[\n","\n]",'=>',",\n","[\n","\n]"],json_encode($array))).
                        substr($code, $i + $length);
                    file_put_contents($filename, $code);
                }
                exec('vendor/bin/php-cs-fixer fix '.$filename.' > /dev/null 2>&1 & echo $!');
            }
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
        $modulesJs = "";
        $dirList = glob(base_path().'/nano/modules/*.php');
        sort($dirList);
        foreach ($dirList as $id => $filename) {
            $code = file_get_contents($filename);
            $tokens = token_get_all($code);
            $phpCode = null;
            $xmlCode = '';
            foreach ($tokens as $t) {
                if (is_array($t)) {
                    if (T_INLINE_HTML === $t[0]) {
                        $xmlCode.=$t[1];
                    } elseif (T_OPEN_TAG === $t[0]) {
                        $phpCode = '';
                    } elseif (T_CLOSE_TAG === $t[0]) {
                        $lines = substr_count($phpCode, "\n") + 1;
                        $xmlCode.=htmlentities(json_encode($phpCode), ENT_NOQUOTES, 'utf-8').str_repeat("\n", $lines);
                    } else {
                        $phpCode.=$t[1];
                    }
                } else {
                    $phpCode.=$t;
                }
            }
            $dom = new \DOMDocument;
            try {
                $dom->loadXML($xmlCode);
            }catch (\Exception $e) {
                echo "Error in $filename: \n$xmlCode";
                throw $e;
            }
            foreach ($dom->getElementsByTagName('template') as $template) {
                $v8->template = str_replace('vue:', ':',
                                            $dom->saveHTML($template));
            }
            foreach ($dom->getElementsByTagName('script') as $script) {
                $v8->executeString(str_repeat("\n", $script->getLineNo()-1) . $script->nodeValue, $filename);
            }
        }
        //Install Modules
        $v8->executeString('object2array(Module.instances,"item.install()");');
        foreach ($dirList as $id => $filename) {
            $name = basename($filename, '.php');
            $menues[$name]->id = $id;
            dump($filename);
            $modulesJs.="Vue.component('".strtolower($name)."', require('./modules/".$name.".vue'));\n";
            $modulesJs.="registerMenu(".json_encode($menues[$name]).");\n";
        }
        file_put_contents(resource_path().'/assets/js/modules.js', $modulesJs);
        passthru("gulp");
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
