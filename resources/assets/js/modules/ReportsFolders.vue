<template>
    <div class="row">
        <div id="configChart" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 collapse-xs collapse-sm collapse-md" data-toggle="collapse-xs collapse-sm collapse-md">
            <div v-show.visible="!($root.getPaths().length &gt; 2 &amp;&amp; $root.getPaths()[$root.getPaths().length-1].name.substr(0,1)=='*')">
                <h2 id="nav-tabs">Carpetas</h2>
                <abmgroup id="ReportsFolders.Folders" :model="folder" groupField="folder_id" :root="null" typeField="type" nameField="name" leafType="LEAF" childrenAssociation="children">
                </abmgroup>
            </div>
            <div v-show.visible="$root.getPaths().length &gt; 1">
                <h2 id="nav-tabs">Reportes</h2>
                <abm id="ReportsFolders.Reports" :model="report" refreshWith="ReportsFolders.Folders" nameField="name">
                    <span></span>
                </abm>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" v-show.visible="$root.getPaths().length &gt; 2">
            <chart refreshWith="ReportsFolders.Reports,form@ReportsFolders.Reports" :model="report"></chart>
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
    this.$title = "report";
    this.$pluralTitle = "reports";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"variables":{"name":"variables","label":"Variables","type":"tags","enum":[],"source":new ReportsFolders.Variable(function(){try{var url="/api/ReportsFolders/variables?sort=name";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),"textField":"name","value":"variables","isAssociation":false},"aggregator":{"name":"aggregator","label":"Agregación","type":"select","enum":["sum","max","min","avg"],"source":undefined,"textField":undefined,"value":"aggregator","isAssociation":false},"rows":{"name":"rows","label":"Filas","type":"tags","enum":[],"source":function (){
                            return module.report.$selectFrom('dimensiones', {variables:module.report.variables,domains:false});
                        },"textField":"name","value":"rows","isAssociation":false},"cols":{"name":"cols","label":"Columnas","type":"tags","enum":[],"source":function (){
                            return module.report.$selectFrom('dimensiones', {variables:module.report.variables,domains:false});
                        },"textField":"name","value":"cols","isAssociation":false},"filter":{"name":"filter","label":"Filtro","type":"filter","enum":[],"source":function (){
                            return module.report.$selectFrom('dimensiones', {variables:module.report.variables,domains:true});
                        },"textField":"name","value":"filter","isAssociation":false},"variableTags":{"name":"variableTags","label":"Clasificación","type":"tags","enum":[],"source":function (){
                            return module.variableTags;
                        },"textField":"name","value":"variableTags","isAssociation":true,"isMultiple":true}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"}];
    };
    this.$methods = {
dashboard1:function(t,methodCallback,childrenAssociation){self.$call("dashboard1",{"t":t}, childrenAssociation, methodCallback)},
        listVariables:function(ids,methodCallback,childrenAssociation){self.$call("listVariables",{"ids":ids}, childrenAssociation, methodCallback)},
        tablas:function(conn,methodCallback,childrenAssociation){self.$call("tablas",{"conn":conn}, childrenAssociation, methodCallback)},
        columnas:function(tabla,methodCallback,childrenAssociation){self.$call("columnas",{"tabla":tabla}, childrenAssociation, methodCallback)},
        dimensiones:function(variables,domains,methodCallback,childrenAssociation){self.$call("dimensiones",{"variables":variables,"domains":domains}, childrenAssociation, methodCallback)}    };
    this.$initFields();
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
    this.$title = "Carpeta";
    this.$pluralTitle = "Carpetas";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"type":{"name":"type","label":"Tipo","type":"text","enum":["FOLDER","LEAF"],"source":undefined,"textField":undefined,"value":"type","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"}];
    };
    this.$methods = {
    };
    this.$initFields();
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
    this.$title = "variable_tag";
    this.$pluralTitle = "variable_tags";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"}];
    };
    this.$methods = {
tagsList:function(methodCallback,childrenAssociation){self.$call("tagsList",{}, childrenAssociation, methodCallback)}    };
    this.$initFields();
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
        return "fields=name,file";
    };
    this.$name = "Variable";
    this.$pluralName = "Variables";
    this.$title = "variable";
    this.$pluralTitle = "variables";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"description":{"name":"description","label":"Descripción","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"description","isAssociation":false},"image":{"name":"image","label":"Imagen","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"image","isAssociation":false},"aggregator":{"name":"aggregator","label":"Agregación","type":"select","enum":["sum","max","min","avg"],"source":undefined,"textField":undefined,"value":"aggregator","isAssociation":false},"dimensions":{"name":"dimensions","label":"dimensions","type":"tags","enum":[],"source":function (){
                            return module.dimension;
                        },"textField":"name","value":"dimensions","isAssociation":true,"isMultiple":true},"rows":{"name":"rows","label":"Filas","type":"tags","enum":[],"source":function (){
                            return module.report.$selectFrom('dimensiones', {variables:self.id,domains:false});
                        },"textField":"name","value":"rows","isAssociation":false},"cols":{"name":"cols","label":"Columnas","type":"tags","enum":[],"source":function (){
                            return module.report.$selectFrom('dimensiones', {variables:self.id,domains:false});
                        },"textField":"name","value":"cols","isAssociation":false},"filter":{"name":"filter","label":"Filtro","type":"filter","enum":[],"source":function (){
                            return module.report.$selectFrom('dimensiones', {variables:self.id,domains:true});
                        },"textField":"name","value":"filter","isAssociation":false},"information_source":{"name":"information_source","label":"Fuente de información","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"information_source","isAssociation":false},"file":{"name":"file","label":"Archivo fuente","type":"file","enum":[],"source":undefined,"textField":function (data){return data?data.name:''},"value":"file","isAssociation":false},"periodicity":{"name":"periodicity","label":"Periodicidad","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"periodicity","isAssociation":false},"chart_type":{"name":"chart_type","label":"Tipo de gráfico","type":"select","enum":["bar","bar2","horizontalBar","area","line","pie","polarArea","pivot"],"source":undefined,"textField":undefined,"value":"chart_type","isAssociation":false},"variableTags":{"name":"variableTags","label":"Tags","type":"tags","enum":[],"source":function (){
                            return module.variableTags;
                        },"textField":"name","value":"variableTags","isAssociation":true,"isMultiple":true}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Archivo fuente","data":"attributes.file","render":function (data){return data?data.name:''}}];
    };
    this.$methods = {
    };
    this.$initFields();
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
    this.$title = "unit";
    this.$pluralTitle = "units";
    this.$ = {"name":{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"name","data":"attributes.name"}];
    };
    this.$methods = {
    };
    this.$initFields();
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
    this.$title = "family";
    this.$pluralTitle = "families";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"main_unit":{"name":"main_unit","label":"Unidad principal","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"main_unit","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Unidad principal","data":"attributes.main_unit"}];
    };
    this.$methods = {
    };
    this.$initFields();
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
    this.$title = "dimension";
    this.$pluralTitle = "dimensions";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"column":{"name":"column","label":"Columna de la tabla","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"column","isAssociation":false},"arbitrary":{"name":"arbitrary","label":"Arbitraria","type":"select","enum":["si","no"],"source":undefined,"textField":undefined,"value":"arbitrary","isAssociation":false},"numeric":{"name":"numeric","label":"Es numeral","type":"select","enum":["si","no"],"source":undefined,"textField":undefined,"value":"numeric","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Columna de la tabla","data":"attributes.column"}];
    };
    this.$methods = {
    };
    this.$initFields();
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
    this.$title = "domain";
    this.$pluralTitle = "domains";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"synonyms":{"name":"synonyms","label":"Sinónimos (separados por comas)","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"synonyms","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Sinónimos (separados por comas)","data":"attributes.synonyms"}];
    };
    this.$methods = {
    };
    this.$initFields();
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
    this.$title = "formula";
    this.$pluralTitle = "formulas";
    this.$ = {"formula":{"name":"formula","label":"Fórmula y = f(x)","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"formula","isAssociation":false},"origin":{"name":"origin","label":"Unidad origen (x)","type":"select","enum":[],"source":new ReportsFolders.Unit(),"textField":"name","value":"origin","isAssociation":true,"isMultiple":false},"target":{"name":"target","label":"Unidad destino (y)","type":"select","enum":[],"source":new ReportsFolders.Unit(),"textField":"name","value":"target","isAssociation":true,"isMultiple":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
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
    this.$initFields();
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
                report: new ReportsFolders.Report(function(){try{var url="/api/ReportsFolders/folders/"+(module.folder.id?module.folder.id:"¡@!")+"/reports";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
folder: new ReportsFolders.Folder(),
table: new ReportsFolders.Report(),
variableTags: new ReportsFolders.VariableTag(),
dimension: new ReportsFolders.Dimension(),
domain: new ReportsFolders.Domain(),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>