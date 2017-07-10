<?php

namespace App\Builder;

use app\Builder\Resource;

/**
 * Description of Relationship
 *
 * @author davidcallizaya
 */
class Relationship extends Element
{

    public function relationshipType()
    {
        if (!empty($this->isMultiple) && !empty($this->belongsTo)) {
            return 'belongsToMany';
        } elseif (!empty($this->isMultiple) && empty($this->belongsTo)) {
            return 'hasMany';
        } elseif (empty($this->isMultiple) && empty($this->belongsTo)) {
            return 'hasOne';
        } elseif (empty($this->isMultiple) && !empty($this->belongsTo)) {
            return 'belongsTo';
        }
    }

    public function className()
    {
        return Resource::get($this->type)->className();
    }

    public function foreign()
    {

    }

    public function local()
    {

    }
}
