<template>
    <span>
        <a class="user-editable" v-on:click="open" v-bind:title="url">
            {{texto ? texto : '[enlace]'}}
        </a>
        <div class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div style="position: relative;
                                    width: 100%;
                                    margin-bottom: 10px;">
                                    <div style="padding-bottom: 129%;
                                        position: relative;">
                                        <pdf
                                            url="//cdn.mozilla.net/pdfjs/tracemonkey.pdf"
                                            style="position: absolute;  
                                            top: 0; height: 100%;
                                            left: 0; width: 100%;"
                                            v-bind:page="documento.pagina"
                                            v-on:load="documento.onload"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Documento:</label>
                                <select name="document" class="form-control" v-model="documento.url">
                                    <option>Seleccione el documento</option>
                                    <option>&#x1F4C4; Documento 1</option>
                                    <option>&#x1F4C4; Documento 2</option>
                                    <option>&#x1F4C4; Documento 3</option>
                                    <option>&#x1F4C4; Documento 4</option>
                                    <option>&#x1F4C4; Documento 5</option>
                                </select>
                                <label>Enlace:</label>
                                <input name="texto" placeholder="texto" class="form-control" v-model="documento.texto" />
                                <label>Página:</label>
                                <input min="1" v-bind:max="documento.numPages" name="pagina" v-model="documento.pagina" placeholder="página" class="form-control" type="number" />
                                de {{documento.numPages}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>
<script>
    export default {
        data: function () {
            var self = this;
            var model = this.$parent.$attrs.model;
            return {
                url : '',
                texto : '',
                documento : {
                    pagina:1, numPages:0,
                    onload: function (numPages) {
                        self.documento.numPages = numPages;
                    }
                }
            };
        },
        props: [
            'name',
        ],
        methods: {
            open : function () {
                $(this.$el).find(".modal").modal('toggle');
            }
        },
        watch: {
            value: function () {
            },
            "documento.texto" : function () {
                var model = this.$parent.$attrs.model;
                this.texto = this.documento.texto;
                if (model[this.name] === undefined) {
                    model[this.name] = {texto: '' , url: ''};
                }
                model[this.name].texto = this.texto;
            },
            "documento.url" : function () {
                var model = this.$parent.$attrs.model;
                this.url = this.documento.url;
                if (model[this.name] === undefined) {
                    model[this.name] = {texto: '' , url: ''};
                }
                model[this.name].url = this.url;
            }
        },
        mounted() {
        }
    }
</script>
