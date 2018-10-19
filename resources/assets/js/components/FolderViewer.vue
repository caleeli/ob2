<template>
    <div class="row">
        <div v-bind:class="colDef1()">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <slot></slot>
                        <span v-if="canupload" class="btn btn-primary btn-block" style="position: relative;">Subir archivo(s) <img src='/images/ajax-loader.gif' v-show='loading'><upload v-model="upload" v-bind:target="target" v-bind:multiplefile="true" /></span>
                    </div>
                </div>
            </div>
        </div>
        <div v-bind:class="colDef2()">
            <div class="row">
                <div class="col-sm-12">
                    <table v-if="mode==='list'" width="100%" class="table table-striped table-hover">
                        <tbody>
                            <tr v-if="mode==='list'" v-for="file in listOfFiles">
                                <td>
                                    <i v-bind:class="icon(file).icon" v-bind:style="{color:icon(file).color}"></i>
                                    <a v-bind:href="file.attributes.url" target='_blank'>{{file.attributes.name}}</a>
                                </td>
                                <td>
                                    {{formatDate(file.attributes.updated_at)}}
                                </td>
                                <td>
                                    <span v-if='candelete'><a href="javascript:void(0)" style="color:red" v-on:click="deleteFile(file)"><i class="fa fa-times"></i></a></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else v-for="file in listOfFiles" class="file-box">
                        <div class="file">
                            <a href="javascript:void(0)">
                                <span class="corner"></span>
                                <span class="corner-up" v-if='candelete'><a href="javascript:void(0)" style="color:red" v-on:click="deleteFile(file)"><i class="fa fa-times"></i></a></span>

                                <div class="icon">
                                    <i v-bind:class="icon(file).icon" v-bind:style="{color:icon(file).color}"></i>
                                </div>
                                <div class="file-name">
                                    <a v-bind:href="file.attributes.url" target='_blank'>{{file.attributes.name}}</a>
                                    <br/>
                                    <small>{{formatDate(file.attributes.updated_at)}}</small>
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
                pendingAjax: false
            };
        },
        props: {
            "api": String,
            "filter": String,
            "target": String,
            "candelete": Boolean,
            "canupload": Boolean,
            "col": String,
            "mode": String,
            "refresh": null,
        },
        watch: {
            'upload': function (value) {
                var self = this;
                self.loadFiles()
            },
            'filter': function () {
                this.loadFiles();
            },
            'target': function () {
                this.loadFiles();
            },
            'refresh': function () {
                this.loadFiles();
            },
        },
        methods: {
            colDef1: function () {
                if (this.col) {
                    return "col-sm-"+this.col+" col-md-"+this.col;
                } else {
                    return "col-sm-5 col-md-3";
                }
            },
            colDef2: function () {
                if (this.col) {
                    return "col-sm-"+(12-this.col)+" col-md-"+(12-this.col) + " animated fadeInRight";
                } else {
                    return "col-sm-7 col-md-9 animated fadeInRight";
                }
            },
            loadFiles: function () {
                var self = this;
                if (self.pendingAjax) return;
                var filter = self.filter;
                self.pendingAjax = true;
                $.ajax({
                    'url': self.api,
                    'method': 'GET',
                    'dataType': 'json',
                    'data': {
                        filter: filter
                    },
                    'success': function (data) {
                        self.pendingAjax = false;
                        if (filter==self.filter) {
                            self.listOfFiles.splice(0);
                            data.data.forEach(function (file) {
                                self.listOfFiles.push(file);
                            });
                        } else {
                            self.loadFiles();
                        }
                    },
                    'error': function () {
                        self.pendingAjax = false;
                        if (filter!=self.filter) {
                            self.loadFiles();
                        }
                    }
                });
            },
            formatDate(unixTimestamp) {
                return new Date(unixTimestamp*1000).toLocaleDateString();
            },
            deleteFile: function (file) {
                var self = this;
                if (confirm('¿Desea eliminar el archivo '+file.attributes.name+'?')) {
                    $.ajax({
                        //Obtiene la direccion solo hasta el {storage}
                        // /api/folder/{storage}/{...}
                        'url': (self.api.split('/').length > 4 ? self.api.split('/').slice(0,4).join('/') : self.api)
                                + '/' + file.id,
                        'method': 'DELETE',
                        'dataType': 'json',
                        'success': function (data) {
                            self.loadFiles();
                        }
                    });
                }
            },
            icon: function (file) {
                var color, icon, type;
                switch (file.attributes.mime) {
                    case 'application/pdf':
                        icon = 'fa fa-file-pdf-o';
                        color = 'rgb(226, 31, 52)';
                        type = 'pdf';
                        break;
                    case 'application/msword':
                    case 'application/msword':
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.template':
                    case 'application/vnd.ms-word.document.macroEnabled.12':
                    case 'application/vnd.ms-word.template.macroEnabled.12':
                        icon = 'fa fa-file-word-o';
                        color = '#234486';
                        type = 'word';
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
        }
    });
</script>
