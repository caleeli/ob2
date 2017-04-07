<template>
    <div class="class" :id="id">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props:[
            "class",
            "activate",
            "map",
            "id",
        ],
        carousel:{},
        viewId:0,
        methods: {
            active: function(){
                this.carousel.slider(this.viewId);
            },
            setViewId: function(carousel, id) {
                this.carousel = carousel;
                this.viewId = id;
            },
            focus: function() {
                if(!$(this.$el).is(":visible")) {
                    var index = this.$parent.$children.indexOf(this);
                    this.$parent.$parent.goto(index);
                }
            },
        },
        mounted: function() {
            var evn;
            var self = this;
            for(evn in this.map) {
                this.$children.forEach(function(e){
                    e.$on(evn, function(){
                        self.$emit(self.map[evn]);
                        self.$parent.$emit(self.map[evn]);
                    });
                });
            }
            self.$on(this.activate, function(){
                self.active();
            });
        }
    }
</script>
