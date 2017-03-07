<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Unidades de medida</h2>
            <abm
                id="Units.Units"
                vue:model="unit"
                nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Units",
        "prefix": "repfol",
        "title": "Administración de unidades de medida",
        "icon": "fa fa-tachometer",
        "menu": "main/Configuración",
        "models": [
        ],
        "views": {
        },
        "data": {
            unit: new Module.View.ModelInstance("ReportsFolders.Unit"),
        }
    });
</script>
</root>