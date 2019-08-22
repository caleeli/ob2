<?php

namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SaveUserTrait;

class PoaPeiDoc extends Model
{
    use SoftDeletes, SaveUserTrait;

    protected $table = 'poa_pei_docs';
    protected $fillable = [
        0 => 'link',
        1 => 'descripcion',
    ];
    protected $attributes = [
        'link' => '',
        'descripcion' => '',
    ];
    protected $casts = [
        'link' => 'array',
    ];
}
