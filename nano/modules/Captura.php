<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://openbank.com/vue' xmlns:v-on='http://openbank.com/vue-on'>
<template>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div v-show.visible="!($root.getPaths().length > 2 &amp;&amp; $root.getPaths()[$root.getPaths().length-1].name.substr(0,1)=='*')">
                <h2 id="nav-tabs">Patrones de captura</h2>
                <abm
                        id="Captura.Captures"
                        vue:model="capture"
                        buttons="close,save,Procesar,Importar"
                        v-on:Procesar="procesar"
                        v-on:Importar="importar"
                        nameField="name">
                    <span></span>
                </abm>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" v-show.visible="$root.getPaths().length >= 1">
            <h2 id="nav-tabs">Priorizacion de Hojas</h2>
            <abm
                    id="Capture.Sheets"
                    vue:model="sheet"
                    toolbar="empty"
                    refreshWith="Captura.Captures"
                    nameField="name">
                    <span></span>
            </abm>
            <div v-show.visible="$root.getPaths().length >= 2">
                <h2 id="nav-tabs">Detalles</h2>
                <abm
                        id="Capture.Details"
                        vue:model="detail"
                        toolbar="new"
                        refreshWith="Capture.Sheets"
                        nameField="name">
                    <span></span>
                </abm>
            </div>
            <datatable vue:model="preview" toolbar="empty" refreshWith="Captura.Captures"></datatable>
        </div>
    </div>
</template>
<script>
    var module = new Module({
        "name": "Captura",
        "prefix": "exc",
        "title": "Captura de datos",
        "icon": "fa fa-cloud-upload",
        "menu": "main/Reportes",
        "models": [
            new Module.Model({
                "name": "capture",
                "title": "Captura",
                "pluralTitle": "Capturas",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Nombre",
                    }),
                    new Module.Model.Field({
                        "name": "part_of",
                        "type": "string",
                        "label": "Parte de",
                    }),
                    new Module.Model.Field({
                        "name": "file",
                        "type": "array",
                        "label": "Archivo",
                        "ui": "file",
                        "textField": function(data){return data?data.name:''},
                    }),
                    new Module.Model.Field({
                        "name": "temporal_table",
                        "type": "string",
                        "form": false,
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "imported_columns",
                        "type": "array",
                        "form": false,
                        "list": false,
                    }),
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "sheets",
                        "model": "sheet"
                    }),
                ],
                "events": {
                    "creating": <?php
                    function (CaptureCreating $event) {
                        $event->capture->temporal_table = uniqid('tpm_');
                        \DB::select("CREATE TABLE ".$event->capture->temporal_table." ( like valores_produccion )");
                        \DB::select('ALTER TABLE "'.$event->capture->temporal_table.'" ADD CONSTRAINT "'.$event->capture->temporal_table.'_id_valor_index" UNIQUE ("id_valor");');
                    }
                    ?>,
                    "saved": <?php
                    function (CaptureSaved $event){
                        if(empty($event->capture->file)) {
                            return;
                        }
                        $import = new \App\Xls2Csv2Db;
                        $import->originalName = $event->capture->file['name'];
                        $import->filename = $event->capture->file['path'];
                        $sheets = $import->load(storage_path('app/public/'.$event->capture->file['path']));
                        $loadOrder = 1;
                        foreach ($sheets as $sheet) {
                            $sheetModel = $event->capture->sheets()->firstOrNew([
                                'number' => $sheet->number,
                            ]);
                            if (!$sheetModel->exists) {
                                $sheetModel->name = $sheet->name;
                                $sheetModel->rows = $sheet->rows;
                                $sheetModel->cols = count($sheet->columns);
                                $sheetModel->to_load = $sheet->rows ? 'si' : 'no';
                                $sheetModel->load_order = $sheet->rows ? $loadOrder++ : null;
                                $sheetModel->process = 'descombinar';
                                $sheetModel->save();
                            }
                            foreach ($sheet->columns as $c=>$column) {
                                $detail=$sheetModel->details()->firstOrNew([
                                    'name'=> $column
                                ]);
                                if (!$detail->exists) {
                                    $detail->name = $column;
                                    $detail->type = $c==0?'variable':'dimension';
                                    $detail->copia_inicio_fila = 2;
                                    $detail->copia_inicio_columna = $c+1;
                                    $detail->copia_fin_fila = $sheet->rows;
                                    $detail->copia_fin_columna = $c+1;
                                    $detail->pegado_inicio_fila = 1;
                                    $detail->repetir_pegado = 1;
                                    $detail->save();
                                }
                            }
                        }
                    }
                    ?>,
                },
                "methods": {
                    "procesar()": <?php
                    function procesar() {
                        $import = new \App\Xls2Csv2Db;
                        $import->originalName = $this->file['name'];
                        $import->filename = $this->file['path'];
                        $sql = "BEGIN TRANSACTION;\n";
                        $sql.= "truncate ".$this->temporal_table.";\n";
                        $targetCols = [];
                        foreach($this->sheets()->orderBy('load_order')->get() as $sheet) {
                            if($sheet->to_load!='si') {
                                continue;
                            }
                            $sql.=$sheet->import($import, $this->temporal_table, $targetCols);
                        }
                        $sql.= "COMMIT;\n";
                        $tmpFile = $this->temporal_table.'.sql';
                        \Storage::disk('local')->put($tmpFile, $sql);
                        $datos = \App\Models\Connections\Connection::where("name", "datos")->first();
                        $pdo = \DB::connection("datos")->getPdo();
                        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 0);
                        $pdo->exec($sql);
                        $this->imported_columns = array_keys($targetCols);
                        $this->save();
                        return $this->imported_columns;
                    }
                    ?>,
                    "preview()": <?php
                    function preview() {
                        if (empty($this->temporal_table)) {
                            return [];
                        }
                        $importedColumns = $this->imported_columns;
                        $importedColumns[] = \DB::raw('(select name from be_variables where be_variables.id=id_variable) as variable');
                        return \DB::connection('datos')
                                ->table($this->temporal_table)
                                ->select($importedColumns)
                                ->get();
                    }
                    ?>,
                    "importar()": <?php
                    function importar() {
                        $columns = \DB::connection("datos")->getSchemaBuilder()->getColumnListing("valores_produccion");
                        $vpc=[];
                        foreach($columns as $c) {
                            if($c!='id_valor') {
                                $vpc[]=$c;
                            }
                        }
                        $sql = "BEGIN TRANSACTION;\n";
                        $sql.= "insert into valores_produccion(".implode(',',$vpc).") select ".implode(',',$vpc)." from ".$this->temporal_table.";\n";
                        $sql.= "COMMIT;\n";
                        $pdo = \DB::connection("datos")->getPdo();
                        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 0);
                        $pdo->exec($sql);
                    }
                    ?>,
                },
            }),
            new Module.Model({
                "name": "sheet",
                "title": "Hoja",
                "pluralTitle": "Hojas",
                "fields": [
                    new Module.Model.Field({
                        "name": "number",
                        "type": "string",
                        "label": "Núumero",
                        "form":false,
                        "list":false,
                    }),
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Nombre",
                        "form":false,
                    }),
                    new Module.Model.Field({
                        "name": "rows",
                        "type": "string",
                        "label": "Filas",
                        "form":false,
                    }),
                    new Module.Model.Field({
                        "name": "cols",
                        "type": "string",
                        "label": "Columns",
                        "form":false,
                    }),
                    new Module.Model.Field({
                        "name": "to_load",
                        "type": "string",
                        "label": "Selección de carga",
                        "ui": "select",
                        "enum": ["si", "no"],
                    }),
                    new Module.Model.Field({
                        "name": "load_order",
                        "type": "integer",
                        "label": "Orden de carga",
                    }),
                    new Module.Model.Field({
                        "name": "process",
                        "type": "string",
                        "label": "Funciones",
                        "ui": "tags",
                        "enum": ["descombinar","ignorar filas vacias"],
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "capture",
                        "model": "capture"
                    }),
                    new Module.Model.HasMany({
                        "name": "details",
                        "model": "detail"
                    }),
                ],
                "methods": {
                    "-import()": <?php
                    function import(\App\Xls2Csv2Db $import, $tmpTable, &$targetCols) {
                        $sheet = (object) [
                            "number" => $this->number,
                            "source" => $this->capture->file['path'],
                            "file" => realpath(storage_path('/app')).'/public/'.
                                basename($this->capture->file['path']).'.'.$this->number.'.csv',
                            "table_name" => uniqid('tmp_'),
                            "columns" => [],
                        ];
                        foreach ($this->details()->orderBy('id')->get() as $detail) {
                            $sheet->columns[]=$detail->name;
                        }
                        $fillMergedCells = strpos(','.$this->process, ',descombinar,')!==false;
                        $ignoreEmptyRows = strpos(','.$this->process, ',ignorar filas vacias,')!==false;
                        $sql = $import->importSheet($sheet, \DB::connection("datos"), $fillMergedCells, $ignoreEmptyRows);

                        $tmpDimensions = uniqid('tpm_');
                        $sql.= "CREATE TABLE $tmpDimensions ( \"id\" integer NOT NULL );\n";

                        $tmpVariables = uniqid('tpm_');
                        $sql.= "CREATE TABLE $tmpVariables ( \"id\" integer NOT NULL );\n";
                        
                        foreach ($this->details as $detail) {
                            $sql.=$detail->import($sheet, $tmpTable, $tmpDimensions,  $tmpVariables, $targetCols);
                        }
                        /*$columns = \DB::connection("datos")->getSchemaBuilder()->getColumnListing("valores_produccion");
                        $vpc=[];
                        foreach($columns as $c) {
                            if($c!='id_valor') {
                                $vpc[]=$c;
                            }
                        }*/
                        $sql.= "update $tmpTable set defecto_valor_cargado=valor_cargado;\n";
                        /*$sql.= "insert into valores_produccion(".implode(',',$vpc).") select ".implode(',',$vpc)." from $tmpTable;\n";*/
                        $sql.= "insert into dimension_variable(dimension_id, variable_id) select distinct $tmpDimensions.id, $tmpVariables.id from $tmpDimensions, $tmpVariables;\n";
                        $sql.= "drop table ".$sheet->table_name.";\n";
                        //$sql.= "drop table $tmpTable;\n";
                        $sql.= "drop table $tmpDimensions;\n";
                        $sql.= "drop table $tmpVariables;\n";
                        return $sql;
                    }
                    ?>,
                }
            }),
            new Module.Model({
                "name": "detail",
                "title": "Detalle",
                "pluralTitle": "Detalle",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "label": "Columna",
                        "readonly": true,
                    }),
                    new Module.Model.Field({
                        "name": "type",
                        "type": "string",
                        "label": "Tipo",
                        "ui": "select",
                        "enum": ["variable", "dimension", "nueva dimension"],
                        "default": "Dimension/Columna",
                    }),
                    new Module.Model.Field({
                        "name": "dimension_name",
                        "type": "string",
                        "label": "Nombre dimensión",
                        "form": false,
                    }),
                    new Module.Model.Field({
                        "name": "capture",
                        "type": "string",
                        "label": "Captura de valor",
                        "ui": "select",
                        "enum": ["Capturar de hoja", "Por defecto", "Sin captura"],
                        "default": "Sin captura",
                    }),
                    new Module.Model.Field({
                        "name": "default_value",
                        "type": "string",
                        "label": "Valor por defecto",
                    }),
                    new Module.Model.Field({
                        "name": "copia_inicio_fila",
                        "type": "string",
                        "label": "Copia inicio fila",
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "copia_inicio_columna",
                        "type": "string",
                        "label": "Copia inicio columna",
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "copia_fin_fila",
                        "type": "string",
                        "label": "Copia fin fila",
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "copia_fin_columna",
                        "type": "string",
                        "label": "Copia fin columna",
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "incremento_secuencia",
                        "type": "string",
                        "label": "Incremento secuencia",
                        "list": false,
                        "default": "1",
                    }),
                    new Module.Model.Field({
                        "name": "direccion_incremento",
                        "type": "string",
                        "label": "Direccion incremento",
                        "ui": "select",
                        "enum": ["columna", "fila"],
                        "list": false,
                        "default": "columna",
                    }),
                    new Module.Model.Field({
                        "name": "pegado_inicio_fila",
                        "type": "string",
                        "label": "Pegado inicio fila",
                        "list": false,
                    }),
                    /*new Module.Model.Field({
                        "name": "pegado_inicio_columna",
                        "type": "string",
                        "label": "Pegado inicio columna",
                        "list": false,
                    }),
                    /*new Module.Model.Field({
                        "name": "pegado_accion",
                        "type": "string",
                        "label": "Pegado accion",
                        "ui": "select",
                        "enum": ["normal", "transponer"],
                        "default": "normal",
                        "list": false,
                    }),*/
                    new Module.Model.Field({
                        "name": "repetir_pegado",
                        "type": "integer",
                        "label": "Repetir pegado",
                        "list": false,
                        "default": "1",
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "sheet",
                        "model": "sheet"
                    }),
                    new Module.Model.BelongsTo({
                        "name": "dimension",
                        "module": "ReportsFolders",
                        "model": "dimension",
                        "label": "Dimensión",
                        "list": true,
                        "form": true,
                        "ui": "select",
                        "source": new Module.View.ModelInstance("ReportsFolders.Dimension"),
                        "textField": "name",
                        "nullable": true,
                        "position": 2,
                    }),
                ],
                "methods": {
                    "-import()": <?php
                    function import($sheet, $tmpTable, $tmpDimensions, $tmpVariables, &$targetCols){
                        $sql = '';
                        $pegado_inicio_fila = $this->pegado_inicio_fila;
                        //for($rep=0;$rep<$this->repetir_pegado;$rep++) {
                            if ($this->capture==='Sin captura') {
                                return '';
                            }
                            if($this->direccion_incremento==='columna') {
                                if($this->type=='variable') {
                                    $targetCol = 'id_variable';
                                    $sourceColCasted = $targetCol;
                                } else {
                                    if (empty($this->dimension)) {
                                        return '';
                                    }
                                    $targetCol = $this->dimension->column;
                                }
                                for($c=$this->copia_inicio_columna;$c<=$this->copia_fin_columna;$c+=$this->incremento_secuencia)
                                for($rep=0;$rep<$this->repetir_pegado;$rep++) {
                                    $sourceCol = 'Columna_'.\App\Xls2Csv2Db::columnName($c-1);
                                    $copia_inicio_fila = $this->copia_inicio_fila;
                                    $copia_fin_fila = $this->copia_fin_fila;
                                    if ($this->type=='variable' && $rep===0) {
                                        $sql.= 'insert into be_variables(name) select distinct '.$sheet->table_name.'."'.$sourceCol.'" from '.$sheet->table_name.' where id>='.$copia_inicio_fila.' and id<='.$copia_fin_fila.' and '.$sheet->table_name.'."'.$sourceCol.'" not in (select name from be_variables);'."\n";
                                    }
                                    if($this->type=='variable') {
                                        $sourceCol = "(select be_variables.id from be_variables where be_variables.name=".$sheet->table_name.".\"$sourceCol\")";
                                    }
                                    if ($this->capture==='Capturar de hoja') {
                                        if (empty($this->dimension)) {
                                            $sourceColCasted = $sourceCol;
                                        } else {
                                            $sourceColCasted = $this->dimension->numeric=='si'? 'cast(replace("'.$sourceCol.'", \',\', \'\') as numeric)' : '"'.$sourceCol.'"';
                                        }
                                    } elseif ($this->capture==='Por defecto') {
                                        if (empty($this->dimension)) {
                                            $sourceColCasted = $this->default_value;
                                        } else {
                                            $sourceColCasted = $this->dimension->numeric=='si'? $this->default_value * 1 : "'".str_replace("'", "\\'", $this->default_value)."'";
                                        }
                                    }
                                    $targetCols[$targetCol]=$targetCol;
                                    //$sql.= "insert into $tmpTable(id_valor,$targetCol) select $pegado_inicio_fila+id-$copia_inicio_fila, $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila ON CONFLICT(id_valor) DO UPDATE SET $targetCol=excluded.$targetCol;\n";
                                    $sql.= "insert into $tmpTable(id_valor) select $pegado_inicio_fila+id-$copia_inicio_fila from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and $pegado_inicio_fila+id-$copia_inicio_fila not in (select id_valor from $tmpTable);\n";
                                    $sql.= "update $tmpTable set $targetCol = $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and id_valor=$pegado_inicio_fila+id-$copia_inicio_fila;\n";
                                    $pegado_inicio_fila+=$this->copia_fin_fila - $this->copia_inicio_fila + 1;
                                    //$pegado_inicio_fila+=$this->pegado_salto;
                                }
                            } else {
                                if($this->type=='variable') {
                                    $targetCol = 'id_variable';
                                    $sourceColCasted = $targetCol;
                                } else {
                                    if (empty($this->dimension)) {
                                        return '';
                                    }
                                    $targetCol = $this->dimension->column;
                                }
                                for($fila=$this->copia_inicio_fila;$fila<=$this->copia_fin_fila;$fila+=$this->incremento_secuencia) {
                                    for($c=$this->copia_inicio_columna;$c<=$this->copia_fin_columna;$c+=$this->incremento_secuencia)
                                    for($rep=0;$rep<$this->repetir_pegado;$rep++) {
                                        $sourceCol = 'Columna_'.\App\Xls2Csv2Db::columnName($c-1);
                                        $copia_inicio_fila = $fila;
                                        $copia_fin_fila = $fila;
                                        if ($this->type=='variable' && $rep===0) {
                                            $sql.= 'insert into be_variables(name) select distinct '.$sheet->table_name.'."'.$sourceCol.'" from '.$sheet->table_name.' where id>='.$copia_inicio_fila.' and id<='.$copia_fin_fila.' and '.$sheet->table_name.'."'.$sourceCol.'" not in (select name from be_variables);'."\n";
                                        }
                                        if($this->type=='variable') {
                                            $sourceCol = "(select be_variables.id from be_variables where be_variables.name=".$sheet->table_name.".\"$sourceCol\")";
                                        }
                                        if ($this->capture==='Capturar de hoja') {
                                            if (empty($this->dimension)) {
                                                $sourceColCasted = $sourceCol;
                                            } else {
                                                $sourceColCasted = $this->dimension->numeric=='si'? 'cast(replace("'.$sourceCol.'", \',\', \'\') as numeric)' : '"'.$sourceCol.'"';
                                            }
                                        } elseif ($this->capture==='Por defecto') {
                                            if (empty($this->dimension)) {
                                                $sourceColCasted = $this->default_value;
                                            } else {
                                                $sourceColCasted = $this->dimension->numeric=='si'? $this->default_value * 1 : "'".str_replace("'", "\\'", $this->default_value)."'";
                                            }
                                        }
                                        $targetCols[$targetCol]=$targetCol;
                                        //$sql.= "insert into $tmpTable(id_valor,$targetCol) select $pegado_inicio_fila+id-$copia_inicio_fila, $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila ON CONFLICT(id_valor) DO UPDATE SET $targetCol=excluded.$targetCol;\n";
                                        $sql.= "insert into $tmpTable(id_valor) select $pegado_inicio_fila+id-$copia_inicio_fila from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and $pegado_inicio_fila+id-$copia_inicio_fila not in (select id_valor from $tmpTable);\n";
                                        $sql.= "update $tmpTable set $targetCol = $sourceColCasted from ".$sheet->table_name." where id>=$copia_inicio_fila and id<=$copia_fin_fila and id=$pegado_inicio_fila+id-$copia_inicio_fila;\n";
                                        $pegado_inicio_fila+= 1;
                                    }
                                    //$pegado_inicio_fila+=$this->pegado_salto;
                                }
                            }
                        //}
                        $sql.= "insert into $tmpVariables(id) select id_variable from $tmpTable where id_variable is not null;\n";
                        if ($this->type==='nueva dimension') {
                            $sql.="insert into be_dimensions(\"name\",\"column\") values ('".str_replace("'","\\'",$this->dimension_name)."','".$this->dimension->column."');\n";
                            $sql.="insert into $tmpDimensions(id) values (currval('be_dimensions_id_seq'));\n";
                        } elseif ($this->type==='dimension') {
                            $sql.="insert into $tmpDimensions(id) values (".$this->dimension->id.");\n";
                        }
                        return $sql;
                    }
                    ?>
                }
            }),
        ],
        "views": {
        },
        "data": {
            capture: new Module.View.ModelInstance("Captura.Capture"),
            sheet: new Module.View.ModelInstance("Captura.Sheet", "Captura/captures/{module.capture.id}/sheets"),
            detail: new Module.View.ModelInstance("Captura.Detail", "Captura/captures/{module.capture.id}/sheets/{module.sheet.id}/details"),
            preview: new Module.View.Code(function(){
                return {
                $url:function(){
                    return '/api/Captura/captures/'+(module.capture.id?module.capture.id:"0")+'/preview';
                },
                $list:function(){return 'raw=1';},
                $columns:function(){
                    var columns = [];
                    columns.push({title:'variable', data: 'variable'});
                    if (module.capture.imported_columns &amp;&amp; typeof module.capture.imported_columns.forEach==='function') {
                        module.capture.imported_columns.forEach(function (col) {
                            columns.push({title:col, data: col});
                        });
                    }
                    return columns;
                },
                setRefreshListCallback: function() {
                    
                },
            }}),
        },
        "methods": {
            procesar:function(model){
                var self = this;
                model.$save('', function() {
                    model.$methods.procesar(function(result){
                        model.imported_columns = result;
                        self.$children[3].redraw();
                    });
                });
            },
            importar:function(model){
                var self = this;
                model.$methods.importar(function(result){
                });
            },
        },
    });
</script>
</root>