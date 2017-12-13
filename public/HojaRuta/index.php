<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
                    <a href='#recepcion' class='btn btn-primary' v-on:click='nueva' v-if="!window.isManager">Recepción</a>
                    <a href='#busqueda' class='btn btn-info' v-if="!window.isManager">Búsqueda</a>
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
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="#com_interna" class="btn btn-ligth_green" v-on:click='nuevaNota' v-if="!window.isManager">Comunicación Interna</a>

                        <button type="button" class="btn btn-ligth_green dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span> <!-- caret -->
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>

                        <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                            <li><a href="#nota_oficio" v-on:click='nuevaNota' v-if="!window.isManager">Registrar</a></li>
                            <li><a href="#nota_busqueda">Búsqueda</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-10" v-if="menu=='recepcion'">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Hoja de ruta - SCEP</legend>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Tipo</label>
                                <div class="col-lg-10">
                                    <div class="radio">
                                      <label><input type="radio" name="optradio" value="interna" v-model="hoja.tipo">Interna</label>
                                    </div>
                                    <div class="radio">
                                      <label><input type="radio" name="optradio" value="externa" v-model="hoja.tipo">Externa</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha de recepción</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' v-model="hoja.fecha" class="form-control" />
                                            <span class="input-group-addon" v-on:click='datepick'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Referencia</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" v-model="hoja.referencia" rows="3" id="textArea"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Procedencia</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="hoja.procedencia" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nº de control</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="hoja.nroDeControl" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Anexo hojas</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="hoja.anexoHojas" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Destinatario</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="hoja.destinatario" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" v-on:click="generar" class="btn btn-primary">Guardar</button>
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
                            <legend>Nota Expedida</legend>
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
                            <legend>Nota Expedida</legend>
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
                                    <input type="text" v-model="nota.hoja_de_ruta" class="form-control" placeholder="">
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
                                    <button type="button" disabled v-on:click="generarNota" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-10" v-if="menu=='editar'">
                    <form class="form-horizontal" v-if="!window.isManager">
                        <fieldset>
                            <legend>Hoja de ruta - SCEP </legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tipo</label>
                                <div class="col-lg-10">
                                    <input type="text" disabled="disabled" v-model="hoja.tipo" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Fecha</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date'>
                                            <input type='text' disabled1="disabled" v-model="hoja.fecha" class="form-control" />
                                        </div>
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
                                    <input type="text" disabled1="disabled" v-model="hoja.nroDeControl" class="form-control" placeholder="">
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
                                    <input type="text" disabled1="disabled" v-model="hoja.destinatario" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" v-on:click="generar" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                            <div v-if="!concluido()">
                            <h2>Derivaciones</h2>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Fecha</label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker3'>
                                            <input type='text' :disabled="concluido()" v-model="derivacion.fecha" class="form-control" />
                                            <span class="input-group-addon" v-on:click='datepick3'>
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
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
                                    <input type="text" :disabled="concluido()" v-model="derivacion.destinatario" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Instrucción</label>
                                <div class="col-lg-10">
                                    <input type="text" :disabled="concluido()" v-model="derivacion.instruccion" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" :disabled="concluido()" v-on:click="saveDerivation" class="btn btn-primary">Registrar</button>
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
                                <td>{{derivacion.fecha}}</td>
                                <td>{{derivacion.destinatario}}</td>
                                <td>{{derivacion.comentarios}}</td>
                                <td>{{derivacion.instruccion}}</td>
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
                                <th># Control</th>
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
                                <td>{{hoja.nroDeControl}}</td>
                                <td>{{hoja.referencia}}</td>
                                <td>{{hoja.procedencia}}</td>
                                <td>{{hoja.destinatario}}</td>
                                <td>{{hoja.fecha}}</td>
                                <td><label :class="hoja.color()">{{hoja.concluido()?hoja.conclusion:'PENDIENTE'}}</label></td>
                                <td><a href='#editar' class='btn btn-default' v-on:click='abrir(hoja)'>Abrir</a></td>
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
            </div>
        </div>
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
            this.load(values);
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
            return Math.floor(workday_count(from, to));
        }
        function Derivacion(values) {
            this.id = null,
            this.hoja_ruta_id = '',
            this.fecha = '',
            this.destinatario = '',
            this.comentarios = '',
            this.instruccion = '';
            this.load(values);
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
                        notasBusqueda: [],
                        derivacion: new Derivacion(),
                        derivaciones: [],
                        filtroDerivacion: '',
                    };
                },
                methods: {
                    nueva: function () {
                        this.hoja.id = null;
                        this.hoja.fecha = '';
                        this.hoja.referencia = '';
                        this.hoja.procedencia = '';
                        this.hoja.nroDeControl = '';
                        this.hoja.anexoHojas = '';
                        this.hoja.destinatario = '';
                        this.hoja.fechaAuditor = '';
                        this.hoja.conclusion = '';
                        this.hoja.tipo = 'interna';
                    },
                    save: function(callback) {
                        var self = this;
                        var o = this.hoja;
                        $.ajax({
                            method: 'get',
                            url: 'save.php',
                            data: {
                                id: o.id ? o.id: '',
                                tipo: o.tipo,
                                fecha: o.fecha,
                                referencia: o.referencia,
                                procedencia: o.procedencia,
                                nro_de_control: o.nroDeControl,
                                anexo_hojas: o.anexoHojas,
                                destinatario: o.destinatario,
                                conclusion: o.conclusion,
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
                    nuevaNota: function() {
                        
                    },
                    saveDerivation: function(callback) {
                        var self = this;
                        var o = this.derivacion;
                        $.ajax({
                            method: 'get',
                            url: 'saveDerivacion.php',
                            data: {
                                id: o.id ? o.id: '',
                                hoja_ruta_id: self.hoja.id,
                                fecha: o.fecha,
                                comentarios: o.comentarios,
                                destinatario: o.destinatario,
                                instruccion: o.instruccion,
                                t: new Date().getTime()
                            },
                            dataType: 'json',
                            success: function () {
                            }
                        }).done(function() {
                            self.filtroDerivacion = '';
                            self.hoja.selectDerivations(self.derivaciones, self.filtroDerivacion);
                            if (typeof callback==='function') {
                                callback();
                            }
                            self.derivacion.load({
                                id:'',
                                fecha: '',
                                destinatario: '',
                                comentarios: '',
                                instruccion: '',
                            });
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
                        this.save(function () {
                            self.filtrar();
                        });
                        window.location.hash="#busqueda";
                        
                        /*Vue.nextTick(function () {
                            setTimeout(function (){
                                window.print();
                            }, 100);
                        });*/
                    },
                    generarNota: function() {
                        var self = this;
                        self.saveNota(function () {
                            self.filtrarNota();
                        });
                        window.location.hash="#nota_busqueda";
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
                                t: Math.floor(new Date().getTime()/1000)
                            },
                            dataType: 'json',
                            success: function (res) {
                                self.hojasDeRutaBusqueda.splice(0);
                                res.forEach(function (o) {
                                    self.hojasDeRutaBusqueda.push(new Recepcion({
                                        id: o.id,
                                        tipo: o.tipo,
                                        fecha: o.fecha,
                                        referencia: o.referencia,
                                        procedencia: o.procedencia,
                                        nroDeControl: o.nro_de_control,
                                        anexoHojas: o.anexo_hojas,
                                        destinatario: o.destinatario,
                                        conclusion: o.conclusion,
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
                        this.hoja.load(hoja);
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
                },
                mounted: function () {
                    var self = this;
                    //this.loadHojas();
                    this.filtrar();
                    this.filtrarNota();
                    menu=window.location.hash.substr(1);
                    this.menu=menu?menu:(window.isManager?'busqueda':'recepcion');
                    self.dibujarDashboard();
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
        </script>
    </body>
</html>
