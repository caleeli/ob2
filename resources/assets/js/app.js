Vue.component('datatable', require('./components/DataTable.vue'));
Vue.component('datatablegroup', require('./components/DataTableGroup.vue'));
Vue.component('dv-form', require('./components/Form.vue'));
Vue.component('abm', require('./components/ABM.vue'));
Vue.component('abmgroup', require('./components/ABMGroup.vue'));
Vue.component('template-tuner', require('./components/TemplateTuner.vue'));
Vue.component('tree', require('./components/Tree.vue'));
Vue.component('carousel', require('./components/Carousel.vue'));
Vue.component('carouselitem', require('./components/CarouselItem.vue'));
Vue.component('chart', require('./components/Chart.vue'));
Vue.component('chart2', require('./components/Chart2.vue'));
Vue.component('tags', require('./components/Tags.vue'));
Vue.component('filters', require('./components/Filter.vue'));
Vue.component('imageviewer', require('./components/ImageViewer.vue'));

$(document).ready(function () {
    var app;
    window.app = app = new Vue({
        el: '#app',
        carousel: {},
        methods: {
            goto: function (viewId) {
                if (!$('.navbar-toggle').hasClass("collapsed")) {
                    $('.navbar-toggle').click();
                }
                this.carousel.slider(viewId);
                try {
                    this.path = this.carousel.$children[viewId].$children[0].path;
                } catch (e) {
                    this.path = [];
                }
            },
            gotoDashboard: function () {
                this.goto(0);
            },
            gotoCartera: function () {
                this.goto(1);
            },
            gotoUsuarios: function () {
                this.goto(2);
            },
            getPaths: function () {
                var pathChanged = this.pathChanged;
                var paths = this.path;
                var res = [];
                var load = function (p) {
                    if (typeof p !== 'undefined' && typeof p.forEach === 'function') {
                        p.forEach(load);
                    } else if (typeof p !== 'undefined') {
                        res.push(p);
                    }
                }
                load(paths);
                return res;
            },
            changeTemplate: function (template) {
                if (!$('.navbar-toggle').hasClass("collapsed")) {
                    $('.navbar-toggle').click();
                }
                $("#template-tuner").attr("href", "bower_components/bootswatch/" + template + "/bootstrap.min.css");
                $("#template-tuner-extra").attr("href", "bower_components/bootswatch/" + template + "/extra.min.css");
                localStorage.skin = template;
                this.template = template;
            },
            cssTemplateMenu: function (template) {
                //bind with this.template
                this.template;
                return localStorage.skin===template?'active':'';
            },
        },
        data: {
            pathChanged: 0,
            path: [],
            menues: menues.findPath(['main']),
            template: localStorage.skin ? localStorage.skin : 'simplex',
        },
        mounted: function () {
            var self = this;
            this.carousel = this.$children[0];
            this.goto(menues.findPath('main/Dashboard'.split('/')).menu.id);
            $('.dropdown-submenu a.dropdown-toggle').on("click", function (e) {
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
            setTimeout(function() {
                $.ajax({
                    method: 'HEAD',
                    url: API_SERVER + '/api/ping',
                    success: function () {
                        $("#now_loading").hide();
                        self.$el.style.visibility = "visible";
                    }
                });
            }, 0);
        },
    });

    window.macro = {
        findMenu:function (name, menues) {
            var response = false;
            menues.forEach(function(menu) {
                if (menu.name===name) {
                    response = menu;
                    return true;
                }
                if (typeof menu.options==="object" &&
                    typeof menu.options.forEach==="function"
                ) {
                    var res = self.findMenu(name, menu.options);
                    if (res) {
                        response = res;
                        return true;
                    }
                }
            });
            return response;
        },
        menu: function (path, dontException) {
            var menu = menues.findPath(('main/'+path).split('/'));
            if (menu && menu.menu.id !== 'undefined') {
                app.goto(menu.menu.id);
                return menu.menu;
            } else if(dontException){
                return false;
            } else {
                throw "Menu '" + name + "' not found.";
            }
        },
        app: app,
        abm: function (i) {
            return this.content(i).$children[0].$children[0].$children[0];
        },
        get module () {
            return window.app.$children[0].$children[app.$children[0].viewId].$children[0];
        },
        content: function (i) {
            return app.$children[0].$children[app.$children[0].viewId].$children[0].$children[i];
        },
        when: function(condition, action) {
            var self = this;
            setTimeout(function() {
                if (condition()) {
                    action();
                } else {
                    self.when(condition, action);
                }
            }, 200);
        }
    };

});