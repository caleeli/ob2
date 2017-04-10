<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div v-for="row in list">
                <h4>{{row.attributes.name}}</h4>
                <div class="ntScroll">
                    <div v-for="item in row.relationships[children]" class="ntImage" :style="'background-image: url('+urlImage(item)+')'">
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
                return API_SERVER+'/images/variables/'+item.id+'.jpg';
            },
            refresh:function(){
                var self = this;
                self.model.$select(function (data) {
                    data.data.forEach(function(row) {
                        self.list.push(row);
                    });
                });
            },
        }
    });
</script>
