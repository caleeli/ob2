
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

Vue.component('reportsfolders', require('./modules/ReportsFolders.vue'));
Vue.component('useradministration', require('./modules/UserAdministration.vue'));


$(document).ready(function () {
    var app;
    function message(message) {
        var $msg=$('<div class="alert alert-dismissible alert-info">\
            <button type="button" class="close" data-dismiss="alert">&times;</button>\
            <p>'+message+'</p>\
        </div>');
        $("#message_box").append($msg);
        setTimeout(function(){$("#message_box").html("");}, 4000);
    }
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
                        window.location.href = response.redirect;
                    } else {
                        message('Nombre de usuario o contraseña incorrectos.');
                    }
                });
            },
            resetReg:function(){
                app.user.$reset();
                this.goto(0);
            },
            submitReg:function(){
                var self=this;
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
                app.user.$methods.registrar(
                    app.user.$getData(),
                    {
                        success: function() {
                            self.goto(0);
                        },
                        error: function() {
                            message('No fue posible registrar el usuario verifique sus datos o contactese con el administrador.');
                        },
                    }
                );
            },
            resetRecover: function() {
                app.recover.$reset();
                this.goto(0);
            },
            submitRecover: function() {
                var self=this;
                app.recover.$methods.sendEmail(
                    app.recover.account,
                    {
                        success: function(enviado) {
                            if(enviado) {
                                message('Se envio un correo para recuperar su contraseña.');
                                self.goto(0);
                            } else {
                                message('No se pudo enviar el correo de recuperación, verifique que el usuario o email ingresado.');
                            }
                        },
                        error: function(enviado) {
                            message('No se pudo enviar el correo de recuperación, verifique el usuario o email ingresado.');
                        },
                    }
                );
            },
        },
        data: {
            pathChanged: 0,
            path: [],
            user: new UserAdministration.User("api/UserAdministration/roles/1/users"),
            login: new UserAdministration.Login(),
            recover: new UserAdministration.Recover(),
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
