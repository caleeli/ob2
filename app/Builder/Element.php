<?php

namespace App\Builder;

/**
 * Description of Element
 *
 * @author davidcallizaya
 */
class Element
{
    public static $transformation = [
    ];

    public function __construct($jResource, $name = null)
    {
        if ($name!==null) {
            $this->name = $name;
        }
        foreach ((array) $jResource as $key => $value) {
            if (substr($key,0,1)==="\x00") {
                //private variables
                continue;
            }
            if (empty(static::$transformation[$key])) {
                $this->$key = $value;
            } else {
                $class = static::$transformation[$key];
                if (substr($class,-2)==='[]' && is_array($value)) {
                    $class = substr($class, 0, -2);
                    $this->$key = [];
                    foreach((array)$value as $k=>$v) {
                        $this->$key[$k] = new $class($v, $k);
                    }
                } elseif (substr($class,-2)==='[]') {
                    $class = substr($class, 0, -2);
                    $this->$key = new \stdClass();
                    foreach((array)$value as $k=>$v) {
                        $this->$key->$k = new $class($v, $k);
                    }
                } else {
                    $this->$key = new $class($value, $key);
                }
            }
        }
    }

    public function name()
    {
        return ucfirst(camel_case($this->name));
    }

    public function plural()
    {
        return ucfirst(camel_case(empty($this->plural) ? str_plural($this->name) : $this->plural));
    }

    public function varExport($value)
    {
        return var_export($value, true);
    }
}
