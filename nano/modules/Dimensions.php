<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <h2 id="nav-tabs">Dimensiones</h2>
            <abm
                id="Dimensions.Dimensions"
                vue:model="dimension"
                nameField="name">
                <span></span>
            </abm>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
            <h2 id="nav-tabs">Valores posibles</h2>
            <abm
                id="Dimensions.Domains"
                vue:model="domain"
                refreshWith="Dimensions.Dimensions"
                nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Dimensions",
        "prefix": "repfol",
        "title": "Dimensiones",
        "icon": "fa fa-cube",
        "menu": "main/Reportes",
        "models": [
        ],
        "views": {
        },
        "data": {
            dimension: new Module.View.ModelInstance("ReportsFolders.Dimension"),
            domain: new Module.View.ModelInstance("ReportsFolders.Domain", "ReportsFolders/dimensions/{module.dimension.id}/domains"),
        }
    });
</script>
</root>