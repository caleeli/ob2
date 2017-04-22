<template>
    <div class="row">
        <i class="fa fa-refresh ivRefresh" v-on:click="refresh"></i>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div v-for="row in list">
                <h4>{{row.attributes.name}}</h4>
                <div class="ntScroll">
                    <div v-for="item in row.relationships[children]" class="ntImage" :style="'background-image: url('+urlImage(item)+')'" v-on:click="clickImage(item)">
                        <label>{{item.attributes.name}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseComponent from './BaseComponent.js';
    export default BaseComponent.extend({
        data:function() {
            return {
                "list": [],
            };
        },
        props:[
            "model",
            "children",
            "id",
            "refreshWith",
        ],
        computed: {
        },
        methods: {
            urlImage: function (item) {
                return item.attributes.image ? (item.attributes.image.substr(0,4)=='http' ?
                    item.attributes.image :
                    API_SERVER+'/images/variables/'+item.attributes.image) : 'images/variables/33.jpg';
            },
            refresh: function (){
                var self = this;
                self.list.length = 0;
                self.model.$select(function (data) {
                    data.data.forEach(function(row) {
                        self.list.push(row);
                    });
                });
            },
            clickImage: function (item) {
                this.$emit('clickImage', item);
            },
        }
    });
</script>
