<template>
    <form>
        <div class="form-group" v-for="field in fields">
            <label>{{field.label}}</label>
            <input type="text" class="form-control" :placeholder="field.label" v-model="values[field.value]">
        </div>
        <button type="button" v-on:click="reset" class="btn btn-default">Reestablecer</button>
        <button type="button" v-on:click="cancel" class="btn btn-warning">Cancelar</button>
        <button type="button" v-on:click="save" class="btn btn-success">Guardar</button>
    </form>
</template>

<script>
    export default {
        props:[
            "model",
        ],
        data() {
            window.model = this.model;
            return {
                fields: this.model.$fields(),
                values: this.model,
            };
        },
        computed: {
        },
        methods: {
            reset: function() {
                this.model.$reset();
                this.$emit('reset');
            },
            cancel: function() {
                this.$emit('cancel');
            },
            save: function() {
                this.model.$save();
                this.$emit('save');
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
                vm.$forceUpdate();
            });
        }
    }
</script>
