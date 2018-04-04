<template>
    <span>{{total ? Math.min(value, total) : 0}}/{{total?total:1}}</span>
</template>

<script>
    export default {
        props:[
            "value",
            "total"
        ],
        updated: function () {
            var self = this;
            self.$nextTick(function () {
                $(self.$el).peity("pie", {
                    fill: ['#1ab394', '#d7d7d7', '#ff0000']
                });
            });
        },
        created: function () {
            var self = this;
            self.$nextTick(function () {
                $(self.$el).peity("pie", {
                    fill: ['#1ab394', '#d7d7d7', '#ff0000']
                });
            });
        }
    }
</script>
