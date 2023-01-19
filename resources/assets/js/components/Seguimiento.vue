<template>
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-b-md">
                        <a href="#seguimientoDeTareas" @click="salir" class="btn btn-default btn-xs pull-right">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                            Volver
                        </a>
                        <h2>{{tarea.nombre_tarea}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <dl class="dl-horizontal">
                        <dt>Estado:</dt> <dd><span class="label label-primary">{{tarea.estado}}</span></dd>
                        <div style="height: 4px;"></div>
                        <dt>Prioridad:</dt>
                        <dd>
                            <p class="small font-bold">
                                <span><i v-bind:class="{'fa fa-circle':true, 'text-danger':tarea.prioridad=='Alta', 'text-warning':tarea.prioridad=='Media', 'text-primary':tarea.prioridad=='Baja'}"></i> {{tarea.prioridad}}</span>
                            </p>
                        </dd>
                        <dt>Creado por:</dt>
                        <dd>
                        <avatar class="avatar1em" :user="tarea.creador"/>
                        {{tarea.creador ? tarea.creador.attributes.nombres + ' ' + tarea.creador.attributes.apellidos : ''}}
                        </dd>
                        <dt>Asignado a:</dt>
                        <dd>
                            <template v-for="usuario in usuariosAsignados(tarea.usuarios)">
                                <avatar class="avatar1em" :user="usuario"/>
                                {{usuario ? usuario.attributes.nombres + ' ' + usuario.attributes.apellidos : ''}}
                                <br />
                            </template>
                        </dd>
                    </dl>
                </div>
                <div class="col-lg-7" id="cluster_info">
                    <dl class="dl-horizontal">

                        <dt>Creación:</dt> <dd>{{tarea.created_at}}</dd>
                        <dt>Última modificación:</dt> <dd>{{tarea.updated_at}}</dd>
                        <dt></dt> <dd><avatar class="avatar1em" :user="tarea.usuarioAbm"/> {{tarea.usuarioAbm ? tarea.usuarioAbm.attributes.nombres + ' ' + tarea.usuarioAbm.attributes.apellidos : ''}}</dd>
                        <dt>Tiempo asignado:</dt> <dd>{{tarea.dias_otorgados}} días</dd>
                        <dt>Tiempo restante:</dt> <dd>{{Math.max(0, tarea.dias_otorgados - tarea.dias_pasados)}} días</dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a v-for="enlace in tarea.enlaces" class="text-info"><i class="fa fa-book"></i> {{enlace.attributes.nombre_tarea}}</a>
                </div>
            </div>
            <div class="tabs-container" v-if="tarea.datos">
                <ul class="nav nav-tabs">
                    <li v-for="(tab, index) in definicion" :class="{active: index == tarea.datos.actual, done: index < tarea.datos.maximo, actual: index == tarea.datos.maximo}" @click="cambiarAPaso(index)">
                        <a data-toggle="tab" :href="'#paso-' + index">
                       <span class="tab-ellipsis">{{tab.titulo}}</span>
                        </a>
                    </li>
                    <li v-if="tarea.datos.maximo >= definicion.length" class="done" :class="{active: definicion.length == tarea.datos.actual}" @click="cambiarAPaso(definicion.length)">
                        <a data-toggle="tab" href="'#tarea-completado">
                            <span class="tab-ellipsis">Completado</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div v-if="tarea.datos.maximo >= definicion.length"
                         id="tarea-completado"
                         class="tab-pane"
                         :class="{active: tarea.datos.actual >= definicion.length}">
                        <div class="panel-body">
                            <h1><i class="fa fa-check-circle"></i> Completado</h1>
                        </div>
                    </div>
                    <div v-for="(tab, index) in definicion"
                         v-if="tarea.datos.data[tarea.datos.actual]"
                         class="tab-pane" :class="{active: index == tarea.datos.actual}"
                         :id="'paso-' + index">
                         <div class="panel-body">
                            <h3>
                                {{tab.titulo}}
                                <span style="float: right;">
                                    <!--  @click="descompletarPaso(index)" -->
                                    <button class="btn btn-primary dim" :disabled="readonly" type="button" v-if="index < tarea.datos.maximo">
                                        Completado
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                    <template v-else>
                                        <button v-if="index>0" class="btn btn-warning dim" type="button" @click="volverPaso(index)">
                                            Volver
                                            <i class="fa fa-arrow-circle-left"></i>
                                        </button>
                                        <button class="btn btn-success dim" type="button" @click="completarPaso(index)">
                                            Completar
                                            <i class="fa fa-square-o"></i>
                                        </button>
                                    </template>
                                </span>
                            </h3>

                            <folder-viewer v-bind:api="'/api/folder/tareas/' + tarea.id + '/' + (index+1)"
                                           v-bind:target="'tareas/' + tarea.id + '/' + (index+1)"
                                           v-bind:canupload='!readonly'
                                           v-bind:candelete='!readonly'
                                           v-bind:filter="''"
                                           col="8"
                                           v-bind:refresh="tarea.datos.actual != index"
                                           >
                                <div :class='dataStepClass'>
                                <div>
                                    <label>Fecha</label>
                                    <fecha v-model="tarea.datos.data[tarea.datos.actual].fecha"
                                           @change="save('data.'+tarea.datos.actual+'.fecha', tarea.datos.data[tarea.datos.actual].fecha)"/>
                                </div>
                                <div>
                                    <label>Descripción</label>
                                    <tinymce v-model='tarea.datos.data[tarea.datos.actual].descripcion' plugins="table" height="10em"
                                             @change="save('data.'+tarea.datos.actual+'.descripcion', tarea.datos.data[tarea.datos.actual].descripcion)"/>
                                </div>
                                </div>
                                <br>
                                <template v-for="(botonPaso, formName) in botonesDePasoActual()">
                                    <g-template
                                        ref="gtemplate"
                                        v-if="botonPaso.template"
                                        v-show="botonHabilitadoPaso(formName, botonPaso, tarea.datos.actual)"
                                        :templeta="botonPaso.template"
                                        :name="botonPaso.name"
                                        :tarea-id="tarea.id"
                                        :paso="tarea.datos.actual"
                                        :form="formName"
                                        :disabled="readonly"
                                        v-model="tarea.datos.data[tarea.datos.actual]"
                                        v-on:click='abrirPasoAuditoria(formName, botonPaso, tarea.datos.actual)'
                                        @change="saveGTemplate(botonPaso.name, $event)">
                                        <i class="fa fa-save"></i> {{botonPaso.buttonTitle ? botonPaso.buttonTitle : formName}}
                                    </g-template>
                                    <button v-else
                                            :disabled="readonly"
                                            v-show="botonHabilitadoPaso(formName, botonPaso, tarea.datos.actual)"
                                            type="button" class="btn btn-primary btn-block"
                                            v-on:click='ejecutarAccion(formName, botonPaso, tarea.datos.actual)'>
                                        {{botonPaso.buttonTitle ? botonPaso.buttonTitle : formName}}
                                    </button>
                                </template>
                            </folder-viewer>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            tarea: Object,
            definicion: {
                type: Array,
                default: function () {
                    return [];
                }
            },
            readonly: Boolean,
        },
        computed: {
            dataStepClass: function () {
                return this.readonly ? 'disableEdition' : '';
            }
        },
        watch: {
            tarea: {
                deep: true,
                handler: function(tarea) {
                    this.completarTarea(tarea);
                }
            }
        },
        data: function() {
            return {
                saveQueue: [],
                saving: false
            };
        },
        methods: {
            salir: function() {
                if (this.$refs.gtemplate instanceof Array) {
                    this.$refs.gtemplate.forEach(function(gtemplate) {
                        gtemplate.close();
                    });
                }
                this.$emit('salir');
            },
            cambiarAPaso: function(index) {
                this.setSaveDato('actual', index);
            },
            ejecutarAccion: function(name, def, paso) {
                if (def.action && this[def.action] instanceof Function) {
                    return this[def.action](paso);
                } else {
                    throw JSON.stringify(typeof this[def.action]) + ' is not a function';
                }
            },
            volverPaso: function(index) {
                this.setSaveDato('maximo', Math.min(this.tarea.datos.maximo, index - 1));
                this.setSaveDato('actual', index - 1);
            },
            descompletarPaso: function(index) {
                this.setSaveDato('maximo', index);
                this.setSaveDato('actual', index);
            },
            completarPaso: function(index) {
                this.setSaveDato('maximo', index + 1);
                this.setSaveDato('actual', index + 1);
            },
            completarTarea: function(tarea) {
                this.reactiveSet(tarea, 'datos', tarea.datos, {});
                this.reactiveSet(tarea.datos, 'data', tarea.datos.data, []);
                this.reactiveSet(tarea.datos, 'actual', tarea.datos.actual, 0);
                this.reactiveSet(tarea.datos, 'subpaso4', tarea.datos.subpaso4, 0);
                this.reactiveSet(tarea.datos, 'maximo', tarea.datos.maximo, 1);
                this.reactiveSet(tarea.datos, 'listoParaRevision', tarea.datos.listoParaRevision, false);
                for (var i in this.definicion) {
                    tarea.datos.data[i] = !tarea.datos.data[i] ? {
                        fecha: '',
                        descripcion: ''
                    } : tarea.datos.data[i];
                }
            },
            setSaveDato: function(prop, value, defaultValue) {
                this.reactiveSet(this.tarea.datos, prop, value, defaultValue);
                this.save(prop, value);
            },
            reactiveSet: function(obj, prop, value, defaultValue) {
                if (prop instanceof Array) {
                    var att = prop.shift();
                    if (prop.length === 0) {
                        const descriptor = Object.getOwnPropertyDescriptor(obj, att);
                        value = value !== undefined ? value : (descriptor ? obj[att] : defaultValue);
                        value = value === null ? defaultValue : value;
                        if (descriptor && !(descriptor.get instanceof Function)) {
                            delete obj[att];
                            Vue.set(obj, att, value);
                        } else if (descriptor && obj[att] !== value) {
                            Vue.set(obj, att, value);
                        } else if (!descriptor) {
                            Vue.set(obj, att, value);
                        }
                    } else {
                        this.reactiveSet(obj, att, isNaN(prop[0]) ? {} : []);
                        return this.reactiveSet(obj[att], prop, value, defaultValue);
                    }
                } else {
                    var asArray = prop.split('.');
                    return this.reactiveSet(obj, asArray, value, defaultValue);
                }
            },
            save: function(path, data) {
                this.saveQueue.push([path, data]);
                this.doSaving();
            },
            doSaving: function() {
                if (!this.saving && this.saveQueue.length > 0) {
                    var self = this;
                    $.ajax({
                        method: 'put',
                        url: '/api/seguimiento/' + this.tarea.id + '/' + this.saveQueue[0][0],
                        data: JSON.stringify({
                            data: this.saveQueue[0][1]
                        }),
                        dataType: 'json',
                        success: function() {
                            self.saveQueue.shift();
                            self.saving = false;
                            self.doSaving();
                        },
                        error: function(xhr) {
                            if (confirm("No se pudo guardar el ultimo cambio. ¿Reintentar?\nERROR:\n" + xhr.responseText.substr(0, 25))) {
                                self.saving = false;
                                self.doSaving();
                            }
                        }
                    });
                }
            },
            saveGTemplate: function(name, data) {
                this.save('data.' + this.tarea.datos.actual + '.' + name, data);
            },
            usuariosAsignados: function(tareaUsuarios) {
                var usuarios = tareaUsuarios && tareaUsuarios instanceof Array ? tareaUsuarios : [];
                var asignados = [];
                usuarios.forEach(function(usuario) {
                    if (!asignados.find(function(u) {
                        return u.id === usuario.id;
                    })) {
                        asignados.push(usuario);
                    }
                });
                return asignados;
            },
            botonesDePasoActual: function() {
                return this.definicion &&
                        this.definicion[this.tarea.datos.actual] ?
                        this.definicion[this.tarea.datos.actual].buttons : [];
            },
            botonHabilitadoPaso: function(name, def, paso) {
                var self = this;
                if (def.condition) {
                    return this[def.condition]();
                }
                return true;
            },
            ////////////////////////////////////////////////////////////////////
            /**
             * True si this.tarea.datos.listoParaRevision !== true
             */
            pendienteRevision: function() {
                return this.tarea.datos.maximo <= 4;
                //return this.tarea.datos.listoParaRevision !== true;
            },
            /**
             * True si this.tarea.datos.listoParaRevision === true
             */
            noPendienteRevision: function() {
                return this.tarea.datos.maximo > 4;
                //return !this.pendienteRevision();
            },
            /**
             * Se activa cuando se le da click en el boton "Pasar a revision"
             */
            revisarHoja: function(index) {
                this.setSaveDato('maximo', Math.max(this.tarea.datos.maximo, index + 1));
                this.setSaveDato('actual', index + 1);
                //this.setSaveDato('listoParaRevision', true);
            },
            /**
             * Se activa cuando se le da click en el boton "Volver a editar"
             */
            volverEdicionHoja: function(index) {
                this.setSaveDato('maximo', Math.min(this.tarea.datos.maximo, index - 1));
                this.setSaveDato('actual', index - 1);
                //this.pasos.listoParaRevision = false;
                //this.pasos.actual--;
            }
        }
    }
</script>
<style scoped>
    .tab-ellipsis {
        width: 6em;
        text-overflow: ellipsis;
        overflow: hidden;
        display: inline-block;
        white-space: nowrap;
    }
    .done a {
        background-color: rgba(26, 179, 148, 0.2)!important;
    }
    .actual a {
        background-color: rgba(28, 132, 198, 0.2)!important;
    }
    .active.done a {
        background-color: rgba(26, 179, 148, 0.5)!important;
    }
    .active.actual a {
        background-color: rgba(28, 132, 198, 0.5)!important;
    }
    .disableEdition {
        pointer-events: none;
        opacity: 0.8;
    }
</style>
