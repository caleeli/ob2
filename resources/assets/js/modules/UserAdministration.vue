
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
        return "fields=username,nombres,apellidos,avatar,numero_ci";
    };
    this.$name = "User";
    this.$pluralName = "Users";
    this.$title = "user";
    this.$pluralTitle = "users";
    this.$ = {"username":{"name":"username","label":"Usuario","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"username","isAssociation":false},"password":{"name":"password","label":"Contraseña","type":"password","enum":[],"source":undefined,"textField":undefined,"value":"password","isAssociation":false},"nombres":{"name":"nombres","label":"Nombres","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombres","isAssociation":false},"apellidos":{"name":"apellidos","label":"Apellidos","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"apellidos","isAssociation":false},"avatar":{"name":"avatar","label":"Avatar","type":"file","enum":[],"source":undefined,"textField":function (data){return data?data.name:''},"value":"avatar","isAssociation":false},"numero_ci":{"name":"numero_ci","label":"Nro de CI","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"numero_ci","isAssociation":false},"tipo_doc_ci":{"name":"tipo_doc_ci","label":"Tipo Doc de CI","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"tipo_doc_ci","isAssociation":false},"ext_doc":{"name":"ext_doc","label":"Extensión Doc","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"ext_doc","isAssociation":false},"cod_estado_civil":{"name":"cod_estado_civil","label":"Estado Civil","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_estado_civil","isAssociation":false},"fecha_nac":{"name":"fecha_nac","label":"Fecha Nac","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fecha_nac","isAssociation":false},"dep_cod":{"name":"dep_cod","label":"Codigo Dep","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"dep_cod","isAssociation":false},"cod_ciudad":{"name":"cod_ciudad","label":"Codigo Ciudad","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_ciudad","isAssociation":false},"tipo_persona":{"name":"tipo_persona","label":"Tipo Persona","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"tipo_persona","isAssociation":false},"cod_nac":{"name":"cod_nac","label":"Cod Nac","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_nac","isAssociation":false},"nivel_edu":{"name":"nivel_edu","label":"Nivel de Educación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nivel_edu","isAssociation":false},"cod_cliente":{"name":"cod_cliente","label":"Codigo Cliente","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_cliente","isAssociation":false},"fec_ven_cliente":{"name":"fec_ven_cliente","label":"Fecha de vencimiento Cliente","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fec_ven_cliente","isAssociation":false},"email":{"name":"email","label":"Correo Electronico","type":"email","enum":[],"source":undefined,"textField":undefined,"value":"email","isAssociation":false},"nro_dependientes":{"name":"nro_dependientes","label":"Nro Dependientes","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nro_dependientes","isAssociation":false},"calificacion":{"name":"calificacion","label":"Calificación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"calificacion","isAssociation":false},"direccion":{"name":"direccion","label":"Dirección","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"direccion","isAssociation":false},"ubicacion":{"name":"ubicacion","label":"Ubicación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"ubicacion","isAssociation":false},"fec_registro":{"name":"fec_registro","label":"Fecha de Registro","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fec_registro","isAssociation":false},"hora_registro":{"name":"hora_registro","label":"Hora de Registro","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"hora_registro","isAssociation":false},"cod_mun":{"name":"cod_mun","label":"Codigo Municipio","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_mun","isAssociation":false},"cod_prov":{"name":"cod_prov","label":"Codigo Provincia","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_prov","isAssociation":false},"cod_zona":{"name":"cod_zona","label":"cod_zona","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_zona","isAssociation":false},"unidad":{"name":"unidad","label":"Entidad / Unidad","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"unidad","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Usuario","data":"attributes.username"},{"title":"Nombres","data":"attributes.nombres"},{"title":"Apellidos","data":"attributes.apellidos"},{"title":"Avatar","data":"attributes.avatar","render":function (data){return data?data.name:''}},{"title":"Nro de CI","data":"attributes.numero_ci"}];
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

UserAdministration.Empresa = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/empresas";
    Model.call(this, url, id, "UserAdministration.Empresa");
    this.$list = function () {
        return "fields=cod_empresa,nombre_empresa,corporacion,caracter,rubro,tipologia";
    };
    this.$name = "Empresa";
    this.$pluralName = "Empresas";
    this.$title = "empresa";
    this.$pluralTitle = "empresas";
    this.$ = {"cod_empresa":{"name":"cod_empresa","label":"Código","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_empresa","isAssociation":false},"nombre_empresa":{"name":"nombre_empresa","label":"Empresa","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombre_empresa","isAssociation":false},"corporacion":{"name":"corporacion","label":"Corporación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"corporacion","isAssociation":false},"caracter":{"name":"caracter","label":"Caracter","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"caracter","isAssociation":false},"rubro":{"name":"rubro","label":"Rubro","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"rubro","isAssociation":false},"tipologia":{"name":"tipologia","label":"Tipologia","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"tipologia","isAssociation":false},"detalle_empresa":{"name":"detalle_empresa","label":"detalle_empresa","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"detalle_empresa","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Código","data":"attributes.cod_empresa"},{"title":"Empresa","data":"attributes.nombre_empresa"},{"title":"Corporación","data":"attributes.corporacion"},{"title":"Caracter","data":"attributes.caracter"},{"title":"Rubro","data":"attributes.rubro"},{"title":"Tipologia","data":"attributes.tipologia"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Empresa.prototype = Object.create(Model.prototype);
UserAdministration.Empresa.prototype.constructor = Model;

UserAdministration.EstadoFinanciero = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/estado_financieros";
    Model.call(this, url, id, "UserAdministration.EstadoFinanciero");
    this.$list = function () {
        return "fields=tipo_estado_financiero,informes_auditoria,gestion,archivo,empresa";
    };
    this.$name = "EstadoFinanciero";
    this.$pluralName = "EstadoFinancieros";
    this.$title = "Estado financiero";
    this.$pluralTitle = "Estados financieros";
    this.$ = {"tipo_estado_financiero":{"name":"tipo_estado_financiero","label":"Tipo estado financiero","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"tipo_estado_financiero","isAssociation":false},"informes_auditoria":{"name":"informes_auditoria","label":"Informes auditoria","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"informes_auditoria","isAssociation":false},"gestion":{"name":"gestion","label":"Gestión","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"gestion","isAssociation":false},"archivo":{"name":"archivo","label":"Archivo","type":"file","enum":[],"source":undefined,"textField":function (data){return data?data.name:''},"value":"archivo","isAssociation":false},"grafico_texto":{"name":"grafico_texto","label":"Gráfico texto","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"grafico_texto","isAssociation":false},"grafico_valores":{"name":"grafico_valores","label":"Gráfico valores","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"grafico_valores","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Tipo estado financiero","data":"attributes.tipo_estado_financiero"},{"title":"Informes auditoria","data":"attributes.informes_auditoria"},{"title":"Gestión","data":"attributes.gestion"},{"title":"Archivo","data":"attributes.archivo","render":function (data){return data?data.name:''}},{"title":"empresa","data":"relationships.empresa.attributes.function (data){return data?data.empresa.attributes.nombre_empresa:''}","render":function (data, type, full, meta) {
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
UserAdministration.EstadoFinanciero.prototype = Object.create(Model.prototype);
UserAdministration.EstadoFinanciero.prototype.constructor = Model;

UserAdministration.EmpresaEstado = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/empresa_estados";
    Model.call(this, url, id, "UserAdministration.EmpresaEstado");
    this.$list = function () {
        return "fields=nombre_empresa,gestion";
    };
    this.$name = "EmpresaEstado";
    this.$pluralName = "EmpresaEstados";
    this.$title = "Estado financiero por empresa";
    this.$pluralTitle = "Estados financieros por empresa";
    this.$ = {"nombre_empresa":{"name":"nombre_empresa","label":"Tipo","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombre_empresa","isAssociation":false},"gestion":{"name":"gestion","label":"Gestión","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"gestion","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Tipo","data":"attributes.nombre_empresa"},{"title":"Gestión","data":"attributes.gestion"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.EmpresaEstado.prototype = Object.create(Model.prototype);
UserAdministration.EmpresaEstado.prototype.constructor = Model;

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

</script>