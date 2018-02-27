<template>
    <div class="row">
        <div class="col-sm-5 col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <button class="btn btn-primary btn-block" style="position: relative;">Subir archivo(s) <img src='/images/ajax-loader.gif' v-show='loading'><upload v-model="upload" target="" v-bind:multiplefile="true" /></button>
                        <div class="hr-line-dashed"></div>
                        <h5>Empresa</h5>
                        <select v-model="empresa" class="form-control">
                            <option v-bind:value="0">Todos</option>
                            <option v-for="emp in listEmpresas" v-bind:value="emp.id">{{emp.attributes.cod_empresa?emp.attributes.cod_empresa:' '}} {{emp.attributes.nombre_empresa}}</option>
                        </select>
                        <h5 class="tag-title">Gestión</h5>
                        <select v-model="gestion" class="form-control">
                            <option v-for="g in gestiones" v-bind:value="g">{{g}}</option>
                        </select>
                        <h5 class="tag-title">Tipo</h5>
                        <select v-model="tipo" class="form-control">
                            <option v-for="g in tipos" v-bind:value="g">{{g}}</option>
                        </select>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-md-9 animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div v-for="file in listOfFiles" class="file-box">
                        <div class="file">
                            <a href="javascript:void(0)">
                                <span class="corner"></span>

                                <div class="icon">
                                    <i v-bind:class="icon(file).icon" v-bind:style="{color:icon(file).color}"></i>
                                </div>
                                <div class="file-name">
                                    <a v-bind:href="file.attributes.archivo.url" target='_blank'>{{file.attributes.archivo.name}}</a>
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
    export default ({
        data: function () {
            var gestiones = ['Todas'];
            for (var g = 2015, l = new Date().getFullYear(); g <= l; g++) {
                gestiones.push(g);
            }
            return {
                loading: false,
                upload: '',
                listOfFiles: [],
                listEmpresas: [],
                empresa: 1,
                gestiones: gestiones,
                gestion: 'Todas',
                tipos: [
                    "Todos",
                    "Balance General",
                    "Estado de Recursos y Gastos Corrientes",
                    "Hoja de Trabajo",
                    "Estado de Cambios en el Patrimonio Neto",
                    "Partidas y Rubros Financieros",
                    "Estado de Ejecución Presupuestaria de Gastos",
                    "Estado de Ejecución Presupuestaria de Recursos"
                ],
                tipo: 'Todos'
            };
        },
        props: {
            "model": Object,
            "empresas": Object,
            "carga_estado": Object
        },
        watch: {
            'upload': function (value) {
                var self = this;
                self.loading = true;
                self.carga_estado.$load(0, function () {
                    self.carga_estado.files = JSON.parse(value);
                    self.carga_estado.$save('', function () {
                        self.loading = false;
                        self.loadFiles();
                    });
                });
            },
            'empresa': function () {
                this.loadFiles()
            },
            'gestion': function () {
                this.loadFiles()
            },
            'tipo': function () {
                this.loadFiles()
            }
        },
        methods: {
            loadFiles: function () {
                var self = this, filter = [];
                if (self.empresa > 0) {
                    filter.push('where,empresa_id,' + self.empresa);
                }
                if (self.gestion != 'Todas') {
                    filter.push('where,gestion,' + self.gestion);
                }
                if (self.tipo != 'Todos') {
                    filter.push('where,tipo_estado_financiero,' + JSON.stringify(self.tipo));
                }
                self.model.$select(function (data) {
                    self.listOfFiles.splice(0);
                    data.data.forEach(function (file) {
                        self.listOfFiles.push(file);
                    });
                }, {
                    'filter': filter
                });
            },
            icon: function (file) {
                var color, icon, type;
                switch (file.attributes.archivo.mime) {
                    case 'application/pdf':
                        icon = 'fa fa-file-pdf-o';
                        color = 'rgb(226, 31, 52)';
                        type = 'pdf';
                        break;
                    case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                    case 'application/vnd.ms-excel':
                    default:
                        type = 'excel';
                        icon = 'fa fa-file-excel-o';
                        color = 'rgb(0, 177, 15)';
                }
                return {icon: icon, color: color, type: type};
            }
        },
        mounted: function () {
            var self = this;
            self.loadFiles();
            self.empresas.$select(function (data) {
                self.listEmpresas.splice(0);
                data.data.forEach(function (row) {
                    self.listEmpresas.push(row);
                });
            }, {
                'sort': 'cod_empresa'
            });
        }
    });
</script>
