<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'usradm_users';
    protected $fillable = array(
      0 => 'username',
      1 => 'password',
      2 => 'nombres',
      3 => 'apellidos',
      4 => 'email',
      5 => 'unidad',
      6 => 'role_id',
    );
    protected $attributes = array(
      'username' => '',
      'password' => '',
      'nombres' => '',
      'apellidos' => '',
      'email' => '',
      'unidad' => '',
    );
    protected $casts = array(
      'username' => 'string',
      'password' => 'string',
      'nombres' => 'string',
      'apellidos' => 'string',
      'email' => 'string',
      'unidad' => 'string',
    );
    protected $events = array(
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
        $user = User::where('username', '=', $data['username'])
                                ->first();
        if ($user) {
            throw new \Exception("Usuario ya existe");
        }
        $data['role_id'] = 2;
        $user = new \App\Models\UserAdministration\User($data);
        \Mail::to($data['email'])
                                ->send(new \App\Mail\RegistroUsuario($user));
        $user->save();
        return $data;
    }
}
