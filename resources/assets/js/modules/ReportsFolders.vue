<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <h2 id="nav-tabs">Carpetas</h2>
            <abmgroup id="ReportsFolders.Folders" :model="folder" groupField="folder_id" :root="null" typeField="type" nameField="name" leafType="LEAF" childrenAssociation="children">
            </abmgroup>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8" v-show.visible="$root.getPaths().length &gt; 1">
            <h2 id="nav-tabs">Reportes</h2>
            <abm id="ReportsFolders.Reports" :model="report" refreshWith="ReportsFolders.Folders" nameField="name">
                <chart refreshWith="ReportsFolders.Reports" :model="report"></chart>
            </abm>
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
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"},{"name":"table","label":"Tabla","type":"select","enum":[],"source":function (){
                            return module.table.$selectFrom("tablas", {"conn":null})
                        },"textField":"name","value":"table"},{"name":"aggregator","label":"Agregación","type":"select","enum":["sum","max","min","avg"],"source":undefined,"textField":undefined,"value":"aggregator"},{"name":"measure","label":"Medida","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"measure"},{"name":"rows","label":"Filas","type":"tags","enum":[],"source":function (){
                            return module.table.$selectFrom(
                                "columnas",
                                {"tabla":module.report.table}
                            );
                        },"textField":"name","value":"rows"},{"name":"cols","label":"Columnas","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cols"}];
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"}];
    };
    this.$methods = {
dashboard1:function(t,methodCallback,childrenAssociation){self.$call("dashboard1",{"t":t}, childrenAssociation, methodCallback)},
        tablas:function(conn,methodCallback,childrenAssociation){self.$call("tablas",{"conn":conn}, childrenAssociation, methodCallback)},
        columnas:function(tabla,methodCallback,childrenAssociation){self.$call("columnas",{"tabla":tabla}, childrenAssociation, methodCallback)}    };
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
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"},{"name":"type","label":"Tipo","type":"text","enum":["FOLDER","LEAF"],"source":undefined,"textField":undefined,"value":"type"}];
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
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"}];
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
        return "fields=name,tags";
    };
    this.$name = "Variable";
    this.$pluralName = "Variables";
    this.$fields = function () {
        return [{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"},{"name":"tags","label":"tags","type":"tags","enum":[],"source":function (){
                            return module.variableTags.$selectFrom("tagsList", {});
                        },"textField":"name","value":"tags"}];
    };
    this.$columns = function () {
        return [{"title":"name","data":"attributes.name"},{"title":"tags","data":"attributes.tags"}];
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
        return [{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"}];
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
        return [{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"},{"name":"main_unit","label":"Unidad principal","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"main_unit"}];
    };
    this.$columns = function () {
        return [{"title":"name","data":"attributes.name"},{"title":"Unidad principal","data":"attributes.main_unit"}];
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
        return "fields=name";
    };
    this.$name = "Dimension";
    this.$pluralName = "Dimensions";
    this.$fields = function () {
        return [{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"}];
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
        return [{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name"},{"name":"synonyms","label":"Sinónimos (separados por comas)","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"synonyms"}];
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
        return [{"name":"formula","label":"Fórmula y = f(x)","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"formula"},{"name":"origin","label":"Unidad origen (x)","type":"select","enum":[],"source":new ReportsFolders.Unit(),"textField":"name","value":"origin_id"},{"name":"target","label":"Unidad destino (y)","type":"select","enum":[],"source":new ReportsFolders.Unit(),"textField":"name","value":"target_id"}];
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
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
        }
    }
</script>