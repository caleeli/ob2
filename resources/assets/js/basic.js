
require('./bootstrap');

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
Vue.component('dashboard', require('./modules/Dashboard.vue'));
registerMenu({"path":"main","name":"Dashboard","text":"Inicio","icon":"glyphicon glyphicon-home","id":1});
Vue.component('reportsfolders', require('./modules/ReportsFolders.vue'));
registerMenu({"path":"main","name":"ReportsFolders","text":"Reportes","icon":"fa fa-folder","id":5});
Vue.component('profile', require('./modules/Profile.vue'));
registerMenu({"path":"main","name":"Profile","text":"Perfil","icon":"glyphicon glyphicon-user","id":4});
Vue.component('useradministration', require('./modules/UserAdministration.vue'));
//registerMenu({"path":"main\/Configuraci\u00f3n","name":"UserAdministration","text":"Usuarios","icon":"fa fa-users","id":7});

require('./app');
