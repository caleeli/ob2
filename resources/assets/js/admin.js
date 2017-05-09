
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

require('./app');
