<template>
  <button type="button" class="btn btn-primary btn-block" @click="click"><slot></slot></button>
</template>
<script>
  window.gtemplates = {
      saveData(uuid, valores, titulo) {
          this[uuid].value['titulo'] = titulo;
          this[uuid].value['valores'] = valores;
          this[uuid].self.$emit('change', this[uuid].value);
      }
  };
  export default {
      props: {
          value: Object,
          templeta: String,
          tareaId: Number,
          paso: Number,
          form: String,
          name: String
      },
      methods: {
          click() {
              if (this.templeta) {
                  this.open(this.templeta, this.tareaId, this.paso, this.form, this.name);
              } else {
                  this.$emit('click');
              }
          },
          open: function(templeta, tareaId, paso, form, name) {
              let uuid = this.uuid();
              if (!this.value[name]) {
                  this.value[name] = {
                      titulo: '',
                      valores: {},
                      gestion: '',
                      templeta: templeta
                  };
              }
              window.gtemplates[uuid] = {
                self: this,
                value: this.value[name]
              }
              window.open(
                      "/vue-editor/tarea/" +
                      encodeURIComponent(templeta) + "/" +
                      encodeURIComponent(tareaId) + "/" +
                      encodeURIComponent(paso) + "/" +
                      encodeURIComponent(form),
                      uuid
                      );
          },
          uuid() {
              function ra() {
                  return Math.floor((Math.random() + 1) * 0x10000)
                          .toString(16)
                          .substring(1);
              }
              return ra() + ra() + '-' + ra() + '-' + ra() + '-' + ra() + '-' + ra() + ra() + ra();
          }
      }
  }
</script>
