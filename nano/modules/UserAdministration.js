//PHP: Objeto que ejecuta código en el servidor
//JS: Objeto que ejecuta código en el cliente ?? o siempre sera
//API: Objeto que ejecuta código a traves de REST API
var module = new Module({
    "name": "UserAdministration",
    "prefix": "usradm",
    "title": "User Administration",
    "models": [
        new Module.Model({
            "name": "user",
            "fields": [
                new Module.Model.Field({
                    "name": "username",
                    "type": "string",
                    "default": "admin",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "lastname",
                    "type": "string",
                    "default": "",
                    "required": false
                }),
                new Module.Model.Field({
                    "name": "firstname",
                    "type": "string",
                    "default": "",
                    "required": false
                })
            ],
            "associations": [
                new Module.Model.HasOne({
                    "name": "phone",
                    "model": "phone"
                }),
                new Module.Model.HasMany({
                    "name": "logins",
                    "model": "login"
                }),
                new Module.Model.BelongsToMany({
                    "name": "roles",
                    "model": "role"
                })
            ],
            "methods": {
                "sayHello": "public function sayHello($name) {\
                    return 'Hola '.$name.'!!!';\n\
                }"
            }
        }),
        new Module.Model({
            "name": "role",
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
                    "default": "INACTIVE",
                    "required": true,
                    "enum": ["ACTIVE", "INACTIVE"]
                })
            ],
            "associations": [
                new Module.Model.BelongsToMany({
                    "name": "users",
                    "model": "user"
                })
            ]
        }),
        new Module.Model({
            "name": "login",
            "fields": [
                new Module.Model.Field({
                    "name": "timestamp",
                    "type": "timestamp"
                }),
            ],
            "associations": [
                new Module.Model.BelongsTo({
                    "name": "user",
                    "model": "user"
                })
            ]
        }),
        new Module.Model({
            "name": "phone",
            "fields": [
                new Module.Model.Field({
                    "name": "name",
                    "type": "string"
                }),
                new Module.Model.Field({
                    "name": "number",
                    "type": "string"
                }),
            ],
            "associations": [
                new Module.Model.BelongsTo({
                    "name": "user",
                    "model": "user"
                })
            ]
        }),
    ],
    "views": {
/*        "list": new Module.List({
            "title": "Users",
            "model": "user",
            "sql": "select * from users ",
            "fields": ["username", "firstname", "lastname", {"name": "roles", "exp": "$roles->concat('name')"}],
            "actions": {
                "row": [
                    Module.List.Edit({}),
                    Module.List.Delete({}),
                ],
                "table": [
                    Module.List.New({}),
                ],
            },
        }),
        "form": new Module.Form({
            "title": "Usuario {username?username:'*Nuevo*'}",
            "components": {
                "username": Module.View.InputText("username"),
                "firstname": Module.View.InputText("firstname"),
                "lastname": Module.View.InputText("lastname"),
                "roles": Module.View.SelectMultiple("roles"),
            },
            "form": Module.View.Morita(
                    'Usuario:   {username}\n' +
                    'Nombre:    {firstname}\n' +
                    'Apellidos: {lastname}\n' +
                    'Roles:     {roles}'
            ),
        }),*/
    }
});


InputText = function (object, attribute) {
    return {
        value: object[attribute],
        requestChange: function (newValue) {
            object[attribute] = newValue;
        }
    };
}
