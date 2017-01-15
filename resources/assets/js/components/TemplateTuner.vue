<template>
    <span class="navbar-brand">
        <img src="images/tunning_button_0.png" style="position:absolute; width:1.5em;">
        <img src="images/tunning_button_1.png" style="position:absolute; width:1.5em; cursor: pointer;" :class="rotateClass" v-on:click="rotateTemplate">
    </span>
</template>

<script>
    export default {
        data:function() {
            return {
                templates: [
                    "cerulean",
                    "cosmo",
                    "cyborg",
                    "darkly",
                    "flatly",
                    "journal",
                    "lumen",
                    "paper",
                    "readable",
                    "sandstone",
                    "simplex",
                    "slate",
                    "spacelab",
                    "superhero",
                    "united",
                    "yeti",
                ],
                direction: 1,
                currentTemplate: this.template,
            };
        },
        props:[
            "template"
        ],
        computed: {
            rotateClass: function () {
                var i=this.templates.indexOf(this.currentTemplate)+1;
                return 'rotate-template-'+i;
            }
        },
        methods: {
            rotateTemplate: function() {
                var i=this.templates.indexOf(this.currentTemplate)+this.direction;
                if(i>=this.templates.length || i<0) {
                    this.direction=-this.direction;
                    i=this.templates.indexOf(this.currentTemplate)+this.direction;
                }
                this.currentTemplate = this.templates[i];
                $("#template-tuner").attr("href", "bower_components/bootswatch/"+this.templates[i]+"/bootstrap.min.css");
            }
        },
        mounted() {
        }
    }
</script>
