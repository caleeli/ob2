<?php
namespace App\Models\Connections;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Connection extends Model
{
    use SoftDeletes, Notifiable;
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
    protected $events = array(
    );
    public static function boot()
    {
        static::saved(function ($connection1) {
            $connections = static::all();
            $conns =  [];
            foreach ($connections as $connection) {
                $conn = [
                                        'driver' => $connection->driver,
                                        'host' => $connection->host,
                                        'database' => $connection->database,
                                        'username' => $connection->username,
                                        'password' => $connection->password,
                                    ];
                if (!empty($connection->port)) {
                    $conn['port'] = $connection->port;
                }
                if (!empty($connection->charset)) {
                    $conn['charset'] = $connection->charset;
                }
                if (!empty($connection->collation)) {
                    $conn['collation'] = $connection->collation;
                }
                $conns[$connection->name]= $conn;
            }
            file_put_contents(
                                    config_path() . '/connections.php',
                                    "<?php\nreturn ".var_export($conns, true).";\n"
                                );
        });
    }
                    

    public function tables()
    {
        $tables = \DB::connection($this->name)
                                ->getDoctrineSchemaManager()
                                ->listTableNames();
        return $tables;
    }
}
