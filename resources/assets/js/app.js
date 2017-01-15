
/* global Vue */

/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
var Model = require('./models/Model.js').default;


var UserAdministration = {};
UserAdministration.User = function (id) {
    var self = this;
    Model.call(this, "/api/UserAdministration/users", id);
    this.$fields = function () {
        return [
            {label: 'Username', type: 'text', value: 'username'},
            {label: 'Nombre', type: 'text', value: 'firstname'},
            {label: 'Apellido', type: 'text', value: 'lastname'},
        ];
    };
}
// inherit Person
UserAdministration.User.prototype = Object.create(Model.prototype);
// correct the constructor pointer because it points to Person
UserAdministration.User.prototype.constructor = Model;


Vue.component('datatable', require('./components/DataTable.vue'));
Vue.component('dv-form', require('./components/Form.vue'));
Vue.component('abm', require('./components/ABM.vue'));
Vue.component('template-tuner', require('./components/TemplateTuner.vue'));
Vue.component('tree', require('./components/Tree.vue'));
Vue.component('carousel', require('./components/Carousel.vue'));
Vue.component('carouselitem', require('./components/CarouselItem.vue'));


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
        },
        data: function () {
            return {
                user: new UserAdministration.User(),
            }
        },
        mounted: function () {
            var self = this;
            this.carousel = this.$children[1];
        }
    });

});
