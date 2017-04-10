<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4>Salud</h4>
            <div class="ntScroll">
                <div class="ntImage">
                    <label>Blade el empalador</label>
                </div>
                <div class="ntImage">
                    <label>Revenge of the Sith</label>
                </div>
                <div class="ntImage">
                    <label>DISEÑO de sonrisa</label>
                </div>
                <div class="ntImage">
                    <label>Guf guf</label>
                </div>
            </div>
            <h4>Educación</h4>
            <div class="ntScroll">
                <div class="ntImage">
                    <label>Blade el empalador</label>
                </div>
                <div class="ntImage">
                    <label>Revenge of the Sith</label>
                </div>
                <div class="ntImage">
                    <label>DISEÑO de sonrisa</label>
                </div>
                <div class="ntImage">
                    <label>Guf guf</label>
                </div>
            </div>
            <h4>Hidrocarburos</h4>
            <div class="ntScroll">
                <div class="ntImage">
                    <label>Blade el empalador</label>
                </div>
                <div class="ntImage">
                    <label>Revenge of the Sith</label>
                </div>
                <div class="ntImage">
                    <label>DISEÑO de sonrisa</label>
                </div>
                <div class="ntImage">
                    <label>Guf guf</label>
                </div>
            </div>
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