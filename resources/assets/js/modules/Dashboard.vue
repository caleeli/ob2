<template>
    <imageviewer :model="variableTags" children="variables"></imageviewer>
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
                variableTags: new ReportsFolders.VariableTag(function(){try{var url="/api/ReportsFolders/VariableTag?include=variables";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>