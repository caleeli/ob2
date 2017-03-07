<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 id="nav-tabs">Perfil</h2>
            <dv-form :model="user"></dv-form>
        </div>
    </div>
</template>
<script>
    var module;
    var Model = require("../models/Model.js").default;
    var Profile = {};
    window.Profile = Profile;
    
    export default {
        props:[
        ],
        methods: {
        },
        data: function () {
            module = this;
            return {
                path: [],
                user: new UserAdministration.User(function(){try{var url="/api/UserAdministration/users";return url.indexOf("¡@!")===-1?url:this.$defaultUrl;}catch(err){return this.$defaultUrl;}},localStorage.user_id),
            }
        },
        mounted: function() {
            var self = this;
            this.path = this.$children[0].path;
        }
    }
</script>