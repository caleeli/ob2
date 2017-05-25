<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Recover extends Model
{
    use SoftDeletes, Notifiable;
    protected $table = 'usradm_recovers';
    protected $fillable = array(
      0 => 'account',
      1 => 'key',
      2 => 'user_id',
    );
    protected $attributes = array(
      'account' => '',
      'key' => '',
    );
    protected $casts = array(
      'account' => 'string',
      'key' => 'string',
    );
    protected $events = array(
    );
    public function user()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }


    public function sendEmail($account)
    {
        $enviado = false;
        $usersByUsername = User::where('username', '=', $account)->get();
        $usersByEmail = User::where('email', '=', $account)->get();
        foreach ($usersByUsername as $user) {
            $recover = Recover::create([
                                    'account'=> $account,
                                    'key'=> uniqid('', true),
                                ]);
            $recover->user()->associate($user);
            \Mail::to($user->email)
                                    ->send(new \App\Mail\RecoverPassword($user, $recover));
            $enviado = true;
        }
        foreach ($usersByEmail as $user) {
            if ($user->username===$user->email) {
                continue;
            }
            $recover = Recover::create([
                                    'account'=> $account,
                                    'key'=> uniqid('', true),
                                ]);
            $recover->user()->associate($user);
            \Mail::to($user->email)
                                    ->send(new \App\Mail\RecoverPassword($user, $recover));
            $enviado = true;
        }
        return $enviado;
    }
}
