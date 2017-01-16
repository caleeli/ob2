<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME', 'Application Name')}}</title>

        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bower_components/jstree/dist/themes/default/style.min.css">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        <link id="template-tuner" rel="stylesheet" type="text/css" href="bower_components/bootswatch/cosmo/bootstrap.min.css">
    </head>
    <body>
        <div  id="app">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">{{env('APP_NAME', 'Application Name')}}</a>
                        <template-tuner template="cosmo"></template-tuner>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" v-on:click="gotoDashboard"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                            <li><a href="#" v-on:click="gotoCartera"><i class="glyphicon glyphicon-home"></i> Cartera</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i> Configuración <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" v-on:click="gotoUsuarios"><i class="fa fa-users"></i> Usuarios</a></li>
                                    <li><a href="#"><i class="fa fa-folder"></i> Reportes</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-database"></i> Conexiones</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="glyphicon glyphicon-user"></i> Perfil</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-education"></i> Ayuda</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <carousel>
                            <carouselitem class = "active">
                                Pendiente: DASHBOARD
                            </carouselitem>
                            <carouselitem>
                                (Espere Cargando...)
                            </carouselitem>
                            <carouselitem>
                                <abm :model="user"></abm>
                            </carouselitem>
                            <!-- carouselitem class = "active" activate="logout" :map="{save:'login'}">
                                <dv-form :model="user"></dv-form>
                            </carouselitem -->
                        </carousel>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ elixir('js/app.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" charset="utf8" src="js/jszip.min.js"></script>
        <script type="text/javascript" charset="utf8" src="js/pdfmake.min.js"></script>
        <script type="text/javascript" charset="utf8" src="js/vfs_fonts.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>

        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/datatables.net-responsive-bs/js/responsive.bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/jstree/dist/jstree.min.js"></script>
        <script type="text/javascript" charset="utf8">
            (function ( $ ) {
                $.fn.slider = function(viewId) {
                    if ( typeof viewId === 'undefined') {
                        this.children().slideUp();
                        this.children('.active').slideDown();
                    } else {
                        this.children('.active').slideUp();
                        $(this.children()[viewId]).slideDown();
                        $(this.children()[viewId]).addClass('active');
                    }
                };
            }( jQuery ));
        </script>
    </body>
</html>
