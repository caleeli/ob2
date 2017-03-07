<?php
namespace App\Models\ReportsFolders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variable extends Model
{
    use SoftDeletes;
    protected $table = 'repfol_variables';
    protected $fillable = array(
      0 => 'name',
      1 => 'tags',
    );
    protected $attributes = array(
      'name' => null,
      'tags' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'tags' => 'string',
    );
}
