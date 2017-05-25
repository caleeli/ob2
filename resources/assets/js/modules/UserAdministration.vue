<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
            <h2 id="nav-tabs">Roles</h2>
            <abm id="UserAdministration.Roles" :model="role" nameField="name">
                <span></span>
            </abm>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8" v-show.visible="$root.getPaths().length &gt;= 1">
            <h2 id="nav-tabs">Usuarios</h2>
            <abm id="UserAdministration.Users" :model="user" refreshWith="UserAdministration.Roles" nameField="name">
                <span></span>
            </abm>
        </div>
    </div>
</template>
<script>
    var module;
    var Model = require("../models/Model.js").default;
    var UserAdministration = {};
    window.UserAdministration = UserAdministration;
    UserAdministration.User = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/users";
    Model.call(this, url, id, "UserAdministration.User");
    this.$list = function () {
        return "fields=username,nombres,apellidos";
    };
    this.$name = "User";
    this.$pluralName = "Users";
    this.$title = "user";
    this.$pluralTitle = "users";
    this.$ = {"username":{"name":"username","label":"Usuario","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"username","isAssociation":false},"password":{"name":"password","label":"Contraseña","type":"password","enum":[],"source":undefined,"textField":undefined,"value":"password","isAssociation":false},"nombres":{"name":"nombres","label":"Nombres","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombres","isAssociation":false},"apellidos":{"name":"apellidos","label":"Apellidos","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"apellidos","isAssociation":false},"email":{"name":"email","label":"Correo Electronico","type":"email","enum":[],"source":undefined,"textField":undefined,"value":"email","isAssociation":false},"unidad":{"name":"unidad","label":"Entidad / Unidad","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"unidad","isAssociation":false},"variableTags":{"name":"variableTags","label":"Áreas de interes","type":"tags","enum":[],"source":new ReportsFolders.VariableTag(),"textField":"name","value":"variableTags","isAssociation":true,"isMultiple":true}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Usuario","data":"attributes.username"},{"title":"Nombres","data":"attributes.nombres"},{"title":"Apellidos","data":"attributes.apellidos"}];
    };
    this.$methods = {
registrar:function(data,methodCallback,childrenAssociation){self.$call("registrar",{"data":data}, childrenAssociation, methodCallback)}    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.User.prototype = Object.create(Model.prototype);
UserAdministration.User.prototype.constructor = Model;

UserAdministration.Role = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/roles";
    Model.call(this, url, id, "UserAdministration.Role");
    this.$list = function () {
        return "fields=name,status";
    };
    this.$name = "Role";
    this.$pluralName = "Roles";
    this.$title = "Rol";
    this.$pluralTitle = "Roles";
    this.$ = {"name":{"name":"name","label":"name","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"name","isAssociation":false},"status":{"name":"status","label":"status","type":"select","enum":["ACTIVE","INACTIVE"],"source":undefined,"textField":undefined,"value":"status","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"name","data":"attributes.name"},{"title":"status","data":"attributes.status"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Role.prototype = Object.create(Model.prototype);
UserAdministration.Role.prototype.constructor = Model;

UserAdministration.Login = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/logins";
    Model.call(this, url, id, "UserAdministration.Login");
    this.$list = function () {
        return "fields=username,password,token";
    };
    this.$name = "Login";
    this.$pluralName = "Logins";
    this.$title = "login";
    this.$pluralTitle = "logins";
    this.$ = {"username":{"name":"username","label":"username","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"username","isAssociation":false},"password":{"name":"password","label":"password","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"password","isAssociation":false},"token":{"name":"token","label":"token","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"token","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"username","data":"attributes.username"},{"title":"password","data":"attributes.password"},{"title":"token","data":"attributes.token"}];
    };
    this.$methods = {
validate:function(username, password,methodCallback,childrenAssociation){self.$call("validate",{"username":username,"password":password}, childrenAssociation, methodCallback)}    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Login.prototype = Object.create(Model.prototype);
UserAdministration.Login.prototype.constructor = Model;

UserAdministration.Recover = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/recovers";
    Model.call(this, url, id, "UserAdministration.Recover");
    this.$list = function () {
        return "fields=account,key";
    };
    this.$name = "Recover";
    this.$pluralName = "Recovers";
    this.$title = "recover";
    this.$pluralTitle = "recovers";
    this.$ = {"account":{"name":"account","label":"account","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"account","isAssociation":false},"key":{"name":"key","label":"key","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"key","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"account","data":"attributes.account"},{"title":"key","data":"attributes.key"}];
    };
    this.$methods = {
sendEmail:function(account,methodCallback,childrenAssociation){self.$call("sendEmail",{"account":account}, childrenAssociation, methodCallback)}    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Recover.prototype = Object.create(Model.prototype);
UserAdministration.Recover.prototype.constructor = Model;

    export default {
        props:[
        ],
        methods: {
        },
        data: function () {
            module = this;
            return {
                path: [],
                user: new UserAdministration.User(function(){try{var url="/api/UserAdministration/roles/"+(module.role.id?module.role.id:"¡@!")+"/users";return API_SERVER+(url.indexOf("¡@!")===-1?url:this.$defaultUrl);}catch(err){return API_SERVER+this.$defaultUrl;}}),
role: new UserAdministration.Role(),
variableTags: new ReportsFolders.VariableTag(),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
            if (this.$children[1] && this.$children[1].path) this.path.push(this.$children[1].path);
        }
    }
</script>