
/* global Vue */

/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
var menues = [];
menues.findPath = function (path, base) {
    var p = path.shift();
    if (typeof base === 'undefined') {
        base = this;
    }
    for (var i = 0, l = base.length; i < l; i++) {
        if (base[i].name === p && path.length === 0) {
            return base[i].options;
        } else if (base[i].name === p) {
            return this.findPath(path, base[i].options);
        }
    }
    var menu = {
        name: p,
        text: p,
        icon: "fa fa-tags",
        options: [],
    };
    menu.options.menu = menu;
    base.push(menu);
    if (path.length === 0) {
        return base[base.length - 1].options;
    } else {
        return this.findPath(path, base[base.length - 1].options);
    }
    return base;
}
window.registerMenu = function (menu) {
    menu.options = [];
    menu.options.menu = menu;
    var option = menues.findPath((menu.path?menu.path+"/"+menu.name:menu.name).split("/")).menu;
    if(typeof menu.id!=='undefined') {
        option.id = menu.id;
    }
    option.name = menu.name;
    option.icon = menu.icon;
    option.text = menu.text;
}
window.registerMenu({
    name: "main",
    path: "",
    text: "main",
});
window.registerMenu({
    name: "Dashboard",
    path: "main",
    text: "Dashboard",
});
window.registerMenu({
    name: "Reportes",
    path: "main",
    text: "Reportes",
});
window.registerMenu({
    name: "Configuración",
    path: "main",
    text: "Configuración",
});
require('./modules');
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
            },
        },
        data: {
            pathChanged: 0,
            path: [],
            menues: menues.findPath(['main']),
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
            $(function () {
                $("#now_loading").hide();
                self.$el.style.visibility = "visible";
            });
        },
    });

});