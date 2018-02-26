
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
    this.$ = {"username":{"name":"username","label":"Usuario","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"username","isAssociation":false},"password":{"name":"password","label":"Contraseña","type":"password","enum":[],"source":undefined,"textField":undefined,"value":"password","isAssociation":false},"nombres":{"name":"nombres","label":"Nombres","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombres","isAssociation":false},"apellidos":{"name":"apellidos","label":"Apellidos","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"apellidos","isAssociation":false},"avatar":{"name":"avatar","label":"Avatar","type":"file","enum":[],"source":undefined,"textField":function (data){return data?data.name:''},"value":"avatar","isAssociation":false},"numero_ci":{"name":"numero_ci","label":"Nro de CI","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"numero_ci","isAssociation":false},"tipo_doc_ci":{"name":"tipo_doc_ci","label":"Tipo Doc de CI","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"tipo_doc_ci","isAssociation":false},"ext_doc":{"name":"ext_doc","label":"Extensión Doc","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"ext_doc","isAssociation":false},"cod_estado_civil":{"name":"cod_estado_civil","label":"Estado Civil","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_estado_civil","isAssociation":false},"fecha_nac":{"name":"fecha_nac","label":"Fecha Nac","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fecha_nac","isAssociation":false},"dep_cod":{"name":"dep_cod","label":"Codigo Dep","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"dep_cod","isAssociation":false},"cod_ciudad":{"name":"cod_ciudad","label":"Codigo Ciudad","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_ciudad","isAssociation":false},"tipo_persona":{"name":"tipo_persona","label":"Tipo Persona","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"tipo_persona","isAssociation":false},"cod_nac":{"name":"cod_nac","label":"Cod Nac","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_nac","isAssociation":false},"nivel_edu":{"name":"nivel_edu","label":"Nivel de Educación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nivel_edu","isAssociation":false},"cod_cliente":{"name":"cod_cliente","label":"Codigo Cliente","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_cliente","isAssociation":false},"fec_ven_cliente":{"name":"fec_ven_cliente","label":"Fecha de vencimiento Cliente","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fec_ven_cliente","isAssociation":false},"email":{"name":"email","label":"Correo Electronico","type":"email","enum":[],"source":undefined,"textField":undefined,"value":"email","isAssociation":false},"nro_dependientes":{"name":"nro_dependientes","label":"Nro Dependientes","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nro_dependientes","isAssociation":false},"calificacion":{"name":"calificacion","label":"Calificación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"calificacion","isAssociation":false},"direccion":{"name":"direccion","label":"Dirección","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"direccion","isAssociation":false},"ubicacion":{"name":"ubicacion","label":"Ubicación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"ubicacion","isAssociation":false},"fec_registro":{"name":"fec_registro","label":"Fecha de Registro","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fec_registro","isAssociation":false},"hora_registro":{"name":"hora_registro","label":"Hora de Registro","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"hora_registro","isAssociation":false},"cod_mun":{"name":"cod_mun","label":"Codigo Municipio","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_mun","isAssociation":false},"cod_prov":{"name":"cod_prov","label":"Codigo Provincia","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_prov","isAssociation":false},"cod_zona":{"name":"cod_zona","label":"cod_zona","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_zona","isAssociation":false},"unidad":{"name":"unidad","label":"Entidad / Unidad","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"unidad","isAssociation":false},"remember_token":{"name":"remember_token","label":"remember_token","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"remember_token","isAssociation":false}};
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
        return "fields=cod_empresa,nombre_empresa,caracter,rubro";
    };
    this.$name = "Empresa";
    this.$pluralName = "Empresas";
    this.$title = "empresa";
    this.$pluralTitle = "empresas";
    this.$ = {"cod_empresa":{"name":"cod_empresa","label":"Código","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_empresa","isAssociation":false},"nombre_empresa":{"name":"nombre_empresa","label":"Empresa","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombre_empresa","isAssociation":false},"corporacion":{"name":"corporacion","label":"Corporación","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"corporacion","isAssociation":false},"caracter":{"name":"caracter","label":"Caracter","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"caracter","isAssociation":false},"rubro":{"name":"rubro","label":"Rubro","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"rubro","isAssociation":false},"tipologia":{"name":"tipologia","label":"Tipologia","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"tipologia","isAssociation":false},"detalle_empresa":{"name":"detalle_empresa","label":"detalle_empresa","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"detalle_empresa","isAssociation":false},"sub_empresa":{"name":"sub_empresa","label":"sub_empresa","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"sub_empresa","isAssociation":false},"es_principal":{"name":"es_principal","label":"es_principal","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"es_principal","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Código","data":"attributes.cod_empresa"},{"title":"Empresa","data":"attributes.nombre_empresa"},{"title":"Caracter","data":"attributes.caracter"},{"title":"Rubro","data":"attributes.rubro"}];
    };
    this.$methods = {
eeff:function(gestion, eeff,methodCallback,childrenAssociation){self.$call("eeff",{"gestion":gestion,"eeff":eeff}, childrenAssociation, methodCallback)}    };
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
        return "fields=tipo_estado_financiero,gestion,archivo,empresa";
    };
    this.$name = "EstadoFinanciero";
    this.$pluralName = "EstadoFinancieros";
    this.$title = "Estado financiero";
    this.$pluralTitle = "Estados financieros";
    this.$ = {"tipo_estado_financiero":{"name":"tipo_estado_financiero","label":"Tipo estado financiero","type":"select","enum":["Balance General","Estado de Recursos y Gastos Corrientes","Hoja de Trabajo","Estado de Cambios en el Patrimonio Neto","Partidas y Rubros Financieros","Estado de Ejecución Presupuestaria de Gastos","Estado de Ejecución Presupuestaria de Recursos"],"source":undefined,"textField":undefined,"value":"tipo_estado_financiero","isAssociation":false},"gestion":{"name":"gestion","label":"Gestión","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"gestion","isAssociation":false},"archivo":{"name":"archivo","label":"Archivo","type":"file","enum":[],"source":undefined,"textField":function (data){return data?data.name:''},"value":"archivo","isAssociation":false},"empresa":{"name":"empresa","label":"Empresa","type":"select","enum":[],"source":new UserAdministration.Empresa(),"textField":function (data){return data?(data.cod_empresa?data.cod_empresa:'   ')+' '+data.nombre_empresa:''},"value":"empresa","isAssociation":true,"isMultiple":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Tipo estado financiero","data":"attributes.tipo_estado_financiero"},{"title":"Gestión","data":"attributes.gestion"},{"title":"Archivo","data":"attributes.archivo","render":function (data){return data?data.name:''}},{"title":"Empresa","visible":true,"render":function (data){return data?(data.cod_empresa?data.cod_empresa:'   ')+' '+data.nombre_empresa:''},"data":"relationships.empresa.attributes"}];
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

UserAdministration.CuadroFinanciero = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/cuadro_financieros";
    Model.call(this, url, id, "UserAdministration.CuadroFinanciero");
    this.$list = function () {
        return "fields=titulo,contenido,grafico";
    };
    this.$name = "CuadroFinanciero";
    this.$pluralName = "CuadroFinancieros";
    this.$title = "Cuadro financiero";
    this.$pluralTitle = "Cuadros financieros";
    this.$ = {"titulo":{"name":"titulo","label":"Título","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"titulo","isAssociation":false},"contenido":{"name":"contenido","label":"Formula (html)","type":"html","enum":[],"source":undefined,"textField":undefined,"value":"contenido","isAssociation":false},"grafico":{"name":"grafico","label":"Grafico (json)","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"grafico","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Título","data":"attributes.titulo"},{"title":"Formula (html)","data":"attributes.contenido"},{"title":"Grafico (json)","data":"attributes.grafico"}];
    };
    this.$methods = {
calculate:function(empresaId, gestion, html, grafico,methodCallback,childrenAssociation){self.$call("calculate",{"empresaId":empresaId,"gestion":gestion,"html":html,"grafico":grafico}, childrenAssociation, methodCallback)}    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.CuadroFinanciero.prototype = Object.create(Model.prototype);
UserAdministration.CuadroFinanciero.prototype.constructor = Model;

UserAdministration.EmpresaGrafico = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/empresa_graficos";
    Model.call(this, url, id, "UserAdministration.EmpresaGrafico");
    this.$list = function () {
        return "fields=titulo,tipo,informes_auditoria,datos";
    };
    this.$name = "EmpresaGrafico";
    this.$pluralName = "EmpresaGraficos";
    this.$title = "Empresa gráfico";
    this.$pluralTitle = "Empresa gráficos";
    this.$ = {"titulo":{"name":"titulo","label":"Título","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"titulo","isAssociation":false},"tipo":{"name":"tipo","label":"Tipo","type":"select","enum":["bar","line","pie"],"source":undefined,"textField":undefined,"value":"tipo","isAssociation":false},"informes_auditoria":{"name":"informes_auditoria","label":"Informes auditoria","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"informes_auditoria","isAssociation":false},"datos":{"name":"datos","label":"Datos","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"datos","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Título","data":"attributes.titulo"},{"title":"Tipo","data":"attributes.tipo"},{"title":"Informes auditoria","data":"attributes.informes_auditoria"},{"title":"Datos","data":"attributes.datos"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.EmpresaGrafico.prototype = Object.create(Model.prototype);
UserAdministration.EmpresaGrafico.prototype.constructor = Model;

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

UserAdministration.CargaEstado = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/carga_estados";
    Model.call(this, url, id, "UserAdministration.CargaEstado");
    this.$list = function () {
        return "fields=files";
    };
    this.$name = "CargaEstado";
    this.$pluralName = "CargaEstados";
    this.$title = "Carga de estados financieros";
    this.$pluralTitle = "Cargas de estados financieros";
    this.$ = {"files":{"name":"files","label":"Archivos","type":"multiplefile","enum":[],"source":undefined,"textField":function (data,type,row){
                            var res = [];
                            data.forEach(function (item) {res.push(item.name)});
                            return res.join(", ");
                        },"value":"files","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Archivos","data":"attributes.files","render":function (data,type,row){
                            var res = [];
                            data.forEach(function (item) {res.push(item.name)});
                            return res.join(", ");
                        }}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.CargaEstado.prototype = Object.create(Model.prototype);
UserAdministration.CargaEstado.prototype.constructor = Model;

UserAdministration.Firma = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/firmas";
    Model.call(this, url, id, "UserAdministration.Firma");
    this.$list = function () {
        return "fields=cod_firma,gestion,representante_legal,informe_dictamen,documento_firma,informes,owner";
    };
    this.$name = "Firma";
    this.$pluralName = "Firmas";
    this.$title = "Firma";
    this.$pluralTitle = "Firmas de auditoria";
    this.$ = {"cod_firma":{"name":"cod_firma","label":"Código","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_firma","isAssociation":false},"gestion":{"name":"gestion","label":"Gestión","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"gestion","isAssociation":false},"detalle":{"name":"detalle","label":"Detalle","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"detalle","isAssociation":false},"representante_legal":{"name":"representante_legal","label":"Representante legal","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"representante_legal","isAssociation":false},"informe_dictamen":{"name":"informe_dictamen","label":"Informe o Dictamen","type":"file","enum":[],"source":undefined,"textField":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time;
                        },"value":"informe_dictamen","isAssociation":false},"vigencia_certificado":{"name":"vigencia_certificado","label":"Vigencia certificado","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"vigencia_certificado","isAssociation":false},"documento_firma":{"name":"documento_firma","label":"Documento Firma","type":"file","enum":[],"source":undefined,"textField":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time;
                        },"value":"documento_firma","isAssociation":false},"informes":{"name":"informes","label":"Informes","type":"multiplefile","enum":[],"source":undefined,"textField":function (data,type,row){
                            var res = [];
                            if (data && typeof data.forEach==='function') {
                                data.forEach(function (item) {
                                    res.push('<a href="' + item.url + '" target="_blank">' + item.name + '</a>');
                                });
                            }
                            return res.join("<br> ");
                        },"value":"informes","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Código","data":"attributes.cod_firma"},{"title":"Gestión","data":"attributes.gestion"},{"title":"Representante legal","data":"attributes.representante_legal"},{"title":"Informe o Dictamen","data":"attributes.informe_dictamen","render":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time;
                        }},{"title":"Documento Firma","data":"attributes.documento_firma","render":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time;
                        }},{"title":"Informes","data":"attributes.informes","render":function (data,type,row){
                            var res = [];
                            if (data && typeof data.forEach==='function') {
                                data.forEach(function (item) {
                                    res.push('<a href="' + item.url + '" target="_blank">' + item.name + '</a>');
                                });
                            }
                            return res.join("<br> ");
                        }},{"title":"Propietario","visible":false,"render":function (data, type, full, meta) {
                            return data ? data : '';
                        },"data":"relationships.owner.attributes.null"}];
    };
    this.$methods = {
listEditButton: function (data, type, row, meta){
                        var owner_id = row.relationships.owner ? row.relationships.owner.id : false;
                        var canEdit = owner_id == localStorage.user_id;
                        return canEdit ? true : '';
                    }    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Firma.prototype = Object.create(Model.prototype);
UserAdministration.Firma.prototype.constructor = Model;

UserAdministration.Uai = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/uais";
    Model.call(this, url, id, "UserAdministration.Uai");
    this.$list = function () {
        return "fields=cod_uai,gestion_uai,empresa,estructura_uai,titular_uai,tipo_de_informes,informes_emitidos_scep,owner";
    };
    this.$name = "Uai";
    this.$pluralName = "Uais";
    this.$title = "UAI";
    this.$pluralTitle = "UAIs";
    this.$ = {"cod_uai":{"name":"cod_uai","label":"Código","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_uai","isAssociation":false},"gestion_uai":{"name":"gestion_uai","label":"Gestión","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"gestion_uai","isAssociation":false},"empresa":{"name":"empresa","label":"Empresa","type":"select","enum":[],"source":new UserAdministration.Empresa(),"textField":"nombre_empresa","value":"empresa","isAssociation":true,"isMultiple":false},"estructura_uai":{"name":"estructura_uai","label":"Estructura UAI","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"estructura_uai","isAssociation":false},"titular_uai":{"name":"titular_uai","label":"Titular UAI","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"titular_uai","isAssociation":false},"tipo_de_informes":{"name":"tipo_de_informes","label":"Tipo de Informes","type":"file","enum":[],"source":undefined,"textField":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var owner = typeof row.relationships.owner==='undefined' || !row.relationships.owner
                                ? ''
                                : row.relationships.owner.attributes.nombres + ' '
                                    + row.relationships.owner.attributes.apellidos;
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time
                              + '<br><i class="fa fa-user-o"></i> '
                              + owner;
                        },"value":"tipo_de_informes","isAssociation":false},"informes_emitidos_scep":{"name":"informes_emitidos_scep","label":"Informes emitidos SCEP","type":"file","enum":[],"source":undefined,"textField":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var owner = typeof row.relationships.owner==='undefined' || !row.relationships.owner
                                ? ''
                                : row.relationships.owner.attributes.nombres + ' '
                                    + row.relationships.owner.attributes.apellidos;
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time
                              + '<br><i class="fa fa-user-o"></i> '
                              + owner;
                        },"value":"informes_emitidos_scep","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Código","data":"attributes.cod_uai"},{"title":"Gestión","data":"attributes.gestion_uai"},{"title":"Empresa","visible":true,"render":function (data, type, full, meta) {
                            return data ? data : '';
                        },"data":"relationships.empresa.attributes.nombre_empresa"},{"title":"Estructura UAI","data":"attributes.estructura_uai"},{"title":"Titular UAI","data":"attributes.titular_uai"},{"title":"Tipo de Informes","data":"attributes.tipo_de_informes","render":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var owner = typeof row.relationships.owner==='undefined' || !row.relationships.owner
                                ? ''
                                : row.relationships.owner.attributes.nombres + ' '
                                    + row.relationships.owner.attributes.apellidos;
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time
                              + '<br><i class="fa fa-user-o"></i> '
                              + owner;
                        }},{"title":"Informes emitidos SCEP","data":"attributes.informes_emitidos_scep","render":function (data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var owner = typeof row.relationships.owner==='undefined' || !row.relationships.owner
                                ? ''
                                : row.relationships.owner.attributes.nombres + ' '
                                    + row.relationships.owner.attributes.apellidos;
                            var $a = $('<a></a>');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('<i class="fa fa-download"></i> ');
                            return $("<div />").append($a).html()
                              + '<br><i class="fa fa-clock-o"></i> '
                              + time
                              + '<br><i class="fa fa-user-o"></i> '
                              + owner;
                        }},{"title":"Propietario","visible":false,"render":function (data, type, full, meta) {
                            return data ? data : '';
                        },"data":"relationships.owner.attributes.null"}];
    };
    this.$methods = {
listEditButton: function (data, type, row, meta){
                        var owner_id = row.relationships.owner ? row.relationships.owner.id : false;
                        var canEdit = owner_id == localStorage.user_id;
                        return canEdit ? true : '';
                    }    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Uai.prototype = Object.create(Model.prototype);
UserAdministration.Uai.prototype.constructor = Model;

UserAdministration.Tarea = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/tareas";
    Model.call(this, url, id, "UserAdministration.Tarea");
    this.$list = function () {
        return "fields=cod_tarea,creador,usuario,nombre_tarea,descripcion,fecha_ini,fecha_fin,estado,avance,prioridad";
    };
    this.$name = "Tarea";
    this.$pluralName = "Tareas";
    this.$title = "Tarea";
    this.$pluralTitle = "Tareas";
    this.$ = {"cod_tarea":{"name":"cod_tarea","label":"Código","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"cod_tarea","isAssociation":false},"creador":{"name":"creador","label":"Creador","type":"select","enum":[],"source":new UserAdministration.User(),"textField":function (data){console.log(arguments); return data?data.nombres + ' ' +data.apellidos:''},"value":"creador","isAssociation":true,"isMultiple":false},"usuario":{"name":"usuario","label":"Usuario","type":"select","enum":[],"source":new UserAdministration.User(),"textField":function (data){console.log(arguments); return data?data.nombres + ' ' +data.apellidos:''},"value":"usuario","isAssociation":true,"isMultiple":false},"nombre_tarea":{"name":"nombre_tarea","label":"Tarea","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombre_tarea","isAssociation":false},"descripcion":{"name":"descripcion","label":"Descripción","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"descripcion","isAssociation":false},"fecha_ini":{"name":"fecha_ini","label":"Fecha inicio","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fecha_ini","isAssociation":false},"fecha_fin":{"name":"fecha_fin","label":"Fecha finalización","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"fecha_fin","isAssociation":false},"estado":{"name":"estado","label":"Estado","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"estado","isAssociation":false},"avance":{"name":"avance","label":"Avance","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"avance","isAssociation":false},"prioridad":{"name":"prioridad","label":"Prioridad","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"prioridad","isAssociation":false},"revisor1":{"name":"revisor1","label":"Revisor 1","type":"select","enum":[],"source":new UserAdministration.User(),"textField":function (data){return data?data.nombres + ' ' +data.apellidos:''},"value":"revisor1","isAssociation":true,"isMultiple":false},"aprobacion1":{"name":"aprobacion1","label":"Aprovación 1","type":"select","enum":[],"source":new UserAdministration.User(),"textField":function (data){return data?data.nombres + ' ' +data.apellidos:''},"value":"aprobacion1","isAssociation":true,"isMultiple":false},"revisor2":{"name":"revisor2","label":"Revisor 2","type":"select","enum":[],"source":new UserAdministration.User(),"textField":"username","value":"revisor2","isAssociation":true,"isMultiple":false},"aprobacion2":{"name":"aprobacion2","label":"Aprovación 2","type":"select","enum":[],"source":new UserAdministration.User(),"textField":function (data){return data?data.nombres + ' ' +data.apellidos:''},"value":"aprobacion2","isAssociation":true,"isMultiple":false},"adjuntos":{"name":"adjuntos","label":"adjuntos","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"adjuntos","isAssociation":true,"isMultiple":true},"avances":{"name":"avances","label":"avances","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"avances","isAssociation":true,"isMultiple":true}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Código","data":"attributes.cod_tarea"},{"title":"Creador","visible":true,"render":function (data){console.log(arguments); return data?data.nombres + ' ' +data.apellidos:''},"data":"relationships.creador.attributes"},{"title":"Usuario","visible":true,"render":function (data){console.log(arguments); return data?data.nombres + ' ' +data.apellidos:''},"data":"relationships.usuario.attributes"},{"title":"Tarea","data":"attributes.nombre_tarea"},{"title":"Descripción","data":"attributes.descripcion"},{"title":"Fecha inicio","data":"attributes.fecha_ini"},{"title":"Fecha finalización","data":"attributes.fecha_fin"},{"title":"Estado","data":"attributes.estado"},{"title":"Avance","data":"attributes.avance"},{"title":"Prioridad","data":"attributes.prioridad"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Tarea.prototype = Object.create(Model.prototype);
UserAdministration.Tarea.prototype.constructor = Model;

UserAdministration.Adjunto = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/adjuntos";
    Model.call(this, url, id, "UserAdministration.Adjunto");
    this.$list = function () {
        return "fields=archivo";
    };
    this.$name = "Adjunto";
    this.$pluralName = "Adjuntos";
    this.$title = "adjunto";
    this.$pluralTitle = "adjuntos";
    this.$ = {"archivo":{"name":"archivo","label":"Archivo","type":"file","enum":[],"source":undefined,"textField":function (data){return data?data.name:''},"value":"archivo","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Archivo","data":"attributes.archivo","render":function (data){return data?data.name:''}}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Adjunto.prototype = Object.create(Model.prototype);
UserAdministration.Adjunto.prototype.constructor = Model;

UserAdministration.Avance = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/avances";
    Model.call(this, url, id, "UserAdministration.Avance");
    this.$list = function () {
        return "fields=avance,descripcion";
    };
    this.$name = "Avance";
    this.$pluralName = "Avances";
    this.$title = "avance";
    this.$pluralTitle = "avances";
    this.$ = {"avance":{"name":"avance","label":"Avance","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"avance","isAssociation":false},"descripcion":{"name":"descripcion","label":"Descripción","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"descripcion","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Avance","data":"attributes.avance"},{"title":"Descripción","data":"attributes.descripcion"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Avance.prototype = Object.create(Model.prototype);
UserAdministration.Avance.prototype.constructor = Model;

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

UserAdministration.Documento = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/documentos";
    Model.call(this, url, id, "UserAdministration.Documento");
    this.$list = function () {
        return "fields=nombre,archivo";
    };
    this.$name = "Documento";
    this.$pluralName = "Documentos";
    this.$title = "documento";
    this.$pluralTitle = "documentos";
    this.$ = {"nombre":{"name":"nombre","label":"Nombre","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"nombre","isAssociation":false},"archivo":{"name":"archivo","label":"Archivo","type":"file","enum":[],"source":undefined,"textField":undefined,"value":"archivo","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Nombre","data":"attributes.nombre"},{"title":"Archivo","data":"attributes.archivo"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.Documento.prototype = Object.create(Model.prototype);
UserAdministration.Documento.prototype.constructor = Model;

UserAdministration.HojaTrabajo = function (url, id) {
    var self = this;
    this.$defaultUrl = "/api/UserAdministration/hoja_trabajos";
    Model.call(this, url, id, "UserAdministration.HojaTrabajo");
    this.$list = function () {
        return "fields=titulo,templeta,gestion,valores";
    };
    this.$name = "HojaTrabajo";
    this.$pluralName = "HojaTrabajos";
    this.$title = "Hoja de trabajo";
    this.$pluralTitle = "Hojas de trabajo";
    this.$ = {"titulo":{"name":"titulo","label":"Título de la hoja de trabajo","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"titulo","isAssociation":false},"templeta":{"name":"templeta","label":"ID de templeta","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"templeta","isAssociation":false},"gestion":{"name":"gestion","label":"Gestión","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"gestion","isAssociation":false},"valores":{"name":"valores","label":"Valores llenados","type":"text","enum":[],"source":undefined,"textField":undefined,"value":"valores","isAssociation":false}};
    this.$fields = function () {
        return this.object2array(this.$, "item");
    };
    this.$columns = function () {
        return [{"title":"Título de la hoja de trabajo","data":"attributes.titulo"},{"title":"ID de templeta","data":"attributes.templeta"},{"title":"Gestión","data":"attributes.gestion"},{"title":"Valores llenados","data":"attributes.valores"}];
    };
    this.$methods = {
    };
    this.$initFields();
    if(id) {
        this.$load(id);
    }
}
UserAdministration.HojaTrabajo.prototype = Object.create(Model.prototype);
UserAdministration.HojaTrabajo.prototype.constructor = Model;

</script>