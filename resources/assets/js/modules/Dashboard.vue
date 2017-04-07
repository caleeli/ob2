<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h2>Reportes</h2>
            <chart2 type="bar" :model="report" method="dashboard1"></chart2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <h2>Indices</h2>
            <chart2 type="pie" :model="report" method="dashboard1"></chart2>
        </div>
    </div>
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
        },
        data: function () {
            module = this;
            return {
                path: [],
                report: new ReportsFolders.Report(),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>