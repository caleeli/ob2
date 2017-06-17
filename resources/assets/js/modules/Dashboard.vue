<template>
    <imageviewer :model="variableTags" children="variables,reports" v-on:clickImage="clickImage"></imageviewer>
</template>
<script>
    var module;
    var Model = require("../models/Model.js").default;
    var Dashboard = {};
    window.Dashboard = Dashboard;
    
    export default {
        props:[
        ],
        methods: {
            "clickImage":function (item) {
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
            },
        },
        data: function () {
            module = this;
            return {
                path: [],
                variableTags: new ReportsFolders.VariableTag(function(){try{var url="/api/ReportsFolders/VariableTag?include=variables,reports";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>