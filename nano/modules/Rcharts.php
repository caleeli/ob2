<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Gráficos R</h2>
            <abm
                vue:model="rchart">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Rcharts",
        "prefix": "repfol",
        "title": "Gráficos R",
        "icon": "fa fa-square-o",
        "menu": "main/Reportes",
        "models": [
        ],
        "views": {
        },
        "data": {
            rchart: new Module.View.ModelInstance("ReportsFolders.Rchart"),
            variableTags: new Module.View.ModelInstance("ReportsFolders.VariableTag"),
        }
    });
</script>
</root>