{!! $document !!}
<link type="text/css" href="/css/text_layer_builder.css" rel="stylesheet">
<div class="popup" v-show="showPDF" style="display:none">
    <div class="header" v-show="pdfEditMode">
        <input placeholder="Ingrese el texto del enlace" size="30" v-model="selectedLinkName"/>
        <upload v-model="uploadAux" type="singlefile" v-bind:small="true" disk="referencias" v-on:uploaded="fileUploaded"></upload>
        <select v-model="selectedFile" v-on:change="loadPDF(selectedFile)">
            <option value=""></option>
            <option v-for="file in files" v-bind:value="file.url">@{{file.name}}</option>
        </select>
        <button type="button" v-on:click="modoResaltar" v-bind:style="{backgroundColor:highlightMode?'green':''}">&#128221;</button>
        <button type="button" v-on:click="completarSeleccion">&#128190;</button>
        <button type="button" v-on:click="cerrarPDF" style="position:absolute; right:0px;">X</button>
    </div>
    <div class="header" v-show="!pdfEditMode">
        @{{selectedLinkName}}
        <button type="button" v-on:click="cerrarPDF" style="position:absolute; right:0px;">X</button>
    </div>
    <div class="preview">
        <div id="container"></div>
    </div>
</div>
<style>
    .noedit .editable {
        border: none;
    }
    .popup {
        position: fixed;
        top: 10vh;
        left: 10vw;
        width: 80vw;
        height: 80vh;
        border: 1px solid black;
    }
    .popup .header {
        height: 2em;
        color: white;
        background-color: gray;
        position: relative;
    }
    .popup .header button {
        width: 2em;
        height: 2em;
        padding: 0px;
        cursor: pointer;
    }
    .popup .preview {
        height: calc(100% - 2em);
        overflow: auto;
        background-color: darkgray;
    }
    div.editable {
        position: relative;
        width: 100%;
        border: 1px lightgreen dashed;
        min-height: 0.9em;
    }
    div.editable select {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        opacity: 0;
    }
    div.editable textarea {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        border: none;
        resize: none;
        padding: 0px;
        margin: 0px;
    }
    .link-button input {
        position: absolute;
        top: 0px;
        left: 0px;
        width: calc(100% - 2em);
        height: 100%;
    }
    .link-button button {
        position: absolute;
        top: -1px;
        right: 0px;
        width: 2em;
        height: 100%;
        padding: 0px;
    }
    .link-button span {
        cursor: pointer;
    }
    #container.highlight {
        -webkit-touch-callout: none; /* iOS Safari */
          -webkit-user-select: none; /* Safari */
           -khtml-user-select: none; /* Konqueror HTML */
             -moz-user-select: none; /* Firefox */
              -ms-user-select: none; /* Internet Explorer/Edge */
                  user-select: none; /* Non-prefixed version, currently
                                        supported by Chrome and Opera */
    }
    #container.highlight .textLayer div:hover{
        background-color: #f66;
        cursor: copy;
    }
    #container.highlight .textLayer div.pdfselect:hover{
        background-color: #f00;
        cursor: not-allowed;
    }
    .pdfselect {
        background-color: #f00;
    }
</style>
<script type='text/x-template' id='gtemplate'>
    <div>
    </div>
</script>
<script type='text/x-template' id='lista'>
    <div class="editable" >
        @{{text(innerValue)}}
        <select v-model="innerValue" v-if="editable()">
            <option v-for="item in data" v-bind:value="item.id">@{{item.text}}</option>
        </select>
    </div>
</script>
<script type='text/x-template' id='texto'>
    <div class="editable" >
        <span v-html="innerValue.split('\n').join('<br>')"></span>
        <textarea v-model="innerValue" v-if="editable()"></textarea>
    </div>
</script>
<script type='text/x-template' id='check'>
    <div class="editable" v-on:click="rotarCheck" v-html="fixEmpty(innerValue)">
    </div>
</script>
<script type='text/x-template' id='enlace'>
    <div class="editable link-button">
        <span v-on:click="abrirEnlace">@{{innerValue.text}}</span>
        <button type="button" v-on:click="editarEnlace" v-if="editable()">&#128279;</button>
    </div>
</script>
<script type='text/x-template' id='upload'>
    <div style="
    display: inline-block;
    position: relative;
    border: 1px solid lightgray;
    background-color: ButtonHighlight;
    color: ButtonText;
    overflow: hidden;
    line-height: 17px;
    margin-bottom: -5px;">
        <span v-if="type!=='multiplefile' && !small" class="input-group-btn">
            <a class="btn btn-default" v-bind:href="file(value).url" v-bind:download="file(value).name"><i class="fa fa-download"></i></a>
        </span>
        <input v-show="!small" type="text" readonly="readonly" v-bind:value="file(value, type==='multiplefile').name" class="form-control form-file-progress">
        <span class="input-group-btn">
            <span class="btn btn-default" type="button" v-bind:style="{opacity:uploading?'0.2':'1'}">
                &#8682;
                <input type="file" style="
                                        width: 100%;
                                        height: 100%;
                                        position: absolute;
                                        left: 0px;
                                        top: 0px;
                                        opacity: 0;"
                                        accept="application/pdf"
                                        v-on:change="changeFile($event, type==='multiplefile')"
                                        v-bind:multiple="type==='multiplefile'">
            </span>
            <span v-show="uploading" style="position: absolute;top: 0px;left: 0px;transform: scale(0.5);color: black;width: 100%;text-align: center;">@{{progress}}%</span>
        </span>
    </div>
</script>
<script src="/bower_components/vue/dist/vue.js"></script>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/js/pdf.js"></script>
<script>
    var autoSave = {!! json_encode(empty($autoSave) ? null : $autoSave) !!};
    var saveLast = false;
    function doAutoSave() {
        if (!saveLast) return;
        console.log("Saving");
        saveLast = false;
        for (var a in variables) {
            variables[a] = app[a];
        }
        window.opener.app.pasosFileAuditoriaAutoSave(variables);
    }
    function saveTarea() {
        saveLast = true;
    }
    window.onbeforeunload = doAutoSave;
    /*function () {
        if (saveLast) {
            return confirm('Algunos cambios aun se guardaron, ¿Desea cerrar la ventana o esperar?');
        }
    };*/
    var timeoutSave = setInterval(doAutoSave , 4000);
</script>
<script src="/js/hoja_trabajo.js?{{filemtime(public_path('/js/hoja_trabajo.js'))}}"></script>
<script type="text/javascript" src="/js/text_layer_builder.js"></script>
<script type="text/javascript" charset="utf8" src="/bower_components/jq-ajax-progress/src/jq-ajax-progress.min.js"></script>
