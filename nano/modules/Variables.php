<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Variables</h2>
            <abm
                id="Variables.Variables"
                vue:model="variable"
                refreshWith="Variables.Folders"
                nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Variables",
        "prefix": "repfol",
        "title": "Variables",
        "icon": "fa fa-square-o",
        "menu": "main/Reportes",
        "models": [
        ],
        "views": {
        },
        "data": {
            variable: new Module.View.ModelInstance("ReportsFolders.Variable"),
        }
    });
</script>
</root>