<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue' xmlns:v-on='http://openbank.com/vue-on'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 collapse-xs collapse-sm collapse-md" data-toggle="collapse-xs collapse-sm collapse-md">
            <div v-show.visible="!($root.getPaths().length > 2 &amp;&amp; $root.getPaths()[$root.getPaths().length-1].name.substr(0,1)=='*')">
                <h2 id="nav-tabs">Captura de datos</h2>
                <abm
                        id="Captura.Captures"
                        vue:model="capture"
                        buttons="close,save,update"
                        v-on:update="update"
                        nameField="name">
                    <span></span>
                </abm>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" v-show.visible="$root.getPaths().length >= 1">
            <h2 id="nav-tabs">Priorizacion de Hojas</h2>
            <abm
                    id="Capture.Sheets"
                    vue:model="sheet"
                    refreshWith="Captura.Captures"
                    nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Captura",
        "prefix": "exc",
        "title": "Captura de datos",
        "icon": "fa fa-cloud-upload",
        "menu": "main/Configuración",
        "models": [
            new Module.Model({
                "name": "capture",
                "title": "Captura",
                "pluralTitle": "Capturas",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Nombre",
                    }),
                    new Module.Model.Field({
                        "name": "part_of",
                        "type": "string",
                        "label": "Parte de",
                    }),
                    new Module.Model.Field({
                        "name": "file",
                        "type": "array",
                        "label": "Archivo",
                        "ui": "file",
                        "textField": "file.name",
                    }),
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "sheets",
                        "model": "sheet"
                    }),
                ]
            }),
            new Module.Model({
                "name": "sheet",
                "title": "Hoja",
                "pluralTitle": "Hojas",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Nombre",
                        "form":false,
                    }),
                    new Module.Model.Field({
                        "name": "rows",
                        "type": "string",
                        "label": "Filas",
                        "form":false,
                    }),
                    new Module.Model.Field({
                        "name": "cols",
                        "type": "string",
                        "label": "Columns",
                        "form":false,
                    }),
                    new Module.Model.Field({
                        "name": "to_load",
                        "type": "string",
                        "label": "Selección de carga",
                        "ui": "select",
                        "enum": ["si", "no"],
                    }),
                    new Module.Model.Field({
                        "name": "load_order",
                        "type": "integer",
                        "label": "Orden de carga",
                    }),
                    new Module.Model.Field({
                        "name": "process",
                        "type": "string",
                        "label": "Funciones",
                        "ui": "tags",
                        "enum": ["descombinar","visualizar filas ocultas","visualizar columnas ocultas"],
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "capture",
                        "model": "capture"
                    }),
                ]
            }),
        ],
        "views": {
        },
        "data": {
            capture: new Module.View.ModelInstance("Captura.Capture"),
            sheet: new Module.View.ModelInstance("Captura.Sheet", "Captura/captures/{module.capture.id}/sheets"),
        },
        "methods": {
            update:function(){
                console.log("actualizado!!!");
            },
        },
    });
</script>
</root>