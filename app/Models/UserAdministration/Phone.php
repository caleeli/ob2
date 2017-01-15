<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use SoftDeletes;
    protected $table = 'usradm_phones';
    protected $fillable = array(
      0 => 'name',
      1 => 'number',
    );
    protected $attributes = array(
      'name' => null,
      'number' => null,
    );
    protected $casts = array(
      'name' => 'string',
      'number' => 'string',
    );
    public function user()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }
}
