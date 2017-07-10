<?php

namespace app\Builder;

/**
 * Resource builder
 */
class Resource extends Element
{
    public static $transformation = [
        'definition' => \App\Builder\Definition::class
    ];
    protected static $instances = [
    ];

    /**
     * Get an resource instance by full name
     * @param string $type
     * @return Resource
     */
    public static function get($type)
    {
        return Resource::$instances[$type];
    }

    public function __construct($jResource, $key = null)
    {
        parent::__construct($jResource, $key);
        Resource::$instances[$this->fullName()] = $this;
    }

    public function makeFile($path, $content, $type)
    {
        if (!file_exists(dirname($filename))) {
            mkdir(dirname($filename), 0777, true);
        }
        file_put_contents($path, $content);
        if ($type === 'php') {
            exec('vendor/bin/php-cs-fixer fix '.$path.' > /dev/null 2>&1 & echo $!');
        }
        if ($type === 'js') {
            exec('js-beautify '.$path.' > /dev/null 2>&1 & echo $!');
        }
    }

    public function makeMigration($name)
    {
        return base_path().'/database/migrations/'.snake_case($name).'.php';
        try {
            if (isset(glob(base_path().'/database/migrations/*'.snake_case($name).'.php')[0])) {
                return glob(base_path().'/database/migrations/*'.snake_case($name).'.php')[0];
            }
            Artisan::call('make:migration', ['name' => snake_case($name)]);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        return glob(base_path().'/database/migrations/*'.snake_case($name).'.php')[0];
    }

    public function className()
    {
        return '\\App\\Models\\'.$this->package->name().'\\'.$this->name();
    }

    public function fullName()
    {
        return $this->package->name().'.'.$this->name();
    }

    public function fullNamePlural()
    {
        return $this->package->name().'.'.$this->plural();
    }

    public function definition()
    {
        return json_encode($this->definition);
    }

    public function table()
    {
        return empty($this->table) ? snake_case($this->plural()) : $this->table;
    }

    public function fillable()
    {
        $fillable = [];
        foreach ($this->definition->attributes as $name => $value) {
            $fillable[] = $name;
        }
        return $this->varExport($fillable);
    }

    public function defaults()
    {
        $defaults = [];
        foreach ($this->definition->attributes as $name => $value) {
            $defaults[$name] = isset($value->default) ? $value->default : null;
        }
        return $this->varExport($defaults);
    }

    public function casts()
    {
        $casts = [];
        foreach ($this->definition->attributes as $name => $value) {
            try{
                $casts[$name] = $value->type;
            }catch(\Exception $e) {
                throw new \Exception($name.': '.$e->getMessage());
            }
        }
        return $this->varExport($casts);
    }

    public function events()
    {
        $events = [];
        foreach ($this->definition->events as $name => $event) {
            $events[$name] = '\\App\\Events\\'.$this->package->name().
                '\\'.$this->name().
                $event->name();
        }
        return $this->varExport($events);
    }

    public function methods()
    {
        return $this->definition->methods;
    }

    public function attributes()
    {
        return $this->definition->attributes;
    }

    public function relationships()
    {
        return $this->definition->relationships;
    }

    public function url() {
        return '/api/'.$this->package->name().'/'.$this->plural();
    }

    public function selection() {
        return json_encode($this->selection);
    }

    public function build() {
        return view('builders.resource', ['resource'=>$this])->render();
    }
}
