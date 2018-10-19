<template>
  <div class="ibox">
    <div class="ibox-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="m-b-md">
            <a href="#seguimientoDeTareas" class="btn btn-default btn-xs pull-right">
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
            <dt>Última actualización:</dt> <dd>{{tarea.updated_at}}</dd>
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

      <div class="tabs-container">
        <ul class="nav nav-tabs">
          <li v-for="(tab, index) in definicion" :class="{active: index == tarea.datos.actual}" @click="tarea.datos.actual=index">
              <a data-toggle="tab" :href="'#paso-' + index">
             <span class="tab-ellipsis">{{tab.titulo}}</span>
              <i v-show="index < tarea.datos.maximo" class="fa fa-check-square text-success" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div v-for="(tab, index) in definicion"
               class="tab-pane" :class="{active: index == tarea.datos.actual}"
               :id="'paso-' + index">
               <div class="panel-body">
              <h3>{{tab.titulo}}</h3>

              <folder-viewer v-bind:api="'/api/folder/tareas/' + tarea.id + '/' + (index+1)"
                             v-bind:target="'tareas/' + tarea.id + '/' + (index+1)"
                             v-bind:canupload='true'
                             v-bind:candelete='true'
                             v-bind:filter="''"
                             col="8"
                             v-bind:refresh="tarea.datos.actual != index"
                             >

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
                <br>
                <g-template
                    v-for="(botonPaso, formName) in botonesDePasoActual()"
                    v-show="botonHabilitadoPaso(formName, botonPaso, tarea.datos.actual)"
                    :templeta="botonPaso.template"
                    :name="botonPaso.name"
                    :tarea-id="tarea.id"
                    :paso="tarea.datos.actual"
                    :form="formName"
                    v-model="tarea.datos.data[tarea.datos.actual]"
                    v-on:click='abrirPasoAuditoria(formName, botonPaso, tarea.datos.actual)'
                    @change="saveGTemplate(botonPaso.name, $event)">
                  <i class="fa fa-save"></i> {{botonPaso.buttonTitle ? botonPaso.buttonTitle : formName}}
                </g-template>

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
          definicion: Array
      },
      methods: {
          save: function(path, data) {
              $.ajax({
                  method: 'put',
                  url: '/api/seguimiento/' + this.tarea.id + '/' + path,
                  data: JSON.stringify({
                      data: data
                  }),
                  dataType: 'json'
              });
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
          /**
           * True si this.tarea.datos.listoParaRevision !== true
           */
          pendienteRevision: function() {
              return this.tarea.datos.listoParaRevision !== true;
          },
          noPendienteRevision: function() {
              return !this.pendienteRevision();
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
</style>