<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Perfil</h2>
            <dv-form vue:model="user" ></dv-form>
        </div>
    </div>
</template>
<script>
    /*
     * perdir contraseña anterior para cambiar por una nueva.
     * adicionar sin poder eliminar correo electronico
     * cerulean
     * journal o readable
     * flaty
     * recuperar contraseña error.
     */
    var module = new Module({
        "name": "Profile",
        "prefix": "prof",
        "title": "Perfil",
        "icon": "glyphicon glyphicon-user",
        "menu": "main",
        "models": [
        ],
        "views": {
        },
        "data": {
            user: new Module.View.ModelInstance("UserAdministration.User", "UserAdministration/users", "localStorage.user_id"),
        }
    });
</script>
</root>