<?php
namespace App\Models\UserAdministration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Login extends Model
{
    use SoftDeletes;
    protected $table = 'usradm_logins';
    protected $fillable = array(
      0 => 'timestamp',
    );
    protected $attributes = array(
      'timestamp' => null,
    );
    protected $casts = array(
      'timestamp' => 'timestamp',
    );
    public function user()
    {
        return $this->belongsTo('App\Models\UserAdministration\User');
    }
}
