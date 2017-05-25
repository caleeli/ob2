<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <h2 id="nav-tabs">Roles</h2>
            <abm
                id="UserAdministration.Roles"
                vue:model="role"
                nameField="name"
                >
                <span></span>
            </abm>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8" v-show.visible="$root.getPaths().length >= 1">
            <h2 id="nav-tabs">Usuarios</h2>
            <abm
                id="UserAdministration.Users"
                vue:model="user"
                refreshWith="UserAdministration.Roles"
                nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "UserAdministration",
        "prefix": "usradm",
        "title": "Usuarios",
        "icon": "fa fa-users",
        "menu": "main/Configuración",
        "models": [
            new Module.Model({
                "name": "user",
                "fields": [
                    new Module.Model.Field({
                        "name": "username",
                        "type": "string",
                        "label": "Usuario",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "password",
                        "type": "string",
                        "label": "Contraseña",
                        "list": false,
                        "default": "",
                        "ui": "password",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "nombres",
                        "type": "string",
                        "label": "Nombres",
                        "default": "",
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "apellidos",
                        "type": "string",
                        "label": "Apellidos",
                        "default": "",
                        "required": false
                    }),
                    /*new Module.Model.Field({
                        "name": "materno",
                        "type": "string",
                        "label": "Materno",
                        "default": "",
                        "list": false,
                        "required": true
                    }),
/*                    new Module.Model.Field({
                        "name": "ap_casada",
                        "label": "Ap. de Casada",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "numero_ci",
                        "type": "integer",
                        "label": "Nro de CI",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "tipo_doc_ci",
                        "type": "integer",
                        "label": "Tipo Doc de CI",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "ext_doc",
                        "type": "integer",
                        "label": "Extensión Doc",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "cod_estado_civil",
                        "type": "integer",
                        "label": "Estado Civil",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "fecha_nac",
                        "type": "date",
                        "label": "Fecha Nac",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "dep_cod",
                        "type": "integer",
                        "label": "Codigo Dep",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "cod_ciudad",
                        "type": "integer",
                        "label": "Codigo Ciudad",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "tipo_persona",
                        "type": "integer",
                        "label": "Tipo Persona",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "cod_nac",
                        "type": "integer",
                        "label": "Cod Nac",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "nivel_edu",
                        "type": "integer",
                        "label": "Nivel de Educación",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "cod_cliente",
                        "type": "integer",
                        "label": "Codigo Cliente",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "fec_ven_cliente",
                        "type": "integer",
                        "label": "Fecha de vencimiento Cliente",
                        "default": "",
                        "required": true
                    }),*/
                    new Module.Model.Field({
                        "name": "email",
                        "type": "string",
                        "label": "Correo Electronico",
                        "default": "",
                        "list": false,
                        "ui": "email",
                        "required": true
                    }),/*
                    new Module.Model.Field({
                        "name": "nro_dependientes",
                        "type": "string",
                        "label": "Nro Dependientes",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "calificacion",
                        "type": "string",
                        "label": "Calificación",
                        "default": "",
                        "required": true
                    }),
                     new Module.Model.Field({
                        "name": "direccion",
                        "type": "string",
                        "label": "Dirección",
                        "default": "",
                        "required": true
                    }),
                     new Module.Model.Field({
                        "name": "ubicacion",
                        "type": "string",
                        "label": "Ubicación",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "fec_registro",
                        "type": "date",
                        "label": "Fecha de Registro",
                        "default": "",
                        "required": true
                    }),
                     new Module.Model.Field({
                        "name": "hora_registro",
                        "type": "date",
                        "label": "Hora de Registro",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "cod_mun",
                        "type": "string",
                        "label": "Codigo Municipio",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "cod_prov",
                        "type": "string",
                        "label": "Codigo Provincia",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "cod_zona",
                        "type": "string",
                        "default": "Codigo Zona",
                        "required": false
                    }),*/
                    new Module.Model.Field({
                        "name": "unidad",
                        "type": "string",
                        "label": "Entidad / Unidad",
                        "default": "",
                        "list": false,
                        "required": false
                    }),
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "logins",
                        "model": "login"
                    }),
                    new Module.Model.BelongsTo({
                        "name": "role",
                        "model": "role"
                    }),
                    new Module.Model.BelongsToMany({
                        "name": "variableTags",
                        "module": "ReportsFolders",
                        "model": "variable_tag",
                        "label": "Áreas de interes",
                        "form": true,
                        "ui": "tags",
                        "source": new Module.View.ModelInstance("ReportsFolders.VariableTag"),
                        "textField": "name",
                    }),
                ],
                "methods": {
                    "registrar(data)": <?php
                        function registrar($data) {
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
                    ?>
                }
            }),
            new Module.Model({
                "name": "role",
                "title": "Rol",
                "pluralTitle": "Roles",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "status",
                        "type": "string",
                        "default": "ACTIVE",
                        "required": true,
                        "ui": "select",
                        "enum": ["ACTIVE", "INACTIVE"]
                    }),
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "users",
                        "model": "user"
                    }),
                ]
            }),
            new Module.Model({
                "name": "login",
                "fields": [
                    new Module.Model.Field({
                        "name": "username",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "password",
                        "type": "string",
                        "default": "",
                        "hash": true,
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "token",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                ],
                "associations": [
                    /*new Module.Model.HasOne({
                        "name": "user",
                        "model": "user",
                        "columns": ["username", "password"],
                        "references": ["username", "password"],
                    }),*/
                ],
                "methods": {
                    "validate(username, password)": <?php
                    public function validate($username="", $password="") {
                    $user = User::where('username', '=', $username)
                        ->where('password', '=', $password)
                        ->first();
                    $token = uniqid();
                    if(!empty($user)){
                        $login = new Login();
                        $login->username = $username;
                        $login->password = $password;
                        $login->token = $token;
                        $login->save();
                    }
                    return !empty($user)?['token'=>$token,'user_id'=>$user->id,'redirect'=>$user->role_id==1?'admin':'basic']:false;
                } ?>
                }
            }),
            new Module.Model({
                "name": "recover",
                "fields": [
                    new Module.Model.Field({
                        "name": "account",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "key",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "user",
                        "model": "user",
                        "nullable": true,
                    }),
                ],
                "methods": {
                    "sendEmail(account)": <?php
                        function sendEmail($account) {
                            $enviado = false;
                            $usersByUsername = User::where('username', '=', $account)->get();
                            $usersByEmail = User::where('email', '=', $account)->get();
                            foreach($usersByUsername as $user) {
                                $recover = Recover::create([
                                    'account'=> $account,
                                    'key'=> uniqid('', true),
                                ]);
                                $recover->user()->associate($user);
                                \Mail::to($user->email)
                                    ->send(new \App\Mail\RecoverPassword($user, $recover));
                                $enviado = true;
                            }
                            foreach($usersByEmail as $user) {
                                if($user->username===$user->email) {
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
                    ?>
                }
            }),
        ],
        "views": {
        },
        "data": {
            user: new Module.View.ModelInstance("UserAdministration.User", "UserAdministration/roles/{module.role.id}/users"),
            role: new Module.View.ModelInstance("UserAdministration.Role"),
            variableTags: new Module.View.ModelInstance("ReportsFolders.VariableTag"),
        }
    });
</script>
</root>