<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano.com/vue'>
<script>
    var module = new Module({
        "name": "UserAdministration",
        "prefix": "adm",
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
                    new Module.Model.Field({
                        "name": "avatar",
                        "type": "array",
                        "label": "Avatar",
                        "ui": "file",
                        "textField": function(data){return data?data.name:''},
                    }),
                    new Module.Model.Field({
                        "name": "numero_ci",
                        "type": "integer",
                        "label": "Nro de CI",
                        "default": 0,
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "tipo_doc_ci",
                        "type": "integer",
                        "label": "Tipo Doc de CI",
                        "default": 0,
                        "list": false,
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "ext_doc",
                        "type": "integer",
                        "label": "Extensión Doc",
                        "default": 0,
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_estado_civil",
                        "type": "string",
                        "label": "Estado Civil",
                        "default": "",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "fecha_nac",
                        "type": "date",
                        "label": "Fecha Nac",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "dep_cod",
                        "type": "integer",
                        "label": "Codigo Dep",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_ciudad",
                        "type": "integer",
                        "label": "Codigo Ciudad",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "tipo_persona",
                        "type": "integer",
                        "label": "Tipo Persona",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_nac",
                        "type": "integer",
                        "label": "Cod Nac",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "nivel_edu",
                        "type": "integer",
                        "label": "Nivel de Educación",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_cliente",
                        "type": "integer",
                        "label": "Codigo Cliente",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "fec_ven_cliente",
                        "type": "integer",
                        "label": "Fecha de vencimiento Cliente",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "email",
                        "type": "string",
                        "label": "Correo Electronico",
                        "default": "",
                        "list": false,
                        "ui": "email",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "nro_dependientes",
                        "type": "string",
                        "label": "Nro Dependientes",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "calificacion",
                        "type": "string",
                        "label": "Calificación",
                        "list": false,
                        "required": false
                    }),
                     new Module.Model.Field({
                        "name": "direccion",
                        "type": "string",
                        "label": "Dirección",
                        "list": false,
                        "required": false
                    }),
                     new Module.Model.Field({
                        "name": "ubicacion",
                        "type": "string",
                        "label": "Ubicación",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "fec_registro",
                        "type": "date",
                        "label": "Fecha de Registro",
                        "list": false,
                        "required": false
                    }),
                     new Module.Model.Field({
                        "name": "hora_registro",
                        "type": "date",
                        "label": "Hora de Registro",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_mun",
                        "type": "string",
                        "list": false,
                        "label": "Codigo Municipio",
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_prov",
                        "type": "string",
                        "label": "Codigo Provincia",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_zona",
                        "type": "string",
                        "default": "Codigo Zona",
                        "list": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "unidad",
                        "type": "string",
                        "label": "Entidad / Unidad",
                        "default": "",
                        "list": false,
                        "required": false
                    })
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "logins",
                        "model": "login"
                    }),
                    new Module.Model.BelongsTo({
                        "name": "role",
                        "model": "role"
                    })
                ],
                "methods": {
                    "registrar(data)": <?php
                        function ($data) {
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
                    })
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "users",
                        "model": "user"
                    })
                ]
            }),
            new Module.Model({
                "name": "empresa",
                "title": "empresa",
                "pluralTitle": "empresas",
                "fields": [
                    new Module.Model.Field({
                        "name": "cod_empresa",
                        "type": "string",
                        "label": "Código",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "nombre_empresa",
                        "label": "Empresa",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "corporacion",
                        "label": "Corporación",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "caracter",
                        "label": "Caracter",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "rubro",
                        "label": "Rubro",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "tipologia",
                        "label": "Tipologia",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "detalle_empresa",
                        "type": "string",
                        "list": false,
                        "default": ""
                    })
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "estados",
                        "model": "estado_financiero"
                    }),
                ]
            }),
            new Module.Model({
                "name": "estado_financiero",
                "title": "Estado financiero",
                "pluralTitle": "Estados financieros",
                "fields": [
                    new Module.Model.Field({
                        "name": "tipo_estado_financiero",
                        "type": "string",
                        "label": "Tipo estado financiero",
                        //"ui": "select",
                        /*"enum": ["Balance General", "Estado de Resultados", "Estado de Flujo de Efectivo", "Estado Cambios en el Patrimonio Neto",
                        "Estado de Ejecución Presupuestaria de Recursos", "Cuenta Ahorro Financiamiento"],*/
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "informes_auditoria",
                        "label": "Informes auditoria",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "label": "Gestión",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "archivo",
                        "type": "array",
                        "label": "Archivo",
                        "ui": "file",
                        "textField": function(data){return data?data.name:''},
                    }),
                    new Module.Model.Field({
                        "name": "grafico_texto",
                        "label": "Gráfico texto",
                        "type": "string",
                        "list": false,
                        "default": "activo,pasivo"
                    }),
                    new Module.Model.Field({
                        "name": "grafico_valores",
                        "label": "Gráfico valores",
                        "type": "string",
                        "list": false,
                        "default": "4500,4000"
                    })
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "empresa",
                        "model": "empresa",
                        "nullable": true,
                        "list": true,
                        "textField": "nombre_empresa",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.Empresa"),
                        "form": true
                    })
                ]
            }),
            new Module.ViewModel({
                "name": "empresa_estado",
                "title": "Estado financiero por empresa",
                "pluralTitle": "Estados financieros por empresa",
                "sql": "select adm_estado_financieros.id, adm_empresas.id as empresa_id, nombre_empresa, gestion from adm_estado_financieros left join adm_empresas\n\
                                on (adm_estado_financieros.empresa_id=adm_empresas.id)",
                "fields": [
                    new Module.Model.Field({
                        "name": "nombre_empresa",
                        "type": "string",
                        "label": "Tipo",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "label": "Gestión",
                        "type": "string",
                        "default": ""
                    }),
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "estados",
                        "model": "estado_financiero",
                        "foreignKey": "empresa_id",
                        "localKey": "empresa_id",
                        "where": ["'gestion', '=', $this->gestion"]
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
                    })
                ],
                "associations": [
                ],
                "methods": {
                    "validate(username, password)": <?php
                        function ($username="", $password="") {
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
                        }
                    ?>
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
                    })
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "user",
                        "model": "user",
                        "nullable": true
                    })
                ],
                "methods": {
                    "sendEmail(account)": <?php
                        function ($account) {
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
            })
        ]
    });
</script>
</root>