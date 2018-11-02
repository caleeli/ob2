<!DOCTYPE html>
<html>

    <head>
        <script src="js/server.js?v0.148"></script>
        <link href="documentacion/font-awesome/css/font-awesome.css" rel="stylesheet">

    </head>

    <body>
        <div id='app' class='panel'>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Unir Excels</h5>
                </div>
                <div class="ibox-content">
                    <div style="overflow-y: scroll;">
                        <form action="angie/procesar">
                            <h2>Archivos a ser cargados</h2>
                            <h4>Carpeta: {{$folder}}</h4>
                            <folder-viewer api="/api/folder/tareas/unir_excel"
                                           v-bind:target='"tareas/unir_excel"'
                                           v-bind:canupload='true'
                                           v-bind:candelete='true'
                                           >
                                <h2>Tabla destino</h2>
                                <input name="tabla">
                                <button>Procesar</button>
                            </folder-viewer>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
var app;
app = new Vue({
    el: '#app'
});
        </script>
    </body>
</html>