<template>
    <div class="form-control form-control-tags">
        <div style="position:absolute;left:0px;top:0px;min-width:100%;height:100%; padding: 11px; ">
            <select :placeholder="placeholder" style="position:absolute;left:0px;top:0px;width:100%;height:100%;opacity:0;"
                    v-on:change="select">
                <option v-for="option in domain" v-bind:value="typeof option=='object'?option.id:option" :hidden="isSelected(typeof option=='object'?option.id:option)">{{typeof option=='object'?option.attributes[field.textField]:option}}</option>
                <option value="" hidden=""></option>
            </select>
            <span v-for="option in selected" class="label label-tag" :value="option.value" style="position:relative;" v-on:click="remove">{{option.text}} <i class="glyphicon glyphicon-remove"></i></span>
        </div>
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
                        if(typeof option=='object') {
                            options[option.id] = option.attributes[self.field.textField];
                        } else {
                            options[option] = option;
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
            }
        },
        methods: {
            clickControl: function (event) {
                if(event.target.nodeName==='DIV') {
                    $(event.target.previousElementSibling).click();
                }
            },
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
                }
                this.$emit('change');
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
        mounted() {
            var self = this;
            this.$$el = $(this.$el);
            this.separator = ',';
            this.options = {};
            self.refresh();
        }
    }
</script>
