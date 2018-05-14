<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hoja de Ruta</title>
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/moment/min/moment.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
        <script src="bower_components/chart.js/dist/Chart.min.js"></script>
        <script src="bower_components/vue/dist/vue.min.js"></script>
        <script src="bower_components/moment/min/moment-with-locales.min.js"></script>
        <script src="/documentacion/js/plugins/peity/jquery.peity.min.js"></script>
        <script src="/js/export-excel.js"></script>
        <style>
        @media print{
           .noprint{
               display:none;
           }
        }
        .btn-ligth_green{
            background-color: #5cb85c;
            color:white;
            border-color: rgb(76, 174, 76);
        }
        .btn-pink{
            background-color: #de5f5b;
            color:white;
            border-color: #ac3b37;
        }
        .btn-success{
            background-color: #428442;
        }
        </style>
        <link rel="shortcut icon" href="/HojaRuta/images/logo1.png">
    </head>
    <body>
        <div id ="wrapper" class="container" style="padding-top:80px;">
            <div class="navbar navbar-default navbar-fixed-top navbar-custom affix-top">
                <div class="col-md-1">
                    <img src="images/logo1.png" style="height:48px">
                </div>
                <!--
                  Botones principales
                -->
                <div class="col-md-11" style="padding-top: 8px;padding-bottom: 8px;">
                    <div class="btn-group" v-if="!window.isManager">
                        <a href="#recepcion" class="btn btn-primary" v-on:click='nuevaExterna'>Hoja de ruta externa</a>

                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span> <!-- caret -->
                            <span class="sr-only">Hoja de ruta externa</span>
                        </button>

                        <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                            <li><a href="#recepcion" v-on:click='nuevaExterna' v-if="!window.isManager">Registrar</a></li>
                            <li><a href="#busqueda" v-on:click='filtroTipo="externa";filtrar()'>Búsqueda</a></li>
                            <li><a href="#reporte_hoja_ruta" v-on:click="initReporte('externa')">Reporte</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" v-if="!window.isManager">
                        <a href="#recepcion" class="btn btn-danger btn-pink" v-on:click='nuevaInterna'>Hoja de ruta interna</a>

                        <button type="button" class="btn btn-danger btn-pink dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span> <!-- caret -->
                            <span class="sr-only">Hoja de ruta interna</span>
                        </button>

                        <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                            <li><a href="#recepcion" v-on:click='nuevaInterna' v-if="!window.isManager">Registrar</a></li>
                            <li><a href="#busqueda" v-on:click='filtroTipo="interna";filtrar()'>Búsqueda</a></li>
                            <li><a href="#reporte_hoja_ruta" v-on:click="initReporte('interna')">Reporte</a></li>
                        </ul>
                    </div>
                    <a href='#busqueda' class='btn btn-info' v-if="window.isManager">Dashboard</a>
                    <div class="btn-group">
                        <a href="#nota_oficio" class="btn btn-success" v-on:click='nuevaNota' v-if="!window.isManager">Notas oficio</a>

                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span> <!-- caret -->
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>

                        <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                            <li><a href="#nota_oficio" v-on:click='nuevaNota' v-if="!window.isManager">Registrar</a></li>
                            <li><a href="#nota_busqueda">Búsqueda</a></li>
                            <li><a href="#nota_reporte">Reporte</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="#com_interna" class="btn btn-ligth_green" v-on:click='nuevaNota' v-if="!window.isManager">Comunicación Interna</a>

                        <button type="button" class="btn btn-ligth_green dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span> <!-- caret -->
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>

                        <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                            <li><a href="#com_interna" v-on:click='nuevaComunicacion' v-if="!window.isManager">Registrar</a></li>
                            <li><a href="#com_busqueda">Búsqueda</a></li>
                            <li><a href="#reporte_com">Reporte</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-10" v-if="menu=='recepcion'">
                    <form class="form-horizontal" v-on:submit.prevent="generar">
                        <fieldset>
                            <legend>Hoja de ruta - SCEP <b># {{hoja.numero}}</b></legend>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Tipo</label>
                                <!--div class="col-lg-8">
                                    <div class="radio">
                                      <label><input type="radio" name="optradio" value="interna" v-model="hoja.tipo">Interna</label>
                                    </div>
                                    <div class="radio">
                                      <label><input type="radio" name="optradio" value="externa" v-model="hoja.tipo">Externa</label>
                                    </div>
                                </div-->
                                <div class="col-lg-10">
                                    <div class="radio" style="text-transform: uppercase">
                                      <label>{{hoja.tipo}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de recepción</label>
                                <div class="col-lg-10">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input required type='text' readonly="readonly" v-model="hoja.fecha" class="form-control" />
                                            <span class="input-group-addon" v-on:click='datepick'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Referencia</label>
                                <div class="col-lg-10">
                                    <textarea required class="form-control" v-model="hoja.referencia" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Procedencia</label>
                                <div class="col-lg-10">
                                    <input required="required" type="text" v-model="hoja.procedencia" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº de control</label>
                                <div class="col-lg-10">
                                    <input required type="number" step="any" v-model="hoja.nroDeControl" class="form-control" placeholder="" v-on:blur="validarNroControl(hoja.nroDeControl)">
                                    <p class="text-danger" v-if="errores.nro_control_dup"><small>{{errores.nro_control_msg}}</small></p>
                                    <p class="text-success" v-if="!errores.nro_control_dup && errores.nro_control_msg"><small><i class="glyphicon glyphicon-check"></i></small></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Anexo hojas</label>
                                <div class="col-sm-1">
                                    <input type="text" v-model="hoja.anexoHojas_fjs" class="form-control" placeholder="">
                                    fjs
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" v-model="hoja.anexoHojas_arch" class="form-control" placeholder="">
                                    arch
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" v-model="hoja.anexoHojas_ani" class="form-control" placeholder="">
                                    anillados
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" v-model="hoja.anexoHojas_leg" class="form-control" placeholder="">
                                    legajo
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" v-model="hoja.anexoHojas_eje" class="form-control" placeholder="">
                                    ejemplar
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" v-model="hoja.anexoHojas_eng" class="form-control" placeholder="">
                                    engrapdo
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" v-model="hoja.anexoHojas_cd" class="form-control" placeholder="">
                                    cd
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Destinatario</label>
                                <div class="col-lg-10">
                                    <div class="btn-group btn-block">
                                        <input required type="text" v-model="hoja.destinatario" class="form-control dropdown-toggle" data-toggle="dropdown" placeholder="">
                                        <ul class="dropdown-menu">
                                            <li v-for="dest in destinatarios" v-on:click="hoja.destinatario=dest.attributes.nombres+' '+dest.attributes.apellidos" v-if="(dest.attributes.nombres+' '+dest.attributes.apellidos).toLowerCase().indexOf(hoja.destinatario.toLowerCase())>-1"><a href="javascript:void(0)">{{dest.attributes.nombres}} {{dest.attributes.apellidos}}</a></li>
                                        </ul>
                                    </div>
                                <!-- tags v-bind:model="hoja" v-bind:property="'destinatario'" v-bind:domain="destinatarios" v-bind:field="{textField:'nombres'}" / -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tipo
                                    <p class="text-danger" v-if="errores.hoja_tipo">Seleccione un tipo</p>
                                </label>
                                <div v-bind:class="{'col-md-5':1, 'has-error':errores.hoja_tipo}">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="EDC" v-model="hoja.tipoTarea">
                                            1. Evaluación de consistencia
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="AUD" v-model="hoja.tipoTarea">
                                            2. Auditorías
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="SUP" v-model="hoja.tipoTarea">
                                            3. Supervisiones
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="RDI" v-model="hoja.tipoTarea">
                                            4. Relevamientos de Información
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="COD" v-model="hoja.tipoTarea">
                                            5. Contrataciones Directas
                                        </label>
                                    </div>
                                </div>
                                <div v-bind:class="{'col-md-5':1, 'has-error':errores.hoja_tipo}">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="EIU" v-model="hoja.tipoTarea">
                                            6. Evaluación de Informes de UAI's
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="EIP" v-model="hoja.tipoTarea">
                                            7. Evaluación de Informes de POA y PE de UAI
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="SYD" v-model="hoja.tipoTarea">
                                            8. Solicitudes y denuncias
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="TAD" v-model="hoja.tipoTarea">
                                            9. Tareas administrativas
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="OTR" v-model="hoja.tipoTarea">
                                            10. Otros
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!--
                    Botón: Notas oficio
                    Nota expedida y Nota recibida
                tabla:
                    N hoja deruta
                   N nota SGE
                entidad
                referencia
                dias otorgados
                -->
                <div class="col-md-10" v-if="menu=='nota_oficio'">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Oficio</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº Hoja de Ruta</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.hoja_de_ruta" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de emisión</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='notaExternaFechaEnvio'>
                                            <input type='text' v-model="nota.fecha_emision" class="form-control" />
                                            <span class="input-group-addon" v-on:click='notaExternaFechaEnvioPick'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº NOTA CGE/SCEP</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.nro_nota" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Reiterativa</label>
                                <div class="col-lg-10">
                                    <select class="form-control" v-model="nota.reiterativa">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de entrega</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='notaExternaFechaEntrega'>
                                            <input type='text' v-model="nota.fecha_entrega" class="form-control" />
                                            <span class="input-group-addon" v-on:click='notaExternaFechaEntrega'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Entidad o Empresa</label>
                                <div class="col-lg-10">
                                    <input type="text" name="entidad_empresa" v-model="nota.entidad_empresa" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre y apellidos</label>
                                <div class="col-lg-10">
                                    <input type="text" name="nombre_apellidos" v-model="nota.nombre_apellidos" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cargo</label>
                                <div class="col-lg-10">
                                    <input type="text" name="cargo" v-model="nota.cargo" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Referencia</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" v-model="nota.referencia" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Días otorgados para respuesta</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.dias" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Días de retraso</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.retraso" class="form-control" placeholder="">
                                </div>
                            </div>
                            <legend>Nota Recibida</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº Hoja de Ruta</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.hoja_de_ruta_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de recepción</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='notaExternaFechaRecepcion'>
                                            <input type='text' v-model="nota.fecha_recepcion" class="form-control" />
                                            <span class="input-group-addon" v-on:click='notaExternaFechaRecepcion'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº NOTA</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.nro_nota_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Remitente</label>
                                <div class="col-lg-10">
                                    <input type="text" name="remitente" v-model="nota.remitente_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Asunto o Referencia</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" v-model="nota.referencia_recepcion" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Fojas/ Arch./ Anillados/ Legajos/ Otros</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.fojas_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" v-on:click="generarNota" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!--
                    Botón: Comunicación Interna
                    
                -->
                <div class="col-md-10" v-if="menu=='com_interna'">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Comunicación Interna</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº Hoja de Ruta</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.hoja_de_ruta" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de emisión</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='notaExternaFechaEnvio'>
                                            <input type='text' v-model="nota.fecha_emision" class="form-control" />
                                            <span class="input-group-addon" v-on:click='notaExternaFechaEnvioPick'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº NOTA CGE/SCEP</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.nro_nota" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Reiterativa</label>
                                <div class="col-lg-10">
                                    <select class="form-control" v-model="nota.reiterativa">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de entrega</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='notaExternaFechaEntrega'>
                                            <input type='text' v-model="nota.fecha_entrega" class="form-control" />
                                            <span class="input-group-addon" v-on:click='notaExternaFechaEntrega'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Entidad o Empresa</label>
                                <div class="col-lg-10">
                                    <input type="text" name="entidad_empresa" v-model="nota.entidad_empresa" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nombre y apellidos</label>
                                <div class="col-lg-10">
                                    <input type="text" name="nombre_apellidos" v-model="nota.nombre_apellidos" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cargo</label>
                                <div class="col-lg-10">
                                    <input type="text" name="cargo" v-model="nota.cargo" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Referencia</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" v-model="nota.referencia" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Días otorgados para respuesta</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.dias" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Días de retraso</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.retraso" class="form-control" placeholder="">
                                </div>
                            </div>
                            <legend>Nota Recibida</legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº Hoja de Ruta</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.hoja_de_ruta_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de recepción</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='notaExternaFechaRecepcion'>
                                            <input type='text' v-model="nota.fecha_recepcion" class="form-control" />
                                            <span class="input-group-addon" v-on:click='notaExternaFechaRecepcion'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº NOTA</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.nro_nota_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Remitente</label>
                                <div class="col-lg-10">
                                    <input type="text" name="remitente" v-model="nota.remitente_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Asunto o Referencia</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" v-model="nota.referencia_recepcion" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Fojas/ Arch./ Anillados/ Legajos/ Otros</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="nota.fojas_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" v-on:click="generarComunicacion" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-10" v-if="menu=='editar'">
                    <form class="form-horizontal" v-if="!window.isManager">
                        <fieldset>
                            <legend>Hoja de ruta - SCEP <b># {{hoja.numero}}</b></legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tipo</label>
                                <div class="col-lg-10">
                                    <input type="text" disabled="disabled" v-model="hoja.tipo" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha</label>
                                <div class="col-lg-10">
                                    <div class='input-group date'>
                                        <fecha v-model="hoja.fecha"></fecha>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" disabled="disabled" class="col-lg-2 control-label">Referencia</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" disabled1="disabled" v-model="hoja.referencia" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Procedencia</label>
                                <div class="col-lg-10">
                                    <input type="text" disabled1="disabled" v-model="hoja.procedencia" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº de control</label>
                                <div class="col-lg-10">
                                    <input type="text" disabled1="disabled" v-model="hoja.nroDeControl" class="form-control" placeholder="" v-on:blur="validarNroControl(hoja.nroDeControl)">
                                    <p class="text-danger" v-if="errores.nro_control_dup"><small>{{errores.nro_control_msg}}</small></p>
                                    <p class="text-success" v-if="!errores.nro_control_dup && errores.nro_control_msg"><small><i class="glyphicon glyphicon-check"></i></small></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Anexo hojas</label>
                                <div class="col-lg-10">
                                    <input type="text" disabled1="disabled" v-model="hoja.anexoHojas" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Destinatario</label>
                                <div class="col-lg-10">
                                    <div class="btn-group btn-block">
                                        <input type="text" v-model="hoja.destinatario" class="form-control dropdown-toggle" data-toggle="dropdown" placeholder="">
                                        <ul class="dropdown-menu">
                                            <li v-for="dest in destinatarios" v-on:click="hoja.destinatario=dest.attributes.nombres+' '+dest.attributes.apellidos" v-if="(dest.attributes.nombres+' '+dest.attributes.apellidos).toLowerCase().indexOf(hoja.destinatario.toLowerCase())>-1"><a href="javascript:void(0)">{{dest.attributes.nombres}} {{dest.attributes.apellidos}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tipo
                                    <p class="text-danger" v-if="errores.hoja_tipo">Seleccione un tipo</p>
                                </label>
                                <div v-bind:class="{'col-md-5':1, 'has-error':errores.hoja_tipo}">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="EDC" v-model="hoja.tipoTarea">
                                            1. Evaluación de consistencia
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="AUD" v-model="hoja.tipoTarea">
                                            2. Auditorías
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="SUP" v-model="hoja.tipoTarea">
                                            3. Supervisiones
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="RDI" v-model="hoja.tipoTarea">
                                            4. Relevamientos de Información
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="COD" v-model="hoja.tipoTarea">
                                            5. Contrataciones Directas
                                        </label>
                                    </div>
                                </div>
                                <div v-bind:class="{'col-md-5':1, 'has-error':errores.hoja_tipo}">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="EIU" v-model="hoja.tipoTarea">
                                            6. Evaluación de Informes de UAI's
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="EIP" v-model="hoja.tipoTarea">
                                            7. Evaluación de Informes de POA y PE de UAI
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="SYD" v-model="hoja.tipoTarea">
                                            8. Solicitudes y denuncias
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="TAD" v-model="hoja.tipoTarea">
                                            9. Tareas administrativas
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="hoja_edit_tipo" value="OTR" v-model="hoja.tipoTarea">
                                            10. Otros
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" v-on:click="actualizarHR" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                            <div v-if="!concluido()">
                            <h2>Derivaciones</h2>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Fecha</label>
                                <div class="col-lg-10">
                                    <div v-bind:class='{"input-group":1, "date":1, "has-error": errores.derivacion_fecha}' id='datetimepicker3'>
                                        <input type='text' :disabled="concluido()" readonly="readonly" v-model="derivacion.fecha" class="form-control" />
                                        <span class="input-group-addon" v-on:click='datepick3'>
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Comentarios</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" :disabled="concluido()" v-model="derivacion.comentarios" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Destinatario</label>
                                <div class="col-lg-10">
                                    <div v-bind:class='{"has-error": errores.derivacion_destinatarios}'>
                                        <tags v-model="derivacion.destinatarios" v-bind:domain="destinatarios" v-bind:field="{textField:function(item){return item.nombres+' '+item.apellidos}}" v-on:change="sincronizaDestinatario"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Instrucción</label>
                                <div class="col-lg-10">
                                    <input type="text" :disabled="concluido()" v-model="derivacion.instruccion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Días plazo</label>
                                <div class="col-lg-10">
                                    <div class="btn-group btn-block">
                                        <input type="number" v-model="derivacion.dias_plazo" class="form-control dropdown-toggle" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" :disabled="concluido()" v-on:click="saveDerivation(derivacion)" class="btn btn-primary">Registrar</button>
                                    <button type="button" :disabled="concluido()" v-on:click="terminarHoja" class="btn btn-warning">Terminar</button>
                                </div>
                            </div>
                            </div>
                        </fieldset>
                    </form>
                    <input class="form-control" v-model='filtroDerivacion' placeholder="busqueda aaa" v-on:keyup='filtrarDerivacion'>
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Destinatario</th>
                                <th>Comentarios</th>
                                <th>Instrucción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='derivacion in derivaciones'>
                                <td v-if="!derivacion.editable">{{derivacion.fecha}}</td>
                                <td v-if="!derivacion.editable" style="white-space: pre">{{derivacion.destinatario}}</td>
                                <td v-if="!derivacion.editable">{{derivacion.comentarios}}</td>
                                <td v-if="!derivacion.editable">{{derivacion.instruccion}}</td>
                                <td v-if="derivacion.editable"><input type="text" v-model="derivacion.fecha" class="form-control"></td>
                                <td v-if="derivacion.editable"><input type="text" v-model="derivacion.destinatario" class="form-control"></td>
                                <td v-if="derivacion.editable"><textarea class="form-control" v-model="derivacion.comentarios" class="form-control"></textarea></td>
                                <td v-if="derivacion.editable"><input type="text" v-model="derivacion.instruccion" class="form-control"></td>
                                <td>
                                    <a v-if="!derivacion.editable" href='javascript:void(0)' class='btn btn-default glyphicon glyphicon-pencil' v-on:click='derivacion.editable=true;'></a>
                                    <a v-if="derivacion.editable" href='javascript:void(0)' class='btn btn-primary glyphicon glyphicon-floppy-disk' v-on:click='derivacion.editable=false;saveDerivation(null, derivacion);'></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-10" v-if="menu=='hoja'">
                    <p><img src="http://subcep.com/images/logoCGE.png?1" width="212" height="64" /></p>
                    <p align="center" style="font-size: 18px;"><b>HOJA DE RUTA</b></p>
                    <p align="center" style="font-size: 18px;"></p>
                    <table border="0" style="font-size: 12px; width: 748px; height: 127px;">
                    <tbody style="font-size: 12px;">
                    <tr style="font-size: 12px;">
                    <td style="font-size: 12px;">REFERENCIA: &nbsp;&nbsp;</td>
                    <td style="font-size: 12px;" colspan="5"><b>&nbsp;</b>{{hoja.referencia}}</td>
                    </tr>
                    <tr style="font-size: 12px;">
                    <td style="font-size: 12px;">PROCEDENCIA:</td>
                    <td style="font-size: 12px;" colspan="5">{{hoja.procedencia}}</td>
                    </tr>
                    <tr style="font-size: 12px;">
                    <td style="font-size: 12px;">N&ordm; DE CONTROL:</td>
                    <td style="font-size: 12px;">{{hoja.nroDeControl}}</td>
                    <td align="right" style="font-size: 12px;">FECHA:</td>
                    <td style="font-size: 12px;">
                        <span style='display:inline-block;'>{{dia(hoja.fecha)}}</span>
                        <span style='display:inline-block;'>{{mes(hoja.fecha)}}</span>
                        <span style='display:inline-block;'>{{anio(hoja.fecha)}}</span>
                    </td>
                    <td style="font-size: 12px;">ANEXO HOJAS:</td>
                    <td style="font-size: 12px;">{{hoja.anexoHojas}}</td>
                    </tr>
                    <tr style="font-size: 12px;">
                    <td style="font-size: 12px;"></td>
                    <td style="font-size: 12px;"></td>
                    <td style="font-size: 12px;"></td>
                    <td style="font-size: 12px;"></td>
                    <td style="font-size: 12px;"></td>
                    <td style="font-size: 12px;"></td>
                    </tr>
                    </tbody>
                    </table>
                    <table border="0" style="font-size: 12px; width: 748px; height: 44px;">
                    <tbody>
                    <tr>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
                    <td style="font-size: 12px;">DESTINATARIO:</td>
                    <td style="font-size: 12px;"><b>{{hoja.destinatario}}</b></td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td style="font-size: 12px;"></td>
                    <td style="font-size: 12px;"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b></td>
                    <td></td>
                    </tr>
                    </tbody>
                    </table>
                    <p></p>
                    <hr />
                    <p align="left"></p>
                    <p></p>
                    <p></p>
                </div>
                <div class="col-md-10" v-if="menu=='busqueda'">
                    <h4>{{filtroTipo}}</h4>
                    <div class="row justify-content-md-center" v-if="window.isManager">
                        <div class="col-md-5">
                            <canvas id="seguimientoMes" width="400" height="200"></canvas>
                        </div>
                        <div class="col-md-5">
                            <canvas id="pendientes" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="input-group">
                        <input class="form-control" v-model='filtro' placeholder="busqueda">
                        <a href="javascript:void(0)" class="btn input-group-addon" v-on:click='filtrar'>Buscar</a>
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nº Control</th>
                                <th>Referencia</th>
                                <th>Procedencia</th>
                                <th>Destinatario</th>
                                <th>Fecha Recep. (correspondencia)</th>
                                <th>Conclusión</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='hoja in hojasDeRutaBusqueda'>
                                <td>{{hoja.numero}}</td>
                                <td>{{hoja.nroDeControl}}</td>
                                <td>{{hoja.referencia}}</td>
                                <td>{{hoja.procedencia}}</td>
                                <td>{{hoja.destinatario}}</td>
                                <td>{{hoja.fecha}}</td>
                                <td><label :class="hoja.color()">{{hoja.concluido()?hoja.conclusion:'PENDIENTE'}}</label></td>
                                <td><a href='#editar' class='btn btn-default' v-on:click='abrir(hoja)'>Abrir</a>
                                    <div class="btn-group" style="width: 6em;">
                                        <a v-bind:href='imprimirHoja(hoja, 1)' target="_blank" v-on:click="clickImprimir(event, imprimirHoja(hoja, 1))" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                                        <a v-bind:href='imprimirHoja(hoja, 2)' target="_blank" v-on:click="clickImprimir(event, imprimirHoja(hoja, 2))" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                                        <a v-bind:href='imprimirHoja(hoja, 3)' target="_blank" v-on:click="clickImprimir(event, imprimirHoja(hoja, 3))" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                                    </div>
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-10" v-if="menu=='nota_busqueda'">
                    <div class="row justify-content-md-center" v-if="window.isManager">
                    </div>
                    <input class="form-control" v-model='filtroNota' placeholder="busqueda nota" v-on:keyup='filtrarNota'>
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Hoja de Ruta</th>
                                <th>Fecha Emision</th>
                                <th>Nro Nota</th>
                                <th>Reiterativa</th>
                                <th>Fecha Entrega</th>
                                <th>Entidad/Empresa</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Días</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='note in notasBusqueda'>
                                <td>{{note.hoja_de_ruta}}</td>
                                <td>{{note.fecha_emision}}</td>
                                <td>{{note.nro_nota}}</td>
                                <td>{{note.reiterativa}}</td>
                                <td>{{note.fecha_entrega}}</td>
                                <td>{{note.entidad_empresa}}</td>
                                <td>{{note.nombre_apellidos}}</td>
                                <td>{{note.cargo}}</td>
                                <td><span v-if="note.dias"><span class="diasPasaron" v-bind:chart="note.pasaron()>note.dias?'pieRojo':'pie'">{{note.pasaron()}}/{{note.dias}}</span> {{note.pasaron()}}/{{note.dias}} días</span></td>
                                <td><a href='#nota_oficio' class='btn btn-default' v-on:click='abrirNota(note)'>Abrir</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-10" v-if="menu=='com_busqueda'">
                    <div class="row justify-content-md-center" v-if="window.isManager">
                    </div>
                    <input class="form-control" v-model='filtroComunicacion' placeholder="busqueda comunicación interna" v-on:keyup='filtrarComunicacion'>
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Hoja de Ruta</th>
                                <th>Fecha Emision</th>
                                <th>Nro Nota</th>
                                <th>Reiterativa</th>
                                <th>Fecha Entrega</th>
                                <th>Entidad/Empresa</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Días</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='note in comunicacionesBusqueda'>
                                <td>{{note.hoja_de_ruta}}</td>
                                <td>{{note.fecha_emision}}</td>
                                <td>{{note.nro_nota}}</td>
                                <td>{{note.reiterativa}}</td>
                                <td>{{note.fecha_entrega}}</td>
                                <td>{{note.entidad_empresa}}</td>
                                <td>{{note.nombre_apellidos}}</td>
                                <td>{{note.cargo}}</td>
                                <td><span v-if="note.dias"><span class="diasPasaron" v-bind:chart="note.pasaron()>note.dias?'pieRojo':'pie'">{{note.pasaron()}}/{{note.dias}}</span> {{note.pasaron()}}/{{note.dias}} días</span></td>
                                <td><a href='#com_interna' class='btn btn-default' v-on:click='abrirComunicacion(note)'>Abrir</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <div class="col-md-12" v-if="menu=='reporte_hoja_ruta'">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Reporte - Hojas de Ruta ({{reporte.tipo}})</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Fecha recepción</label>
                                <div class="col-md-5">
                                    <fecha v-model="reporte.fecha_recepcion1"></fecha>
                                </div>
                                <div class="col-md-5">
                                    <fecha v-model="reporte.fecha_recepcion2"></fecha>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-md-2 control-label">Referencia</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" v-model="reporte.referencia" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Procedencia</label>
                                <div class="col-md-10">
                                    <input type="text" v-model="reporte.procedencia" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nº de control</label>
                                <div class="col-md-10">
                                    <input v-model="reporte.nroDeControl" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Fecha de Conclusión</label>
                                <div class="col-md-5">
                                    <fecha v-model="reporte.fecha_conclusion1"></fecha>
                                </div>
                                <div class="col-md-5">
                                    <fecha v-model="reporte.fecha_conclusion2"></fecha>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Gestión</label>
                                <div class="col-md-10">
                                    <input v-model="reporte.gestion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Fecha derivación</label>
                                <div class="col-md-5">
                                    <fecha v-model="reporte.fecha_derivacion1"></fecha>
                                </div>
                                <div class="col-md-5">
                                    <fecha v-model="reporte.fecha_derivacion2"></fecha>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Destinatario</label>
                                <div class="col-md-10">
                                    <div class="btn-group btn-block">
                                        <input type="text" v-model="reporte.destinatario" class="form-control dropdown-toggle" data-toggle="dropdown" placeholder="">
                                        <ul class="dropdown-menu">
                                            <li v-for="dest in destinatarios" v-on:click="reporte.destinatario=dest.attributes.nombres+' '+dest.attributes.apellidos" v-if="(dest.attributes.nombres+' '+dest.attributes.apellidos).toLowerCase().indexOf(hoja.destinatario.toLowerCase())>-1"><a href="javascript:void(0)">{{dest.attributes.nombres}} {{dest.attributes.apellidos}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-10">
                                    <input type="radio" name="reporteForma" value="SoloHojas" v-model="reporte.forma" /> Por hojas de ruta
                                    <input type="radio" name="reporteForma" value="SoloDerivaciones" v-model="reporte.forma" /> Por derivaciones
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-10">
                                    <input type="checkbox" value='1' v-model="reporte.todasLasDerivaciones" /> Mostrar todas las derivaciones
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-lg-offset-2">
                                    <button type="button" v-on:click="generarReporteExterna" class="btn btn-primary">Generar Reporte</button>
                                    <button type="button" v-on:click="exportarExcel('reporteExterna', 'Hojas de Ruta Externas')" class="btn btn btn-default">Exportar Excel</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <table id="reporteExterna" class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th v-if="reporte.forma==='SoloDerivaciones'"></th>
                                <th>Nº Control</th>
                                <th>{{reporte.forma==='SoloDerivaciones' ? 'Fecha Derivación' : 'Gestión' }}</th>
                                <th>{{reporte.forma==='SoloDerivaciones' ? 'Destinatario' : 'Referencia' }}</th>
                                <th>Procedencia</th>
                                <th>Fecha Recepción</th>
                                <th>Conclusión</th>
                                <th v-if="reporte.forma==='SoloDerivaciones'">Referencia</th>
                            </tr>
                        </thead>
                        <tbody v-for='(rep, r) in reporteExterna'>
                            <tr v-if="reporte.forma!='SoloDerivaciones'">
                                <th>{{r+1}}</th>
                                <td>{{rep.nro_de_control}}</td>
                                <td>{{rep.gestion}}</td>
                                <td>{{rep.referencia}}</td>
                                <td>{{rep.procedencia}}</td>
                                <td style="white-space: pre;">{{rep.fecha}}</td>
                                <td style="white-space: pre;">{{rep.conclusion}}</td>
                            </tr>
                            <tr v-if="reporte.forma==='Combinado'">
                                <th>#</th>
                                <th>Nº Control</th>
                                <th>Fecha Derivación</th>
                                <th>Referencia</th>
                                <th>Destinatario</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr v-if="reporte.forma!='SoloHojas'" v-for='(derivacion, d) in rep.derivaciones'>
                                <th v-if="reporte.forma==='SoloDerivaciones'">{{r+1}}</th>
                                <td>{{d+1}}</td>
                                <td>{{rep.nro_de_control}}</td>
                                <td style="white-space: pre;">{{derivacion.fecha}}</td>
                                <td style="white-space: pre">{{reporte.forma==='SoloDerivaciones' ? derivacion.destinatario : rep.referencia}}</td>
                                <td>{{reporte.forma==='SoloDerivaciones' ? rep.procedencia : derivacion.destinatario}}</td>
                                <td>{{reporte.forma==='SoloDerivaciones' ? rep.fecha : ''}}</td>
                                <td>{{reporte.forma==='SoloDerivaciones' ? rep.conclusion : ''}}</td>
                                <td v-if="reporte.forma==='SoloDerivaciones'">{{rep.referencia}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-10" v-if="menu=='nota_reporte'">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Reporte - Oficio</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nº Hoja de Ruta</label>
                                <div class="col-md-10">
                                    <input type="text" v-model="notaReporte.hoja_de_ruta" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-md-2 control-label">Fecha de emisión</label>
                                <div class="col-md-5">
                                    <fecha v-model="notaReporte.fecha_emision1">
                                </div>
                                <div class="col-md-5">
                                    <fecha v-model="notaReporte.fecha_emision2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nº NOTA CGE/SCEP</label>
                                <div class="col-md-10">
                                    <input type="text" v-model="notaReporte.nro_nota" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Reiterativa</label>
                                <div class="col-md-10">
                                    <select class="form-control" v-model="notaReporte.reiterativa">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-md-2 control-label">Fecha de entrega</label>
                                <div class="col-md-5">
                                    <fecha v-model="notaReporte.fecha_entrega1" />
                                </div>
                                <div class="col-md-5">
                                    <fecha v-model="notaReporte.fecha_entrega2" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Entidad o Empresa</label>
                                <div class="col-md-10">
                                    <input type="text" name="entidad_empresa" v-model="notaReporte.entidad_empresa" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nombre y apellidos</label>
                                <div class="col-md-10">
                                    <input type="text" name="nombre_apellidos" v-model="notaReporte.nombre_apellidos" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Cargo</label>
                                <div class="col-md-10">
                                    <input type="text" name="cargo" v-model="notaReporte.cargo" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-md-2 control-label">Referencia</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" v-model="notaReporte.referencia" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <legend>Reporte - Nota Recibida</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nº Hoja de Ruta</label>
                                <div class="col-md-10">
                                    <input type="text" v-model="notaReporte.hoja_de_ruta_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-md-2 control-label">Fecha de recepción</label>
                                <div class="col-md-5">
                                    <fecha v-model="notaReporte.fecha_recepcion1" />
                                </div>
                                <div class="col-md-5">
                                    <fecha v-model="notaReporte.fecha_recepcion2" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nº NOTA</label>
                                <div class="col-md-10">
                                    <input type="text" v-model="notaReporte.nro_nota_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Remitente</label>
                                <div class="col-md-10">
                                    <input type="text" name="remitente" v-model="notaReporte.remitente_recepcion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-md-2 control-label">Asunto o Referencia</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" v-model="notaReporte.referencia_recepcion" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="button" v-on:click="generarNotaReporte" class="btn btn-primary">Generar Reporte</button>
                                    <button type="button" v-on:click="exportarExcel('reporteExterna', 'Hojas de Ruta Externas')" class="btn btn btn-default">Exportar Excel</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <table id="reporteInterna" class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>Hoja de Ruta</th>
                                <th>Fecha Emision</th>
                                <th>Nro Nota</th>
                                <th>Reiterativa</th>
                                <th>Fecha Entrega</th>
                                <th>Entidad/Empresa</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Días</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for='note in reporteNotas'>
                                <td>{{note.hoja_de_ruta}}</td>
                                <td>{{note.fecha_emision}}</td>
                                <td>{{note.nro_nota}}</td>
                                <td>{{note.reiterativa}}</td>
                                <td>{{note.fecha_entrega}}</td>
                                <td>{{note.entidad_empresa}}</td>
                                <td>{{note.nombre_apellidos}}</td>
                                <td>{{note.cargo}}</td>
                                <td><span v-if="note.dias">{{note.pasaron()}}/{{note.dias}} días</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
           </div>
        </div>
        <script type='text/x-template' id='template-fecha'>
            <div class='input-group date'>
                <input type='text' v-model="innerValue" readonly="readonly" class="form-control" />
                <span class="input-group-addon" v-on:click="datepick">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </script>
        <script type='text/x-template' id='template-tags'>
            <div class="form-control form-control-tags" style="position:relative;">
                <div style="position:absolute;left:0px;top:0px;min-width:100%;height:100%; padding: 11px; ">
                    <select v-model="innerValue" style="position:absolute;left:0px;top:0px;width:100%;height:100%;opacity:0;"
                            v-on:change="select">
                        <option v-for="option in domain" v-bind:value="typeof option=='object'?option.id:option" :hidden="isSelected(typeof option=='object'?option.id:option)">{{getOptionText(option)}}</option>
                        <option alue="" hidden=""></option>
                    </select>
                    <span v-for="option in selected" class="label label-info" :value="option.value" style="position:relative;" v-on:click="remove">{{option.text}} <i class="glyphicon glyphicon-remove"></i></span>
                </div>
            </div>
        </script>
        <script>
        function Recepcion(values) {
            this.id = null,
            this.fecha= '',
            this.referencia= '',
            this.procedencia= '',
            this.nroDeControl= '',
            this.anexoHojas= '',
            this.destinatario= '';
            this.fechaAuditor= '';
            this.conclusion= '';
            this.tipo= 'interna';
            this.tipoTarea= '';
            this.numero= '';
            this.load(values);
        }
        Recepcion.prototype.load = function (values){
            if (typeof values==='object' && values) {
                for(var a in values) if (typeof values[a]!='function') {
                    this[a] = values[a];
                }
            }
        }
        Recepcion.prototype.concluido = function () {
            return this.conclusion && this.conclusion!=='0000-00-00';
        }
        Recepcion.prototype.color = function () {
            var semanas = Math.ceil((new Date().getTime()-new Date(this.fecha).getTime())/1000/60/60/24/7);
            var color;
            color = semanas<=1?'label label-success':color;
            color = semanas==2?'label label-warning':color;
            color = semanas>=3?'label label-danger':color;
            color = this.concluido() ? 'label label-default':color;
            return color;
        }
        Recepcion.prototype.selectDerivations = function (list, filter){
            var self = this;
            list.splice(0);
            $.ajax({
                method:'GET',
                url: 'selectDerivacion.php',
                data: {
                    hoja_ruta_id: self.id,
                    filter: filter ? filter : '',
                    t: Math.floor(new Date().getTime()/1000)
                },
                dataType: 'json',
                success: function (res) {
                    res.forEach(function (o) {
                        list.push(new Derivacion({
                            id: o.id,
                            fecha: o.fecha,
                            comentarios: o.comentarios,
                            destinatario: o.destinatario,
                            instruccion: o.instruccion,
                        }));
                    });
                }
            });
        }
        function Nota(values) {
        	this.id = null;
			this.hoja_de_ruta = '';
			this.fecha_emision = '';
			this.nro_nota = '';
			this.reiterativa = '';
			this.fecha_entrega = '';
			this.entidad_empresa = '';
			this.nombre_apellidos = '';
			this.cargo = '';
			this.referencia = '';
			this.dias = '';
			this.retraso = '';
			this.hoja_de_ruta_recepcion = '';
			this.fecha_recepcion = '';
			this.nro_nota_recepcion = '';
			this.remitente_recepcion = '';
			this.referencia_recepcion = '';
			this.fojas_recepcion = '';
			this.numero = '';
            this.load(values);
        }
        function NotaReporte(values) {
			this.hoja_de_ruta = '';
			this.fecha_emision1 = '';
			this.fecha_emision2 = '';
			this.nro_nota = '';
			this.reiterativa = '';
			this.fecha_entrega1 = '';
			this.fecha_entrega2 = '';
			this.entidad_empresa = '';
			this.nombre_apellidos = '';
			this.cargo = '';
			this.referencia = '';
			//this.dias = '';
			//this.retraso = '';
			this.hoja_de_ruta_recepcion = '';
			this.fecha_recepcion1 = '';
			this.fecha_recepcion2 = '';
			this.nro_nota_recepcion = '';
			this.remitente_recepcion = '';
			this.referencia_recepcion = '';
			//this.fojas_recepcion = '';
			//this.numero = '';
        }
        Nota.prototype.load = function (values){
            if (typeof values==='object' && values) {
                for(var a in values) if (typeof values[a]!='function') {
                    this[a] = values[a];
                }
            }
        }
        Nota.prototype.pasaron = function () {
            var from = moment(this.fecha_entrega+' 00:00:00', 'YYYY-MM-DD HH:mm:ss');
            var to = moment();
            var pasaron = Math.floor(workday_count(from, to));
            return isNaN(pasaron) ? '' : pasaron;
        }
        function Derivacion(values) {
            this.id = null,
            this.hoja_ruta_id = '',
            this.fecha = '',
            this.destinatario = '',
            this.destinatarios = '',
            this.comentarios = '',
            this.instruccion = '';
            this.dias_plazo = '';
            this.load(values);
            this.editable = false;
        }
        Derivacion.prototype.load = function (values){
            if (typeof values==='object' && values) {
                for(var a in values) if (typeof values[a]!='function') {
                    this[a] = values[a];
                }
            }
        }
        window.workday_count = function(start,end) {
            var first = start.clone().endOf('week'); // end of first week
            var last = end.clone().startOf('week'); // start of last week
            var days = last.diff(first,'days') * 5 / 7; // this will always multiply of 7
            var wfirst = first.day() - start.day(); // check first week
            if(start.day() == 0) --wfirst; // -1 if start with sunday
            var wlast = end.day() - last.day(); // check last week
            if(end.day() == 6) --wlast; // -1 if end with saturday
            return wfirst + days + wlast; // get the total
        }

        /**
         * Si la pagina tiene el parametro ?dashboard se considera que es
         * el gerente o jefe de la unidad
         */
        window.isManager = window.location.search.indexOf('dashboard')>0;
        /**
         * Inicia el controlador de la pagina
         */
        $(document).ready(function () {
            var app = new Vue({
                el: '#wrapper',
                data: function () {
                    var self = this;
                    return {
                        menu: 'recepcion',
                        hojasDeRuta: [],
                        hoja: new Recepcion(),
                        nota: new Nota(),
                        filtro: '',
                        hojasDeRutaBusqueda: [],
                        filtroNota: '',
                        filtroComunicacion: '',
                        notasBusqueda: [],
                        comunicacionesBusqueda: [],
                        derivacion: new Derivacion(),
                        derivaciones: [],
                        filtroDerivacion: '',
                        destinatarios : [],
                        reservedNumber : '',
                        filtroTipo : 'externa',
                        reporte: {
                            tipo: 'externa',
                            fecha_recepcion1: '',
                            fecha_recepcion2: '',
                            referencia: '',
                            procedencia: '',
                            nroDeControl: '',
                            fecha_conclusion1: '',
                            fecha_conclusion2: '',
                            gestion: String(new Date().getFullYear()),
                            fecha_derivacion1: '',
                            fecha_derivacion2: '',
                            destinatario: '',
                            forma: 'Combinado',
                            todasLasDerivaciones: false,
                        },
                        reporteExterna: [],
                        notaReporte: new NotaReporte(),
                        reporteNotas: [],
                        errores: {
                            derivacion_fecha: false,
                            derivacion_destinatarios: false,
                            hoja_tipo: false,
                            nro_control_dup: false,
                            nro_control_msg: '',
                        },
                    };
                },
                methods: {
                    validarNroControl: function (numero) {
                        var self = this;
                        $.ajax({
                            url: 'checkHoja.php',
                            data: {
                                numero: numero,
                                gestion: new Date().getFullYear(),
                            },
                            dataType: 'json',
                            success: function (response) {
                                self.errores.nro_control_dup = !response.success;
                                self.errores.nro_control_msg = response.message;
                            }
                        });
                    },
                    exportarExcel: function (id, name) {
                        exportToExcel(id, name);
                    },
                    hoja_fjs: function (anexo) {var ma =anexo.match(/(\d+)\s*fjs/i);return ma ? ma[1] : ''},
                    hoja_arch: function (anexo) {var ma =anexo.match(/(\d+)\s*arc/i);return ma ? ma[1] : ''},
                    hoja_ani: function (anexo) {var ma =anexo.match(/(\d+)\s*ani/i);return ma ? ma[1] : ''},
                    hoja_leg: function (anexo) {var ma =anexo.match(/(\d+)\s*leg/i);return ma ? ma[1] : ''},
                    hoja_eje: function (anexo) {var ma =anexo.match(/(\d+)\s*eje/i);return ma ? ma[1] : ''},
                    hoja_eng: function (anexo) {var ma =anexo.match(/(\d+)\s*eng/i);return ma ? ma[1] : ''},
                    hoja_cd: function (anexo) {var ma =anexo.match(/(\d+)\s*cd/i);return ma ? ma[1] : ''},
                    sincronizaDestinatario: function (destinatarios) {
                        var self = this;
                        var destinatario = [];
                        destinatarios.forEach(function (dest) {
                            destinatario.push(dest.text);
                        });
                        self.derivacion.destinatario = destinatario.join('\n');
                    },
                    nuevaExterna : function () {
                        this.nueva('externa');
                    },
                    nuevaInterna : function () {
                        this.nueva('interna');
                    },
                    nueva: function (tipo) {
                        this.hoja.id = null;
                        this.hoja.fecha = '';
                        this.hoja.referencia = '';
                        this.hoja.procedencia = '';
                        this.hoja.nroDeControl = '';
                        this.hoja.anexoHojas = '';
                        this.hoja.destinatario = '';
                        this.hoja.fechaAuditor = '';
                        this.hoja.conclusion = '';
                        this.hoja.tipo = !tipo ? 'interna' : tipo;
                        this.hoja.tipoTarea = '';
                        this.hoja.numero = '';
                        this.hoja.anexoHojas_fjs = '';
                        this.hoja.anexoHojas_arch = '';
                        this.hoja.anexoHojas_ani = '';
                        this.hoja.anexoHojas_leg = '';
                        this.hoja.anexoHojas_eje = '';
                        this.hoja.anexoHojas_eng = '';
                        this.hoja.anexoHojas_cd = '';
                        this.reservarNumero();
                    },
                    save: function(callback) {
                        var self = this;
                        var o = this.hoja;
                        if (!o.fecha.match(/\d\d\d\d-\d\d-\d\d/)) {
                            alert("El formato de la fecha no es correcto");
                            return false;
                        }
                        self.errores.hoja_tipo = !o.tipoTarea;
                        if (self.errores.hoja_tipo) {
                            return false;
                        }
                        $.ajax({
                            method: 'get',
                            url: 'save.php',
                            data: {
                                id: o.id ? o.id: '',
                                tipo: o.tipo,
                                tipo_tarea: o.tipoTarea,
                                fecha: o.fecha,
                                referencia: o.referencia,
                                procedencia: o.procedencia,
                                nro_de_control: o.nroDeControl,
                                anexo_hojas: o.anexoHojas,
                                destinatario: o.destinatario,
                                conclusion: o.conclusion,
                                numero: o.numero,
                                t: new Date().getTime()
                            },
                            dataType: 'json',
                            success: function () {
                            },
                            error: function (response) {
                                alert(JSON.stringify(response));
                            }
                        }).done(function(response) {
                            if (typeof response==='object' && response.error) {
                                alert(response.error);
                            } else if (typeof response==='object' && response.success) {
                                if (typeof callback==='function') {
                                    callback();
                                }
                            } else {
                                alert(response);
                            }
                        });
                    },
                    saveNota: function(callback) {
                        var self = this;
                        var o = this.nota;
                        $.ajax({
                            method: 'get',
                            url: 'saveNota.php',
                            data: {
                                id: o.id ? o.id: '',
                                hoja_de_ruta: o.hoja_de_ruta,
                                fecha_emision: o.fecha_emision,
                                nro_nota: o.nro_nota,
                                reiterativa: o.reiterativa,
                                fecha_entrega: o.fecha_entrega,
                                entidad_empresa: o.entidad_empresa,
                                nombre_apellidos: o.nombre_apellidos,
                                cargo: o.cargo,
                                referencia: o.referencia,
                                dias: o.dias,
                                retraso: o.retraso,
                                hoja_de_ruta_recepcion: o.hoja_de_ruta_recepcion,
                                fecha_recepcion: o.fecha_recepcion,
                                nro_nota_recepcion: o.nro_nota_recepcion,
                                remitente_recepcion: o.remitente_recepcion,
                                referencia_recepcion: o.referencia_recepcion,
                                fojas_recepcion: o.fojas_recepcion,
                                t: new Date().getTime()
                            },
                            dataType: 'json',
                            success: function () {
                            }
                        }).done(function() {
                            if (typeof callback==='function') {
                                callback();
                            }
                        });
                    },
                    saveComunicacion: function(callback) {
                        var self = this;
                        var o = this.nota;
                        $.ajax({
                            method: 'get',
                            url: 'saveComunicacion.php',
                            data: {
                                id: o.id ? o.id: '',
                                hoja_de_ruta: o.hoja_de_ruta,
                                fecha_emision: o.fecha_emision,
                                nro_nota: o.nro_nota,
                                reiterativa: o.reiterativa,
                                fecha_entrega: o.fecha_entrega,
                                entidad_empresa: o.entidad_empresa,
                                nombre_apellidos: o.nombre_apellidos,
                                cargo: o.cargo,
                                referencia: o.referencia,
                                dias: o.dias,
                                retraso: o.retraso,
                                hoja_de_ruta_recepcion: o.hoja_de_ruta_recepcion,
                                fecha_recepcion: o.fecha_recepcion,
                                nro_nota_recepcion: o.nro_nota_recepcion,
                                remitente_recepcion: o.remitente_recepcion,
                                referencia_recepcion: o.referencia_recepcion,
                                fojas_recepcion: o.fojas_recepcion,
                                t: new Date().getTime()
                            },
                            dataType: 'json',
                            success: function () {
                            }
                        }).done(function() {
                            if (typeof callback==='function') {
                                callback();
                            }
                        });
                    },
                    nuevaNota: function() {
                        var self = this;
                        self.nota.id = '';
                        self.nota.hoja_de_ruta = '';
                        self.nota.fecha_emision = '';
                        self.nota.nro_nota = '';
                        self.nota.reiterativa = '';
                        self.nota.fecha_entrega = '';
                        self.nota.entidad_empresa = '';
                        self.nota.nombre_apellidos = '';
                        self.nota.cargo = '';
                        self.nota.referencia = '';
                        self.nota.dias = '';
                        self.nota.retraso = '';
                        self.nota.hoja_de_ruta_recepcion = '';
                        self.nota.fecha_recepcion = '';
                        self.nota.nro_nota_recepcion = '';
                        self.nota.remitente_recepcion = '';
                        self.nota.referencia_recepcion = '';
                        self.nota.fojas_recepcion = '';
                    },
                    nuevaComunicacion: function () {
                        this.nuevaNota();
                    },
                    saveDerivation: function(callback, o) {
                        var self = this;
                        if (typeof o==='undefined') o = this.derivacion;
                        self.errores.derivacion_fecha = !o.fecha;
                        self.errores.derivacion_destinatarios = !o.destinatarios;
                        if (self.errores.derivacion_fecha || self.errores.derivacion_destinatarios) {
                            return;
                        }
                        $.ajax({
                            method: 'get',
                            url: 'saveDerivacion.php',
                            data: {
                                id: o.id ? o.id: '',
                                hoja_ruta_id: self.hoja.id,
                                fecha: o.fecha,
                                comentarios: o.comentarios,
                                destinatario: o.destinatario,
                                destinatarios: o.destinatarios,
                                instruccion: o.instruccion,
                                //tipo: o.tipo,
                                dias_plazo: o.dias_plazo,
                                t: new Date().getTime()
                            },
                            dataType: 'json',
                            success: function () {
                            }
                        }).done(function() {
                            var gestion = String(new Date().getFullYear());
                            var nroDerivacion = self.derivaciones.length + 1;
                            var usuarios=[];
                            var destinatarios_ids = o.destinatarios.split(",");
                            self.destinatarios.forEach(function (d) {
                                if (destinatarios_ids.find(function(ii){return ii==d.id;})) {
                                    usuarios.push(d);
                                }
                            });
                            self.findTask(
                                self.hoja.nroDeControl, gestion,
                                function (tarea) {
                                    self.crearAsignacion(o, tarea, usuarios, nroDerivacion, function () {});
                                },
                                function () {
                                    self.createTask(o, gestion, usuarios, nroDerivacion, function (tarea) {
                                        self.crearAsignacion(o, tarea.data, usuarios, nroDerivacion, function () {});
                                    });
                                }
                            );
                            self.filtroDerivacion = '';
                            self.hoja.selectDerivations(self.derivaciones, self.filtroDerivacion);
                            if (typeof callback==='function') {
                                callback();
                            }
                            self.derivacion.load({
                                id:'',
                                fecha: '',
                                destinatario: '',
                                destinatarios: '',
                                comentarios: '',
                                instruccion: '',
                            });
                        });
                    },
                    createTask: function (derivacion, gestion, usuarios, nro_asignacion, callback) {
                        var self = this;
                        var asignaciones = [];
                        usuarios.forEach(function(user){
                            asignaciones.push({
                                "type": "UserAdministration.Asignacion",
                                "attributes": {
                                    "nro_asignacion": nro_asignacion,
                                    "user_id": user.id,
                                }
                            });
                        });
                        $.ajax({
                            method: 'POST',
                            url: '/api/UserAdministration/tareas',
                            data: JSON.stringify({
                                "data":{
                                    "type":"UserAdministration.Tarea",
                                    "attributes":{
                                        "cod_tarea":"",
                                        "nro_de_control": self.hoja.nroDeControl,
                                        "tipo": self.hoja.tipoTarea,
                                        "gestion": gestion, //gestion actual
                                        "nombre_tarea": self.hoja.nroDeControl + ' - ' + self.hoja.referencia,
                                        "descripcion": derivacion.comentarios,
                                        "estado":"Pendiente",
                                        "avance":0,
                                        "prioridad":"Media"
                                    },
                                    "relationships":{
                                        "creador":{
                                            "data":{"id":"2"}
                                        },
                                        /*"asignaciones":{
                                            "data":asignaciones
                                        },*/
                                        "revisor1":{"data":{"id":null}},
                                        "aprobacion1":{"data":{"id":null}},
                                        "revisor2":{"data":{"id":null}},
                                        "aprobacion2":{"data":{"id":null}},
                                        "adjuntos":{"data":[]},"avances":{"data":[]}
                                    }
                                }
                            }),
                            success: function (tarea) {
                                callback(tarea);
                            }
                        });
                    },
                    findTask: function (nroControl, gestion, exists, doesntExists) {
                        var self = this;
                        $.ajax({
                            method: 'GET',
                            url: '/api/UserAdministration/tareas',
                            data: {
                                filter: [
                                    'where,nro_de_control,'+nroControl,
                                    'where,gestion,'+gestion,
                                ],
                                include: 'usuarios'
                            },
                            success: function (response) {
                                if (response.data.length>0) {
                                    exists(response.data[0]);
                                } else {
                                    doesntExists();
                                }
                            }
                        });
                    },
                    crearAsignacion: function (derivacion, tarea, usuarios, nro_asignacion, callback) {
                        var asignaciones = [];
                        usuarios.forEach(function(user){
                            asignaciones.push({
                                "type": "UserAdministration.Asignacion",
                                "attributes": {
                                    "nro_asignacion": nro_asignacion,
                                    "user_id": user.id,
                                    "tarea_id": tarea.id,
                                    //"tipo": derivacion.tipo,
                                    "dias_plazo": derivacion.dias_plazo,
                                }
                            });
                        });
                        $.ajax({
                            method: 'POST',
                            url: '/api/UserAdministration/tareas/' + tarea.id + '/asignaciones',
                            data: JSON.stringify({
                                data: asignaciones
                            }),
                            success: function (response) {
                                callback(response);
                            }
                        });
                    },
                    terminarHoja: function() {
                        var self = this;
                        self.saveDerivation(function () {
                            var fecha = new Date;
                            self.hoja.conclusion = self.anio(fecha)+
                              '-'+self.mes(fecha)+
                              '-'+self.dia(fecha);
                            self.save(function(){
                                self.filtrar();
                            });
                            
                        });
                    },
                    generar: function() {
                        var self = this;
                        var o = self.hoja;
                        var anexoHojas = [];
                        if (o.anexoHojas_fjs) anexoHojas.push(o.anexoHojas_fjs+' fjs');
                        if (o.anexoHojas_arch) anexoHojas.push(o.anexoHojas_arch+' arch');
                        if (o.anexoHojas_ani) anexoHojas.push(o.anexoHojas_ani+' anillados');
                        if (o.anexoHojas_leg) anexoHojas.push(o.anexoHojas_leg+' legajo');
                        if (o.anexoHojas_eje) anexoHojas.push(o.anexoHojas_eje+' ejemplar');
                        if (o.anexoHojas_eng) anexoHojas.push(o.anexoHojas_eng+' engrapad');
                        if (o.anexoHojas_cd) anexoHojas.push(o.anexoHojas_cd+' cd');
                        if (anexoHojas.length) o.anexoHojas = anexoHojas.join(', ');
                        this.save(function () {
                            self.filtrar();
                            window.location.hash="#busqueda";
                        });
                    },
                    actualizarHR: function() {
                        var self = this;
                        this.save(function () {
                            self.filtrar();
                            window.location.hash="#busqueda";
                        });
                    },
                    generarNota: function() {
                        var self = this;
                        self.saveNota(function () {
                            self.filtrarNota();
                        });
                        window.location.hash="#nota_busqueda";
                    },
                    generarComunicacion: function() {
                        var self = this;
                        self.saveComunicacion(function () {
                            self.filtrarComunicacion();
                        });
                        window.location.hash="#com_busqueda";
                    },
                    generarReporteExterna: function () {
                        var self = this;
                        $.ajax({
                            method: 'get',
                            url: 'reporteHojaRuta.php',
                            data: self.reporte,
                            dataType: 'json',
                            success: function (res) {
                                self.reporteExterna.splice(0);
                                res.forEach(function (row) {
                                    self.reporteExterna.push(row);
                                });
                            }
                        });
                    },
                    generarNotaReporte: function () {
                        var self = this;
                        $.ajax({
                            method: 'get',
                            url: 'reporteNota.php',
                            data: self.notaReporte,
                            dataType: 'json',
                            success: function (res) {
                                self.reporteNotas.splice(0);
                                res.forEach(function (row) {
                                    self.reporteNotas.push(new Nota(row));
                                });
                            }
                        });
                    },
                    datepick: function() {
                        var self = this;
                        Vue.nextTick(function () {
                            $('#datetimepicker1').datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                            $('#datetimepicker1').datepicker('show');
                            $("#datetimepicker1").on("changeDate", function (e) {
                                self.hoja.fecha = $("#datetimepicker1 input").val();
                            });
                        });
                    },
                    datepick2: function() {
                        var self = this;
                        Vue.nextTick(function () {
                            $('#datetimepicker2').datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                            $('#datetimepicker2').datepicker('show');
                            $("#datetimepicker2").on("changeDate", function (e) {
                                self.hoja.fechaAuditor = $("#datetimepicker2 input").val();
                            });
                        });
                    },
                    datepick3: function() {
                        var self = this;
                        Vue.nextTick(function () {
                            $('#datetimepicker3').datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                            $('#datetimepicker3').datepicker('show');
                            $("#datetimepicker3").on("changeDate", function (e) {
                                self.derivacion.fecha = $("#datetimepicker3 input").val();
                            });
                        });
                    },
                    notaExternaFechaEnvioPick: function() {
                        var self = this;
                        Vue.nextTick(function () {
                            $('#notaExternaFechaEnvio').datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                            $('#notaExternaFechaEnvio').datepicker('show');
                            $("#notaExternaFechaEnvio").on("changeDate", function (e) {
                                self.nota.fecha_emision = $("#notaExternaFechaEnvio input").val();
                            });
                        });
                    },
                    notaExternaFechaEntrega: function() {
                        var self = this;
                        Vue.nextTick(function () {
                            $('#notaExternaFechaEntrega').datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                            $('#notaExternaFechaEntrega').datepicker('show');
                            $("#notaExternaFechaEntrega").on("changeDate", function (e) {
                                self.nota.fecha_entrega = $("#notaExternaFechaEntrega input").val();
                            });
                        });
                    },
                    notaExternaFechaRecepcion: function() {
                        var self = this;
                        Vue.nextTick(function () {
                            $('#notaExternaFechaRecepcion').datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                            $('#notaExternaFechaRecepcion').datepicker('show');
                            $("#notaExternaFechaRecepcion").on("changeDate", function (e) {
                                self.nota.fecha_recepcion = $("#notaExternaFechaRecepcion input").val();
                            });
                        });
                    },
                    imprimir: function () {
                        window.print();
                    },
                    filtrar: function () {
                        var self = this;
                        $.ajax({
                            method:'GET',
                            url: 'select.php',
                            data: {
                                filter: self.filtro,
                                tipo: self.filtroTipo,
                                t: Math.floor(new Date().getTime()/1000)
                            },
                            dataType: 'json',
                            success: function (res) {
                                self.hojasDeRutaBusqueda.splice(0);
                                res.forEach(function (o) {
                                    self.hojasDeRutaBusqueda.push(new Recepcion({
                                        id: o.id,
                                        tipo: o.tipo,
                                        tipoTarea: o.tipo_tarea,
                                        fecha: o.fecha,
                                        referencia: o.referencia,
                                        procedencia: o.procedencia,
                                        nroDeControl: o.nro_de_control,
                                        anexoHojas: o.anexo_hojas,
                                        destinatario: o.destinatario,
                                        conclusion: o.conclusion,
                                        numero: o.numero,
                                    }));
                                });
                            }
                        });
                    },
                    filtrarDerivacion: function () {
                        var self = this;
                        if (!self.runningFiltrarDerivacion) {
                            self.runningFiltrarDerivacion = true;
                            setTimeout(
                                function () {
                                    self.hoja.selectDerivations(
                                        self.derivaciones,
                                        self.filtroDerivacion
                                    );
                                    self.runningFiltrarDerivacion = false;
                                },
                                600
                            );
                        }
                    },
                    filtrarNota: function () {
                        var self = this;
                        $.ajax({
                            method:'GET',
                            url: 'selectNota.php',
                            data: {
                                filter: self.filtroNota,
                                t: Math.floor(new Date().getTime()/1000)
                            },
                            dataType: 'json',
                            success: function (res) {
                                self.notasBusqueda.splice(0);
                                res.forEach(function (o) {
                                    self.notasBusqueda.push(new Nota({
                                        id: o.id,
                                        hoja_de_ruta: o.hoja_de_ruta,
                                        fecha_emision: o.fecha_emision,
                                        nro_nota: o.nro_nota,
                                        reiterativa: o.reiterativa,
                                        fecha_entrega: o.fecha_entrega,
                                        entidad_empresa: o.entidad_empresa,
                                        nombre_apellidos: o.nombre_apellidos,
                                        cargo: o.cargo,
                                        referencia: o.referencia,
                                        dias: o.dias,
                                        retraso: o.retraso,
                                        hoja_de_ruta_recepcion: o.hoja_de_ruta_recepcion,
                                        fecha_recepcion: o.fecha_recepcion,
                                        nro_nota_recepcion: o.nro_nota_recepcion,
                                        remitente_recepcion: o.remitente_recepcion,
                                        referencia_recepcion: o.referencia_recepcion,
                                        fojas_recepcion: o.fojas_recepcion,
                                    }));
                                });
                                self.drawNotasPie();
                            }
                        });
                    },
                    filtrarComunicacion: function () {
                        var self = this;
                        $.ajax({
                            method:'GET',
                            url: 'selectComunicacion.php',
                            data: {
                                filter: self.filtroComunicacion,
                                t: Math.floor(new Date().getTime()/1000)
                            },
                            dataType: 'json',
                            success: function (res) {
                                self.comunicacionesBusqueda.splice(0);
                                res.forEach(function (o) {
                                    self.comunicacionesBusqueda.push(new Nota({
                                        id: o.id,
                                        hoja_de_ruta: o.hoja_de_ruta,
                                        fecha_emision: o.fecha_emision,
                                        nro_nota: o.nro_nota,
                                        reiterativa: o.reiterativa,
                                        fecha_entrega: o.fecha_entrega,
                                        entidad_empresa: o.entidad_empresa,
                                        nombre_apellidos: o.nombre_apellidos,
                                        cargo: o.cargo,
                                        referencia: o.referencia,
                                        dias: o.dias,
                                        retraso: o.retraso,
                                        hoja_de_ruta_recepcion: o.hoja_de_ruta_recepcion,
                                        fecha_recepcion: o.fecha_recepcion,
                                        nro_nota_recepcion: o.nro_nota_recepcion,
                                        remitente_recepcion: o.remitente_recepcion,
                                        referencia_recepcion: o.referencia_recepcion,
                                        fojas_recepcion: o.fojas_recepcion,
                                    }));
                                });
                                self.drawComunicacionPie();
                            }
                        });
                    },
                    drawNotasPie: function () {
                        Vue.nextTick(function () {
                            $("span.diasPasaron").each(function () {
                                var chart = $(this).attr("chart")=='pieRojo' ? 'pie' : $(this).attr("chart");
                                $(this).peity(chart, {
                                    fill: $(this).attr("chart") === 'pie' ? ['#1ab394', '#d7d7d7'] : ['#FB3C40', '#1ab394'],
                                })
                            });
                        });
                    },
                    drawComunicacionPie: function () {
                        Vue.nextTick(function () {
                            $("span.diasPasaron").each(function () {
                                var chart = $(this).attr("chart")=='pieRojo' ? 'pie' : $(this).attr("chart");
                                $(this).peity(chart, {
                                    fill: $(this).attr("chart") === 'pie' ? ['#1ab394', '#d7d7d7'] : ['#FB3C40', '#1ab394'],
                                })
                            });
                        });
                    },
                    dia: function (fecha){
                        if (!fecha) return '';
                        var d = "0"+(new Date(fecha)).getDate();
                        return d.substr(d.length-2);
                    },
                    mes: function (fecha){
                        if (!fecha) return '';
                        var d = "0"+((new Date(fecha)).getMonth()+1);
                        return d.substr(d.length-2);
                    },
                    anio: function (fecha){
                        if (!fecha) return '';
                        return (new Date(fecha)).getYear()+1900;
                    },
                    abrir: function (hoja) {
                        var self = this;
                        this.hoja.load(hoja, function () {
                            self.hoja.anexoHojas_fjs = self.hoja_fjs(self.hoja.anexoHojas);
                            self.hoja.anexoHojas_arch = self.hoja_arch(self.hoja.anexoHojas);
                            self.hoja.anexoHojas_ani = self.hoja_ani(self.hoja.anexoHojas);
                            self.hoja.anexoHojas_leg = self.hoja_leg(self.hoja.anexoHojas);
                            self.hoja.anexoHojas_eje = self.hoja_eje(self.hoja.anexoHojas);
                            self.hoja.anexoHojas_eng = self.hoja_eng(self.hoja.anexoHojas);
                            self.hoja.anexoHojas_cd = self.hoja_cd(self.hoja.anexoHojas);
                        });
                        this.derivacion.load({
                            id:'',
                            fecha: '',
                            destinatario: '',
                            comentarios: '',
                            instruccion: '',
                        });
                        self.filtroDerivacion = '';
                        this.hoja.selectDerivations(this.derivaciones, self.filtroDerivacion);
                    },
                    abrirNota: function (nota) {
                        this.nota.load(nota);
                        self.filtroNota = '';
                    },
                    abrirComunicacion: function (nota) {
                        this.nota.load(nota);
                        self.filtroComunicacion = '';
                    },
                    registrar: function () {
                        
                    },
                    concluido: function () {
                        return this.hoja.conclusion && this.hoja.conclusion!=='0000-00-00';
                    },
                    dibujarDashboard: function () {
                        Vue.nextTick(function(){
                            if (!document.getElementById("seguimientoMes")) {
                                return;
                            }
                            $.ajax({
                                url:'graficos.php',
                                method:'get',
                                data: {
                                    t: Math.floor(new Date().getTime()/1000)
                                },
                                dataType:'json'
                            }).then(function (data) {
                                if (!document.getElementById("seguimientoMes")) {
                                    return;
                                }
                                $("#seguimientoMes").parent().find("iframe").remove();
                                var ctx = document.getElementById("seguimientoMes").getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: data.meses,
                                        datasets: [
                                            {
                                                label: 'concluidos',
                                                data: data.concluidos,
                                                borderColor: '#00ff10',
                                            },
                                            {
                                                label: 'pendientes',
                                                data: data.pendientes,
                                                borderColor: '#ff1020',
                                            }
                                        ]
                                    }
                                });
                                $("#pendientes").parent().find("iframe").remove();
                                var ctx = document.getElementById("pendientes").getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: ["concluidos", "pendientes"],
                                        datasets: [{
                                            data: data.totalesMes,
                                            backgroundColor: ['#00ff10', '#ff1020']
                                        }]
                                    }
                                });
                            });
                        });
                    },
                    cargarDestinatarios : function () {
                        var self = this;
                        $.ajax({
                            url:'/api/UserAdministration/users?fields=nombres,apellidos',
                            method:'get',
                            data: {
                                t: Math.floor(new Date().getTime()/1000)
                            },
                            dataType:'json'
                        }).then(function (data) {
                            self.destinatarios.splice(0);
                            data.data.forEach(function (row) {
                                self.destinatarios.push(row);
                            });
                        });
                    },
                    reservarNumero : function () {
                        var self = this;
                        $.ajax({
                            url:'reservarNumero.php',
                            method:'get',
                            data: {
                                tipo: self.hoja.tipo,
                                t: Math.floor(new Date().getTime()/1000)
                            },
                            dataType:'json'
                        }).then(function (data) {
                            self.hoja.numero = data.reservedNumber;
                        });
                    },
                    imprimirHoja : function (hoja, posicion) {
                        //body=774*1179
                        return '/report?format=774*1184&path=/HojaRuta/imprimeHoja.php%3Fid='+hoja.id+'%26pos='+posicion;
                    },
                    clickImprimir : function (e, href) {
                        window.open(href);
                        e.preventDefault();
                    },
                    initReporte: function (tipo) {
                        this.reporte.tipo = tipo;
                        this.reporte.fecha_recepcion1 = '';
                        this.reporte.fecha_recepcion2 = '';
                        this.reporte.referencia = '';
                        this.reporte.procedencia = '';
                        this.reporte.nroDeControl = '';
                        this.reporte.fecha_conclusion1 = '';
                        this.reporte.fecha_conclusion2 = '';
                        this.reporte.gestion = String(new Date().getFullYear());
                        this.reporte.fecha_derivacion1 = '';
                        this.reporte.fecha_derivacion2 = '';
                        this.reporte.destinatario = '';
                        this.reporteExterna.splice(0);
                    }
                },
                mounted: function () {
                    var self = this;
                    //this.loadHojas();
                    this.filtrar();
                    this.filtrarNota();
                    this.filtrarComunicacion();
                    menu=window.location.hash.substr(1);
                    this.menu=menu?menu:(window.isManager?'busqueda':'recepcion');
                    self.dibujarDashboard();
                    self.cargarDestinatarios();
                    self.nueva();
                }
            });
            window.app = app;
            $(window).on('hashchange', function() {
                app.menu=window.location.hash.substr(1);
                app.menu=app.menu?app.menu:'busqueda';
                if (app.menu=='busqueda') {
                    app.dibujarDashboard();
                }
                if (app.menu=='nota_busqueda') {
                    app.drawNotasPie();
                }
            });
        });
        Vue.component('fecha', {
            template: '#template-fecha',
            props: {
                value: String
            },
            data: function () {
                return {
                    innerValue: this.value
                };
            },
            methods: {
                datepick: function() {
                    var self = this;
                    Vue.nextTick(function () {
                        $(self.$el).datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                        $(self.$el).datepicker('show');
                        $(self.$el).on("changeDate", function (e) {
                            self.innerValue = $(self.$el).find("input").val();
                        });
                    });
                },
            },
            watch: {
                'innerValue': function (value) {
                    this.$emit('input', value);
                },
                'value': function (value) {
                    this.innerValue = value;
                }
            },
            updated: function () {
                var self = this;
                self.$nextTick(function () {
                    $(self.$el).datepicker({autoclose:true, format:'yyyy-mm-dd', language: 'es'});
                    $(self.$el).datepicker('show');
                    $(self.$el).on("changeDate", function (e) {
                        self.innerValue = $(self.$el).find("input").val();
                    });
                });
            }
        });
        Vue.component('tags', {
            template: '#template-tags',
            props:[
                "domain",
                "value",
                "field",
            ],
            data: function () {
                return {
                    innerValue: '',
                    changes: 0,
                };
            },
            watch: {
                'value': function (value) {
                    this.innerValue = '';
                    this.refresh();
                }
            },
            computed: {
                selected: function() {
                    return this.getSelected(this.value);
                }
            },
            methods: {
                getSelected: function (value) {
                    var selected = [];
                    var self = this;
                    var values = this.getValues(value);
                    var options = {};
                    this.changes;
                    if(this.domain && typeof this.domain.forEach==='function') {
                        this.domain.forEach(function(option){
                            if(typeof option=='object') {
                                options[option.id] = self.getOptionText(option);
                            } else {
                                options[option] = self.getOptionText(option);
                            }
                        });
                    }

                    values.forEach(function(val){
                        selected.push({
                            value: val,
                            text: typeof options[val]!=='undefined'?options[val]:'',
                        });
                    });
                    return selected;
                },
                getOptionText: function (option) {
                    var self = this;
                    if(typeof option=='object') {
                        return typeof self.field.textField === 'function'
                            ? self.field.textField(option.attributes)
                            : option.attributes[self.field.textField];
                    } else {
                        return option;
                    }
                },
                clickControl: function (event) {
                    if(event.target.nodeName==='DIV') {
                        $(event.target.previousElementSibling).click();
                    }
                },
                getValues: function(value) {
                    if (value===undefined) {
                        value = this.value;
                    }
                    if (!value) {
                        return [];
                    } else if (typeof value.split==='function') {
                        return value.split(this.separator);
                    } else if (typeof value.forEach==='function') {
                        var values = [];
                        value.forEach(function(row) {
                            values.push(row.id);
                        });
                        return values;
                    } else {
                        return [];
                    }
                },
                setValues: function(values){
                    var self = this;
                    var value;
                    if (!this.value) {
                        value = values.join(this.separator);
                    } else if (typeof this.value.split==='function') {
                        value = values.join(this.separator);
                    } else if (typeof this.value.forEach==='function') {
                        value = [];
                        values.forEach(function(v) {
                            self.domain.forEach(function(option) {
                                if (option.id==v) {
                                    value.push(option);
                                }
                            });
                        });
                    }
                    this.$emit('input', value);
                    this.$emit('change', self.getSelected(value));
                },
                refresh: function() {
                    var self = this;
                    var values = this.getValues();
                    this.options = {};
                    this.changes++;
                },
                addLabel:function(newValue){
                    var values = this.getValues();
                    if(values.findIndex(function(e){return e==newValue})===-1) {
                        values.push(newValue);
                        this.setValues(values);
                    }
                    this.refresh();
                },
                removeLabel:function(oldValue){
                    var values = this.getValues();
                    if(values.findIndex(function(e){return e==oldValue})!==-1) {
                        values.splice(values.findIndex(function(e){return e==oldValue}), 1);
                        this.setValues(values);
                    } else {
                        throw "Tag not found id="+oldValue;
                    }
                    this.refresh();
                },
                isSelected:function(label){
                    var values = this.getValues();
                    return values.findIndex(function(e){return e==label})!==-1;
                },
                select: function(event) {
                    var value = event.target.value;
                    event.target.value = '';
                    this.addLabel(value);
                },
                remove: function(event) {
                    var value = event.currentTarget.getAttribute("value");
                    this.removeLabel(value);
                },
            },
            mounted: function () {
                var self = this;
                this.$$el = $(this.$el);
                this.separator = ',';
                this.options = {};
                self.refresh();
            }
        });
        </script>
    </body>
</html>
