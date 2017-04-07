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
        return "fields=name,driver,host,port,database";
    };
    this.$name = "Connection";
    this.$pluralName = "Connections";
    this.$fields = function () {
        return [{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},{"name":"driver","label":"driver","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"driver","isAssociation":false},{"name":"host","label":"host","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"host","isAssociation":false},{"name":"port","label":"port","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"port","isAssociation":false},{"name":"database","label":"database","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"database","isAssociation":false},{"name":"username","label":"username","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"username","isAssociation":false},{"name":"password","label":"password","type":"password","enum":[],"source":undefined,"textField":undefined,"value":"password","isAssociation":false},{"name":"charset","label":"charset","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"charset","isAssociation":false},{"name":"collation","label":"collation","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"collation","isAssociation":false}];
    };
    this.$columns = function () {
        return [{"title":"name","data":"attributes.name"},{"title":"driver","data":"attributes.driver"},{"title":"host","data":"attributes.host"},{"title":"port","data":"attributes.port"},{"title":"database","data":"attributes.database"}];
    };
    this.$methods = {
    };
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
        }
    }
</script>