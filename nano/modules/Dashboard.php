<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano2.com/vue' xmlns:v-on='http://nano2.com/vue-events'>
<template>
    <imageviewer vue:model="variableTags" children="variables" v-on:clickImage="clickImage"/>
</template>
<script>
    var module = new Module({
        "name": "Dashboard",
        "prefix": "dash",
        "title": "Inicio",
        "icon": "glyphicon glyphicon-home",
        "menu": "main",
        "models": [
        ],
        "views": {
        },
        "data": {
            variableTags: new Module.View.ModelInstance("ReportsFolders.VariableTag", "ReportsFolders/VariableTag?include=variables"),
        },
        "methods": {
            "clickImage": function (item) {
                var variablesInput;
                macro.menu('Reportes/ReportsFolders');
                macro.abm(0).path[0].goto();
                macro.when(function(){return macro.abm(0).getRow(1)}, function() {
                    macro.abm(0).selectRow(1);
                    macro.abm(1).clickButton(0);
                    variablesInput = macro.content(1).$children[0].$children[1].$children[0].$children[0];
                    macro.when(
                        function(){
                            if (variablesInput.domain.length>0) {
                                macro.module.report.variables=[item];
                                variablesInput.refresh();
                                return macro.module.report.variables!=null;
                            }
                            return false;
                        },
                        function() {
                            macro.module.report.aggregator=item.attributes.aggregator;
                            macro.module.report.$.rows.domain.refresh(function() {
                                macro.module.report.rows = item.attributes.rows;
                            });
                            macro.module.report.$.cols.domain.refresh(function() {
                                macro.module.report.cols = item.attributes.cols;
                            });
                            macro.module.report.$.filter.domain.refresh(function() {
                                macro.module.report.filter = item.attributes.filter;
                                macro.content(2).refresh();
                            });
                        }
                    );
                });
            }
        }
    });
</script>
</root>