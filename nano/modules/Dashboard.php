<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <imageviewer vue:model="variableTags" children="variables" />
</template>
<script>
    var module = new Module({
        "name": "Dashboard",
        "prefix": "dash",
        "title": "",
        "icon": "glyphicon glyphicon-home",
        "menu": "main",
        "models": [
        ],
        "views": {
        },
        "data": {
            variableTags: new Module.View.ModelInstance("ReportsFolders.VariableTag", "ReportsFolders/VariableTag?include=variables"),
        }
    });
</script>
</root>