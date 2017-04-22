<template>
    <table class="table table-striped table-hover" border="0" style="width: 100%;">
        <tr><th>Dimension</th><th>Valor</th></tr>
        <tr v-for="filter in filters"><td style="width: 50%;">
            <div class="form-group">
                <select class="form-control" :placeholder="field.label" v-model="filter.value" v-on:change="onChange">
                    <option value=""></option>
                    <option v-for="option in domain" v-bind:value="option.id">{{option.attributes[field.textField]}}</option>
                    <option v-bind:value="filter.value" hidden="">{{filter.value}}</option>
                </select>
            </div>
        </td><td style="width: 50%;">
            <div class="form-group filter-group">
                <select v-if="(domain.get(filter.value) || {relationships:{domains:[]}}).relationships.domains.length>0" class="form-control" :placeholder="field.label" v-model="filter.value2" v-on:change="onChange">
                    <option value=""></option>
                    <option v-for="option in (domain.get(filter.value) || {relationships:{domains:[]}}).relationships.domains" v-bind:value="option.id">{{option.attributes[field.textField]}}</option>
                    <option v-bind:value="filter.value2" hidden="">{{filter.value2}}</option>
                </select>
                <input v-if="(domain.get(filter.value) || {relationships:{domains:[]}}).relationships.domains.length==0" class="form-control" :placeholder="field.label" v-model="filter.value2" v-on:change="onChange">
                <button type="button" class="filter-close" v-on:click="clear(filter)">×</button>
            </div>
        </td></tr>
    </table>
</template>

<script>
    export default {
        props:[
            "model",
            "property",
            "domain",
            "field",
        ],
        data() {
            return {
                filters: [
                ],
                changes: 0,
            };
        },
        computed: {
        },
        methods: {
            onChange: function() {
                var res = [];
                this.filters.forEach(function (field) {
                    if (field.value) {
                        res.push([field.value,'=',field.value2]);
                    }
                });
                this.model[this.property] = JSON.stringify(res);
                this.$emit('change');
            },
            refresh: function() {
                var res = [];
                var self = this;
                try {
                    res = JSON.parse(this.model[this.property]);
                } catch(e) {}
                if (!res) {
                    res = [];
                }
                this.filters.length = 0;
                res.forEach(function (re) {
                    self.filters.push({label:"", value: re[0], value2: re[2]});
                });
                for(var i=res.length; i<3; i++) {
                    this.filters.push({label:"", value: "", value2: ""});
                }
            },
            clear: function(filter) {
                filter.value = '';
                filter.value2 = '';
                this.onChange();
            },
        },
        mounted() {
            var self = this;
            self.refresh();
        }
    }
</script>
