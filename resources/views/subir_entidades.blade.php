<!DOCTYPE html>
<html>

    <head>
        <script src="../js/server.js?v0.148"></script>
        <link href="../documentacion/font-awesome/css/font-awesome.css" rel="stylesheet">
        <style>
            .file-manager .btn {
                padding: 1em;
            }
        </style>
    </head>

    <body>
        <div id='app' class='panel'>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Archivos cargados</h5>
                </div>
                <div class="ibox-content">
                    <div style="overflow-y: scroll;">
                            <folder-viewer api="/api/folder/{{$folder}}"
                                           v-bind:target='"{{$folder}}"'
                                           v-bind:canupload='true'
                                           v-bind:candelete='true'
                                           >
                            </folder-viewer>
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