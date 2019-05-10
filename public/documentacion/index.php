<?php
require('../../vendor/autoload.php');
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>SCEP</title>
        <link rel="shortcut icon" type="image/png" href="../favicon.png"/>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/jquery.steps.css">
        <!-- link rel="stylesheet" type="text/css" href="/css/viewer.css" -->
        <script>
            if (typeof localStorage.user_id === 'undefined'
                || localStorage.user_id === null
                || localStorage.user_id === "null"
                || !localStorage.user_id
            ) location.href = 'login.html';
        </script>
        <style>
            .document-preview {
                width: 8.5in;
                border: 1px solid black;
                padding-left: 1.5cm;
                padding-right: 0.5cm;
                padding-top: 1cm;
                padding-bottom: 1cm;
                box-shadow: 4px 4px 8px -2px rgb(60,60,60);
                margin-bottom: 8px;
            }
            #abmUAI .dataTable a[target]{
                word-break: break-all;
                display: inline-block;
                max-width: 16vw;
            }
            #abmUAI .dataTable{
                font-size: 80%;
            }
            #abmFirmasDeAuditoria .dataTable a[target]{
                word-break: break-all;
                display: inline-block;
                max-width: 16vw;
            }
            #abmFirmasDeAuditoria .dataTable{
                font-size: 80%;
            }
            .menu-icon {
                height:1.5em;
            }
            .avatar1em {
                width: 1em;
                border: 1px solid;
                border-radius: 1em;
            }
            .wizard > .steps > ul > li {
                width: 12%;
            }
            .wizard > .steps .unable a,
            .wizard > .steps .unable a:hover,
            .wizard > .steps .unable a:active
            {
                background: #fff;
                color: #aaa;
                cursor: default;
            }
            .wizard .active
            {
                font-weight: bold;
            }
            .tarea-paso {
                padding: 2px 4px!important;
                border-radius: 8px;
            }
            /*.tarea-paso1 {background-color: #940813!important;}
            .tarea-paso2 {background-color: #C72328!important;}
            .tarea-paso3 {background-color: #E43A28!important;}
            .tarea-paso4 {background-color: #E66826!important;}
            .tarea-paso5 {background-color: #FBCD37!important;}
            .tarea-paso6 {background-color: #FEF149!important;}
            .tarea-paso7 {background-color: #D2FD3B!important;}
            .tarea-paso8 {background-color: #70D52D!important;}*/
        </style>
    </head>

    <body>
        <div id="now_loading">
            Cargando ...<br/>
            <i class="ajax-loader"></i>
        </div>
        <div id="wrapper" style="visibility:hidden;">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="/nav-header/" style="background: transparent;">
                            <div class="dropdown profile-element">
                                    <span class="clear">
                                        <span class="block m-t-xs" style="margin-top: 0px;padding: 8px 13px; text-align: left;">
                                            <span style="color: white; display: inline-table; margin-left: 2em;">
                                                <strong>{{user.username}}</strong><br />
                                                <span>Usuario</span>
                                            </span>
                                        </span>
                                    </span>
                            </div>
                            <div class="logo-element" style="margin-top: 0px;padding: 8px 0px;">
                                <a href="javascript:void(0)" class="navbar-minimalize"><img src="/images/logo-white.png" style="height: 44px;"></a>
                            </div>
                        </li>
                        <li class="active"><a href="#estadosFinancieros"><img class="fa fa-th-large menu-icon" src="img/eeff.png"> <span class="nav-label">Estados financieros</span></a></li>
                        <li class="active"><a href="#seguimientoDeTareas"><img class="fa fa-th-large menu-icon" src="img/tasks.png"> <span class="nav-label">Revisión de carpetas</span></a></li>
                        <li class="active"><a href="#cambio_password"><img class="fa fa-th-large menu-icon" src="img/candado.png"> <span class="nav-label">Cambio de contraseña</span></a></li>
                        <li class="active"><a href="#bibliotecaScep"><img class="fa fa-th-large menu-icon" src="img/fideicomiso.png"> <span class="nav-label">Biblioteca SCEP</span></a></li>
                        <li class="active" v-if="esUsuarioAuxiliar()">
                            <a href="index.html"><i class="fa fa-th-large menu-icon"></i> <span class="nav-label">Admin</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="active"><a href="#estadosFinancierosAdmin">Estados financieros ADM</a></li>
                                <li class="active"><a href="#usuariosAdmin">Administración de usuarios</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg dashbard-1" style=''>
                <div class="top-header border-bottom">
                    <nav role="navigation" class="navbar navbar-static-top" style="margin-bottom: 0px; background: #F3F3F4;">
                        <div class="navbar-header visible-xs">
                            <a href="javascript:void(0)" class="navbar-minimalize profile-element"><img src="img/logo2.png" style="height: 55px;"></a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right"><li></li>   <li><a href="login.html" style="color: #999C9E;"><i class="fa fa-sign-out"></i>Cerrar Sesión</a></li> </ul>
                    </nav>
                </div>
                <carousel>
                    <!--
                        EMPRESAS PUBLICAS
                    -->
                    <carouselitem id="empresasPublicas" classbase="active">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <h5>DETALLE EMPRESAS PÚBLICAS</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow-y: scroll;">
                                                    <newtable v-bind:model="empresa" v-on:selectrow="seleccionaEmpresa" title="" id_field="cod_empresa" group="sub_empresa" open="0" v-bind:candelete="esUsuarioAuxiliar()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div id="descripcionEmpresa" class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="col-lg-12">
                                                <div class="ibox">
                                                    <div class="ibox-title">
                                                        <h5> {{empresa.nombre_empresa}}</h5>
                                                        <div class="ibox-tools" v-if='esUsuarioAuxiliar()'>
                                                            <a v-show="!editingEmpresa" v-on:click="editEmpresa" title='Editar contenido'>
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                            <a v-show="editingEmpresa" title='Subir Archivo' style="position: relative;overflow: hidden;display: inline-block;line-height: 0.9em;">
                                                                <i class="fa fa-upload"></i>
                                                                <upload v-model="uploadAdjEmpresa" target="empresas" v-bind:multiplefile="false" v-on:change="mostrarUploadLink"/>
                                                            </a>
                                                            <a v-show="editingEmpresa" v-on:click="cancelEmpresa(empresa)" title='Salir'>
                                                                <i class="fa fa-arrow-left"></i>
                                                            </a>
                                                            <a v-show="editingEmpresa" v-on:click="saveEmpresa(empresa)" title='Guardar'>
                                                                <i class="fa fa-save"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div v-show="!editingEmpresa" class="ibox-content" v-html="empresa.detalle_empresa"></div>
                                                    <div v-show="editingEmpresa" class="ibox-content">
                                                        <tinymce v-model="empresa.detalle_empresa" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </carouselitem>

                    <!--
                        ESTADOS FINANCIEROS
                    -->
                    <carouselitem id="estadosFinancieros">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>ESTADOS FINANCIEROS</h5>
                                                <div class="ibox-tools">
                                                    <a v-show="eeffModo=='graficos'" v-on:click="eeffModo='descargas'"
                                                       target='_blank' style='color:#222222' class="" title="Descargas">
                                                        <i class="fa fa-download"></i>
                                                        DESCARGAS
                                                    </a>
                                                    <a v-show="eeffModo=='descargas'" v-on:click="eeffModo='graficos'"
                                                       target='_blank' style='color:#222222' class="" title="Gráficos">
                                                        <i class="fa fa-arrow-circle-left"></i>
                                                        VOLVER
                                                    </a>
                                                    <a v-show="eeffModo=='graficos'" v-bind:href="'/report?path=/documentacion/reporte_1.html%23reporte/'+empresaSeleccionada+'/'+empresaSeleccionadaGestion"
                                                       target='_blank' style='color:#222222' class="" title="imprimir">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow: hidden;">
                                                    <div class="row">
                                                      <div class="col-lg-6">
                                                        <select class="form-control" id="select" v-model='empresaSeleccionada' v-on:change="cargarEstadosFinancieros">
                                                            <option v-for="emp in empresas" v-bind:value='emp.id'>{{emp.attributes.cod_empresa}} - {{emp.attributes.nombre_empresa}}</option>
                                                        </select>
                                                      </div>
                                                      <div class="col-lg-2">
                                                        <select class="form-control" id="gestion" v-model='empresaSeleccionadaGestion' v-on:change="cargarEstadosFinancieros">
                                                            <option v-for="year in gestiones" v-bind:value='year'>{{year}}</option>
                                                        </select>
                                                      </div>
                                                      <div class="col-lg-4" v-show="eeffModo=='graficos'">
                                                        <select class="form-control" v-model='cuadroSeleccionado' v-on:change="cargarEstadosFinancieros">
                                                            <option v-for="cua in cuadros_financieros_completo" v-bind:value='cua.id'>{{cua.attributes.titulo}}</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div id="cuadros_financieros" class="row" v-show="eeffModo=='graficos'">
                                                        <div v-for="estado in cuadros_financieros" class="col-md-12">
                                                            <div class="ibox float-e-margins" v-bind:title="empresaSeleccionada">
                                                                <div class="ibox-title">
                                                                    <h5>{{estado.attributes.titulo}}</h5>
                                                                    <div class="ibox-tools">
                                                                        <a v-if='eeffEditable.indexOf(estado.id)==-1' v-on:click='editEEFF(estado)'>
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>
                                                                        <a v-if='eeffEditable.indexOf(estado.id)>-1' v-on:click='saveEEFF(estado)'>
                                                                            <i class="fa fa-floppy-o"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="ibox-content indicador">
                                                                    <!-- a v-bind:href="estado.attributes.archivo?estado.attributes.archivo.url:'#'">{{estado.attributes.archivo?estado.attributes.archivo.name:''}}</a -->
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div v-if='eeffEditable.indexOf(estado.id)==-1' v-html="estado.html"></div>
                                                                            <htmleditor v-if='eeffEditable.indexOf(estado.id)>-1' v-bind:model="estado.attributes" v-bind:property="'contenido'" />
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div v-html="estado.presupuesto"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div v-for="data in estado.calculatedChart" class="col-md-6">
                                                                            <br>
                                                                            <basic-chart title="Presupuesto aprobado"
                                                                                 refreshWith="select,gestion"
                                                                                 mcols="aprobado"
                                                                                 v-bind:type="data.type"
                                                                                 v-bind:mdata='data' />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div v-if="empresaSeleccionada==3 && empresaSeleccionadaGestion==2015" class="col-md-12">
                                                                            <img src="img/boa_cuentas.png" style="width:90%">
                                                                        </div>
                                                                        <div v-if="empresaSeleccionada==3 && empresaSeleccionadaGestion==2016" class="col-md-12">
                                                                            <img src="img/boa_cuentas_2016.png" style="width:90%">
                                                                        </div>
                                                                        <div v-if="empresaSeleccionada==15 && empresaSeleccionadaGestion==2016" class="col-md-12">
                                                                            <img src="img/easba_cuentas.png" style="width:90%">
                                                                        </div>
                                                                        <div v-if="empresaSeleccionada==21 && empresaSeleccionadaGestion==2016" class="col-md-12">
                                                                            <img src="img/miteleferico_cuentas.png" style="width:90%">
                                                                        </div>
                                                                        <div v-if="empresaSeleccionada==22 && empresaSeleccionadaGestion==2016" class="col-md-12">
                                                                            <img src="img/quipus_cuentas.png" style="width:90%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- div class="col-md-6" v-if="user.username==='admin'">
                                                            <a class="btn btn-primary" v-on:click="addCCFF"><h1><i class="fa fa-plus-circle"></i></h1></a>
                                                        </div -->
                                                    </div>
                                                    <div class="row" v-show="eeffModo=='descargas'">
                                                        <div class="col-sm-12">
                                                            <div class="ibox float-e-margins" v-bind:title="empresaSeleccionada">
                                                                <div class="ibox-title">
                                                                    <h5>DESCARGAS</h5>
                                                                </div>
                                                                <div class="ibox-content indicador">
                                                                    <table width="100%" border="1">
                                                                        <tr v-for="link in estadosAdjuntos(estados_financieros, empresaSeleccionada, empresaSeleccionadaGestion)">
                                                                            <td style="padding: 4pt 8pt">
                                                                                <a v-if="link.pdf" v-bind:href="link.pdf.href" style='color:black;'
                                                                                   target='_blank' class="" v-bind:title="link.pdf.name">
                                                                                    <i v-bind:class="link.pdf.icon" v-bind:style='{color:link.pdf.color}'></i>
                                                                                    {{link.pdf.name}}
                                                                                </a>
                                                                            </td>
                                                                            <td style="padding: 4pt 8pt">
                                                                                <a v-if="link.excel" v-bind:href="link.excel.href" style='color:black;'
                                                                                   target='_blank' class="" v-bind:title="link.excel.name">
                                                                                    <i v-bind:class="link.excel.icon" v-bind:style='{color:link.excel.color}'></i>
                                                                                    {{link.excel.name}}
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        ESTADOS FINANCIEROS ADMIN
                    -->
                    <carouselitem id="estadosFinancierosAdmin">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>ESTADOS FINANCIEROS - ARCHIVOS CARGADOS</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow-y: scroll;">
                                                    <!-- abm v-bind:model="estado_financiero_adm" v-bind:editable="true" buttons='close,save,delete'></abm>
                                                    <h5>CARGA MASIVA</h5>
                                                    <abm v-bind:model="carga_estado" v-bind:editable="true" buttons='close,save,delete'></abm -->
                                                    <file-viewer v-bind:model="estado_financiero_adm" v-bind:empresas="empresa" v-bind:carga_estado="carga_estado"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        BIBLIOTECA SCEP
                    -->
                    <carouselitem id="bibliotecaScep">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>BIBLIOTECA SCEP</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <!-- (biblioteca_normativa ? biblioteca_normativa + '_' : '') -->
                                                <div style="overflow-y: scroll;">
                                                    <folder-viewer api="/api/folder/normativa"
                                                        v-bind:target='"normativa"'
                                                        v-bind:canupload='esAdmin'
                                                        v-bind:candelete='esAdmin'
                                                        mode='list'
                                                        v-bind:filter="
                                                                (biblioteca_normativa ? biblioteca_normativa + '%' : '')
                                                                + (biblioteca_busqueda ? '%' + biblioteca_busqueda + '%' : '')
                                                                + ('.%')
                                                        ">
                                                        <h5>Normativa</h5>
                                                        <select v-model="biblioteca_normativa" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Ley_Financial">Leyes Financiales</option>
                                                            <option value="Reg._LF.">Reglamento Leyes Financiales</option>
                                                            <option value="Clasificador">Clasificador Presupuestario</option>
                                                            <option value="LINEAMIENTOS">Lineamientos del COSSEP</option>
                                                            <option value="dl_crea">Creación de Empresas Públicas</option>
                                                            <option value="SCEP">Interna SCEP</option>
                                                            <option value="NORMAS_AUDIT">Normas de Auditoría</option>
                                                            <option value="NORMAS_CONT">Normas de Contabilidad</option>
                                                            
                                                        </select>
                                                        <h5>Criterio de busqueda</h5>
                                                        <input v-model="biblioteca_busqueda" class="form-control">
                                                        <br>
                                                    </folder-viewer>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <carouselitem id="usuariosAdmin">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Administración de usuarios</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow-y: scroll;">
                                                    <abm v-bind:model="usuarios" v-bind:editable="true" buttons='close,save'></abm>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        EVALUACIONES DE CONSISTENCIA
                    -->
                    <carouselitem id="firmasDeAuditoria">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>EVALUACIONES DE CONSISTENCIA</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow: auto;">
                                                    <abm id="abmFirmasDeAuditoria" v-bind:model="firma_auditoria" v-bind:editable="esAdmin || noEsDoctorMari()" buttons="close,save,delete" :toolbar="contratacionesDirectasToolbar"></abm>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        CONTRATACIONES DIRECTAS
                    -->
                    <carouselitem id="contratacionesDirectas">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>CONTRATACIONES DIRECTAS</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow: auto;">
                                                    <abm id="abmContratacionesDirectas" v-bind:model="contratacion_directa" v-bind:editable="esAdmin || noEsDoctorMari()" buttons="close,save,delete" :toolbar="contratacionesDirectasToolbar"></abm>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        UAI
                    -->
                    <carouselitem id="UAI">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Unidades de Auditoria Interna</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow: auto;">
                                                    <abm id="abmUAI" v-bind:model="uai" v-bind:editable="esAdmin || noEsDoctorMari()"  :toolbar="contratacionesDirectasToolbar" buttons="close,save,delete"></abm>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        Seguimiento de tareas
                    -->
                    <carouselitem id="seguimientoDeTareas">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Revisión de carpetas</h5>
                                                <div class="ibox-tools" v-if="esUsuarioGerente()">
                                                    <a href="#asignarTarea" class="btn btn-primary btn-xs" v-on:click='crearTarea'>Asignar tarea</a>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                        <div class="panel blank-panel">
                                                            <div class="">
                                                                <div class="panel-options">
                                                                    <ul class="nav nav-tabs small">
                                                                        <li class="active"><a v-on:click="setTipoTarea('EDC')" data-toggle="tab">Crédito Individual</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('AUD')" data-toggle="tab">Crédito Veloz</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('SUP')" data-toggle="tab">Crédito Temporada</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('RDI')" data-toggle="tab">Crédito Verde</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('COD')" data-toggle="tab">Crediestudio</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('EIU')" data-toggle="tab">Crédito Agropecuario</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('EIP')" data-toggle="tab">Crédito Solidario</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('SYD')" data-toggle="tab">Bancos de Emprendimiento</a></li>
                                                                        <li class=""><a v-on:click="setTipoTarea('TAD')" data-toggle="tab">Crédito Socia Adicional</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a class="btn btn-default"  v-on:click='listarTareas'>
                                                                <i class="fa fa-refresh"></i>
                                                                <small class="hidden-xs hidden-sm">Recargar</small>
                                                            </a>
                                                        </span>
                                                        <input type="text" class="form-control form-file-progress" placeholder="Busqueda" v-model="busquedaTareas">
                                                        <span class="input-group-btn">
                                                            <span class="btn btn-primary" type="button" v-on:click="buscarTarea">
                                                                <i class="fa fa-search"></i>
                                                                <small class="hidden-xs hidden-sm">Buscar</small>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row" v-for='tareaI in tareas'>
                                                                <div class="col-md-4 col-xs-12">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td class="project-status" width="35%">
                                                                                <small>Estado</small><br>
                                                                                <span v-bind:class="{
                                                                                        'label': true,
                                                                                        'label-danger': avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo]) <= 30,
                                                                                        'label-warning': 30 < avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo]) && avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo]) < 100,
                                                                                        'label-primary': 100 <= avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo])
                                                                                    }">
                                                                                    <i v-bind:class="{
                                                                                       'fa':true,
                                                                                       'fa-clock-o':avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo])<100,
                                                                                       'fa-check':avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo])>=100
                                                                                    }"></i>
                                                                                    <span class="hidden-xs hidden-sm hidden-md">{{avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo])<100?'Pendiente': 'Completado'}}</span>
                                                                                </span>
                                                                            </td>
                                                                            <td class="project-title" width="65%">
                                                                                <a href="#detalleTarea" v-on:click='seleccionaTarea(tareaI)'>{{tareaI.attributes.nombre_tarea}}</a>
                                                                                <br>
                                                                                <small class="block-with-text">{{tareaI.attributes.descripcion}}</small>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="col-md-2 col-xs-4 project-completion">
                                                                    <div class="progress progress-striped active m-b-sm">
                                                                        <div v-bind:style="{width: avancePasosPorcentaje(tareaI, definicionPasos[tareaI.attributes.tipo])+'%'}" class="progress-bar progress-bar-primary"></div>
                                                                    </div>
                                                                    <span class="tarea-paso tarea-paso1 label label-primary">1</span>
                                                                    <span v-show='definicionPasos[tareaI.attributes.tipo].length>=2' v-bind:class="{'tarea-paso':1, 'tarea-paso2':pasoPorTarea(tareaI, 2), label:1, 'label-primary': pasoPorTarea(tareaI, 2), 'label-default': !pasoPorTarea(tareaI, 2)}">2</span>
                                                                    <span v-show='definicionPasos[tareaI.attributes.tipo].length>=3' v-bind:class="{'tarea-paso':1, 'tarea-paso3':pasoPorTarea(tareaI, 3), label:1, 'label-primary': pasoPorTarea(tareaI, 3), 'label-default': !pasoPorTarea(tareaI, 3)}">3</span>
                                                                    <span v-show='definicionPasos[tareaI.attributes.tipo].length>=4' v-bind:class="{'tarea-paso':1, 'tarea-paso4':pasoPorTarea(tareaI, 4), label:1, 'label-primary': pasoPorTarea(tareaI, 4), 'label-default': !pasoPorTarea(tareaI, 4)}">4</span>
                                                                    <span v-show='definicionPasos[tareaI.attributes.tipo].length>=5' v-bind:class="{'tarea-paso':1, 'tarea-paso5':pasoPorTarea(tareaI, 5), label:1, 'label-primary': pasoPorTarea(tareaI, 5), 'label-default': !pasoPorTarea(tareaI, 5)}">5</span>
                                                                    <span v-show='definicionPasos[tareaI.attributes.tipo].length>=6' v-bind:class="{'tarea-paso':1, 'tarea-paso6':pasoPorTarea(tareaI, 6), label:1, 'label-primary': pasoPorTarea(tareaI, 6), 'label-default': !pasoPorTarea(tareaI, 6)}">6</span>
                                                                    <span v-show='definicionPasos[tareaI.attributes.tipo].length>=7' v-bind:class="{'tarea-paso':1, 'tarea-paso7':pasoPorTarea(tareaI, 7), label:1, 'label-primary': pasoPorTarea(tareaI, 7), 'label-default': !pasoPorTarea(tareaI, 7)}">7</span>
                                                                    <span v-show='definicionPasos[tareaI.attributes.tipo].length>=8' v-bind:class="{'tarea-paso':1, 'tarea-paso8':pasoPorTarea(tareaI, 8), label:1, 'label-primary': pasoPorTarea(tareaI, 8), 'label-default': !pasoPorTarea(tareaI, 8)}">8</span>
                                                                    
                                                                </div>
                                                                <div class="col-md-2 col-xs-5 project-user">
                                                                    <div v-for="u in usuariosAsignados(tareaI.relationships.usuarios)">
                                                                        <img class="avatar1em" v-bind:src="u.attributes.fotografia ? u.attributes.fotografia.url : '/images/slightly-smiling-face_1f642.png'">
                                                                        {{u.attributes.nombres+' '+u.attributes.apellidos}}
                                                                    </div>
                                                                </div>
                                                                <!-- td class="project-owner">
                                                                    <i class="fa fa-user-secret"></i> {{tareaI.relationships.creador.attributes.nombres+' '+tareaI.relationships.creador.attributes.apellidos}}
                                                                </td -->
                                                                <div class="col-md-1 col-xs-3 text-right project-priority">
                                                                    <span style="display: inline-block">
                                                                        <small>Prioridad</small><br>
                                                                        <span v-bind:class="{
                                                                                'label': true,
                                                                                'label-danger': tareaI.attributes.prioridad=='Alta',
                                                                                'label-warning': tareaI.attributes.prioridad=='Media',
                                                                                'label-primary': tareaI.attributes.prioridad=='Baja'
                                                                            }">{{tareaI.attributes.prioridad}}</span>
                                                                    </span>
                                                                </div>
                                                                <div class="col-md-3 col-xs-12 project-actions" style="padding-top: 0.5em">
                                                                    <span v-if="tareaI.attributes.dias_otorgados>=0" style="display: inline-block; float: left;">
                                                                        <div><peity v-bind:value="tareaI.attributes.dias_pasados" v-bind:total="tareaI.attributes.dias_otorgados"/></div>
                                                                        <small>{{tareaI.attributes.dias_otorgados ? Math.max(0, tareaI.attributes.dias_otorgados - tareaI.attributes.dias_pasados)+'d' : ''}}</small>
                                                                    </span>
                                                                    <a v-if="tareaI.relationships.creador.id==user.id" v-if="esUsuarioGerente()" href="javascript:void(0)" class="btn btn-white btn-sm" v-on:click='cancelarTarea(tareaI)'><i class="fa fa-times"></i> Cancelar </a>
                                                                    <a v-if="tareaI.relationships.creador.id==user.id" href="#asignarTarea" class="btn btn-white btn-sm" v-on:click='modificarTarea(tareaI)'><i class="fa fa-pencil"></i> Modificar </a>
                                                                    <a v-if="definicionPasos[tareaI.attributes.tipo].length>1" href="#detalleTarea" class="btn btn-white btn-sm" v-on:click='seleccionaTarea(tareaI)'><i class="fa fa-folder"></i> Abrir </a>
                                                                    <!-- a v-if="puedeRegistrarAvance(tareaI)" href="#registrarAvance" class="btn btn-white btn-sm" v-on:click='registrarAvanceTarea(tareaI)'><i class="fa fa-forward"></i> Avance </a -->
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <hr>
                                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        Visualizar detalle de tarea
                    -->
                    <carouselitem id="detalleTarea">
                      <seguimiento :definicion="definicionPasos[tarea.tipo]" :tarea="tarea" @salir="listarTareas" :readonly="esInvitado"></seguimiento>
                    </carouselitem>
                    <!--
                        Asignar una nueva tarea
                    -->
                    <carouselitem id="asignarTarea">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>Tarea</h5>
                                                <div class="ibox-tools">
                                                    <a href="#seguimientoDeTareas" class="btn btn-primary btn-xs" v-on:click='guardarTarea'>Guardar Tarea</a>
                                                    <a href="#seguimientoDeTareas" class="btn btn-default btn-xs pull-right">Volver</a>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <dl class="dl-horizontal">
                                                            <dt>Código:</dt> <dd v-show='!tarea.cod_tarea'>(se generará al guardar la tarea o al adjuntar un archivo)</dd>
                                                            <dd v-show='tarea.cod_tarea'>{{tarea.cod_tarea}}</dd>
                                                        </dl>
                                                        <dl class="dl-horizontal">
                                                            <dt>Tarea:</dt> <dd><input type="text" class="form-control" placeholder="tarea" v-model="tarea.nombre_tarea"></dd>
                                                        </dl>
                                                        <dl class="dl-horizontal">
                                                            <dt>Estado:</dt> <dd><span class="label label-primary">Pendiente</span></dd>
                                                        </dl>
                                                        <dl class="dl-horizontal">
                                                            <dt>Prioridad:</dt>
                                                            <dd>
                                                                <select class="form-control" placeholder="prioridad" v-model="tarea.prioridad">
                                                                    <option value="Baja">Baja</option>
                                                                    <option value="Media">Media</option>
                                                                    <option value="Alta">Alta</option>
                                                                </select>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <dl class="dl-horizontal">
                                                            <dt>Creado por:</dt> <dd>{{user.nombres + ' ' + user.apellidos}}</dd>
                                                        </dl>
                                                        <dl class="dl-horizontal">
                                                            <dt>Asignado a:</dt> <dd>
                                                                <div style="position:relative">
                                                                    <tags v-bind:model="tarea" v-bind:property="'usuarios'" v-bind:domain="users" v-bind:field="{textField:'nombres'}" />
                                                                </div>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <div class="col-lg-7" id="cluster_info">
                                                        <dl class="dl-horizontal">



                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="row" v-show="tarea.avance>0">
                                                    <div class="col-lg-12">
                                                        <dl class="dl-horizontal">
                                                            <dt>Avance % :</dt>
                                                            <dd>
                                                                <div class="progress progress-striped active m-b-sm">
                                                                    <div v-bind:style="{width: tarea.avance+'%'}" class="progress-bar progress-bar-warning"></div>
                                                                </div>
                                                                <small>
                                                                    El avance de la tarea es de <strong>{{tarea.avance}}%</strong>.
                                                                </small>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="row m-t-sm">
                                                    <div class="col-lg-12">
                                                        <div class="panel blank-panel">
                                                            <div class="panel-heading">
                                                                <div class="panel-options">
                                                                    <ul class="nav nav-tabs">
                                                                        <li class="active"><a href="#tab-1a" data-toggle="tab">Descripción</a></li>
                                                                        <li class=""><a href="#tab-2a" data-toggle="tab">Actividades</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body">

                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="tab-1a">
                                                                        <p>
                                                                            <textarea class="form-control" v-model="tarea.descripcion" placeholder="Descripción"></textarea>
                                                                        </p>
                                                                        <h5>Adjuntos</h5>
                                                                        <ul class="list-unstyled project-files">
                                                                            <li v-for="adjunto in tarea.adjuntos" v-if='adjunto.attributes.archivo'><a :href="adjunto.attributes.archivo?adjunto.attributes.archivo.url:''" target="_blank"><i class="fa fa-file"></i> {{adjunto.attributes.archivo?adjunto.attributes.archivo.name:''}}</a></li>
                                                                        </ul>
                                                                        <dv-form :model="Adjunto" v-on:custom="adjuntarArchivoNuevaTarea" buttons="Adjuntar"></dv-form>

                                                                    </div>
                                                                    <div class="tab-pane" id="tab-2a">

                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Avance</th>
                                                                                    <th>Numero de asignacion</th>
                                                                                    <th>Fecha y Hora</th>
                                                                                    <th>Usuario</th>
                                                                                    <th>Comentarios</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(avance,i) in avances">
                                                                                    <td>
                                                                                        <span class="label label-primary">{{Math.round(avance.attributes.avance_relativo)}}%</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        {{avance.relationships.asignacion ? avance.relationships.asignacion.attributes.nro_asignacion : ''}}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{avance.attributes.created_at}}
                                                                                    </td>
                                                                                    <td>
                                                                                        <p>
                                                                                            {{avance.relationships.usuario 
                                                                                                ? avance.relationships.usuario.attributes.nombres + ' ' + avance.relationships.usuario.attributes.apellidos
                                                                                                : ''}}
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p>
                                                                                            {{avance.attributes.descripcion}}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        Registrar avance de tarea
                    -->
                    <carouselitem id="registrarAvance">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="wrapper wrapper-content animated fadeInUp">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="m-b-md">
                                                        <a href="javascript:history.back()" class="btn btn-success btn-xs pull-right" v-on:click="guardarAvance">Guardar avance</a>
                                                        <a href="#seguimientoDeTareas" class="btn btn-default btn-xs pull-right">Volver</a>
                                                        <h2>{{tarea.nombre_tarea}}</h2>
                                                    </div>
                                                    <dl class="dl-horizontal">
                                                        <dt>Estado:</dt> <dd><span class="label label-primary">{{tarea.estado}}</span></dd>
                                                        <div style="height: 4px;"></div>
                                                        <dt>Prioridad:</dt>
                                                        <dd>
                                                            <p class="small font-bold">
                                                                <span><i v-bind:class="{'fa fa-circle':true, 'text-danger':tarea.prioridad=='Alta', 'text-warning':tarea.prioridad=='Media', 'text-primary':tarea.prioridad=='Baja'}"></i> {{tarea.prioridad}}</span>
                                                            </p>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <dl class="dl-horizontal">
                                                        <dt>Creado por:</dt> <dd>{{tarea.creador ? tarea.creador.attributes.nombres + ' ' + tarea.creador.attributes.apellidos : ''}}</dd>
                                                        <dt>Asignado a:</dt> <dd style="white-space: pre-line">{{tarea.usuarios && typeof tarea.usuarios.map==='function' ? usuariosAsignados(tarea.usuarios).map(function(u){return u.attributes.nombres+' '+u.attributes.apellidos}).join('\n') : ''}}</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-7" id="cluster_info">
                                                    <dl class="dl-horizontal">

                                                        <dt>Creación:</dt> <dd>{{tarea.created_at}}</dd>
                                                        <dt>Última actualización:</dt> <dd>{{tarea.updated_at}}</dd>
                                                        <dt>Tiempo asignado:</dt> <dd>{{tarea.dias_otorgados}} días</dd>
                                                        <dt>Tiempo restante:</dt> <dd>{{Math.max(0, tarea.dias_otorgados - tarea.dias_pasados)}} días</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <dl class="dl-horizontal">
                                                        <dt>Avance % :</dt>
                                                        <dd>
                                                            <input type="number" min="0" max="100" class="form-control" placeholder="avance" v-model="avance.avance">
                                                        </dd>
                                                    </dl>
                                                    <dl class="dl-horizontal">
                                                        <dt>Comentario de avance:</dt>
                                                        <dd>
                                                            <textarea class="form-control" v-model="avance.descripcion" placeholder="Descripción"></textarea>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="row m-t-sm">
                                                <div class="col-lg-12">
                                                    <div class="panel blank-panel">
                                                        <div class="panel-heading">
                                                            <div class="panel-options">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a href="#tab-1b" data-toggle="tab">Descripción</a></li>
                                                                    <li class=""><a href="#tab-2b" data-toggle="tab">Actividades</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="panel-body">

                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="tab-1b">
                                                                    <p>
                                                                        {{tarea.descripcion}}
                                                                    </p>
                                                                    <h5>Adjuntos</h5>
                                                                    <ul class="list-unstyled project-files">
                                                                        <li v-for="adjunto in tarea.adjuntos" v-if='adjunto.attributes.archivo'><a :href="adjunto.attributes.archivo?adjunto.attributes.archivo.url:''" target="_blank"><i class="fa fa-file"></i> {{adjunto.attributes.archivo?adjunto.attributes.archivo.name:''}}</a></li>
                                                                    </ul>
                                                                    <dv-form :model="Adjunto" v-on:custom="adjuntarArchivo" buttons="Adjuntar"></dv-form>
                                                                </div>
                                                                <div class="tab-pane" id="tab-2b">

                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Avance</th>
                                                                                    <th>Numero de asignacion</th>
                                                                                    <th>Fecha y Hora</th>
                                                                                    <th>Usuario</th>
                                                                                    <th>Comentarios</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(avance,i) in avances">
                                                                                    <td>
                                                                                        <span class="label label-primary">{{Math.round(avance.attributes.avance_relativo)}}%</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        {{avance.relationships.asignacion ? avance.relationships.asignacion.attributes.nro_asignacion : ''}}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{avance.attributes.created_at}}
                                                                                    </td>
                                                                                    <td>
                                                                                        <p>
                                                                                            {{avance.relationships.usuario 
                                                                                                ? avance.relationships.usuario.attributes.nombres + ' ' + avance.relationships.usuario.attributes.apellidos
                                                                                                : ''}}
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p>
                                                                                            {{avance.attributes.descripcion}}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <carouselitem id="informesDeAuditoriaYSeguimientos">
                        <div class="row">
                            <div class="col-lg-12">
                            </div>
                        </div>
                    </carouselitem>
                    <carouselitem id="PEIyPOA">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <br><br>
                                                <h3><a href="pei_scep.pdf" target="_blank"><i class="fa fa-file-pdf-o"></i> Plan Estrategico Institucional (PEI)</a></h3>
                                                <p>Objetivos del Plan Estratégicos Institucional “PEI” del MEFP y su Contribución ..... el MEFP.
                                                    Hacer un seguimiento y control al PEI y al POA con incidencia en la.</p>
                                                <br>
                                                <h3><a href="poa_scep.pdf" target="_blank"><i class="fa fa-file-pdf-o"></i> Plan Operativo Anual (POA)</a></h3>
                                                <p>Objetivos del Plan Estratégicos Institucional “PEI” del MEFP y su Contribución ..... el MEFP.
                                                    Hacer un seguimiento y control al PEI y al POA con incidencia en la.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <carouselitem id="cambio_password">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>CAMBIO DE CONTRASEÑA</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <p class="text-center">Introdusca en los siguientes campos su nueva contraseña:</p>
                                                        <form method="post" id="passwordForm">
                                                            <input type="password" class="input-lg form-control" v-model="password1" placeholder="Nueva contraseña" autocomplete="off">
                                                            <input type="password" class="input-lg form-control" v-model="password2" placeholder="Repetir la contraseña" autocomplete="off">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <span id="pwmatch" v-bind:class="{glyphicon:true, 'glyphicon-remove':password1!=password2 || password2=='', 'glyphicon-ok':password1==password2 && password2!=''}" v-bind:style="{color:password1!=password2 || password2==''?'#FF0004':'rgb(0, 164, 30)'}"></span> Contraseñas coinciden
                                                                </div>
                                                            </div>
                                                            <input type="button" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Cambiando contraseña..." value="Cambiar contraseña" v-on:click="cambiarPassword" v-bind:disabled="password1!=password2 || password2==''">
                                                        </form>
                                                    </div><!--/col-sm-6-->
                                                </div><!--/row-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                    <carouselitem id="hojas_de_trabajo">
                        <div class="row">
                            <div class="col-md-4" style="background: white; min-height: 100vh;" v-show="!auditoriaAbierta">
                                <h2>Seleccione el tipo de Auditoria </h2>
                                
                                <div style="padding-left:2em">
                                    <div v-for="tipo in tiposAuditoria" ><label> <input type="radio" v-bind:value="tipo.id" name="tipoAuditoria" v-model="tipoAuditoria"> &nbsp; {{tipo.name}}</label></div>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gestión:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control m-b" v-model="gestionAuditoria">
                                            <option v-for="gestion in gestiones" v-if="gestion>=2018" v-bind:value="gestion">{{gestion}}</option>
                                            <!--
                                            y que se guarde en un registro por cada gestion  en una pantalla aparte.
                                            El boton de CREAR es para un registro nuevo
                                            El boton de ABRIR es para buscar un tipo deauditoria por gestion, la pantalla siguiente se habilita un buscador.
                                            -->	
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" type="button" v-on:click="crearAuditoria">Crear</button>
                                        <button class="btn btn-white" type="button" v-on:click="abrirAuditoria">Abrir</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" v-show="!auditoriaAbierta" id="archivosAuditoria">
                                <div v-for="file in archivosAuditoria" class="file-box">
                                    <div class="file">
                                        <a v-on:click="abrirFileAudioria(file)">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                <i class="fa fa-file"></i>
                                            </div>
                                            <div class="file-name">
                                                {{file.attributes.titulo}}
                                                <br/>
                                                <small>{{file.attributes.created_at}}</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="background: white;" v-show="auditoriaAbierta">
                                <iframe id="editorAuditoria" v-bind:src="auditoriaUrl" style="width:100%;height:80vh;border:1px solid black;"></iframe>
                                <div class="form-group">
                                    <div>
                                        <input class="form-control" v-model="auditoriaFileName">
                                        <button class="btn btn-primary" type="button" v-on:click="recargarFileAuditoria">Recargar</button>
                                        <button class="btn btn-primary" type="button" v-on:click="guardarFileAuditoria">Guardar</button>
                                        <button class="btn btn-white" type="button" v-on:click="cerrarFileAuditoria">Cerrar</button>
                                    </div>
                                </div>		
                            </div>
                        </div>
                    </carouselitem>
                    <!--
                        Clasificacion de empresas
                    -->
                    <carouselitem id="ClasificacionEmpresas">
                        <div class="row wrapper border-bottom page-heading">
                            <div class="wrapper wrapper-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>CLASIFICACIÓN DE EMPRESAS</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow: auto;">
                                                    <abm id="abmClasificacionEmpresas" v-bind:model="clasificacionEmpresas" v-bind:editable="esAuxiliar" v-bind:toolbar='esAuxiliar?"new,search":"search"' buttons="close,save,delete"></abm>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ibox">
                                            <div class="ibox-title">
                                                <h5>FIDEICOMISOS</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <div style="overflow: auto;">
                                                    <abm id="abmFideicomisos" v-bind:model="fideicomisos" v-bind:editable="esAuxiliar" v-bind:toolbar='esAuxiliar?"new,search":"search"' buttons="close,save,delete"></abm>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carouselitem>
                </carousel>
              
              <div class="footer">
                <div>
                  <strong>Copyright</strong> subcep.com © 2017-2019. Site designed by <a href="mailto:angelitacc27@gmail.com">Angela Choque</a> <a href="https://wa.me/59173241591?text=Estoy%20interesado%20en%20el%20sistema%20subcep.com" target="_blank">(+591 73241591)</a>
                </div>
              </div>
            </div>
        </div>
      

        <!-- Mainly scripts -->
        <script src="../js/server.js?v0.173"></script>
        <script>
        $(document).ready(function () {
            var app;
            app = new Vue({
                el: '#wrapper',
                carousel: {},
                tareaAvance: 0,
                data: function () {
                    var self = this;
                    var gestiones = [];
                    for (var y=(new Date()).getFullYear(); y>=2015; y--) {
                        gestiones.push(y);
                    }
                    $.ajaxSetup({
                        async: false,
                    });
                    var userInstance = new UserAdministration.User("/api/UserAdministration/users", localStorage.user_id);
                    $.ajaxSetup({
                        async: true,
                    });
                    //userInstance.role_id=2;
                    return {
                        documento : {
                            pagina:1, numPages:0,
                            onload: function (numPages) {
                                self.documento.numPages = numPages;
                            }
                        },
                        trabajo : {
                            check : [],
                            check1 : 0,
                            //enlace1 : {texto:'', url:''},
                        },
                        user: userInstance,
                        usertarea: new UserAdministration.User(),
                        usuarios: new UserAdministration.User(),
                        users: [],
                        empresas: [],
                        empresa: new UserAdministration.Empresa(),
                        empresa_estado: new UserAdministration.EmpresaEstado(),
                        estado_financiero_aux: new UserAdministration.EstadoFinanciero(),
                        estado_financiero_adm: new UserAdministration.EstadoFinanciero(),
                        firma_auditoria: new UserAdministration.Firma(function(){return "/api/UserAdministration/firmas";}),
                        contratacion_directa: new UserAdministration.Contratacion(function(){return "/api/UserAdministration/contratacions";}),
                        //uai: new UserAdministration.Uai(function(){return "/api/UserAdministration/users/"+localStorage.user_id+"/uais";}),
                        uai: new UserAdministration.Uai(function(){return "/api/UserAdministration/uais";}),
                        tarea: new UserAdministration.Tarea(),
                        avance: new UserAdministration.Avance(function(){return app.tarea && app.tarea.id? ("/api/UserAdministration/tareas/"+app.tarea.id+"/avances") : "/api/UserAdministration/avances"}),
                        avances: [],
                        estados_financieros: [],
                        Adjunto: new UserAdministration.Adjunto(function(){return app.tarea && app.tarea.id? ("/api/UserAdministration/tareas/"+app.tarea.id+"/adjuntos") : "/api/UserAdministration/adjuntos"}),
                        PathItem: [],
                        busquedaTareas: '',
                        tareasTodas: [],
                        tareas: [],
                        empresaSeleccionada: "1",
                        empresaSeleccionadaId: "",
                        graficos:[],
                        //graficoModel: new UserAdministration.EmpresaGrafico(function(){return self.empresaSeleccionadaId? ("/api/UserAdministration/empresas/"+self.empresaSeleccionadaId+"/graficos") : "/api/UserAdministration/EmpresaGraficos"}),
                        empresaSeleccionadaGestion: '2017',
                        eeffEditable: [],
                        cuadro_financiero: new UserAdministration.CuadroFinanciero(),
                        cuadros_financieros: [],
                        cuadros_financieros_completo: [],
                        editingEmpresa: false,
                        carga_estado: new UserAdministration.CargaEstado,
                        password1: '',
                        password2: '',
                        cuadroSeleccionado: 1,
                        gestiones: gestiones,
                        hoja_trabajo : new UserAdministration.HojaTrabajo(),
                        eeffModo: 'graficos',
                        //Variables para hojas de auditoria
                        tiposAuditoria: [],
                        tipoAuditoria: '',
                        auditoriaUrl: 'about:blank',
                        auditoriaAbierta: false,
                        gestionAuditoria: new Date().getFullYear(),
                        archivosAuditoria: [],
                        auditoriaFileName: '',
                        fideicomisos: new UserAdministration.Fideicomiso(),
                        clasificacionEmpresas: new UserAdministration.ClasificacionEmpresa(),
                        uploadAdjEmpresa: '',
                        biblioteca_busqueda: '',
                        biblioteca_normativa: '',
                        biblioteca_gestion: '',
                        tipoTarea: 'EDC',
                        pasos: {
                            data: [
                                {fecha: '', descripcion: ''},
                                {fecha: '', descripcion: ''},
                                {fecha: '', descripcion: ''},
                                {fecha: '', descripcion: '', hojaTrabajo: {
                                    titulo : '',
                                    valores : {},
                                    gestion : '',
                                    templeta : '',
                                }},
                                {fecha: '', descripcion: ''},
                                {fecha: '', descripcion: '', anexo4: {
                                        titulo : '',
                                        valores : {},
                                        gestion : '',
                                        templeta : '',
                                    }},
                                {fecha: '', descripcion: ''},
                                {fecha: '', descripcion: ''},
                            ],
                            actual: 0,
                            subpaso4: 0,
                            maximo: 1,
                            listoParaRevision: false,
                        },
                        //pasosAuditoriaAbierta: false,
                        hojaTrabajoLocalSave: false,
                        definicionPasos: <?= json_encode(\App\Http\Controllers\VueEditorController::pasos ) ?>
                    };
                },
                computed: {
                    contratacionesDirectasToolbar: function () {
                        //return (this.esAdmin || this.esGerente || this.esAuxiliar) ? 'new,search' : 'search';
                        return (this.esAdmin || this.noEsDoctorMari()) ? 'new,search' : 'search';
                    },
                    esAdmin: function () {
                        return this.user.role_id==1;
                    },
                    esGerente: function () {
                        return this.user.role_id==1 || this.user.role_id==3;
                    },
                    esAuxiliar: function () {
                        return this.user.role_id==1 || this.user.role_id==4 || this.user_id==1;
                    },
                    esInvitado: function () {
                        return this.user.role_id==5;
                    },
                },
                methods: {
                    noEsDoctorMari: function () {
                        return this.user_id!=2 && this.user_id!=12;
                    },
                    savePasosTarea: function (api, value) {
                        console.log(value);
                        if (!value || !value.tarea || !value.tarea.id) {
                          return false;
                        }
                        if (!value || !value.datos) {
                          return false;
                        }
                        api.url='/api/UserAdministration/tareas/' + value.tarea.id;
                        api.data = {
                            datos: JSON.stringify(value.datos)
                        };
                        console.log(api);
                        return api;
                    },
                    loadPasosTarea: function (data) {
                        
                    },
                    avancePasosPorcentaje: function (tarea, definicion) {
                        if (!tarea.attributes.datos) {
                            return 0;
                        }
                        var pendiente=100, pendientes=0, avance=0;
                        definicion.forEach(function (def) {
                            if (def.porcentaje!==undefined) {
                                pendiente-=def.porcentaje;
                                pendientes++;
                            }
                        });
                        definicion.forEach(function (def) {
                            if (def.porcentaje===undefined) {
                                def.porcentaje =pendiente / pendientes;
                            }
                        });
                        definicion.forEach(function (def, i) {
                            //maximo o actual
                            if (i<tarea.attributes.datos.maximo) {
                                avance+=def.porcentaje;
                            }
                        });
                        return avance*1;
                    },
                    botonesDePasoActual: function () {
                        return this.definicionPasos[this.tarea.tipo] &&
                            this.definicionPasos[this.tarea.tipo][this.pasos.actual] ? 
                            this.definicionPasos[this.tarea.tipo][this.pasos.actual].buttons : [];
                    },
                    pasoPorTarea: function (tarea, paso) {
                        return tarea.attributes && tarea.attributes.datos
                            && tarea.attributes.datos.maximo && tarea.attributes.datos.maximo>=paso;
                    },
                    cargarPasosTarea: function () {
                        var self = this;
                        var merge = function (target, source, replace, name) {
                            if (target instanceof Array && replace) {
                                target.splice(0);
                                for (var i=0,l=source.length;i<l;i++) {
                                    target.push(source[i]);
                                }
                            } else if (target instanceof Array) {
                                for (var i=0,l=target.length;i<l;i++) {
                                    if (typeof target[i]==='object') {
                                        merge(target[i], source[i], false, i);
                                    } else {
                                        target[i] = source[i];
                                    }
                                }
                            } else if (target instanceof Object && replace) {
                                for (var a in source) {
                                    if (typeof target[a]==='object') {
                                        merge(target[a], source[a]);
                                    } else {
                                        target[a] = source[a];
                                    }
                                }
                            } else if (target instanceof Object) {
                                for (var a in target) {
                                    if (typeof source[a]!=='undefined') {
                                        if (typeof target[a]==='object') {
                                            merge(target[a], source[a], a==='valores', a);
                                        } else {
                                            target[a] = source[a];
                                        }
                                    }
                                }
                            }
                        }
                        if (self.tarea.datos) {
                            merge(self.pasos, self.tarea.datos);
                        } else {
                            merge(self.pasos, {
                                data: [
                                    {fecha: '', descripcion: ''},
                                    {fecha: '', descripcion: ''},
                                    {fecha: '', descripcion: ''},
                                    {fecha: '', descripcion: '', hojaTrabajo: {
                                        titulo : '',
                                        valores : {},
                                        gestion : '',
                                        templeta : '',
                                    }},
                                    {fecha: '', descripcion: ''},
                                    {fecha: '', descripcion: '', anexo4: {
                                        titulo : '',
                                        valores : {},
                                        gestion : '',
                                        templeta : '',
                                    }},
                                    {fecha: '', descripcion: ''},
                                    {fecha: '', descripcion: ''},
                                ],
                                actual: 0,
                                subpaso4: 0,
                                maximo: 1,
                                listoParaRevision: false,
                            });
                        }
                        if (!self.pasos.data[5]|| !self.pasos.data[5].anexo4) {
                            console.log('Falta anexo4 ', self.pasos.data[5]);
                        }
                    },
                    /**
                     * Este metodo es llamado desde el iframe de la templeta de auditoria
                     * @param object variables
                     */
                    variablesCargadas: function (variables) {
                        if (typeof this.pasos!=='undefined'
                            && typeof this.pasos.data!=='undefined'
                            && typeof this.pasos.data[3]!=='undefined'
                            && typeof this.pasos.data[3].hojaTrabajo!=='undefined'
                            && typeof this.pasos.data[3].hojaTrabajo.valores!=='undefined') {
                            var valores = this.pasos.data[3].hojaTrabajo.valores;
                            for(var a in valores) {
                                if (typeof valores[a]!=='function') {
                                    variables[a] = valores[a];
                                }
                            }
                        }
                    },
                    pasosRecargarFileAuditoria: function () {
                        this.recargarFileAuditoria();
                    },
                    pasosGuardarDB: function (callback) {
                        var self = this;
                        this.tarea.datos = JSON.parse(JSON.stringify(this.pasos));
                        this.tarea.$save('', function() {
                            if (typeof callback === 'function') {
                                callback();
                            }
                        }, true);
                    },
                    pasosGuardarFileAuditoria: function () {
                        var self = this;
                        var iframe = $("#pasosEditorAuditoria")[0];
                        var iframeWindow = iframe.contentWindow || iframe.contentDocument;
                        if (!iframeWindow.guardarHoja) {
                            return;
                        }
                        iframeWindow.guardarHoja(function (valores) {
                            self.pasos.data[3].hojaTrabajo.titulo = self.auditoriaFileName;
                            self.pasos.data[3].hojaTrabajo.valores = valores;
                            self.pasos.data[3].hojaTrabajo.gestion = self.gestionAuditoria;
                            self.pasos.data[3].hojaTrabajo.templeta = self.tipoAuditoria;
                            self.cerrarPasoAuditoria();
                            self.pasosGuardarDB();
                        });
                        self.cerrarPasoAuditoria();
                    },
                    pasosFileAuditoriaAutoSave: function (valores, tipoTarea, step, fileName) {
                        var self = this;
                        var def = self.definicionPasos[tipoTarea][step];
                        var templeta;
                        var hoja;
                        for(var titulo in def.buttons) {
                            if (fileName===titulo) {
                                templeta = def.buttons[titulo].template;
                                hoja = def.buttons[titulo].name;
                            }
                        };
                        if (!templeta) {
                            throw "No se pudo encontrar una templeta";
                        }
                        self.pasos.data[step][hoja].titulo = fileName;
                        self.pasos.data[step][hoja].valores = valores;
                        self.pasos.data[step][hoja].gestion = self.gestionAuditoria;
                        if (!self.pasos.data[step][hoja].templeta) {
                          self.pasos.data[step][hoja].templeta = templeta;
                        }
                        self.pasosGuardarDB(function () {
                        });
                    },
                    pasosCerrarFileAuditoria: function () {
                        this.cerrarFileAuditoria();
                        this.cerrarPasoAuditoria();
                    },
                    cerrarPasoAuditoria: function () {
                        this.pasos.subpaso4 = 0;
                    },
                    estaPasoAuditoriaAbierta: function () {
                        return this.pasos.subpaso4 === 1 && this.pasos.actual === 3;
                    },
                    /**
                     * Se activa cuando se le da click en el boton "Pasar a revision"
                     */
                    revisarHoja: function () {
                        this.pasos.listoParaRevision = true;
                        this.guardarPaso();
                    },
                    /**
                     * True si this.pasos.listoParaRevision !== true
                     */
                    pendienteRevision: function () {
                        return this.pasos.listoParaRevision !== true;
                    },
                    noPendienteRevision: function () {
                        return !this.pendienteRevision();
                    },
                    /**
                     * Se activa cuando se le da click en el boton "Volver a editar"
                     */
                    volverEdicionHoja: function () {
                        this.pasos.listoParaRevision = false;
                        this.pasos.actual--;
                        this.guardarPaso();
                    },
                    botonHabilitadoPaso: function (name, def, paso) {
                        var self = this;
                        if (def.condition) {
                            return this[def.condition]();
                        }
                        return true;
                    },
                    abrirPasoAuditoria: function (name, def, paso) {
                        var self = this;
                        var hoja = def.name;
                        if (def.action) {
                            return this[def.action]();
                        }
                        self.pasos.data[paso].template = def.template;
                        if (self.pasos.data[paso][hoja]===undefined) {
                            self.pasos.data[paso][hoja] = {
                                titulo : '',
                                valores : {},
                                gestion : '',
                                templeta : '',
                            };
                        }
                        if (self.pasos.data[paso][hoja].titulo) {
                            self.abrirPasoFileAuditoria(paso, def);
                        } else {
                            self.tipoAuditoria = def.template;
                            self.crearPasoAuditoria(name, def.template, paso);
                        }
                    },
                    crearPasoAuditoria: function (name, templete, paso) {
                        var self = this;
                        self.auditoriaFileName = name;
                        window.open(
                            "/vue-editor/tarea/" + templete + "/" + self.tarea.id + "/"
                            + paso + "/" + encodeURIComponent(name),
                            "editorF"
                        );
                    },
                    abrirPasoFileAuditoria: function (paso, def) {
                        var self = this;
                        var hoja = def.name;
                        self.tipoAuditoria = self.pasos.data[paso][hoja].templeta;
                        self.auditoriaUrl = '/vue-editor/file/' + self.tipoAuditoria;
                        self.auditoriaFileName = self.pasos.data[paso][hoja].titulo;
                        self.hoja_trabajo.titulo = self.pasos.data[paso][hoja].titulo;
                        self.hoja_trabajo.valores = self.pasos.data[paso][hoja].valores;
                        self.hoja_trabajo.gestion = self.pasos.data[paso][hoja].gestion;
                        self.hoja_trabajo.templeta = self.pasos.data[paso][hoja].templeta;
                        window.open(
                            "/vue-editor/tarea/" + self.pasos.data[paso][hoja].templeta
                            + "/" + self.tarea.id + "/" + paso
                            + "/" + encodeURIComponent(self.pasos.data[paso][hoja].titulo),
                            "editorF"
                        );
                    },
                    guardarPaso: function () {
                        if (this.pasos.actual===7) {
                            return;
                        }
                        this.pasos.actual++;
                        this.pasos.maximo = Math.max(this.pasos.maximo, this.pasos.actual+1);
                        this.pasosGuardarDB();
                    },
                    pasosTitulo: function (paso) {
                        try {
                            return this.definicionPasos[this.tipoTarea] ? this.definicionPasos[this.tipoTarea][paso].titulo : '';
                        } catch(e) {
                            return '';
                        }
                    },
                    setTipoTarea: function (tipoTarea) {
                        this.tipoTarea = tipoTarea;
                        this.listarTareas();
                    },
                    usuariosAsignados: function (tareaUsuarios) {
                        var usuarios = tareaUsuarios && tareaUsuarios instanceof Array ? tareaUsuarios : [];
                        var asignados = [];
                        usuarios.forEach(function (usuario) {
                            if(!asignados.find(function(u){return u.id===usuario.id;})) {
                                asignados.push(usuario);
                            }
                        });
                        return asignados;
                    },
                    puedeRegistrarAvance: function (tareaI) {
                        var usuarios = tareaI.relationships ? tareaI.relationships.usuarios : tareaI.usuarios;
                        var avance = tareaI.attributes ? tareaI.attributes.avance : tareaI.avance;
                        return usuarios
                            && this.perteneceA(usuarios, localStorage.user_id)
                            && avance<100;
                    },
                    perteneceA: function (usuarios, userId) {
                        return usuarios.find(function(item){return item.id==userId})!==undefined;
                    },
                    seleccionaEmpresa: function () {
                        window.location.hash = '#descripcionEmpresa';
                        $('#descripcionEmpresa')[0].scrollIntoView(true);
                    },
                    listarTareas: function () {
                        var self = this;
                        this.tarea.$select(
                            function (data) {
                                self.tareasTodas.splice(0);
                                data.data.forEach(function (row) {
                                    self.tareasTodas.push(row);
                                });
                                self.pintarTareas();
                            },
                            {
                                filter:[
                                    'where,tipo,'+JSON.stringify(self.tipoTarea),
                                    'whereUserAssigned,'+localStorage.user_id+','+localStorage.user_id,
                                ],
                                sort: '-updated_at'
                            }
                        );
                    },
                    loadListTo: function (from, to) {
                        var self = this;
                        to.splice(0);
                        from.$select(function (data) {
                            data.data.forEach(function (row) {
                                to.push(row);
                            });
                        });
                    },
                    listarEmpresas: function () {
                        var self = this;
                        self.empresas.splice(0);
                        self.empresa.$select(function (data) {
                            data.data.forEach(function (row) {
                                self.empresas.push(row);
                            });
                        },{
                            sort: "cod_empresa"
                        });
                    },
                    pintarTareas: function () {
                        var self = this;
                        self.tareas.splice(0);
                        var limit = 50;
                        self.tareasTodas.forEach(function (row) {
                            if (self.tareas.length>=limit) {
                                return;
                            }
                            if (self.busquedaTareas) {
                                for(var att in row.attributes) {
                                    var val = row.attributes[att];
                                    if (
                                        (val && typeof val.indexOf==='function' &&
                                        val.indexOf(self.busquedaTareas)!==-1) ||
                                        val==self.busquedaTareas
                                    ) {
                                        self.tareas.push(row);
                                        break;
                                    }
                                }
                            } else {
                                self.tareas.push(row);
                            }
                        });
                    },
                    cargarTarea: function (id, callback) {
                        var self = this;
                        self.tarea.$load(id, function () {
                            if (id) {
                                self.avance.$select(function (response) {
                                    self.avances.splice(0);
                                    response.data.forEach(function (a) {
                                        self.avances.push(a);
                                    });
                                    if (typeof callback==='function') {
                                        callback(self.tarea);
                                    }
                                }, {
                                    'sort': 'id'
                                });
                            }
                        });
                    },
                    seleccionaTarea: function (tarea) {
                        var self = this;
                        self.cargarTarea(tarea.id, function () {
                            self.cargarPasosTarea();
                        });
                    },
                    modificarTarea: function (tarea) {
                        var self = this;
                        self.cargarTarea(tarea.id, function () {
                            self.cargarPasosTarea();
                        });
                    },
                    cancelarTarea: function (tarea) {
                        var self = this;
                        var confirmacion = confirm(
                            '¿Confirma que desea cancelar la tarea: '
                            + tarea.attributes.cod_tarea + ', '
                            + tarea.attributes.nombre_tarea
                        );
                        if (confirmacion) {
                            self.cargarTarea(tarea.id, function () {
                                self.tarea.$delete('', function () {
                                    setTimeout(function() {self.listarTareas();}, 50);
                                });
                            });
                        }
                    },
                    crearTarea: function () {
                        this.cargarTarea(0);
                    },
                    guardarTarea: function (event, callback) {
                        var self = this;
                        self.tarea.creador = {id:localStorage.user_id};
                        this.tarea.$save('', function() {
                            self.listarTareas();
                            if (typeof callback==='function') {
                                callback(self.tarea);
                            }
                        });
                    },
                    crearAvance: function () {
                        var self = this;
                        var ultimaAsignacion = self.tarea.ultima_asignacion[localStorage.user_id];
                        self.avance.$load(0, function () {
                            var max=0;
                            self.avance.avance = 0;
                            self.avance.asignacion = {id: ultimaAsignacion};
                            self.avance.usuario = {id: localStorage.user_id};
                            //console.log(self.tarea.ultima_asignacion, ultimaAsignacion);
                            self.tarea.avances.forEach(function (avance) {
                                /*console.log({'usuario_abm_id': avance.attributes.usuario_abm_id,
                                    id: avance.id,
                                    asignacion_id: avance.attributes.asignacion_id,
                                    avance: avance.attributes.avance,
                                    max: max,
                                    a: avance.attributes.usuario_abm_id == localStorage.user_id,
                                    b: avance.id>max,
                                    c: avance.attributes.asignacion_id==ultimaAsignacion,
                                });*/
                                if (avance.attributes.usuario_abm_id == localStorage.user_id) {
                                    if (avance.id>max && avance.attributes.asignacion_id==ultimaAsignacion) {
                                        self.avance.avance = avance.attributes.avance;
                                        max = avance.id;
                                    }
                                }
                            });
                        });
                    },
                    guardarAvance: function () {
                        var self = this;
                        this.avance.tarea_id = this.tarea.id;
                        this.avance.$save('', function() {
                            self.listarTareas();
                            self.cargarTarea(self.tarea.id);
                        });
                    },
                    registrarAvanceTarea: function (tarea) {
                        var self = this;
                        self.cargarTarea(tarea.id, function () {
                            self.crearAvance();
                        });
                    },
                    adjuntarArchivo: function () {
                        var self = this;
                        this.Adjunto.$save('', function () {
                            self.Adjunto.$load(0);
                            self.cargarTarea(self.tarea.id);
                        });
                    },
                    adjuntarArchivoNuevaTarea: function () {
                        var self = this;
                        self.guardarTarea(null, function () {
                            self.Adjunto.$save('', function () {
                                self.Adjunto.$load(0);
                                self.cargarTarea(self.tarea.id);
                            });
                        });
                    },
                    abrirUAI: function () {
                        $("#abmUAI").get(0).__vue__.goto(0);
                    },
                    abrirFirmasDeAuditoria: function () {
                        $("#abmFirmasDeAuditoria").get(0).__vue__.goto(0);
                    },
                    abrirContratacionesDirectas: function () {
                        $("#abmContratacionesDirectas").get(0).__vue__.goto(0);
                    },
                    buscarTarea: function () {
                        this.pintarTareas();
                    },
                    cargarEstadosFinancieros: function () {
                        var self = this;
                        //indicators:
                        self.cargarCuadrosFinancieros();
                        //charts:
                        var model = new UserAdministration.EstadoFinanciero("/api/UserAdministration/estado_financieros");
                        model.$select(function (resultado) {
                            app.estados_financieros.splice(0);
                            resultado.data.forEach(function (row) {
                                app.estados_financieros.push(row);
                            });
                        },
                        {
                            'filter':[
                                'where,empresa_id,=,'+self.empresaSeleccionada,
                                'where,gestion,=,'+self.empresaSeleccionadaGestion,
                            ]
                        });
                    },
                    addCommas: function (nStr)
                    {
                        nStr += '';
                        x = nStr.split('.');
                        x1 = x[0];
                        x2 = x.length > 1 ? '.' + x[1] : '';
                        var rgx = /(\d+)(\d{3})/;
                        while (rgx.test(x1)) {
                            x1 = x1.replace(rgx, '$1' + ',' + '$2');
                        }
                        return x1 + x2;
                    },
                    /**
                     * Carga los cuadros de estados financieros.
                     *
                     */
                    cargarCuadrosFinancieros: function () {
                        var self = this;
                        var model = self.cuadro_financiero;
                        model.$select(function (resultado) {
                            app.cuadros_financieros.splice(0);
                            resultado.data.forEach(function (row) {
                                row.html = '';
                                var gestion = self.empresaSeleccionadaGestion;
                                gestion = Math.max(gestion, 2017);
                                self.cuadro_financiero.$methods.calculate(
                                    self.empresaSeleccionada,
                                    gestion,
                                    row.attributes.contenido,
                                    row.attributes.grafico,
                                    function (html) {
                                        row.html = html[0];
                                        row.presupuesto = html[1];
                                        if (!html[2]) {
                                            row.calculatedChart=[];
                                        } else {
                                            row.calculatedChart = JSON.parse(html[2]);
                                        }
                                        if (typeof row.calculatedChart.forEach!=='function') {
                                            row.calculatedChart=[];
                                        }
                                        Vue.nextTick(function () {
                                            document.getElementById('estadosFinancieros').__vue__.$children.forEach(function(comp) {
                                                try {
                                                    comp.refresh();
                                                } catch(ee){}
                                            });
                                        });
                                    }
                                );
                                app.cuadros_financieros.push(row);
                            });
                        },
                        {
                            sort: "id",
                            'filter':[
                                'where,id,=,'+self.cuadroSeleccionado,
                            ]
                        });
                    },
                    /**
                     * Carga los cuadros de estados financieros.
                     *
                     */
                    cargarCuadrosFinancierosCompleto: function () {
                        var self = this;
                        var model = self.cuadro_financiero;
                        model.$select(function (resultado) {
                            app.cuadros_financieros_completo.splice(0);
                            resultado.data.forEach(function (row) {
                                app.cuadros_financieros_completo.push(row);
                            });
                        },
                        {
                            sort: "id"
                        });
                    },
                    /**
                     * Habilita el modo edición de un estado financiero.
                     *
                     */
                    editEEFF: function (estado) {
                        var self=this;
                        self.eeffEditable.push(estado.id);
                    },
                    saveEEFF: function (estado) {
                        var self=this;
                        self.cuadro_financiero.$load(estado.id, function () {
                            self.cuadro_financiero.contenido = estado.attributes.contenido;
                            self.cuadro_financiero.$save();
                            estado.html = '';
                            self.cuadro_financiero.$methods.calculate(
                                self.empresaSeleccionada,
                                self.empresaSeleccionadaGestion,
                                estado.attributes.contenido,
                                function (html) {
                                    estado.html = html;
                                }
                            );
                            var i = self.eeffEditable.indexOf(estado.id);
                            self.eeffEditable.splice(i,1);
                        });
                    },
                    editableEEFF: function (estado) {
                        var self=this;
                        return self.eeffEditable.indexOf(estado.id)>-1;
                    },
                    /**
                     * Agrega un cuadro de estado financiero.
                     */
                    addCCFF: function () {
                        var self=this;
                        self.cuadro_financiero.$create(function(estado) {
                            estado.titulo = prompt('Nombre del cuadro');
                            estado.contenido = '<table width="100%"><tbody><tr><td style="background-color: #a4a5d5; color: white;" rowspan="2"><h1 style="text-align: center;">{{$uc(\'1\')}}</h1><p style="text-align: center;">ACTIVO</p></td><td style="background-color: #d14550; color: white;"><h2 style="text-align: center;">{{$uc(\'2\')}}</h2><p style="text-align: center;">PASIVO</p></td></tr><tr><td style="background-color: #19a3ab; color: white;"><h2 style="text-align: center;">{{$uc(\'3\')}}</h2><p style="text-align: center;">PATRIMONIO</p></td></tr></tbody></table>';
                            estado.$save('', function() {
                                self.cargarCuadrosFinancieros();
                            });
                        });
                    },
                    editEmpresa: function () {
                        var self = this;
                        var s = self.empresa.detalle_empresa;
                        self.empresa.detalle_empresa = '';
                        Vue.nextTick(function () {
                            self.empresa.detalle_empresa = s;
                        });
                        self.editingEmpresa = true;
                    },
                    saveEmpresa: function (empresa) {
                        var self = this;
                        self.editingEmpresa = false;
                        empresa.$save();
                    },
                    cancelEmpresa: function (empresa) {
                        var self = this;
                        self.editingEmpresa = false;
                        empresa.$load(empresa.id);
                    },
                    /**
                     * Cambia la contraseña deñ usuario actual.
                     */
                    cambiarPassword: function () {
                        var self = this;
                        self.user.password=self.password1;
                        self.user.$save();
                        window.location.href="login.html";
                    },
                    esUsuarioGerente: function () {
                        return this.user.role_id==1 || this.user.role_id==3;
                    },
                    esUsuarioAuxiliar: function () {
                        return this.user.role_id==1 || this.user.role_id==4;
                    },
                    estadosAdjuntos: function (estadosFinancieros, cuadroSeleccionado) {
                        var self = this;
                        var docs = {};
                        var cuadro = self.cuadros_financieros_completo.find(function (cf) {
                            return cf.id === cuadroSeleccionado;
                        });
                        estadosFinancieros.forEach(function (estado) {
                            var color, icon, type;
                            switch (estado.attributes.archivo.mime) {
                                case 'application/pdf':
                                    icon = 'fa fa-file-pdf-o';
                                    color = 'rgb(226, 31, 52)';
                                    type = 'pdf';
                                    break;
                                case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                                case 'application/vnd.ms-excel':
                                default:
                                    type = 'excel';
                                    icon = 'fa fa-file-excel-o';
                                    color = 'rgb(0, 177, 15)';
                            }
                            if (docs[estado.attributes.tipo_estado_financiero]===undefined) {
                                docs[estado.attributes.tipo_estado_financiero]={};
                            }
                            docs[estado.attributes.tipo_estado_financiero][type] = {
                                href: estado.attributes.archivo.url,
                                color: color,
                                icon: icon,
                                name: estado.attributes.tipo_estado_financiero
                            };
                        });
                        var links = [];
                        for(var name in docs) {
                            links.push({pdf:docs[name].pdf,excel:docs[name].excel});
                        }
                        return links;
                    },
                    /**
                     * 
                     * @param {type} url
                     * @param {type} text
                     * @param {type} bind
                     * @returns {undefined}Carga una lista de forma generica
                     */
                    loadList: function (url, bind) {
                        var cacheId = 'cacheList_' + url;
                        var cache = window.localStorage[cacheId];
                        if (cache) {
                            bind.splice(0);
                            try {
                                JSON.parse(cache).forEach(function (row){
                                    bind.push(row);
                                });
                            } catch(e) {
                                console.log({cacheId:e});
                            }
                        }
                        $.ajax({
                            url: url,
                            method: 'get',
                            dataType: 'json',
                            success: function (res) {
                                bind.splice(0);
                                res.forEach(function (row) {
                                    bind.push(row);
                                });
                                window.localStorage[cacheId] = JSON.stringify(bind);
                            }
                        });
                    },
                    crearAuditoria: function () {
                        var self = this;
                        this.auditoriaUrl = '/vue-editor/file/' + this.tipoAuditoria;
                        this.auditoriaFileName = 'Nuevo documento';
                        self.hoja_trabajo.$load(0, function () {
                            self.auditoriaAbierta = true;
                        });
                    },
                    abrirAuditoria: function () {
                        this.cargarArchivosAuditoria(this.gestionAuditoria, this.tipoAuditoria);
                    },
                    cargarArchivosAuditoria: function (gestion, templeta) {
                        var self = this;
                        self.archivosAuditoria.splice(0);
                        $.ajax({
                            url: '/api/UserAdministration/hojaTrabajos?filter[]=where,gestion,'
                                + encodeURIComponent(gestion)
                                + '&filter[]=where,templeta,'
                                + encodeURIComponent(JSON.stringify(templeta)),
                            method: 'get',
                            dataType: 'json',
                            success: function (res) {
                                res.data.forEach(function (row) {
                                    self.archivosAuditoria.push(row);
                                });
                                Vue.nextTick(function () {
                                    $('#archivosAuditoria .file-box').each(function() {
                                        animationHover(this, 'pulse');
                                    });
                                });
                            }
                        });
                    },
                    abrirFileAudioria: function (file) {
                        var self = this;
                        self.auditoriaFileName = file.attributes.titulo;
                        self.auditoriaUrl = '/vue-editor/file/' + self.tipoAuditoria + '/' + file.id;
                        self.hoja_trabajo.$load(file.id, function () {
                            self.auditoriaAbierta = true;
                        });
                    },
                    cerrarFileAuditoria: function () {
                        this.auditoriaUrl = 'about:blank';
                        this.auditoriaAbierta = false;
                    },
                    recargarFileAuditoria: function () {
                        var iframe = document.getElementById('editorAuditoria');
                        iframe.src = iframe.src;
                    },
                    guardarFileAuditoria: function () {
                        var self = this;
                        var iframe = $("#editorAuditoria")[0];
                        var iframeWindow = iframe.contentWindow || iframe.contentDocument;
                        if (!iframeWindow.guardarHoja) {
                            return;
                        }
                        iframeWindow.guardarHoja(function (valores) {
                            self.hoja_trabajo.titulo = self.auditoriaFileName;
                            self.hoja_trabajo.valores = valores;
                            self.hoja_trabajo.gestion = self.gestionAuditoria;
                            self.hoja_trabajo.templeta = self.tipoAuditoria;
                            self.hoja_trabajo.$save('', function () {
                                self.abrirAuditoria();
                                self.cerrarFileAuditoria();
                            });
                        });
                    },
                    mostrarUploadLink: function (file) {
                        prompt('Archivo cargado', file.url);
                    }
                },
                watch: {
                    tipoAuditoria: function () {
                        this.abrirAuditoria();
                    }
                },
                mounted: function () {
                    var self = this;
                    this.carousel = this.$children[0];
                    $("#now_loading").hide();
                    $(this.$el).css("visibility", "visible");
                    var hash0 = location.hash;
                    location.hash = '';
                    location.hash = hash0;
                    this.listarTareas();
                    this.listarEmpresas();
                    this.cargarEstadosFinancieros();
                    this.cargarCuadrosFinancieros();
                    this.cargarCuadrosFinancierosCompleto();
                    this.loadListTo(this.usertarea, this.users);
                    //this.hoja_trabajo.$load(0);
                    this.loadList('/vue-editor/list/Hojas%20de%20Trabajo', this.tiposAuditoria);
                }
            });
            window.app = app;
            $(window).on('hashchange', function() {
                $("body").removeClass("mini-navbar");
            });
            HashRoute.route('#estadosFinancieros/{empresa}', function (empresa) {
                window.app.empresaSeleccionada = empresa;
                var $parent = $('#estadosFinancieros').parent();
                $parent.slider('#estadosFinancieros');
            });
        });
        $.ajaxSetup({
            headers: {
              'Authorization': "Basic " + localStorage.user_id
            }
        });
        </script>
        <!-- Peity -->
        <script src="js/plugins/peity/jquery.peity.min.js"></script>

        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="js/inspinia.js"></script>
    </body>
</html>
