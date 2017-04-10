
/* global Vue */

/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

//Vue.component('datatable', require('./components/DataTable.vue'));
//Vue.component('datatablegroup', require('./components/DataTableGroup.vue'));
Vue.component('dv-form', require('./components/Form.vue'));
//Vue.component('abm', require('./components/ABM.vue'));
//Vue.component('abmgroup', require('./components/ABMGroup.vue'));
Vue.component('template-tuner', require('./components/TemplateTuner.vue'));
//Vue.component('tree', require('./components/Tree.vue'));
Vue.component('carousel', require('./components/Carousel.vue'));
Vue.component('carouselitem', require('./components/CarouselItem.vue'));
//Vue.component('chart', require('./components/Chart.vue'));

//Vue.component('reportsfolders', require('./modules/ReportsFolders.vue'));
Vue.component('useradministration', require('./modules/UserAdministration.vue'));


$(document).ready(function () {
    var app;
    window.app = app = new Vue({
        el: '#app',
        carousel:{},
        methods: {
            goto: function(viewId) {
                this.carousel.slider(viewId);
            },
            gotoDashboard:function(){
                this.goto(0);
            },
            gotoCartera:function(){
                this.goto(1);
            },
            gotoUsuarios:function(){
                this.goto(2);
            },
            getPaths: function() {
                var pathChanged = this.pathChanged;
                var paths = this.path;
                var res = [];
                var load = function(p) {
                    if(typeof p.forEach==='function') {
                        p.forEach(load);
                    } else {
                        res.push(p);
                    }
                }
                load(paths);
                return res;
            },
            reset:function(){
                app.login.$reset();
            },
            submit:function(){
                app.login.$methods.validate(app.login.username, app.login.password, function(response){
                    if(response) {
                        localStorage.token = response.token;
                        localStorage.user_id = response.user_id;
                        window.location.href = '/';
                    }
                });
            },
            resetReg:function(){
                app.user.$reset();
                this.goto(0);
            },
            submitReg:function(){
                if (!this.user.username) {
                    $("#username").addClass("has-error").find("input").focus();
                    return ;
                }
                $("#username").removeClass("has-error");
                if (this.password2!==this.user.password) {
                    $("#password2").addClass("has-error").find("input").focus();
                    return ;
                }
                $("#password2").removeClass("has-error");
                app.user.$methods.registrar(app.user.$getData());
                this.goto(0);
            },
        },
        data: {
            pathChanged: 0,
            path: [],
            user: new UserAdministration.User("api/UserAdministration/roles/1/users"),
            login: new UserAdministration.Login(),
            password2: "",
        },
        mounted: function () {
            var self = this;
            this.carousel = this.$children[0];
            $(function () {
                $("#now_loading").hide();
                self.$el.style.visibility = "visible";
            });
        }
    });

});
