<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Conexiones</h2>
            <abm vue:model="connection" ><i></i></abm>
        </div>
    </div>
</template>
<script>
    var MODULE = "Connections";
    var module = new Module({
        "name": MODULE,
        "prefix": "conn",
        "title": "Connections",
        "icon": "fa fa-database",
        "menu": "main/Configuración",
        "models": [
            new Module.Model({
                "name": "connection",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "driver",
                        "type": "string",
                        "default": "",
                        "list": false,
                        "required": false,
                    }),
                    new Module.Model.Field({
                        "name": "host",
                        "type": "string",
                        "default": "",
                        "required": false,
                    }),
                    new Module.Model.Field({
                        "name": "port",
                        "type": "string",
                        "default": "",
                        "list": false,
                        "required": false,
                    }),
                    new Module.Model.Field({
                        "name": "database",
                        "type": "string",
                        "default": "",
                        "required": false,
                    }),
                    new Module.Model.Field({
                        "name": "username",
                        "type": "string",
                        "default": "",
                        "required": false,
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "password",
                        "type": "string",
                        "default": "",
                        "required": false,
                        "ui": "password",
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "charset",
                        "type": "string",
                        "default": "",
                        "required": false,
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "collation",
                        "type": "string",
                        "default": "",
                        "required": false,
                        "list": false,
                    }),
                ],
                "associations": [
                ],
                "methods": {
                    "-boot()": <?php
                        public static function boot()
                        {
                            static::saved(function($connection1){
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
                    ?>,
                    "-tables()": <?php
                        function tables()
                        {
                            $tables = \DB::connection($this->name)
                                ->getDoctrineSchemaManager()
                                ->listTableNames();
                            return $tables;
                        }
                    ?>,
                }
            }),
        ],
        "views": {
        },
        "data": {
            connection: new Module.View.ModelInstance(MODULE+".Connection"),
        }
    });
</script>
</root>