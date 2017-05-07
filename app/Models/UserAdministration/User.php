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
      1 => 'password',
      2 => 'nombres',
      3 => 'paterno',
      4 => 'materno',
      5 => 'email',
      6 => 'unidad',
      7 => 'role_id',
    );
    protected $attributes = array(
      'username' => '',
      'password' => '',
      'nombres' => '',
      'paterno' => '',
      'materno' => '',
      'email' => '',
      'unidad' => '',
    );
    protected $casts = array(
      'username' => 'string',
      'password' => 'string',
      'nombres' => 'string',
      'paterno' => 'string',
      'materno' => 'string',
      'email' => 'string',
      'unidad' => 'string',
    );
    public function logins()
    {
        return $this->hasMany('App\Models\UserAdministration\Login');
    }


    public function role()
    {
        return $this->belongsTo('App\Models\UserAdministration\Role');
    }


    public function variableTags()
    {
        return $this->belongsToMany('App\Models\ReportsFolders\VariableTag');
    }


    public function registrar($data)
    {
        $data['role_id'] = 2;
        $user = new \App\Models\UserAdministration\User($data);
        $user->save();
        \Mail::to($data['email'])
                                ->send(new \App\Mail\RegistroUsuario($user));
        return $data;
    }
}
