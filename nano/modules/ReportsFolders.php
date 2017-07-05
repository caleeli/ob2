<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano2.com/vue'>
<template>
    <div class="row">
        <div id='configChart' class="col-xs-12 col-sm-12 col-md-4 col-lg-4 collapse-xs collapse-sm collapse-md" data-toggle="collapse-xs collapse-sm collapse-md">
            <div v-show.visible="!($root.getPaths().length > 2 &amp;&amp; $root.getPaths()[$root.getPaths().length-1].name.substr(0,1)=='*')">
                <h2 id="nav-tabs">Carpetas</h2>
                <abmgroup
                    id="ReportsFolders.Folders"
                    vue:model="folder"
                    groupField="folder_id"
                    vue:root="null"
                    typeField="type"
                    nameField="name"
                    leafType="LEAF"
                    childrenAssociation="children" >
                </abmgroup>
            </div>
            <div v-show.visible="$root.getPaths().length > 1">
                <h2 id="nav-tabs">Reportes</h2>
                <abm
                        id="ReportsFolders.Reports"
                        vue:model="report"
                        refreshWith="ReportsFolders.Folders"
                        nameField="name">
                    <span></span>
                </abm>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" v-show.visible="$root.getPaths().length > 2">
            <chart refreshWith="ReportsFolders.Reports,form@ReportsFolders.Reports" vue:model="report"/>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "ReportsFolders",
        "prefix": "be",
        "title": "Reportes",
        "icon": "fa fa-folder",
        "menu": "main/Reportes",
        "models": [
            new Module.Model({
                "name": "report",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Nombre",
                    }),
                    new Module.Model.Field({
                        "name": "variables",
                        "type": "string",
                        "list": false,
                        "label": "Variables",
                        "source": new Module.View.ModelInstance("ReportsFolders.Variable", "ReportsFolders/variables?sort=name"),
                        "textField": "name",
                        "ui": "tags",
                    }),
                    //information_source
                    //periodicity
                    new Module.Model.Field({
                        "name": "aggregator",
                        "type": "string",
                        "list": false,
                        "ui": "select",
                        "label": "Agregación",
                        "enum": ["sum", "max", "min", "avg"],
                    }),
                    new Module.Model.Field({
                        "name": "rows",
                        "type": "string",
                        "list": false,
                        "label": "Filas",
                        "source": function(){
                            return module.report.$selectFrom('dimensiones', {variables:module.report.variables,domains:false});
                        },
                        "textField": "name",
                        "ui": "tags",
                    }),
                    new Module.Model.Field({
                        "name": "cols",
                        "type": "string",
                        "list": false,
                        "label": "Columnas",
                        "source": function(){
                            return module.report.$selectFrom('dimensiones', {variables:module.report.variables,domains:false});
                        },
                        "textField": "name",
                        "ui": "tags",
                    }),
                    new Module.Model.Field({
                        "name": "chart_type",
                        "type": "string",
                        "list": false,
                        "form": false,
                        "default": "line",
                        "label": "Tipo de gráfico",
                        "enum": [
                            "bar",
                            "bar2",
                            "horizontalBar",
                            "area",
                            "line",
                            "pie",
                            "polarArea",
                            "pivot",
                        ],
                        "ui": "select",
                    }),
                    new Module.Model.Field({
                        "name": "filter",
                        "type": "string",
                        "list": false,
                        "label": "Filtro",
                        "source": function(){
                            return module.report.$selectFrom('dimensiones', {variables:module.report.variables,domains:true});
                        },
                        "textField": "name",
                        "ui": "filter",
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "folder",
                        "model": "folder"
                    }),
                    new Module.Model.BelongsToMany({
                        "name": "variableTags",
                        "model": "variable_tag",
                        "label": "Clasificación",
                        "form": true,
                        "ui": "tags",
                        "source": function(){
                            return module.variableTags;
                        },
                        "textField": "name",
                    }),
                    new Module.Model.HasMany({
                        "name": "variables",
                        "model": "variable"
                    }),
                ],
                "methods": {
                    "dashboard1(t)": <?php
                        function dashboard1($t=0)
                        {
                            $res = ['x'=>[],'series'=>['reportes'=>[]]];
                            $rep = \DB::select("select (select be_folders.name from be_folders where be_folders.id=be_reports.folder_id) as name, count(*) as count from be_reports group by folder_id");
                            foreach ($rep as $row) {
                                $res['x'][] = $row->name;
                                $res['series']['reportes'][] = $row->count;
                            }
                            return $res;
                        }
                    ?>,
                    "listVariables(ids)": <?php
                        function listVariables($ids)
                        {
                            $variables = explode(',', $ids);
                            $list = [];
                            foreach($variables as $var) {
                                $list[] = \App\Models\ReportsFolders\Variable::findOrFail($var);
                            }
                            return $list;
                        }
                    ?>,
                    "tablas(conn)": <?php
                    function tablas($conn=null) {
                        $collection = [];
                        $tables = \DB::connection("datos")->getDoctrineSchemaManager()->listTableNames();
                        $type = 'tables';
                        foreach ($tables as $name) {
                            $collection[] = [
                                'type'          => $type,
                                'id'            => $name,
                                'attributes'    => ['name'=>$name],
                                'relationships' => [],
                            ];
                        }
                        return ['data'=>$collection];
                    }
                    ?>,
                    "columnas(tabla)": <?php
                    function columnas($tabla='ejemplo') {
                        $collection = [];
                        $columns = \DB::connection("datos")->getSchemaBuilder()->getColumnListing($tabla);
                        $type = 'columns';
                        foreach ($columns as $name) {
                            $collection[] = [
                                'type'          => $type,
                                'id'            => $name,
                                'attributes'    => ['name'=>$name],
                                'relationships' => [],
                            ];
                        }
                        return ['data'=>$collection];
                    }
                    ?>,
                    "dimensiones(variables,domains)": <?php
                    function dimensiones($variables='',$domains=false) {
                        $collection = [];
                        if(empty($variables)) {
                            return ['data'=>$collection];
                        }
                        if(!is_array($variables)) {
                            $ids = explode(',', "$variables");
                        } else {
                            $ids = [];
                            foreach ($variables as $v) {
                                $ids[] = $v['id'];
                            }
                        }
                        $variableRows = \App\Models\ReportsFolders\Variable::whereIn(
                            'id',
                            $ids
                        )->get();
                        $dims = [];
                        $first = true;
                        foreach($variableRows as $var) {
                            $dims1 = [];
                            foreach($var->dimensions()->get() as $dim) {
                                if($first || isset($dims[$dim->id])) {
                                    $dims1[$dim->id] = $dim;
                                }
                            }
                            $dims = $dims1;
                            $first = false;
                        }
                        uasort($dims, function($a, $b) {
                            return strcasecmp($a->name, $b->name);
                        });
                        $type = 'ReportsFolders.Dimension';
                        foreach ($dims as $dim) {
                            $relationships = [];
                            if ($domains) {
                                $relationships["domains"]=[];
                                foreach($dim->domains()->get() as $dom) {
                                    $relationships["domains"][]=[
                                        'type'          => "ReportsFolders.Domain",
                                        'id'            => $dom->name,
                                        'attributes'    => ['name'=>$dom->name],
                                        'relationships' => [],
                                    ];
                                }
                            }
                            $collection[] = [
                                'type'          => $type,
                                'id'            => $dim->id,
                                'attributes'    => ['name'=>$dim->name],
                                'relationships' => $relationships,
                            ];
                        }
                        return ['data'=>$collection];
                    }
                    ?>,
                }
            }),
            new Module.Model({
                "name": "folder",
                "title": "Carpeta",
                "pluralTitle": "Carpetas",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Nombre",
                    }),
                    new Module.Model.Field({
                        "name": "type",
                        "type": "string",
                        "default": "FOLDER",
                        "enum": ["FOLDER", "LEAF"],
                        "label": "Tipo",
                        "list": false,
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "folder",
                        "model": "folder",
                        "nullable": true,
                    }),
                    new Module.Model.HasMany({
                        "name": "children",
                        "model": "folder"
                    }),
                    new Module.Model.HasMany({
                        "name": "reports",
                        "model": "report"
                    }),
                ]
            }),
            new Module.Model({
                "name": "variable_tag",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Nombre",
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsToMany({
                        "name": "variables",
                        "model": "variable",
                    }),
                    new Module.Model.BelongsToMany({
                        "name": "reports",
                        "model": "report",
                    }),
                ],
                methods:{
                    "tagsList()": <?php
                    function tagsList() {
                        $collection = [];
                        $list = $this->all();
                        $type = 'variable_tag';
                        foreach ($list as $row) {
                            $collection[] = [
                                'type'          => $type,
                                'id'            => $row->name,
                                'attributes'    => $row,
                                'relationships' => [],
                            ];
                        }
                        return ['data'=>$collection];
                    }
                    ?>
                }
            }),
            new Module.Model({
                "name": "variable",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "label": "Nombre",
                        "type": "string",
                    }),
                    new Module.Model.Field({
                        "name": "description",
                        "label": "Descripción",
                        "list": false,
                        "type": "string",
                    }),
                    new Module.Model.Field({
                        "name": "image",
                        "label": "Imagen",
                        "list": false,
                        "type": "string",
                    }),
                    new Module.Model.Field({
                        "name": "aggregator",
                        "type": "string",
                        "list": false,
                        "ui": "select",
                        "label": "Agregación",
                        "enum": ["sum", "max", "min", "avg"],
                    }),
                    new Module.Model.Field({
                        "name": "rows",
                        "type": "string",
                        "list": false,
                        "label": "Filas",
                        "source": function(){
                            return module.report.$selectFrom('dimensiones', {variables:self.id,domains:false});
                        },
                        "textField": "name",
                        "ui": "tags",
                    }),
                    new Module.Model.Field({
                        "name": "cols",
                        "type": "string",
                        "list": false,
                        "label": "Columnas",
                        "source": function(){
                            return module.report.$selectFrom('dimensiones', {variables:self.id,domains:false});
                        },
                        "textField": "name",
                        "ui": "tags",
                    }),
                    new Module.Model.Field({
                        "name": "filter",
                        "type": "string",
                        "list": false,
                        "label": "Filtro",
                        "source": function(){
                            return module.report.$selectFrom('dimensiones', {variables:self.id,domains:true});
                        },
                        "textField": "name",
                        "ui": "filter",
                    }),
                    new Module.Model.Field({
                        "name": "information_source",
                        "label": "Fuente de información",
                        "list": false,
                        "form": true,
                        "type": "string",
                    }),
                    new Module.Model.Field({
                        "name": "file",
                        "type": "array",
                        "label": "Archivo fuente",
                        "ui": "file",
                        "textField": function(data){return data?data.name:''},
                    }),
                    new Module.Model.Field({
                        "name": "periodicity",
                        "label": "Periodicidad",
                        "list": false,
                        "form": true,
                        "type": "string",
                    }),
                    new Module.Model.Field({
                        "name": "source_link",
                        "label": "Enlance de descarga",
                        "list": false,
                        "form": false,
                        "type": "string",
                    }),
                    new Module.Model.Field({
                        "name": "chart_type",
                        "type": "string",
                        "list": false,
                        "form": true,
                        "label": "Tipo de gráfico",
                        "default": "line",
                        "enum": [
                            "bar",
                            "bar2",
                            "horizontalBar",
                            "area",
                            "line",
                            "pie",
                            "polarArea",
                            "pivot",
                        ],
                        "ui": "select",
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsToMany({
                        "name": "dimensions",
                        "model": "dimension",
                        "position": 4,
                        "form": true,
                        "ui": "tags",
                        "source": function(){
                            return module.dimension;
                        },
                        "textField": "name",
                    }),
                    new Module.Model.BelongsToMany({
                        "name": "variableTags",
                        "model": "variable_tag",
                        "label": "Tags",
                        "form": true,
                        "ui": "tags",
                        "source": function(){
                            return module.variableTags;
                        },
                        "textField": "name",
                    }),
                ],
            }),
            new Module.Model({
                "name": "unit",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string"
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "family",
                        "model": "family"
                    }),
                ]
            }),
            new Module.Model({
                "name": "family",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "label": "Nombre",
                        "type": "string",
                    }),
                    new Module.Model.Field({
                        "name": "main_unit",
                        "label": "Unidad principal",
                        "type": "string"
                    }),
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "dimensions",
                        "model": "dimension",
                    }),
                ]
            }),
            new Module.Model({
                "name": "dimension",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "label": "Nombre",
                        "type": "string"
                    }),
                    new Module.Model.Field({
                        "name": "column",
                        "label": "Columna de la tabla",
                        "type": "string"
                    }),
                    new Module.Model.Field({
                        "name": "arbitrary",
                        "label": "Arbitraria",
                        "type": "string",
                        "enum": ["si", "no"],
                        "default": "no",
                        "ui": "select",
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "numeric",
                        "label": "Es numeral",
                        "type": "string",
                        "enum": ["si", "no"],
                        "default": "no",
                        "ui": "select",
                        "list": false,
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "family",
                        "model": "family",
                        "label": "Familia",
                        "ui": "select",
                        "source": function(){
                            return module.family;
                        },
                        "textField": "name",
                        "nullable": true,
                    }),
                    new Module.Model.HasMany({
                        "name": "domains",
                        "model": "domain",
                    }),
                    new Module.Model.BelongsToMany({
                        "name": "variables",
                        "model": "variable"
                    }),
                ]
            }),
            new Module.Model({
                "name": "domain",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "label": "Nombre",
                        "type": "string"
                    }),
                    new Module.Model.Field({
                        "name": "synonyms",
                        "label": "Sinónimos (separados por comas)",
                        "type": "string"
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "dimension",
                        "model": "dimension",
                        "nullable": true,
                    }),
                ]
            }),
            new Module.Model({
                "name": "formula",
                "fields": [
                    new Module.Model.Field({
                        "name": "formula",
                        "label": "Fórmula y = f(x)",
                        "type": "string"
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "origin",
                        "label": "Unidad origen (x)",
                        "list": true,
                        "form": true,
                        "textField": "name",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("ReportsFolders.Unit"),
                        "model": "unit"
                    }),
                    new Module.Model.BelongsTo({
                        "name": "target",
                        "label": "Unidad destino (y)",
                        "list": true,
                        "form": true,
                        "textField": "name",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("ReportsFolders.Unit"),
                        "model": "unit"
                    }),
                ]
            }),
        ],
        "views": {
        },
        "data": {
            report: new Module.View.ModelInstance("ReportsFolders.Report", "ReportsFolders/folders/{module.folder.id}/reports"),
            folder: new Module.View.ModelInstance("ReportsFolders.Folder"),
            //conexion: new Module.View.ModelInstance("Connections.Connection"),
            //table: new Module.View.ModelInstance("Connections.Co", "ReportsFolders/connections/{module.conexion.id}/tables"),
            table: new Module.View.ModelInstance("ReportsFolders.Report"),
            variableTags: new Module.View.ModelInstance("ReportsFolders.VariableTag"),
            dimension: new Module.View.ModelInstance("ReportsFolders.Dimension"),
            domain: new Module.View.ModelInstance("ReportsFolders.Domain"),
        }
    });
</script>
</root>