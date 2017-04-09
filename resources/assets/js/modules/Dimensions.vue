<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <h2 id="nav-tabs">Dimensiones</h2>
            <abm id="Dimensions.Dimensions" :model="dimension" nameField="name">
                <span></span>
            </abm>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
            <h2 id="nav-tabs">Valores posibles</h2>
            <abm id="Dimensions.Domains" :model="domain" refreshWith="Dimensions.Dimensions" nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module;
    var Model = require("../models/Model.js").default;
    var Dimensions = {};
    window.Dimensions = Dimensions;
    
    export default {
        props:[
        ],
        methods: {
        },
        data: function () {
            module = this;
            return {
                path: [],
                dimension: new ReportsFolders.Dimension(),
domain: new ReportsFolders.Domain(function(){try{var url="/api/ReportsFolders/dimensions/"+(module.dimension.id?module.dimension.id:"¡@!")+"/domains";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>