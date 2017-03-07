<?php
namespace App\Models\Connections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connection extends Model
{
    use SoftDeletes;
    protected $table = 'conn_connections';
    protected $fillable = array(
      0 => 'name',
      1 => 'driver',
      2 => 'host',
      3 => 'port',
      4 => 'database',
      5 => 'username',
      6 => 'password',
      7 => 'charset',
      8 => 'collation',
    );
    protected $attributes = array(
      'name' => '',
      'driver' => '',
      'host' => '',
      'port' => '',
      'database' => '',
      'username' => '',
      'password' => '',
      'charset' => '',
      'collation' => '',
    );
    protected $casts = array(
      'name' => 'string',
      'driver' => 'string',
      'host' => 'string',
      'port' => 'string',
      'database' => 'string',
      'username' => 'string',
      'password' => 'string',
      'charset' => 'string',
      'collation' => 'string',
    );
}
