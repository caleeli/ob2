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
      2 => 'dashboard',
    );
    protected $attributes = array(
      'name' => '',
      'status' => 'ACTIVE',
      'dashboard' => 'dashboard1',
    );
    protected $casts = array(
      'name' => 'string',
      'status' => 'string',
      'dashboard' => 'string',
    );
    public function users()
    {
        return $this->hasMany('App\Models\UserAdministration\User');
    }
}
