<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SCEP | Ingreso</title>

    <link href="../documentacion/css/bootstrap.min.css" rel="stylesheet">
    <link href="../documentacion/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../documentacion/css/animate.css" rel="stylesheet">
    <link href="../documentacion/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div id="now_loading">
        Cargando ...<br/>
        <i class="ajax-loader"></i>
    </div>
    <div id="app" class="middle-box text-center loginscreen animated fadeInDown" style="visibility:hidden">
        <div>
            <div>

                <h1 class="logo-name"><img style="width:300px;" src="/images/logo2.png?3"></h1>

            </div>
            <h3 style="color:#010080;">Subcontraloría de Empresas Públicas</h3>
            <p class="label-danger" v-if="error">{{error}}</p>
            <p>Ingrese su nombre de usuario y contraseña para ingresar al sistema</p>
            <form class="m-t" role="form" method="post" action="checkuser.php">
                <div class="form-group">
                    <input class="form-control" name="username" placeholder="Username" v-model="login.username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" v-model="login.password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>

                <!-- a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a -->
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/server.js?v3"></script>
    <script>
        $(document).ready(function () {
            var app = new Vue({
                el: '#app',
                data: function() {
                    return {
                        error: window.location.search==='?e' ? 'Usuario o contraseña incorrectas' : '',
                        login: new UserAdministration.Login
                    };
                },
                methods: {
                },
                mounted: function () {
                    $("#now_loading").hide();
                    $(this.$el).css("visibility", "visible");
                }
            });
            window.app = app;
        });
    </script>
</body>

</html>
