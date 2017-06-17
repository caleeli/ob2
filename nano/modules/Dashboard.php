<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano2.com/vue' xmlns:v-on='http://nano2.com/vue-events'>
<template>
    <imageviewer vue:model="variableTags" children="variables,reports" v-on:clickImage="clickImage"/>
</template>
<script>
    /**
     * Agregar vista de listado para poder ver mas informacion de manera mas facil y rapida.
     */
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
            variableTags: new Module.View.ModelInstance("ReportsFolders.VariableTag", "ReportsFolders/VariableTag?include=variables,reports"),
        },
        "methods": {
            "clickImage": function (item) {
                var variablesInput, form;
                macro.menu('Reportes/ReportsFolders', true) || macro.menu('ReportsFolders', true);
                macro.abm(0).path[0].goto();
                macro.when(function(){return macro.abm(0).getRow(1)}, function() {
                    macro.abm(0).selectRow(1);
                    macro.content(1).model.$load(0, function() {
                        macro.content(1).goto(1);
                        variablesInput = macro.content(1).$children[0].$children[1].$children[0].$children[0];
                        form = macro.content(1).$children[0].$children[1].$children[0];
                        macro.when(
                            function(){
                                if (variablesInput.domain.length>0) {
                                    macro.module.report.variables=""+item.id;
                                    variablesInput.refresh();
                                    return macro.module.report.variables!=null;
                                }
                                return false;
                            },
                            function() {
                                macro.module.report.name=item.attributes.name;
                                macro.module.report.aggregator=item.attributes.aggregator;
                                macro.module.report.rows = item.attributes.rows;
                                macro.module.report.cols = item.attributes.cols;
                                macro.module.report.filter = item.attributes.filter;
                                macro.module.report.chart_type = item.attributes.chart_type;
                                macro.module.report.$.rows.domain.refresh(function() {
                                    form.$children[1].refresh();
                                });
                                macro.module.report.$.cols.domain.refresh(function() {
                                    form.$children[2].refresh();
                                });
                                macro.module.report.$.filter.domain.refresh(function() {
                                    form.$children[3].refresh();
                                });
                                macro.content(2).refresh();
                            }
                        );
                    });
                });
            }
        }
    });
</script>
</root>