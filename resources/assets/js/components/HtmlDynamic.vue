
<script>
    import BaseComponent from './BaseComponent.js';
    export default BaseComponent.extend({
        data: function () {
            var self = this;
            return {
                templateRender: null
            };
        },
        props: [
            "id",
            "refreshWith",
            "template",
            //"model",
        ],
        computed: {
        },
        methods: {
            initialize: function () {
                var self = this;
                //window.asd=this.model;
            },
            refresh: function () {
                if (!this.templateRender) {
                    return h('div', 'loading...');
                } else { // If there is a template, I'll show it
                    return this.templateRender();
                }
            },
        },
        render(h) {
            if (!this.templateRender) {
                return h('div', 'loading...');
                } else { // If there is a template, I'll show it
                    return this.templateRender();
                }
        },
        watch: {
            // Every time the template prop changes, I recompile it to update the DOM
            template: {
                immediate: true, // makes the watcher fire on first render, too.
                handler() {
                    var template = !this.template ? '' : this.template;
                    var res = Vue.compile(template);
                    this.templateRender = res.render;
                    // staticRenderFns belong into $options, 
                    // appearantly
                    this.$options.staticRenderFns = []

                    // clean the cache of static elements
                    // this is a cache with the results from the staticRenderFns
                    this._staticTrees = []

                    // Fill it with the new staticRenderFns
                    for (var i in res.staticRenderFns) {
                        //staticRenderFns.push(res.staticRenderFns[i]);
                        this.$options.staticRenderFns.push(res.staticRenderFns[i])
                    }
                }
            }
        },
    });
</script>
