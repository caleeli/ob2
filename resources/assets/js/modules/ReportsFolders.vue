<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <div v-show.visible="!($root.getPaths().length &gt; 2 &amp;&amp; $root.getPaths()[$root.getPaths().length-1].name.substr(0,1)=='*')">
                <h2 id="nav-tabs">Carpetas</h2>
                <abmgroup id="ReportsFolders.Folders" :model="folder" groupField="folder_id" :root="null" typeField="type" nameField="name" leafType="LEAF" childrenAssociation="children">
                </abmgroup>
            </div>
            <div v-show.visible="$root.getPaths().length &gt; 1">
                <h2 id="nav-tabs">Reportes</h2>
                <abm id="ReportsFolders.Reports" :model="report" refreshWith="ReportsFolders.Folders" nameField="name">
                </abm>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8" v-show.visible="$root.getPaths().length &gt; 2">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn btn-primary"><i class="fa fa-bar-chart"></i></a>
                    <a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-area-chart"></i></a>
                    <a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-line-chart"></i></a>
                    <a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-pie-chart"></i></a>
                    <a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-table"></i></a>
                </div>
            </div>
            <chart refreshWith="ReportsFolders.Reports" :model="report"></chart>
        </div>
    </div>
</template>
<script>
    var module;
    var Model = require("../models/Model.js").default;
    var ReportsFolders = {};
    window.ReportsFolders = ReportsFolders;
    ReportsFolders.Report = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/reports";
    Model.call(this, url, id, "ReportsFolders.Report");
    this.$list = function () {
        return "fields=name";
    };
    this.$name = "Report";
    this.$pluralName = "Reports";
    this.$fields = function () {
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},{"name":"variables","label":"Variables","type":"tags","enum":[],"source":new ReportsFolders.Variable(),"textField":"name","value":"variables","isAssociation":false},{"name":"aggregator","label":"Agregación","type":"select","enum":["sum","max","min","avg"],"source":undefined,"textField":undefined,"value":"aggregator","isAssociation":false},{"name":"rows","label":"Filas","type":"tags","enum":[],"source":function (){
                            return module.report.$selectFrom('dimensiones', {variables:module.report.variables});
                        },"textField":"name","value":"rows","isAssociation":false},{"name":"cols","label":"Columnas","type":"tags","enum":[],"source":function (){
                            return module.dimension;
                        },"textField":"name","value":"cols","isAssociation":false},{"name":"filter","label":"Filtro","type":"filter","enum":[],"source":new ReportsFolders.Dimension(function(){try{var url="/api/ReportsFolders/dimensions?fields=id,name,domains";return url.indexOf("¡@!")===-1?url:this.$defaultUrl;}catch(err){return this.$defaultUrl;}}),"textField":"name","value":"filter","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"}];
    };
    this.$methods = {
dashboard1:function(t,methodCallback,childrenAssociation){self.$call("dashboard1",{"t":t}, childrenAssociation, methodCallback)},
        tablas:function(conn,methodCallback,childrenAssociation){self.$call("tablas",{"conn":conn}, childrenAssociation, methodCallback)},
        columnas:function(tabla,methodCallback,childrenAssociation){self.$call("columnas",{"tabla":tabla}, childrenAssociation, methodCallback)},
        dimensiones:function(variables,methodCallback,childrenAssociation){self.$call("dimensiones",{"variables":variables}, childrenAssociation, methodCallback)}    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Report.prototype = Object.create(Model.prototype);
ReportsFolders.Report.prototype.constructor = Model;

ReportsFolders.Folder = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/folders";
    Model.call(this, url, id, "ReportsFolders.Folder");
    this.$list = function () {
        return "fields=name";
    };
    this.$name = "Folder";
    this.$pluralName = "Folders";
    this.$fields = function () {
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},{"name":"type","label":"Tipo","type":"text","enum":["FOLDER","LEAF"],"source":undefined,"textField":undefined,"value":"type","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"}];
    };
    this.$methods = {
    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Folder.prototype = Object.create(Model.prototype);
ReportsFolders.Folder.prototype.constructor = Model;

ReportsFolders.VariableTag = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/variable_tags";
    Model.call(this, url, id, "ReportsFolders.VariableTag");
    this.$list = function () {
        return "fields=name";
    };
    this.$name = "VariableTag";
    this.$pluralName = "VariableTags";
    this.$fields = function () {
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"}];
    };
    this.$methods = {
tagsList:function(methodCallback,childrenAssociation){self.$call("tagsList",{}, childrenAssociation, methodCallback)}    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.VariableTag.prototype = Object.create(Model.prototype);
ReportsFolders.VariableTag.prototype.constructor = Model;

ReportsFolders.Variable = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/variables";
    Model.call(this, url, id, "ReportsFolders.Variable");
    this.$list = function () {
        return "fields=name,tags,description";
    };
    this.$name = "Variable";
    this.$pluralName = "Variables";
    this.$fields = function () {
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},{"name":"tags","label":"Tipos","type":"tags","enum":[],"source":function (){
                            return module.variableTags.$selectFrom("tagsList", {});
                        },"textField":"name","value":"tags","isAssociation":false},{"name":"description","label":"Descripción","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"description","isAssociation":false},{"name":"dimensions","label":"dimensions","type":"tags","enum":[],"source":function (){
                            return module.dimension;
                        },"textField":"name","value":"dimensions","isAssociation":true,"isMultiple":true}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Tipos","data":"attributes.tags"},{"title":"Descripción","data":"attributes.description"}];
    };
    this.$methods = {
    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Variable.prototype = Object.create(Model.prototype);
ReportsFolders.Variable.prototype.constructor = Model;

ReportsFolders.Unit = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/units";
    Model.call(this, url, id, "ReportsFolders.Unit");
    this.$list = function () {
        return "fields=name";
    };
    this.$name = "Unit";
    this.$pluralName = "Units";
    this.$fields = function () {
        return [{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"name","data":"attributes.name"}];
    };
    this.$methods = {
    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Unit.prototype = Object.create(Model.prototype);
ReportsFolders.Unit.prototype.constructor = Model;

ReportsFolders.Family = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/families";
    Model.call(this, url, id, "ReportsFolders.Family");
    this.$list = function () {
        return "fields=name,main_unit";
    };
    this.$name = "Family";
    this.$pluralName = "Families";
    this.$fields = function () {
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},{"name":"main_unit","label":"Unidad principal","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"main_unit","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Unidad principal","data":"attributes.main_unit"}];
    };
    this.$methods = {
    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Family.prototype = Object.create(Model.prototype);
ReportsFolders.Family.prototype.constructor = Model;

ReportsFolders.Dimension = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/dimensions";
    Model.call(this, url, id, "ReportsFolders.Dimension");
    this.$list = function () {
        return "fields=name,column";
    };
    this.$name = "Dimension";
    this.$pluralName = "Dimensions";
    this.$fields = function () {
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},{"name":"column","label":"Columna de la tabla","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"column","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Columna de la tabla","data":"attributes.column"}];
    };
    this.$methods = {
    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Dimension.prototype = Object.create(Model.prototype);
ReportsFolders.Dimension.prototype.constructor = Model;

ReportsFolders.Domain = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/domains";
    Model.call(this, url, id, "ReportsFolders.Domain");
    this.$list = function () {
        return "fields=name,synonyms";
    };
    this.$name = "Domain";
    this.$pluralName = "Domains";
    this.$fields = function () {
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},{"name":"synonyms","label":"Sinónimos (separados por comas)","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"synonyms","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Sinónimos (separados por comas)","data":"attributes.synonyms"}];
    };
    this.$methods = {
    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Domain.prototype = Object.create(Model.prototype);
ReportsFolders.Domain.prototype.constructor = Model;

ReportsFolders.Formula = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/ReportsFolders/formulas";
    Model.call(this, url, id, "ReportsFolders.Formula");
    this.$list = function () {
        return "fields=formula,origin,target";
    };
    this.$name = "Formula";
    this.$pluralName = "Formulas";
    this.$fields = function () {
        return [{"name":"formula","label":"Fórmula y = f(x)","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"formula","isAssociation":false},{"name":"origin","label":"Unidad origen (x)","type":"select","enum":[],"source":new ReportsFolders.Unit(),"textField":"name","value":"origin","isAssociation":true,"isMultiple":false},{"name":"target","label":"Unidad destino (y)","type":"select","enum":[],"source":new ReportsFolders.Unit(),"textField":"name","value":"target","isAssociation":true,"isMultiple":false}];
    };
    this.$columns = function () {
        return [{"title":"Fórmula y = f(x)","data":"attributes.formula"},{"title":"Unidad origen (x)","data":"relationships.origin.attributes.name","render":function (data, type, full, meta) {
                            return data ? data : '';
                        }},{"title":"Unidad destino (y)","data":"relationships.target.attributes.name","render":function (data, type, full, meta) {
                            return data ? data : '';
                        }}];
    };
    this.$methods = {
    };
    if(id) {
        this.$load(id);
    }
}
ReportsFolders.Formula.prototype = Object.create(Model.prototype);
ReportsFolders.Formula.prototype.constructor = Model;

    export default {
        props:[
        ],
        methods: {
        },
        data: function () {
            module = this;
            return {
                path: [],
                report: new ReportsFolders.Report(function(){try{var url="/api/ReportsFolders/folders/"+(module.folder.id?module.folder.id:"¡@!")+"/reports";return url.indexOf("¡@!")===-1?url:this.$defaultUrl;}catch(err){return this.$defaultUrl;}}),
folder: new ReportsFolders.Folder(),
table: new ReportsFolders.Report(),
variableTags: new ReportsFolders.VariableTag(),
dimension: new ReportsFolders.Dimension(),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>