<link type="text/css" href="/css/text_layer_builder.css" rel="stylesheet">
<style>
    .container{width:600px; margin:0 auto; padding-bottom: 30px;}
    .message{padding: 13px; margin-top: 15px; border-radius: 4px; border: #ccc solid 1px;}
    .message p{margin: 0px; font-size: 14px; font-weight: normal; font-family: arial;}
    .success{color: #2C7635;background-color: #DFF0D4;border: #D6E9C4 solid 1px;}
    .information{color: #31708C;background-color: #D1E4F1;border: #BCE8EF solid 1px;}
    .warning{color: #8A6D39;background-color: #FCF8E1;border: #FAEBCA solid 1px;}
    .failure{color: #AC260D;background-color: #F2DEDC;border: #EBCCCF solid 1px;}
    .message-button {cursor: pointer;}
</style>
<div id='app'>
    @if($mode==='edit')
    <div class='popup'>
        <div class="header" style='width: 765px;'>
            <input placeholder="Ingrese el texto del enlace" size="30" v-model="selectedLinkName"/>
            <upload v-model="uploadAux" type="singlefile" v-bind:small="true" disk="referencias" v-on:uploaded="fileUploaded"></upload>
            <select v-model="selectedFile" v-on:change="selectPDF(selectedFile)">
                <option value=""></option>
                <option v-for="file in files" v-bind:value="file.url">@{{file.name}}</option>
            </select>
            <button type="button" v-on:click="modoResaltar" v-bind:style="{backgroundColor:highlightMode?'green':''}">&#128221;</button>
            <button type="button" v-on:click="completarSeleccion">&#128190;</button>
            <button type="button" v-on:click="cerrarPDF" style="position:absolute; right:0px;">X</button>
        </div>
    </div>
    @endif
    <div style='display: flex;'>
        <div class="preview" style='width: 765px'>
            <div id="container"></div>
        </div>
        <div style='position: relative; margin-top: -20px;'>
            <div class="container bg_logo">
                <div v-bind:class="{message:1, information:ii!==markMetaCurrent, success:ii===markMetaCurrent}" v-for='(meta,ii) in markMetas' :style="position(marks[markIds.indexOf(meta.id)], redraw)">
                    <p>
                        <a v-show='metaEditTitle!==ii' href='javascript:void(0)' v-on:click='gotoMark(meta.id)'>@{{meta.title?meta.title:'(sin nombre)'}}</a>
                        <input v-show='metaEditTitle===ii' v-model='meta.title'>
                        <span class='message-button' v-show='metaEditTitle!==ii' v-on:click='metaEditTitle=ii'>[editar]</span>
                        <span class='message-button' v-show='metaEditTitle!==ii' v-on:click='editMarks(meta)'>[editar marcas]</span>
                        <span class='message-button' v-show='metaEditTitle===ii' v-on:click='metaEditTitle=-1'>[ok]</span>
                        <span class='message-button' v-show='metaEditTitle!==ii' v-on:click='openLinkedPDF(meta)'>[enlace]</span>
                        <span class='message-button' v-show='metaEditTitle!==ii' v-on:click='removeMarks(meta)'>[x]</span>
                    </p>
                    <p v-if='meta.description'>@{{meta.description}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .noedit .editable {
        border: none;
    }
    .popup {
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 1
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
    var selectedFile = location.origin + '/documentacion/' + {!! json_encode($pdfPath) !!};
    var selectedFileBase = location.origin + '/documentacion/';
    var marks = {!! json_encode($pdfMarks) !!};
    var markIds = {!! json_encode($markIds) !!};
    var markMetas = {!! json_encode($markMetas) !!};
    var storePath = {!! json_encode($storePath) !!};
    window.linksSelected = {};
</script>
<script src="/js/hoja_trabajo_pdf.js?{{filemtime(public_path('/js/hoja_trabajo_pdf.js'))}}"></script>
<script type="text/javascript" src="/js/text_layer_builder.js"></script>
<script type="text/javascript" charset="utf8" src="/bower_components/jq-ajax-progress/src/jq-ajax-progress.min.js"></script>
