<template>
    <div class="row">
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <button class="btn btn-primary btn-block">Subir archivo</button>
                        <div class="hr-line-dashed"></div>
                        <h5>Folders</h5>
                        <ul class="folder-list" style="padding: 0">
                            <li style="background-color: lightblue;"><a href=""><i class="fa fa-folder"></i> Yacimientos Petroliferos fiscales</a></li>
                            <li><a href=""><i class="fa fa-folder"></i> Corporacion minera de Bolivia COMIBOL</a></li>
                            <li><a href=""><i class="fa fa-folder"></i> Empresa Nacional de Electricidad ENDE</a></li>
                            <li><a href=""><i class="fa fa-folder"></i> Corporación de las Fuerzas Armadas para el Desarrollo Nacional COFADENA</a></li>
                            <li><a href=""><i class="fa fa-folder"></i> Boliviana de Aviación BOA</a></li>
                        </ul>
                        <h5 class="tag-title">Tags</h5>
                        <ul class="tag-list" style="padding: 0">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div v-for="file in listOfFiles" class="file-box">
                        <div class="file">
                            <a href="javascript:void(0)">
                                <span class="corner"></span>

                                <div class="icon">
                                    <p>
                                        <span v-for="variable in file.relationships.variables">
                                            {{variable.attributes.name}}
                                        </span>
                                    </p>
                                    <p>
                                        <span v-for="parametro in file.relationships.parametros">
                                            {{parametro.attributes.values}}
                                        </span>
                                    </p>
                                </div>
                                <div class="file-name">
                                    {{file.attributes.archivo.name}}
                                    <br/>
                                    <small>{{file.attributes.updated_at}}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BaseComponent from './BaseComponent.js';
    export default BaseComponent.extend({
        data: function () {
            return {
                listOfFiles: [
                    {
                        attributes: {
                            archivo: {
                                name:"YPFB ESTADO DE CAMBIOS EN EL PATRIMONIO GESTION 2014.xlsx"
                            },
                            updated_at: "2017-07-01 13:35:43",
                        },
                        relationships: {
                            variables: [
                                {
                                    attributes:{name:'activos'}
                                },
                                {
                                    attributes:{name:'pasivos'}
                                },
                                {
                                    attributes:{name:'patrimonio'}
                                },
                            ],
                            parametros: [
                                {
                                    attributes:{name:'gestion', values:'2014'}
                                },
                                {
                                    attributes:{name:'departamento', values:'LP,CBBA,SC,OR'}
                                },
                            ],
                        },
                    },
                    {
                        attributes: {
                            archivo: {
                                name:"YPFB ESTADO DE CAMBIOS EN EL PATRIMONIO GESTION 2015.xlsx"
                            },
                            updated_at: "2017-07-01 13:35:43",
                        },
                        relationships: {
                            variables: [
                                {
                                    attributes:{name:'activos'}
                                },
                                {
                                    attributes:{name:'pasivos'}
                                },
                                {
                                    attributes:{name:'patrimonio'}
                                },
                            ],
                            parametros: [
                                {
                                    attributes:{name:'gestion', values:'2015'}
                                },
                                {
                                    attributes:{name:'departamento', values:'LP,CBBA,SC,OR'}
                                },
                            ],
                        },
                    },
                    {
                        attributes: {
                            archivo: {
                                name:"YPFB ESTADO DE CAMBIOS EN EL PATRIMONIO GESTION 2016.xlsx"
                            },
                            updated_at: "2017-07-01 13:35:43",
                        },
                        relationships: {
                            variables: [
                                {
                                    attributes:{name:'activos'}
                                },
                                {
                                    attributes:{name:'pasivos'}
                                },
                                {
                                    attributes:{name:'patrimonio'}
                                },
                            ],
                            parametros: [
                                {
                                    attributes:{name:'gestion', values:'2016'}
                                },
                                {
                                    attributes:{name:'departamento', values:'LP,CBBA,SC,OR'}
                                },
                            ],
                        },
                    },
                    {
                        attributes: {
                            archivo: {
                                name:"YPFB ESTADO DE CAMBIOS EN EL PATRIMONIO GESTION 2017.xlsx"
                            },
                            updated_at: "2017-07-01 13:35:43",
                        },
                        relationships: {
                            variables: [
                                {
                                    attributes:{name:'activos'}
                                },
                                {
                                    attributes:{name:'pasivos'}
                                },
                                {
                                    attributes:{name:'patrimonio'}
                                },
                            ],
                            parametros: [
                                {
                                    attributes:{name:'gestion'}
                                },
                                {
                                    attributes:{name:'departamento'}
                                },
                            ],
                        },
                    },
                ]
            };
        },
        props: [
            "id",
            "refreshWith",
        ],
        computed: {
        },
        methods: {
            onLoadModel: function () {
                this.refresh();
            },
            init: function () {
                var self = this;
                //self.model.$on('load', self.onLoadModel, self);
            },
            refresh: function () {
                var self = this;
            },
        }
    });
</script>
