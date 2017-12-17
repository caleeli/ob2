<template>
    <div class="row">
        <div v-if="!viewR" class="ivTools">
            <input class="ivSearch" v-model="search" placeholder="buscar">
            <i class="fa fa-refresh ivRefresh" v-on:click="refresh"></i>
        </div>
        <div v-if="!viewR" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4><br></h4><br>
            <div v-for="row in list">
                <h4 class="variables-header">{{row.attributes.name}}</h4>
                <div class="ntScroll">
                    <div v-for="item in relationships(row)" class="ntImage" v-if="isVisible(item)" v-on:click="clickImage(item)">
                        <div class="row" style="width: 100%;">
                            <div class="col-md-12" style="text-align: center; font-size: 120%;"><b>{{item.attributes.name}}</b></div>
                            <div class="col-md-7" v-html="item.attributes.description"></div>
                            <div class="col-md-5" style="overflow: hidden; height: 85%;"><img v-bind:src="urlImage(item)" style="height: 100%"/></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="viewR">
            <img v-bind:src="'/r/'+itemR">
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
                "viewR": false,
                "itemR": 0,
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
                return item.attributes.image2 && typeof item.attributes.image2.url==='string' ? item.attributes.image2.url :
                       'images/variables/report.png';
/*                return item.attributes.image ? (item.attributes.image.substr(0,4)=='http' ?
                    item.attributes.image :
                    API_SERVER+'/images/variables/'+item.attributes.image) : 'images/variables/report.png';*/
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
                var self = this;
                if (item.attributes.r_code) {
                    self.itemR = item.attributes.id
                    self.viewR = true;
                } else {
                    self.viewR = false;
                    this.$emit('clickImage', item);
                }
            },
            isVisible : function (item) {
                return !(item && typeof item.attributes.estado === 'string' && item.attributes.estado === 'Deshabilitada');
            }
        }
    });
</script>
