<template>
    <div class="form-control" style="height: auto; position:relative; min-height: 45px;">
        <select :placeholder="placeholder" style="position:absolute;left:0px;top:0px;width:100%;height:100%;opacity:0;"
                v-on:change="select">
            <option v-for="option in domain" v-bind:value="option.id" :hidden="isSelected(option.id)">{{option.attributes[field.textField]}}</option>
            <option value="" hidden=""></option>
        </select>
        <span v-for="option in selected" class="label label-tag" :value="option.value" style="position:relative;" v-on:click="remove">{{option.text}} <i class="glyphicon glyphicon-remove"></i></span>
    </div>
</template>

<script>
    export default {
        props:[
            "placeholder",
            "model",
            "property",
            "domain",
            "field",
        ],
        data() {
            return {
                changes: 0,
            };
        },
        computed: {
            selected: function() {
                var selected = [];
                var self = this;
                var values = this.getValues();
                var options = {};
                this.changes;
                if(this.domain && typeof this.domain.forEach==='function') {
                    this.domain.forEach(function(option){
                        options[option.id] = option.attributes[self.field.textField];
                    });
                }

                values.forEach(function(val){
                    selected.push({
                        value: val,
                        text: typeof options[val]!=='undefined'?options[val]:'',
                    });
                });
                return selected;
            }
        },
        methods: {
            getValues: function() {
                var value = this.model[this.property];
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
                var value = this.model[this.property];
                if (!value) {
                    this.model[this.property] = values.join(this.separator);
                } else if (typeof value.split==='function') {
                    this.model[this.property] = values.join(this.separator);
                } else if (typeof value.forEach==='function') {
                    this.model[this.property].length = 0;
                    values.forEach(function(value) {
                        self.domain.forEach(function(option) {
                            if (option.id==value) {
                                self.model[self.property].push(option);
                            }
                        });
                    });
                } else {
                    return [];
                }
            },
            refresh: function() {
                var self = this;
                var values = this.getValues();
                this.options = {};
                /*this.joptions = this.$$el.find("select option");
                this.joptions.each(function(){
                    if(typeof self.options[this.getAttribute("value")]==='undefined'){
                        self.options[this.getAttribute("value")] = this.textContent;
                        $(this).prop("hidden", values.indexOf(this.getAttribute("value"))!==-1);
                    } else {
                        $(this).prop("hidden", true);
                    }
                });*/
                this.changes++;
            },
            addLabel:function(newValue){
                var values = this.getValues();
                if(values.indexOf(newValue)===-1) {
                    values.push(newValue);
                    this.setValues(values);
                }
                this.refresh();
            },
            removeLabel:function(oldValue){
                var values = this.getValues();
                if(values.indexOf(oldValue)!==-1) {
                    values.splice(values.indexOf(oldValue), 1);
                    this.setValues(values);
                }
                this.refresh();
            },
            isSelected:function(label){
                var values = this.getValues();
                return values.indexOf(label)!==-1;
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
        mounted() {
            var self = this;
            this.$$el = $(this.$el);
            this.separator = ',';
            this.options = {};
            self.refresh();
        }
    }
</script>
