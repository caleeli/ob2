<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = 'usradm_roles';
    protected $fillable = array(
      0 => 'name',
      1 => 'status',
    );
    protected $attributes = array(
      'name' => '',
      'status' => 'INACTIVE',
    );
    protected $casts = array(
      'name' => 'string',
      'status' => 'string',
    );
    public function users()
    {
        return $this->belongsToMany('App\Models\UserAdministration\User');
    }
}
