Vue.component('dashboard', require('./modules/Dashboard.vue'));
registerMenu({"path":"main","name":"Dashboard","text":"Inicio","icon":"glyphicon glyphicon-home","id":0});
Vue.component('profile', require('./modules/Profile.vue'));
registerMenu({"path":"main","name":"Profile","text":"Perfil","icon":"glyphicon glyphicon-user","id":1});
Vue.component('useradministration', require('./modules/UserAdministration.vue'));
registerMenu({"path":"main\/Configuraci\u00f3n","name":"UserAdministration","text":"Usuarios","icon":"fa fa-users","id":2});
