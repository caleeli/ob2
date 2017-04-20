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
                    macro.content(1).model.$load(0, function() {
                        macro.content(1).goto(1);
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
                                console.log("enter",macro.module.report.variables);
                                macro.module.report.aggregator=item.attributes.aggregator;
                                console.log("beforere41",macro.module.report.variables);
                                macro.module.report.$.rows.domain.refresh(function() {
                                    console.log("before43",macro.module.report.variables);
                                    macro.module.report.rows = item.attributes.rows;
                                    console.log("before45",macro.module.report.variables);
                                });
                                macro.module.report.$.cols.domain.refresh(function() {
                                    console.log("before48",macro.module.report.variables);
                                    macro.module.report.cols = item.attributes.cols;
                                    console.log("before50",macro.module.report.variables);
                                });
                                macro.module.report.$.filter.domain.refresh(function() {
                                    console.log("before53",macro.module.report.variables);
                                    macro.module.report.filter = item.attributes.filter;
                                    console.log("beforerefresh",macro.module.report.variables);
                                    macro.content(2).refresh();
                                    console.log("afterrefresh", macro.module.report.variables);
                                });
                            }
                        );
                    });
                });
            }
        }
    });
</script>
</root>