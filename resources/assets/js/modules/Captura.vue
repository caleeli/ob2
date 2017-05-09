<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 collapse-xs collapse-sm collapse-md" data-toggle="collapse-xs collapse-sm collapse-md">
            <div v-show.visible="!($root.getPaths().length &gt; 2 &amp;&amp; $root.getPaths()[$root.getPaths().length-1].name.substr(0,1)=='*')">
                <h2 id="nav-tabs">Captura de datos</h2>
                <abm id="Captura.Captures" :model="capture" buttons="close,save,update" v-on:update="update" nameField="name">
                    <span></span>
                </abm>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" v-show.visible="$root.getPaths().length &gt;= 1">
            <h2 id="nav-tabs">Priorizacion de Hojas</h2>
            <abm id="Capture.Sheets" :model="sheet" refreshWith="Captura.Captures" nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module;
    var Model = require("../models/Model.js").default;
    var Captura = {};
    window.Captura = Captura;
    Captura.Capture = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/Captura/captures";
    Model.call(this, url, id, "Captura.Capture");
    this.$list = function () {
        return "fields=name,part_of,file";
    };
    this.$name = "Capture";
    this.$pluralName = "Captures";
    this.$title = "Captura";
    this.$pluralTitle = "Capturas";
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"part_of":{"name":"part_of","label":"Parte de","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"part_of","isAssociation":false},"file":{"name":"file","label":"Archivo","type":"file","enum":[],"source":undefined,"textField":"file.name","value":"file","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Parte de","data":"attributes.part_of"},{"title":"Archivo","data":"attributes.file.name"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
Captura.Capture.prototype = Object.create(Model.prototype);
Captura.Capture.prototype.constructor = Model;

Captura.Sheet = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/Captura/sheets";
    Model.call(this, url, id, "Captura.Sheet");
    this.$list = function () {
        return "fields=name,rows,cols,to_load,load_order,process";
    };
    this.$name = "Sheet";
    this.$pluralName = "Sheets";
    this.$title = "Hoja";
    this.$pluralTitle = "Hojas";
    this.$ = {"to_load":{"name":"to_load","label":"Selección de carga","type":"select","enum":["si","no"],"source":undefined,"textField":undefined,"value":"to_load","isAssociation":false},"load_order":{"name":"load_order","label":"Orden de carga","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"load_order","isAssociation":false},"process":{"name":"process","label":"Funciones","type":"tags","enum":["descombinar","visualizar filas ocultas","visualizar columnas ocultas"],"source":undefined,"textField":undefined,"value":"process","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Filas","data":"attributes.rows"},{"title":"Columns","data":"attributes.cols"},{"title":"Selección de carga","data":"attributes.to_load"},{"title":"Orden de carga","data":"attributes.load_order"},{"title":"Funciones","data":"attributes.process"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
Captura.Sheet.prototype = Object.create(Model.prototype);
Captura.Sheet.prototype.constructor = Model;

    export default {
        props:[
        ],
        methods: {
            "update":function (){
                console.log("actualizado!!!");
            },
        },
        data: function () {
            module = this;
            return {
                path: [],
                capture: new Captura.Capture(),
sheet: new Captura.Sheet(function(){try{var url="/api/Captura/captures/"+(module.capture.id?module.capture.id:"¡@!")+"/sheets";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>