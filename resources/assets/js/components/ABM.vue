<template>
                        <carousel>
                                <carouselitem class="active">
                                    <datatable :model="model" v-on:newrecord="newRecord" v-on:selectrow="selectRow"></datatable>
                                </carouselitem>

                                <carouselitem>
                                    <dv-form :model="model" v-on:cancel="cancelEdit" v-on:save="saveRow"></dv-form>
                                </carouselitem>
                        </carousel>
</template>

<script>
    export default {
        props:[
            "model",
        ],
        carousel:{},
        methods: {
            goto: function(viewId) {
                this.carousel.slider(viewId);
            },
            newRecord: function(){
                this.model.$load(0);
                this.goto(1);
            },
            selectRow: function(id){
                this.model.$load(id);
                this.goto(1);
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
        }
    }
</script>
