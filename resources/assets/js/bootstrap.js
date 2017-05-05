
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
}

