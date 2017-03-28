<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank2.com/vue'>
<template>
    <abm vue:model="cliente"></abm>
    <abm vue:model="cliente"></abm>
</template>
<script>
//PHP: Objeto que ejecuta código en el servidor
//JS: Objeto que ejecuta código en el cliente ?? o siempre sera
//API: Objeto que ejecuta código a traves de REST API
var module = new Module({
    "name": "Clientes",
    "prefix": "cli",
    "title": "Cartera de Clientes",
    "models": [
        new Module.Model({
            "name": "cliente",
            "fields": [
                new Module.Model.Field({
                    "name": "nombres",
                    "type": "string",
                    "label": "Nombres",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "paterno",
                    "type": "string",
                    "label": "Paterno",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "materno",
                    "type": "string",
                    "label": "Materno",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "Ap. de Casada",
                    "type": "string",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "numero_ci",
                    "type": "int",
                    "label": "Nro de CI",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "tipo_doc_ci",
                    "type": "int",
                    "label": "Tipo Doc de CI",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "ext_doc",
                    "type": "int",
                    "label": "Extensión Doc",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "cod_estado_civil",
                    "type": "int",
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
                    "type": "int",
                    "label": "Codigo Dep",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "cod_ciudad",
                    "type": "int",
                    "label": "Codigo Ciudad",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "tipo_persona",
                    "type": "int",
                    "label": "Tipo Persona",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "cod_nac",
                    "type": "int",
                    "label": "Cod Nac",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "nivel_edu",
                    "type": "int",
                    "label": "Nivel de Educación",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "cod_cliente",
                    "type": "int",
                    "label": "Codigo Cliente",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "fec_ven_cliente",
                    "type": "int",
                    "label": "Fecha de vencimiento Cliente",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "email",
                    "type": "string",
                    "label": "Email",
                    "default": "",
                    "required": true
                }),
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
                }),
            ],
            "associations": [
                new Module.Model.BelongsTo({
                    "name": "tipo_doc_ci",  //campo
                    "model": "tipo_documento"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "ext_doc",  //campo
                    "model": "departamento"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "cod_est_civil",  //campo
                    "model": "estado_civil"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "fecha_nac",  //campo
                    "model": "cliente"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "dep_cod",  //campo
                    "model": "departamento"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "ciu_cod",  //campo
                    "model": "ciudades"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "fecha_nac",  //campo
                    "model": "tipo_persona"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "cod_nac",  //campo
                    "model": "nacionalidad"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "nivel_edu",  //campo
                    "model": "nivel_educacional"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "cod_mum",  //campo
                    "model": "ciudades"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "cod_prov",  //campo
                    "model": "ciudades"  //tabla
                }),
                new Module.Model.BelongsTo({
                    "name": "cod_zona",  //campo
                    "model": "ciudades"  //tabla
                })
            ],
            "methods": {
                "sayHello": "public function sayHello($name) {\
                    return 'Hola '.$name.'!!!';\n\
                }"
            }
        }),
        new Module.Model({
            "name": "ciudad",
            "fields": [
                new Module.Model.Field({
                    "name": "cod_ciudad",
                    "type": "int",
                    "label": "Codigo Ciudad",
                    "default": "",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "desc_ciudad",
                    "type": "string",
                    "label": "Descripción Ciudad",
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
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "cod_zona",
                    "type": "string",
                    "label": "Codigo Zona",
                    "required": true
                }),
            ],
           /* "associations": [
                new Module.Model.BelongsToMany({
                    "name": "users",
                    "model": "user"
                })
            ],*/
            "data": "ciudades.sql",
            //"data": "ciudades.csv",
        }),
        new Module.Model({
            "name": "tipo_documento",
            "fields": [
                new Module.Model.Field({
                    "name": "tipo_doc_ci",
                    "type": "int",
                    "label": "Tipo de Documento de CI",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "descripcion",
                    "type": "string",
                    "label": "Descripcion",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "abreviacion",
                    "type": "string",
                    "label": "Abreviacion",
                    "required": true
                }),
            ],
/*            "associations": [
                new Module.Model.BelongsTo({
                    "name": "user",
                    "model": "user"
                })
            ]*/
        }),
        new Module.Model({
            "name": "departamento",
            "fields": [
                new Module.Model.Field({
                    "name": "cod_dep",
                    "type": "int",
                    "label": "Codigo Departamento",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "desc_departamento",
                    "type": "string",
                    "label": "Descripcion Departamento",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "abrv_departamento",
                    "type": "string",
                    "label": "Abreviacion Departamento",
                    "required": true
                }),
            ],
 /*           "associations": [
                new Module.Model.BelongsTo({
                    "name": "user",
                    "model": "user"
                })
            ]*/
        }),
        new Module.Model({
            "name": "estado_civil",
            "fields": [
                new Module.Model.Field({
                    "name": "cod_est_civil",
                    "type": "int",
                    "label": "Codigo Estado Civil",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "desc_est_civil",
                    "type": "string",
                    "label": "Descripcion Estado Civil",
                    "required": true
                }),
                new Module.Model.Field({
                    "name": "abrv_est_civil",
                    "type": "string",
                    "label": "Abreviacion Estado Civil",
                    "required": true
                }),
            ],
 /*           "associations": [
                new Module.Model.BelongsTo({
                    "name": "user",
                    "model": "user"
                })
            ]*/
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
</script>
</root>