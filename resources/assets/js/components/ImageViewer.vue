<template>
    <div class="row">
        <div class="ivTools">
            <input class="ivSearch" v-model="search" placeholder="buscar">
            <i class="fa fa-refresh ivRefresh" v-on:click="refresh"></i>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div v-for="row in list">
                <h4>{{row.attributes.name}}</h4>
                <div class="ntScroll">
                    <div v-for="item in relationships(row)" class="ntImage" :style="'background-image: url('+urlImage(item)+')'" v-on:click="clickImage(item)">
                        <label><p style="text-align: center;"><b>{{item.attributes.name}}</b></p>
                            <p>Fuente: {{item.attributes.information_source}}</p>
                            <p>Periodicidad: {{item.attributes.periodicity}}</p>
                            <p v-html="item.attributes.description"></p>
                        </label>
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
                "search": "",
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
            relationships: function(row) {
                var self = this;
                var list = [];
                var search = new RegExp(this.search.replace(/[^A-Za-z0-9_]/g, '\\$&').replace(/\s+/g,'|'), 'gi');
                this.children.split(",").forEach(function(child) {
                    row.relationships[child].forEach(function(item) {
                        if (item.attributes.name.match(search)) {
                            list.push(item);
                        }
                    });
                });
                return list;
            },
            urlImage: function (item) {
                return item.attributes.image ? (item.attributes.image.substr(0,4)=='http' ?
                    item.attributes.image :
                    API_SERVER+'/images/variables/'+item.attributes.image) : 'images/variables/report.png';
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
