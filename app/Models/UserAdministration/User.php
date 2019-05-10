<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\SaveUserTrait;


class User extends \Illuminate\Foundation\Auth\User
{
    use SoftDeletes, Notifiable, SaveUserTrait;
    protected $table = 'adm_users';
    protected $fillable = array (
      0 => 'username',
      1 => 'password',
      2 => 'nombres',
      3 => 'apellidos',
      4 => 'fotografia',
      5 => 'numero_ci',
      6 => 'tipo_doc_ci',
      7 => 'ext_doc',
      8 => 'cod_estado_civil',
      9 => 'fecha_nac',
      10 => 'dep_cod',
      11 => 'cod_ciudad',
      12 => 'tipo_persona',
      13 => 'cod_nac',
      14 => 'nivel_edu',
      15 => 'cod_cliente',
      16 => 'fec_ven_cliente',
      17 => 'email',
      18 => 'nro_dependientes',
      19 => 'calificacion',
      20 => 'direccion',
      21 => 'ubicacion',
      22 => 'fec_registro',
      23 => 'hora_registro',
      24 => 'cod_mun',
      25 => 'cod_prov',
      26 => 'cod_zona',
      27 => 'unidad',
      28 => 'remember_token',
      29 => 'role_id',
    );
    protected $attributes = array (
      'username' => '',
      'password' => '',
      'nombres' => '',
      'apellidos' => '',
      'fotografia' => NULL,
      'numero_ci' => 0,
      'tipo_doc_ci' => 0,
      'ext_doc' => 0,
      'cod_estado_civil' => '',
      'fecha_nac' => NULL,
      'dep_cod' => NULL,
      'cod_ciudad' => NULL,
      'tipo_persona' => NULL,
      'cod_nac' => NULL,
      'nivel_edu' => NULL,
      'cod_cliente' => NULL,
      'fec_ven_cliente' => NULL,
      'email' => '',
      'nro_dependientes' => NULL,
      'calificacion' => NULL,
      'direccion' => NULL,
      'ubicacion' => NULL,
      'fec_registro' => NULL,
      'hora_registro' => NULL,
      'cod_mun' => NULL,
      'cod_prov' => NULL,
      'cod_zona' => 'Codigo Zona',
      'unidad' => '',
      'remember_token' => '',
    );
    protected $casts = array (
      'username' => 'string',
      'password' => 'string',
      'nombres' => 'string',
      'apellidos' => 'string',
      'fotografia' => 'array',
      'numero_ci' => 'integer',
      'tipo_doc_ci' => 'integer',
      'ext_doc' => 'integer',
      'cod_estado_civil' => 'string',
      'fecha_nac' => 'date',
      'dep_cod' => 'integer',
      'cod_ciudad' => 'integer',
      'tipo_persona' => 'integer',
      'cod_nac' => 'integer',
      'nivel_edu' => 'integer',
      'cod_cliente' => 'integer',
      'fec_ven_cliente' => 'integer',
      'email' => 'string',
      'nro_dependientes' => 'string',
      'calificacion' => 'string',
      'direccion' => 'string',
      'ubicacion' => 'string',
      'fec_registro' => 'date',
      'hora_registro' => 'date',
      'cod_mun' => 'string',
      'cod_prov' => 'string',
      'cod_zona' => 'string',
      'unidad' => 'string',
      'remember_token' => 'string',
    );
    protected $events = array (
    );
    public function logins()
    {
        return $this->hasMany('App\Models\UserAdministration\Login');
    }


    public function role()
    {
        return $this->belongsTo('App\Models\UserAdministration\Role');
    }


    public function uais()
    {
        return $this->hasMany('App\Models\UserAdministration\Uai', 'owner_id', 'id');
    }


    public function firmas()
    {
        return $this->hasMany('App\Models\UserAdministration\Firma', 'owner_id', 'id');
    }


    function setPasswordAttribute ($value) {
                        if ($this->attributes['password']!=$value) {
                            $this->attributes['password'] = md5($value);
                        }
                    }

    function registrar ($data) {
                            $userExists = User::where('username', '=', $data['username'])
                                ->first();
                            if ($userExists) {
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