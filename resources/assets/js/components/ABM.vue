<template>
    <carousel>
        <carouselitem class="active">
            <datatable :model="model" v-on:newrecord="newRecord" v-on:selectrow="selectRow"></datatable>
        </carouselitem>

        <carouselitem>
            <dv-form :model="model" v-on:cancel="cancelEdit" v-on:save="saveRow"></dv-form>
            <slot :parentId="parentId"></slot>
        </carouselitem>
    </carousel>
</template>

<script>
    export default {
        props:[
            "id",
            "model",
            "filter",
            "nameField",
            "refreshWith",
        ],
        carousel:{},
        data: function(){
            return {
                path: [[new PathItem({name: this.model.$pluralName, item: 0}, this)],[]],
            };
        },
        methods: {
            goto: function(viewId) {
                if(viewId===1) {
                    this.path[1]=new PathItem({name: this.model[this.nameField], item: 1}, this);
                } else {
                    this.path[1]=[];
                }
                app.pathChanged++;
                this.carousel.slider(viewId);
            },
            newRecord: function(){
                this.model.$load(0);
                this.goto(1);
            },
            selectRow: function(id){
                var self = this;
                this.model.$load(id, function(){
                    self.$root.$emit('changed', self);
                    self.goto(1);
                });
            },
            cancelEdit: function(){
                this.goto(0);
            },
            saveRow: function(){
                this.model.$refreshList();
                this.goto(0);
            },
        },
        mounted: function() {
            var self = this;
            this.carousel = this.$children[0];
            this.datatable = this.carousel.$children[0].$children[0];
            this.$root.$on('changed', function(element){
                if(typeof element.id!=='undefined') {
                    if(element.id===self.refreshWith) {
                        self.datatable.refresh();
                    }
                }
            });
        }
    }
</script>
