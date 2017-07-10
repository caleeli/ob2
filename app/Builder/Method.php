<?php

namespace App\Builder;

/**
 * Description of Method
 *
 * @author davidcallizaya
 */
class Method extends Element
{

    public function method($name = null)
    {
        if ($name === null) {
            $name = $this->name;
        }
        return 'function '.$name.trim(substr(trim($this->code), 8));
    }
}
