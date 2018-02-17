{!! $document !!}
<style>
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
</style>
<script type='text/x-template' id='gtemplate'>
    <div>
    </div>
</script>
<script type='text/x-template' id='lista'>
    <div class="editable" >
        @{{text(innerValue)}}
        <select v-model="innerValue">
            <option v-for="item in data" v-bind:value="item.id">@{{item.text}}</option>
        </select>
    </div>
</script>
<script type='text/x-template' id='texto'>
    <div class="editable" >
        @{{innerValue}}
        <textarea v-model="innerValue"></textarea>
    </div>
</script>
<script type='text/x-template' id='check'>
    <div class="editable" v-on:click="rotarCheck" v-html="fixEmpty(innerValue)">
    </div>
</script>
<script src="/bower_components/vue/dist/vue.js"></script>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/js/hoja_trabajo.js"></script>
