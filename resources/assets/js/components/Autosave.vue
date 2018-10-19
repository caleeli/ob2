<template>
  <span>
    <slot :data="data" :log="logs" :saved="saved" :diff="diff" :dirty="dirty"></slot>
  </span>
</template>

<script>
  export default {
      props: {
          'data': Object,
          'endpoint': Object,
          'follow': Array,
          'prepareSave': Function
      },
      data() {
          return {
              logs: [],
              saved: {},
              dirty: false
          };
      },
      computed: {
          diff() {
              let self = this;
              let diff = {};
              let dirty = false;
              for (let i in this.follow) {
                  let path = this.follow[i];
                  let current = this.getValueOf(path.split('.'), this.data);
                  let saved = this.getValueOf(path.split('.'), this.saved);
                  let different = JSON.stringify(current) !== JSON.stringify(saved);
                  diff[path] = different;
                  dirty = dirty | different;
              }
              this.dirty = dirty;
              if (dirty) {
                  setTimeout(function() {
                      self.save();
                  }, 1000);
              }
              return diff;
          }
      },
      watch:{
        'data.pasos':{
          deep:true,
          handler(val){
            console.log('Datos actualizados', val);
          }
        }
      },
      methods: {
          save() {
              const self = this;
              this.logs.splice(0);
              let api = Object.assign({}, this.endpoint, {
                  dataType: 'json',
                  sucess(response) {
                      self.saved = response;
                  },
                  error(xhr, ajaxOptions, thrownError) {
                      self.log(thrownError);
                  }
              });
              api = this.prepareSave instanceof Function ? this.prepareSave(api, this.data) : api;
              if (api) {
                //$.ajax(api);
              }
          },
          log(msg) {
              this.logs.push(msg);
          },
          getValueOf(path, o) {
              var a;
              return path.length && o instanceof Object ? (a = path.shift(), this.getValueOf(path, o[a])) : o;
          }
      }
  }
</script>
