<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $table = 'usradm_users';
    protected $fillable = array(
      0 => 'username',
      1 => 'lastname',
      2 => 'firstname',
    );
    protected $attributes = array(
      'username' => 'admin',
      'lastname' => '',
      'firstname' => '',
    );
    protected $casts = array(
      'username' => 'string',
      'lastname' => 'string',
      'firstname' => 'string',
    );
    public function phone()
    {
        return $this->hasOne('App\Models\UserAdministration\Phone');
    }


    public function logins()
    {
        return $this->hasMany('App\Models\UserAdministration\Login');
    }


    public function roles()
    {
        return $this->belongsToMany('App\Models\UserAdministration\Role');
    }


    public function sayHello($name)
    {
        return 'Hola '.$name.'!!!';
    }
}
