<template>
    <div class="class">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props:[
            "class",
            "activate",
            "map"
        ],
        carousel:{},
        viewId:0,
        methods: {
            active: function(){
                console.log(this.viewId);
                this.carousel.slider(this.viewId);
            },
            setViewId: function(carousel, id) {
                this.carousel = carousel;
                this.viewId = id;
            }
        },
        mounted: function() {
            var evn;
            var self = this;
            for(evn in this.map) {
                this.$children.forEach(function(e){
                    e.$on(evn, function(){
                        console.log("evento: "+evn);
                        self.$emit(self.map[evn]);
                        self.$parent.$emit(self.map[evn]);
                    });
                });
            }
            console.log("registro: "+this.activate,self);
            self.$on(this.activate, function(){
                console.log("catch " + self.activate);
                self.active();
            });
        }
    }
</script>
