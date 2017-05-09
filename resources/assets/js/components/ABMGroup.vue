<template>
    <carousel>
        <carouselitem class="active">
            <datatablegroup :model="model" :groupField="groupField" :root="root" :typeField="typeField" :leafType="leafType" :nameField="nameField" v-on:newrecord="newRecord" v-on:editrecord="editRecord" v-on:selectrow="selectRow"></datatablegroup>
        </carouselitem>

        <carouselitem>
            <dv-form :model="model" v-on:cancel="cancelEdit" v-on:save="saveRow" v-on:update="updateRow" v-on:custom="custom" :childrenurl="childrenUrl" :buttons="buttons"></dv-form>
        </carouselitem>
        
        <carouselitem>
        </carouselitem>
    </carousel>
</template>

<script>
    export default {
        props:[
            "id",
            "model",
            "groupField",
            "root",
            "typeField",
            "leafType",
            "nameField",
            "childrenAssociation",
            "buttons",
        ],
        data: function(){
            return {
                childrenUrl: '',
                parentId: null,
                path: [[],[],[]],
            };
        },
        carousel:{},
        methods: {
            goto: function(viewId) {
                if(viewId===1) {
                    this.path[1]=new PathItem({name: this.model[this.nameField], item: 1}, this);
                } else {
                    this.path[1]=[];
                }
                if(viewId===2) {
                    this.path[2]=this.slot.path;
                } else {
                    this.path[2]=[];
                }
                app.pathChanged++;
                this.carousel.slider(viewId, this.path);
            },
            newRecord: function(id){
                var self=this;
                if(!id) {
                    this.childrenUrl='';
                } else {
                    this.childrenUrl='/'+id+'/'+this.childrenAssociation;
                }
                this.model.$load(0, function() {
                    self.goto(1);
                    self.$emit('new', self.model);
                });
            },
            editRecord: function(id){
                var self=this;
                this.model.$load(id, function() {
                    self.goto(1);
                    self.$emit('edit', self.model);
                });
            },
            selectRow: function(id){
                var self = this;
                this.parentId = id;
                this.model.$load(id, function(){
                    self.$root.$emit('changed', self);
                    self.$emit('selectrow', id);
                    //self.goto(2);
                });
            },
            cancelEdit: function(){
                this.goto(0);
                this.$emit('cancel', this.model);
            },
            saveRow: function(){
                this.model.$refreshList();
                this.goto(0);
                this.$emit('save', this.model);
            },
            updateRow: function(){
                this.model.$refreshList();
                this.$emit('update', this.model);
            },
            custom: function(button, model, form) {
                this.$emit(button, model, form);
            },
        },
        mounted: function() {
            var self = this;
            this.carousel = this.$children[0];
            this.datatablegroup = this.carousel.$children[0].$children[0];
            this.form = this.carousel.$children[1].$children[0];
            //this.slot = this.carousel.$children[2].$children[0];
            this.path[0]=this.datatablegroup.path;
        }
    }
</script>
