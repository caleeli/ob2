<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;


class Role extends Model
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_roles';
    protected $fillable = array (
      0 => 'name',
      1 => 'status',
    );
    protected $attributes = array (
      'name' => '',
      'status' => 'ACTIVE',
    );
    protected $casts = array (
      'name' => 'string',
      'status' => 'string',
    );
    protected $events = array (
    );
    public function users()
    {
        return $this->hasMany('App\Models\UserAdministration\User');
    }

}