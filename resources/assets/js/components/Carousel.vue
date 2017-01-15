<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props:[
            "model",
        ],
        carousel:{},
        methods: {
            slider: function(viewId){
                this.carousel.slider(viewId);
            }
        },
        mounted: function() {
            var self = this;
            var events = [];
            this.carousel = $(this.$el);
            this.carousel.slider();
            this.$children.forEach(function(e,i){
                var evn;
                e.setViewId(self.carousel, i);
                for(evn in e.map) {
                    if(events.indexOf(e.map[evn])==-1) {
                        events.push(e.map[evn]);
                    }
                }
            });
            this.$children.forEach(function(e){
                events.forEach(function(v){
                    self.$on(v, function(){
                        console.log("emit: "+v, e);
                        e.$emit(v);
                    });
                });
            });
        }
    }
</script>
