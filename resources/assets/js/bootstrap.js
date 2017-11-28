window.dateFormat = require('dateformat');

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');
window.Notification = require('toastr/toastr.js');

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

window.menues = [];
menues.findPath = function (path, base, create) {
    var p = path.shift();
    if (typeof base === 'undefined') {
        base = this;
    }
    for (var i = 0, l = base.length; i < l; i++) {
        if (base[i].name === p && path.length === 0) {
            return base[i].options;
        } else if (base[i].name === p) {
            return this.findPath(path, base[i].options, create);
        }
    }
    if (!create) {
        return null;
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
        return this.findPath(path, base[base.length - 1].options, create);
    }
    return base;
}
window.registerMenu = function (menu) {
    menu.options = [];
    menu.options.menu = menu;
    var option = menues.findPath((menu.path?menu.path+"/"+menu.name:menu.name).split("/"), menues, true).menu;
    if(typeof menu.id!=='undefined') {
        option.id = menu.id;
    }
    option.name = menu.name;
    option.icon = menu.icon;
    option.text = menu.text;
};

(function ( $ ) {
    $.fn.slider = function(viewId) {
        if ( typeof viewId === 'undefined') {
            this.children().slideUp();
            this.children('.active').slideDown();
        } else if($.isNumeric(viewId)) {
            this.children('.active').slideUp();
            $(this.children()[viewId]).slideDown();
            $(this.children()[viewId]).addClass('active');
        } else {
            this.children('.active').slideUp();
            $(viewId).slideDown();
            $(viewId).addClass('active');
        }
    };
})( jQuery );
window.PathItem=function(base, self) {
    this.goto = function(){
        self.goto(this.item, this);
    }
    for (var a in base) {
        this[a] = base[a];
    }
}
window.HashRoute = {
    routes: [],
    run: function (hash) {
        this.routes.forEach(function(route) {
            var match = hash.match(route[0]);
            if (match) {
                var path = [];
                for (var i = 1, l = match.length; i < l; i++) {
                    path.push(match[i]);
                }
                route[1].apply(window, path);
            }
        });
    },
    route: function (route, callback) {
        var regexp = new RegExp('^'+route.replace(/\{[^}]+\}/g,'?')
            .replace(/[.?+*^$|({[\\]/g, '\\$&')
            .replace(/\\\?/g, '([^/]+)')+'$');
        this.routes.push([regexp, callback]);
    }
}
$(window).on('hashchange', function() {
    try {
        var $parent = $(window.location.hash).parent();
        if ($parent.hasClass("carousel")) {
            $parent.slider(window.location.hash);
        }
    } catch(e) {

    }
    window.HashRoute.run(window.location.hash);
});
/**
 * Auxiliar function to identify object instances.
 */
var identifyObjectList=[];
function identifyObject(object) {
    var index = identifyObjectList.indexOf(object);
    if (index===-1) {
        index = identifyObjectList.length;
        identifyObjectList.push(object);
    }
    return index;
}
