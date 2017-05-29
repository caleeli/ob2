<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div v-show.visible="!($root.getPaths().length &gt; 2 &amp;&amp; $root.getPaths()[$root.getPaths().length-1].name.substr(0,1)=='*')">
                <h2 id="nav-tabs">Patrones de captura</h2>
                <abm id="Captura.Captures" :model="capture" buttons="close,save,Procesar,Importar" v-on:Procesar="procesar" v-on:Importar="importar" nameField="name">
                    <span></span>
                </abm>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" v-show.visible="$root.getPaths().length &gt;= 1">
            <h2 id="nav-tabs">Priorizacion de Hojas</h2>
            <abm id="Capture.Sheets" :model="sheet" toolbar="empty" refreshWith="Captura.Captures" nameField="name">
                    <span></span>
            </abm>
            <div v-show.visible="$root.getPaths().length &gt;= 2">
                <h2 id="nav-tabs">Detalles</h2>
                <abm id="Capture.Details" :model="detail" toolbar="new" refreshWith="Capture.Sheets" nameField="name">
                    <span></span>
                </abm>
            </div>
            <datatable :model="preview" toolbar="empty" refreshWith="Captura.Captures"></datatable>
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
    this.$ = {"name":{"name":"name","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"part_of":{"name":"part_of","label":"Parte de","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"part_of","isAssociation":false},"file":{"name":"file","label":"Archivo","type":"file","enum":[],"source":undefined,"textField":function (data){return data?data.name:''},"value":"file","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.name"},{"title":"Parte de","data":"attributes.part_of"},{"title":"Archivo","data":"attributes.file","render":function (data){return data?data.name:''}}];
    };
    this.$methods = {
procesar:function(methodCallback,childrenAssociation){self.$call("procesar",{}, childrenAssociation, methodCallback)},
        preview:function(methodCallback,childrenAssociation){self.$call("preview",{}, childrenAssociation, methodCallback)},
        importar:function(methodCallback,childrenAssociation){self.$call("importar",{}, childrenAssociation, methodCallback)}    };
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
    this.$ = {"to_load":{"name":"to_load","label":"Selección de carga","type":"select","enum":["si","no"],"source":undefined,"textField":undefined,"value":"to_load","isAssociation":false},"load_order":{"name":"load_order","label":"Orden de carga","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"load_order","isAssociation":false},"process":{"name":"process","label":"Funciones","type":"tags","enum":["descombinar","ignorar filas vacias"],"source":undefined,"textField":undefined,"value":"process","isAssociation":false}};
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

Captura.Detail = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/Captura/details";
    Model.call(this, url, id, "Captura.Detail");
    this.$list = function () {
        return "fields=name,type,dimension,dimension_name,capture,default_value";
    };
    this.$name = "Detail";
    this.$pluralName = "Details";
    this.$title = "Detalle";
    this.$pluralTitle = "Detalle";
    this.$ = {"name":{"name":"name","label":"Columna","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"type":{"name":"type","label":"Tipo","type":"select","enum":["variable","dimension","nueva dimension"],"source":undefined,"textField":undefined,"value":"type","isAssociation":false},"dimension":{"name":"dimension","label":"Dimensión","type":"select","enum":[],"source":new ReportsFolders.Dimension(),"textField":"name","value":"dimension","isAssociation":true,"isMultiple":false},"capture":{"name":"capture","label":"Captura de valor","type":"select","enum":["Capturar de hoja","Por defecto","Sin captura"],"source":undefined,"textField":undefined,"value":"capture","isAssociation":false},"default_value":{"name":"default_value","label":"Valor por defecto","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"default_value","isAssociation":false},"copia_inicio_fila":{"name":"copia_inicio_fila","label":"Copia inicio fila","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"copia_inicio_fila","isAssociation":false},"copia_inicio_columna":{"name":"copia_inicio_columna","label":"Copia inicio columna","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"copia_inicio_columna","isAssociation":false},"copia_fin_fila":{"name":"copia_fin_fila","label":"Copia fin fila","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"copia_fin_fila","isAssociation":false},"copia_fin_columna":{"name":"copia_fin_columna","label":"Copia fin columna","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"copia_fin_columna","isAssociation":false},"incremento_secuencia":{"name":"incremento_secuencia","label":"Incremento secuencia","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"incremento_secuencia","isAssociation":false},"direccion_incremento":{"name":"direccion_incremento","label":"Direccion incremento","type":"select","enum":["columna","fila"],"source":undefined,"textField":undefined,"value":"direccion_incremento","isAssociation":false},"pegado_inicio_fila":{"name":"pegado_inicio_fila","label":"Pegado inicio fila","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"pegado_inicio_fila","isAssociation":false},"repetir_pegado":{"name":"repetir_pegado","label":"Repetir pegado","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"repetir_pegado","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Columna","data":"attributes.name"},{"title":"Tipo","data":"attributes.type"},{"title":"Dimensión","data":"relationships.dimension.attributes.name","render":function (data, type, full, meta) {
                            return data ? data : '';
                        }},{"title":"Nombre dimensión","data":"attributes.dimension_name"},{"title":"Captura de valor","data":"attributes.capture"},{"title":"Valor por defecto","data":"attributes.default_value"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
Captura.Detail.prototype = Object.create(Model.prototype);
Captura.Detail.prototype.constructor = Model;

    export default {
        props:[
        ],
        methods: {
            "procesar":function (model){
                var self = this;
                model.$save('', function() {
                    model.$methods.procesar(function(result){
                        model.imported_columns = result;
                        self.$children[3].redraw();
                    });
                });
            },
            "importar":function (model){
                var self = this;
                model.$methods.importar(function(result){
                });
            },
        },
        data: function () {
            module = this;
            return {
                path: [],
                capture: new Captura.Capture(),
sheet: new Captura.Sheet(function(){try{var url="/api/Captura/captures/"+(module.capture.id?module.capture.id:"¡@!")+"/sheets";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
detail: new Captura.Detail(function(){try{var url="/api/Captura/captures/"+(module.capture.id?module.capture.id:"¡@!")+"/sheets/"+(module.sheet.id?module.sheet.id:"¡@!")+"/details";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
preview: (function (){
                return {
                $url:function(){
                    return '/api/Captura/captures/'+(module.capture.id?module.capture.id:"0")+'/preview';
                },
                $list:function(){return 'raw=1';},
                $columns:function(){
                    var columns = [];
                    columns.push({title:'variable', data: 'variable'});
                    if (module.capture.imported_columns && typeof module.capture.imported_columns.forEach==='function') {
                        module.capture.imported_columns.forEach(function (col) {
                            columns.push({title:col, data: col});
                        });
                    }
                    return columns;
                },
                setRefreshListCallback: function() {
                    
                },
            }})(),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>