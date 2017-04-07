<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Clasificación de Variables</h2>
            <abm
                id="VariableTags.Tags"
                vue:model="variableTag"
                nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "VariableTags",
        "prefix": "repfol",
        "title": "Clasificación de Variables",
        "icon": "fa fa-object-group",
        "menu": "main/Configuración",
        "models": [
        ],
        "views": {
        },
        "data": {
            variableTag: new Module.View.ModelInstance("ReportsFolders.VariableTag"),
        }
    });
</script>
</root>