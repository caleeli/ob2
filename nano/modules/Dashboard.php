<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h2>Reportes</h2>
            <chart2 type='bar' vue:model='report' method='dashboard1' />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h2>Indices</h2>
            <chart2 type='pie' vue:model='report' method='dashboard1' />
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Dashboard",
        "prefix": "dash",
        "title": "Dashboard",
        "icon": "glyphicon glyphicon-home",
        "menu": "main",
        "models": [
        ],
        "views": {
        },
        "data": {
            report: new Module.View.ModelInstance("ReportsFolders.Report"),
        }
    });
</script>
</root>