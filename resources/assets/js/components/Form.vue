<template>
    <form>id:{{id}}
        <div class="form-group" v-for="field in fields">
            <label>{{field.label}}</label>
            <input  v-if="field.type==='text'" type="text" class="form-control" :placeholder="field.label" v-model="values[field.value]" v-on:change="change">
            <input  v-if="field.type==='password'" type="password" class="form-control" :placeholder="field.label" v-model="values[field.value]" v-on:change="change">
            <input  v-if="field.type==='email'" type="email" class="form-control" :placeholder="field.label" v-model="values[field.value]" v-on:change="change">
            <select v-if="field.type==='select'" class="form-control" :placeholder="field.label" v-model="values[field.value]" v-on:change="change">
                <option v-for="option in domains[field.name]" v-bind:value="option.id">{{option.attributes[field.textField]}}</option>
                <option v-bind:value="values[field.value]" hidden="">{{values[field.value]}}</option>
            </select>
            <tags v-if="field.type==='tags'" :placeholder="field.label" :model="values" :property="field.value" :domain="domains[field.name]" :field="field" v-on:change="change">
            </tags>
            <filters v-if="field.type==='filter'" :placeholder="field.label" :model="values" :property="field.value" :domain="domains[field.name]" :field="field"  v-on:change="change"/>
        </div>
        <!-- button type="button" v-on:click="reset" class="btn btn-default">Reestablecer</button -->
        <button type="button" v-on:click="cancel" class="btn btn-warning">Cancelar11</button>
        <button type="button" v-on:click="save" class="btn btn-success">Guardar</button>
    </form>
</template>

<script>
    export default {
        props:[
            "id",
            "model",
            "childrenurl",
        ],
        data() {
            var self = this;
            var fields = this.model.$fields();
            var domains = {};
            fields.forEach(function(f){
                domains[f.name] = self.model.$domain(f, function(domain) {
                });
            });
            return {
                fields: fields,
                values: this.model,
                domains: domains,
            };
        },
        computed: {
        },
        methods: {
            reset: function() {
            window.aaa=this.model;
                this.model.$reset();
                this.$emit('reset');
            },
            cancel: function() {
                this.$emit('cancel');
            },
            save: function() {
                var self = this;
                this.model.$save(this.childrenurl, function(){
                    self.$emit('save');
                });
            },
            change: function() {
                var self = this;
                console.log('changed', self);
                self.$root.$emit('changed', self);
            },
        },
        mounted() {
            var vm = this;
            this.model.setCallback(function(){
                var fields = vm.fields;
                var ff = vm.model.$fields();
                fields.length = 0;
                for(var a in ff) {
                    if(typeof ff[a]!=='function') {
                        fields.push(ff[a]);
                    }
                }
                fields.forEach(function(f){
                    vm.domains[f.name].refresh(function() {
                    });
                });
                vm.$forceUpdate();
                vm.$children.forEach(function(ch){
                    if(typeof ch.refresh==='function'){
                        ch.refresh();
                    }
                });
            });
        }
    }
</script>
