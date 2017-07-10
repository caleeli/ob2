<?php

namespace App\Builder;

/**
 * Description of Definition
 *
 * @author davidcallizaya
 */
class Definition extends Element
{
    public static $transformation = [
        'attributes'    => \App\Builder\Element::class.'[]',
        'relationships' => \App\Builder\Relationship::class.'[]',
        'methods'       => \App\Builder\Method::class.'[]',
        'events'        => \App\Builder\Method::class.'[]',
    ];

}
