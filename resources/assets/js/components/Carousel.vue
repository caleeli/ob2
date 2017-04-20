<template>
    <div>
        <div>
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            "model",
        ],
        carousel:{},
        data() {
            return {
                "currentGroup": this.root,
                "path": [],
                "viewId":0,
            };
        },
        methods: {
            slider: function(viewId, path){
                this.path.lenght=0;
                //path.split("/").forEach(function(item){
                //    this.path.push({name:'',id:null});
                //});
                /*if(path) {
                    path.forEach(function(item){
                        this.path.push(item);
                    });
                }*/
                this.viewId = viewId;
                this.carousel.slider(viewId);
            },
            goto: function(item) {
                item.goto(this);
            }
        },
        mounted: function() {
            var self = this;
            var events = [];
            this.carousel = $(this.$el).children("div");
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
                        e.$emit(v);
                    });
                });
            });
        }
    }
</script>
