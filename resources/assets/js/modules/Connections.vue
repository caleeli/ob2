<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Conexiones</h2>
            <abm :model="connection"><i></i></abm>
        </div>
    </div>
</template>
<script>
    var module;
    var Model = require("../models/Model.js").default;
    var Connections = {};
    window.Connections = Connections;
    Connections.Connection = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/Connections/connections";
    Model.call(this, url, id, "Connections.Connection");
    this.$list = function () {
        return "fields=name,host,database";
    };
    this.$name = "Connection";
    this.$pluralName = "Connections";
    this.$title = "connection";
    this.$pluralTitle = "connections";
    this.$ = {"name":{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"driver":{"name":"driver","label":"driver","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"driver","isAssociation":false},"host":{"name":"host","label":"host","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"host","isAssociation":false},"port":{"name":"port","label":"port","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"port","isAssociation":false},"database":{"name":"database","label":"database","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"database","isAssociation":false},"username":{"name":"username","label":"username","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"username","isAssociation":false},"password":{"name":"password","label":"password","type":"password","enum":[],"source":undefined,"textField":undefined,"value":"password","isAssociation":false},"charset":{"name":"charset","label":"charset","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"charset","isAssociation":false},"collation":{"name":"collation","label":"collation","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"collation","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"name","data":"attributes.name"},{"title":"host","data":"attributes.host"},{"title":"database","data":"attributes.database"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
Connections.Connection.prototype = Object.create(Model.prototype);
Connections.Connection.prototype.constructor = Model;

    export default {
        props:[
        ],
        methods: {
        },
        data: function () {
            module = this;
            return {
                path: [],
                connection: new Connections.Connection(),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>