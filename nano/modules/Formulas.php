<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Formulas</h2>
            <abm
                id="Formulas.Formulas"
                vue:model="formula"
                nameField="formula">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Formulas",
        "prefix": "repfol",
        "title": "Administración de formulas",
        "icon": "fa fa-calculator",
        "menu": "main/Configuración",
        "models": [
        ],
        "views": {
        },
        "data": {
            formula: new Module.View.ModelInstance("ReportsFolders.Formula"),
        }
    });
</script>
</root>