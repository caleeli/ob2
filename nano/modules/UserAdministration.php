<?xml version="1.0" encoding="UTF-8"?>
<root xmlns:vue='http://nano.com/vue'>
<script>
    var module = new Module({
        "name": "UserAdministration",
        "prefix": "adm",
        "title": "Usuarios",
        "icon": "fa fa-users",
        "menu": "main/Configuración",
        "models": [
            new Module.Model({
                "name": "user",
                "extends": "\\Illuminate\\Foundation\\Auth\\User",
                "fields": [
                    new Module.Model.Field({
                        "name": "username",
                        "type": "string",
                        "label": "Usuario",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "password",
                        "type": "string",
                        "label": "Contraseña",
                        "list": false,
                        "default": "",
                        "ui": "password",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "nombres",
                        "type": "string",
                        "label": "Nombres",
                        "default": "",
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "apellidos",
                        "type": "string",
                        "label": "Apellidos",
                        "default": "",
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "fotografia",
                        "type": "array",
                        "label": "Fotografia",
                        "ui": "file",
                        "textField": function(data){return data?data.name:''},
                    }),
                    new Module.Model.Field({
                        "name": "numero_ci",
                        "type": "integer",
                        "label": "Nro de CI",
                        "default": 0,
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "tipo_doc_ci",
                        "type": "integer",
                        "label": "Tipo Doc de CI",
                        "default": 0,
                        "list": false,
                        "form": false,
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "ext_doc",
                        "type": "integer",
                        "label": "Extensión Doc",
                        "default": 0,
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_estado_civil",
                        "type": "string",
                        "label": "Estado Civil",
                        "default": "",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "fecha_nac",
                        "type": "date",
                        "label": "Fecha Nac",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "dep_cod",
                        "type": "integer",
                        "label": "Codigo Dep",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_ciudad",
                        "type": "integer",
                        "label": "Codigo Ciudad",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "tipo_persona",
                        "type": "integer",
                        "label": "Tipo Persona",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_nac",
                        "type": "integer",
                        "label": "Cod Nac",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "nivel_edu",
                        "type": "integer",
                        "label": "Nivel de Educación",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_cliente",
                        "type": "integer",
                        "label": "Codigo Cliente",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "fec_ven_cliente",
                        "type": "integer",
                        "label": "Fecha de vencimiento Cliente",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "email",
                        "type": "string",
                        "label": "Correo Electronico",
                        "default": "",
                        "list": false,
                        "ui": "email",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "nro_dependientes",
                        "type": "string",
                        "label": "Nro Dependientes",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "calificacion",
                        "type": "string",
                        "label": "Calificación",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                     new Module.Model.Field({
                        "name": "direccion",
                        "type": "string",
                        "label": "Dirección",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                     new Module.Model.Field({
                        "name": "ubicacion",
                        "type": "string",
                        "label": "Ubicación",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "fec_registro",
                        "type": "date",
                        "label": "Fecha de Registro",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                     new Module.Model.Field({
                        "name": "hora_registro",
                        "type": "date",
                        "label": "Hora de Registro",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_mun",
                        "type": "string",
                        "list": false,
                        "label": "Codigo Municipio",
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_prov",
                        "type": "string",
                        "label": "Codigo Provincia",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "cod_zona",
                        "type": "string",
                        "default": "Codigo Zona",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "unidad",
                        "type": "string",
                        "label": "Entidad / Unidad",
                        "default": "",
                        "list": false,
                        "form": false,
                        "required": false
                    }),
                    new Module.Model.Field({
                        "name": "remember_token",
                        "type": "string",
                        "label": "remember_token",
                        "default": "",
                        "list": false,
                        "form": false,
                        "required": false
                    })
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "logins",
                        "model": "login"
                    }),
                    new Module.Model.BelongsTo({
                        "name": "role",
                        "model": "role"
                    }),
                    new Module.Model.HasMany({
                        "name": "uais",
                        "model": "uai",
                        "foreignKey": "owner_id",
                        "localKey": "id"
                    }),
                    new Module.Model.HasMany({
                        "name": "firmas",
                        "model": "firma",
                        "foreignKey": "owner_id",
                        "localKey": "id"
                    }),
                ],
                "methods": {
                    "-setPasswordAttribute()": <?php function ($value) {
                        if ($this->attributes['password']!=$value) {
                            $this->attributes['password'] = md5($value);
                        }
                    }
                    ?>,
                    "registrar(data)": <?php
                        function ($data) {
                            $userExists = User::where('username', '=', $data['username'])
                                ->first();
                            if ($userExists) {
                                throw new \Exception("Usuario ya existe");
                            }
                            $data['role_id'] = 2;
                            $user = new \App\Models\UserAdministration\User($data);
                            \Mail::to($data['email'])
                                ->send(new \App\Mail\RegistroUsuario($user));
                            $user->save();
                            return $data;
                        }
                    ?>
                }
            }),
            /**
             * roles
             */
            new Module.Model({
                "name": "role",
                "title": "Rol",
                "pluralTitle": "Roles",
                "fields": [
                    new Module.Model.Field({
                        "name": "name",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "status",
                        "type": "string",
                        "default": "ACTIVE",
                        "required": true,
                        "ui": "select",
                        "enum": ["ACTIVE", "INACTIVE"]
                    })
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "users",
                        "model": "user"
                    })
                ]
            }),
            /**
             * empresa
             */
            new Module.Model({
                "name": "empresa",
                "title": "empresa",
                "pluralTitle": "empresas",
                "fields": [
                    new Module.Model.Field({
                        "name": "cod_empresa",
                        "type": "string",
                        "label": "Código",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "nombre_empresa",
                        "label": "Empresa",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "corporacion",
                        "label": "Corporación",
                        "list": false,
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "caracter",
                        "label": "Caracter",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "rubro",
                        "label": "Rubro",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "tipologia",
                        "label": "Tipologia",
                        "type": "string",
                        "default": "",
                        "list": false,
                    }),
                    new Module.Model.Field({
                        "name": "detalle_empresa",
                        "type": "string",
                        "list": false,
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "sub_empresa",
                        "type": "string",
                        "list": false,
                        "default": "0"
                    }),
                    new Module.Model.Field({
                        "name": "es_principal",
                        "type": "string",
                        "list": false,
                        "default": "0"
                    })
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "estados",
                        "model": "estado_financiero"
                    }),
                    new Module.Model.HasMany({
                        "name": "graficos",
                        "model": "empresa_grafico"
                    }),
                ],
                "methods": {
                    "-getDetalleEmpresaAttribute()": <?php
                        function($value)
                        {
                            $value = str_replace('{{$uc(\'3\')}}', '<span class="calculado" title="patrimonio">{{$uc(\'3\')}}</span>', $value);
                            $ev = new \App\Evaluator($this->id, date('Y'));
                            return $ev->calculate($value);
                        }
                    ?>,
                    "-setDetalleEmpresaAttribute()": <?php
                        function($value)
                        {
                            $dom = new \DOMDocument;
                            $dom->loadHTML($value);
                            $htmlWithTag = $value;
                            foreach($dom->getElementsByTagName('span') as $span) {
                                if ($span->getAttribute('class')==='calculado' &&
                                    $span->getAttribute('title')==='patrimonio'
                                ) {
                                    //$htmlWithTag = str_replace($dom->saveXML($span), '<span class="calculado" title="patrimonio">{{$uc(\'3\')}}</span>' , $htmlWithTag);
                                    $htmlWithTag = str_replace($dom->saveXML($span), '{{$uc(\'3\')}}' , $htmlWithTag);
                                }
                            }

                            $this->attributes['detalle_empresa'] = $htmlWithTag;
                        }
                    ?>,
                    "eeff(gestion, eeff)": <?php
                        function eeff($gestion, $eeff)
                        {
                            $ev = new \App\Evaluator($this->id, $gestion);
                            $res = [];
                            foreach ($eeff as $key => $val) {
                                $isChart = substr($key, 0, 5) === 'chart';
                                $cal = @$ev->calculate($val, $isChart);
                                if ($isChart) {
                                    $res[$key] = json_decode($cal);
                                } else {
                                    $res[$key] = $cal;
                                }
                            }
                            return $res;
                        }
                    ?>
                }
            }),
            /**
             * estado_financiero
             */
            new Module.Model({
                "name": "estado_financiero",
                "title": "Estado financiero",
                "pluralTitle": "Estados financieros",
                "fields": [
                    new Module.Model.Field({
                        "name": "tipo_estado_financiero",
                        "type": "string",
                        "label": "Tipo estado financiero",
                        "ui": "select",
                        "enum": [
                            "Balance General",
                            "Estado de Recursos y Gastos Corrientes",
                            "Hoja de Trabajo",
                            "Estado de Cambios en el Patrimonio Neto",
                            "Partidas y Rubros Financieros",
                            "Estado de Ejecución Presupuestaria de Gastos",
                            "Estado de Ejecución Presupuestaria de Recursos"
                        ],
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "informes_auditoria",
                        "label": "Informes auditoria",
                        "type": "string",
                        "form": false,
                        "list": false,
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "label": "Gestión",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "archivo",
                        "type": "array",
                        "label": "Archivo",
                        "ui": "file",
                        "textField": function(data){return data?data.name:''},
                    }),
                    new Module.Model.Field({
                        "name": "grafico_texto",
                        "label": "Gráfico texto",
                        "type": "string",
                        "list": false,
                        "ui": "html",
                        "form": false,
                        "list": false,
                        "default": "activo,pasivo"
                    }),
                    new Module.Model.Field({
                        "name": "prefix",
                        "type": "string",
                        "label": "prefix",
                        "list": false,
                        "form": false,
                    }),
                    new Module.Model.Field({
                        "name": "tablas",
                        "type": "array",
                        "label": "Tablas",
                        "ui": "tags",
                        "list": false,
                        "form": false,
                        "textField": function(data){return data?data.table_name:''},
                    }),
                    new Module.Model.Field({
                        "name": "grafico_valores",
                        "label": "Gráfico valores",
                        "type": "string",
                        "form": false,
                        "list": false,
                        "default": "4500,4000"
                    })
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "empresa",
                        "model": "empresa",
                        "label": "Empresa",
                        "nullable": true,
                        "list": true,
                        "textField": function(data){return data?(data.cod_empresa?data.cod_empresa:'   ')+' '+data.nombre_empresa:''},
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.Empresa"),
                        "form": true
                    })
                ],
                "events": {
                    "saving": <?php
                    function ($event) {
                        if (empty($event->estadoFinanciero->prefix)) {
                            $event->estadoFinanciero->prefix = uniqid('tmp_');
                        }
                        $ext = @array_pop(explode('.', $event->estadoFinanciero->archivo['name']));
                        if ($ext === 'xls' || $ext === 'xlsx') {
                            $file = realpath(storage_path('app/public/'.$event->estadoFinanciero->archivo['path']));
                            $event->estadoFinanciero->tablas = \App\Xls2Csv2Db::import(
                                $event->estadoFinanciero->prefix,
                                $file
                            );
                        }
                    }
                    ?>
                }
            }),
            /**
             * cuadro_financiero
             */
            new Module.Model({
                "name": "cuadro_financiero",
                "title": "Cuadro financiero",
                "pluralTitle": "Cuadros financieros",
                "fields": [
                    new Module.Model.Field({
                        "name": "titulo",
                        "type": "string",
                        "label": "Título",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "contenido",
                        "type": "string",
                        "label": "Formula (html)",
                        "ui": "html",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "grafico",
                        "type": "string",
                        "label": "Grafico (json)",
                        "default": ""
                    })
                ],
                "associations": [
                ],
                "events": {
                },
                "methods": {
                    "calculate(empresaId, gestion, html, grafico)": <?php
                        function ($empresaId, $gestion, $html, $grafico='{}') {
                            $ev = new \App\Evaluator($empresaId, $gestion);
                            $ppto = '<p class="desc-ind">La empresa cuenta con un presupuesto de Bs. {{$uf("Presup%Vig%")}}</p>
        <table style="height: 223px;" width="100%">
		<tbody>
		<tr>
		<td style="color: white; width: 236px;" rowspan="2">
		<div class="widget" style="text-align: center; background-color: #29B294; margin: 0px 12px 0px 0px; padding: 62px 0;">
		<h2>Bs. {{$uf("Presup%Vig%")}}</h2>
		<p>&nbsp;</p>
		<p>PRESUPUESTO&nbsp;</p>
		</div>
		</td>
		</tr>
		</tbody>
		</table>';
                            return [$ev->calculate($html), $ev->calculate($ppto), $ev->calculate($grafico, true)];
                        }
                    ?>
                }
            }),
            /**
             * empresa_grafico
             */
            new Module.Model({
                "name": "empresa_grafico",
                "title": "Empresa gráfico",
                "pluralTitle": "Empresa gráficos",
                "fields": [
                    new Module.Model.Field({
                        "name": "titulo",
                        "type": "string",
                        "label": "Título",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "tipo",
                        "type": "string",
                        "label": "Tipo",
                        "ui": "select",
                        "enum": ["bar", "line", "pie"],
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "informes_auditoria",
                        "label": "Informes auditoria",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "datos",
                        "label": "Datos",
                        "type": "array",
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "empresa",
                        "model": "empresa",
                        "nullable": true,
                        "textField": "nombre_empresa",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.Empresa"),
                        "list": false,
                        "form": false
                    })
                ],
                "events": {
                }
            }),
            /**
             * empresa_estado
             */
            new Module.ViewModel({
                "name": "empresa_estado",
                "title": "Estado financiero por empresa",
                "pluralTitle": "Estados financieros por empresa",
                "sql": "select max(adm_estado_financieros.id) as id, adm_empresas.id as empresa_id, nombre_empresa, gestion from adm_estado_financieros left join adm_empresas on (adm_estado_financieros.empresa_id=adm_empresas.id) group by adm_empresas.id, gestion",
                "fields": [
                    new Module.Model.Field({
                        "name": "nombre_empresa",
                        "type": "string",
                        "label": "Tipo",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "label": "Gestión",
                        "type": "string",
                        "default": ""
                    }),
                ],
                "associations": [
                    new Module.Model.HasMany({
                        "name": "estados",
                        "model": "estado_financiero",
                        "foreignKey": "empresa_id",
                        "localKey": "empresa_id",
                        "where": ["'gestion', '=', $this->gestion"]
                    }),
                ]
            }),
            /**
             * carga_estado
             */
            new Module.Model({
                "name": "carga_estado",
                "title": "Carga de estados financieros",
                "pluralTitle": "Cargas de estados financieros",
                "fields": [
                    new Module.Model.Field({
                        "name": "files",
                        "type": "array",
                        "label": "Archivos",
                        "ui": "multiplefile",
                        "textField": function(data,type,row){
                            var res = [];
                            data.forEach(function (item) {res.push(item.name)});
                            return res.join(", ");
                        }
                    }),
                ],
                "associations": [],
                "events": {
                    "saving": <?php
                    function ($event) {
                        $files = $event->cargaEstado->files;
                        foreach($files as $file) {
                            list($name, $ext) = explode('.', strtolower($file['name']));
                            list($cod, $emp, $gestion, $estado) = explode('_', $name, 4);
                            $em = \App\Models\UserAdministration\Empresa
                                ::where('cod_empresa', '=', $cod)
                                ->first();
                            if (!$em) continue;
                            $estadoF = [
                                'bg'=>'Balance General',
                                'erg'=>'Estado de Resultados y Gastos',
                                'ppto'=>'Estado de Ejecución Presupuestaria de Gastos',////todo
                                'ppto_ingreso' => 'Estado de Ejecución de Presupuesto de Recursos',
                            ][$estado];
                            $eeff = \App\Models\UserAdministration\EstadoFinanciero
                                ::where('empresa_id', '=', $em->id)
                                ->where('gestion', '=', $gestion)
                                ->where('tipo_estado_financiero', '=', $estadoF)
                                ->get();
                            $ok = false;
                            foreach($eeff as $ef) {
                                $extF = strtolower(@array_pop(explode('.', $ef->archivo['name'])));
                                if ( ($ext==='xls' || $ext==='xlsx') && ($extF==='xls' || $extF==='xlsx') ) {
                                    $ef->archivo = $file;
                                    $ef->save();
                                    $ok = true;
                                    break;
                                }
                                if ( ($ext==='pdf') && ($extF==='pdf') ) {
                                    $ef->archivo = $file;
                                    $ef->save();
                                    $ok = true;
                                    break;
                                }
                            }
                            if (!$ok) {
                                $ef = new \App\Models\UserAdministration\EstadoFinanciero;
                                $ef->empresa_id = $em->id;
                                $ef->gestion = $gestion;
                                $ef->tipo_estado_financiero = $estadoF;
                                $ef->archivo = $file;
                                $ef->save();
                            }
                        }
                    }
                    ?>
                }
            }),
            /**
             * Firmas.
             *
             */
            new Module.Model({
                "name": "firma",
                "title": "Firma",
                "table": "adm_evaluacion_consistencias",
                "pluralTitle": "Firmas de auditoria",
                "fields": [
                    new Module.Model.Field({
                        "name": "cod_firma",
                        "type": "string",
                        "label": "Código",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "informes",
                        "type": "array",
                        "label": "Informes SCEP",
                        "ui": "multiplefile",
                        "textField": function(data,type,row){
                            var res = [];
                            if (data &amp;&amp; typeof data.forEach==='function') {
                                data.forEach(function (item) {
                                    res.push('&lt;a href="' + item.url + '" target="_blank"&gt;' + item.name + '&lt;/a&gt;');
                                });
                            }
                            return res.join("&lt;br&gt; ");
                        }
                    }),
                    new Module.Model.Field({
                        "name": "informe_dictamen",
                        "label": "Dictamen o Informe",
                        "type": "array",
                        "ui": "file",
                        "textField": function(data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('&lt;a&gt;&lt;/a&gt;');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('&lt;i class="fa fa-download"&gt;&lt;/i&gt; ');
                            return $("&lt;div /&gt;").append($a).html()
                              + '&lt;br&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; '
                              + time;
                        },
                        "list": true,
                    }),
                    new Module.Model.Field({
                        "name": "documento_firma",
                        "type": "array",
                        "label": "Documento Firma",
                        "ui": "file",
                        "textField": function(data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('&lt;a&gt;&lt;/a&gt;');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('&lt;i class="fa fa-download"&gt;&lt;/i&gt; ');
                            return $("&lt;div /&gt;").append($a).html()
                              + '&lt;br&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; '
                              + time;
                        },
                    }),
                    new Module.Model.Field({
                        "name": "representante_legal",
                        "label": "Firma de auditoria",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "label": "Gestión",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "detalle",
                        "label": "Detalle",
                        "type": "string",
                        "default": "",
                        "list": false
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "empresa",
                        "model": "empresa",
                        "label": "Empresa auditada",
                        "nullable": true,
                        "list": true,
                        "textField": "nombre_empresa",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.Empresa"),
                        "form": true,
                        "position": 2,
                    }),
                    new Module.Model.BelongsTo({
                        "name": "owner",
                        "label": "Propietario",
                        "model": "user",
                        "textField": null,
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "default": "",
                        "nullable": true,
                        "form": false,
                        "list": true,
                        "visible": false
                    })
                ],
                "methods": {
                    "listEditButton(data, type, row, meta)": function(data, type, row, meta){
                        var owner_id = row.relationships.owner ? row.relationships.owner.id : false;
                        var canEdit = owner_id == localStorage.user_id;
                        return canEdit ? true : '';
                    }
                }
            }),
            /**
             * Contrataciones directas.
             *
             */
            new Module.Model({
                "name": "contratacion",
                "title": "Contratación",
                "table": "contrataciones",
                "pluralTitle": "Contrataciones directas",
                "fields": [
                    new Module.Model.Field({
                        "name": "cod_firma",
                        "type": "string",
                        "label": "Código",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "label": "Gestión",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "informe_dictamen",
                        "label": "Informe",
                        "type": "array",
                        "ui": "file",
                        "textField": function(data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('&lt;a&gt;&lt;/a&gt;');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('&lt;i class="fa fa-download"&gt;&lt;/i&gt; ');
                            return $("&lt;div /&gt;").append($a).html()
                              + '&lt;br&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; '
                              + time;
                        },
                        "list": true,
                    }),
                    new Module.Model.Field({
                        "name": "nota",
                        "type": "array",
                        "label": "Nota",
                        "ui": "file",
                        "textField": function(data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('&lt;a&gt;&lt;/a&gt;');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('&lt;i class="fa fa-download"&gt;&lt;/i&gt; ');
                            return $("&lt;div /&gt;").append($a).html()
                              + '&lt;br&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; '
                              + time;
                        },
                    }),
                    /*new Module.Model.Field({
                        "name": "usuario_abm_id",
                        "type": "integer",
                        "label": "usuario",
                        "list": false,
                    }),*/
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "empresa",
                        "model": "empresa",
                        "nullable": true,
                        "list": false,
                        "textField": "nombre_empresa",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.Empresa"),
                        "form": false
                    }),
                    new Module.Model.BelongsTo({
                        "name": "owner",
                        "label": "Propietario",
                        "model": "user",
                        "textField": null,
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "default": "",
                        "nullable": true,
                        "form": false,
                        "list": true,
                        "visible": false
                    })
                ],
                "methods": {
                    "listEditButton(data, type, row, meta)": function(data, type, row, meta){
                        return true;
                    }
                }
            }),
            /**
             * UAIs
             *
             */
            new Module.Model({
                "name": "uai",
                "title": "UAI",
                "pluralTitle": "UAIs",
                "fields": [
                    new Module.Model.Field({
                        "name": "cod_uai",
                        "type": "string",
                        "label": "Código",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion_uai",
                        "label": "Gestión",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "estructura_uai",
                        "label": "Estructura UAI",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "titular_uai",
                        "label": "Titular UAI",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "tipo_de_informes",
                        "label": "Tipo de Informes",
                        "type": "array",
                        "ui": "file",
                        "textField": function(data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var owner = typeof row.relationships.owner==='undefined' || !row.relationships.owner
                                ? ''
                                : row.relationships.owner.attributes.nombres + ' '
                                    + row.relationships.owner.attributes.apellidos;
                            var $a = $('&lt;a&gt;&lt;/a&gt;');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('&lt;i class="fa fa-download"&gt;&lt;/i&gt; ');
                            return $("&lt;div /&gt;").append($a).html()
                              + '&lt;br&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; '
                              + time
                              + '&lt;br&gt;&lt;i class="fa fa-user-o"&gt;&lt;/i&gt; '
                              + owner;
                        },
                        "list": true,
                    }),
                    new Module.Model.Field({
                        "name": "informes_emitidos_scep",
                        "label": "Informes emitidos SCEP",
                        "type": "array",
                        "ui": "file",
                        "textField": function(data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var owner = typeof row.relationships.owner==='undefined' || !row.relationships.owner
                                ? ''
                                : row.relationships.owner.attributes.nombres + ' '
                                    + row.relationships.owner.attributes.apellidos;
                            var $a = $('&lt;a&gt;&lt;/a&gt;');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('&lt;i class="fa fa-download"&gt;&lt;/i&gt; ');
                            return $("&lt;div /&gt;").append($a).html()
                              + '&lt;br&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; '
                              + time
                              + '&lt;br&gt;&lt;i class="fa fa-user-o"&gt;&lt;/i&gt; '
                              + owner;
                        },
                        "list": true,
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "empresa",
                        "model": "empresa",
                        "label": "Empresa",
                        "nullable": true,
                        "list": true,
                        "textField": "nombre_empresa",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.Empresa"),
                        "form": true,
                        "references": 'empresa_id',
                        "columns": 'cod_empresa',
                        "position": 2,
                    }),
                    new Module.Model.BelongsTo({
                        "name": "owner",
                        "label": "Propietario",
                        "model": "user",
                        "textField": null,
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "default": "",
                        "nullable": true,
                        "form": false,
                        "list": true,
                        "visible": false
                    }),
                ],
                "methods": {
                    "listEditButton(data, type, row, meta)": function(data, type, row, meta){
                        var owner_id = row.relationships.owner ? row.relationships.owner.id : false;
                        var canEdit = owner_id == localStorage.user_id;
                        return canEdit ? true : '';
                    }
                }
            }),
            /**
             * Tareas
             *
             */
            new Module.Model({
                "name": "tarea",
                "title": "Tarea",
                "pluralTitle": "Tareas",
                "fields": [
                    new Module.Model.Field({
                        "name": "cod_tarea",
                        "type": "string",
                        "label": "Código",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "nombre_tarea",
                        "label": "Tarea",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "descripcion",
                        "label": "Descripción",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "fecha_ini",
                        "label": "Fecha inicio",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "fecha_fin",
                        "label": "Fecha finalización",
                        "type": "string",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "estado",
                        "label": "Estado",
                        "type": "string",
                        "default": "Pendiente"
                    }),
                    new Module.Model.Field({
                        "name": "avance",
                        "label": "Avance",
                        "type": "integer",
                        "default": "0"
                    }),
                    new Module.Model.Field({
                        "name": "prioridad",
                        "label": "Prioridad",
                        "type": "string",
                        "default": "Media"
                    }),
                    new Module.Model.Field({
                        "name": "dias_otorgados",
                        "label": "días otorgados",
                        "type": "integer",
                        "default": "0"
                    }),
                    new Module.Model.Field({
                        "name": "nro_de_control",
                        "label": "Nro de control",
                        "type": "string"
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "label": "Gestion de la hoja de ruta",
                        "type": "string"
                    }),
                    new Module.Model.Field({
                        "name": "tipo",
                        "label": "Tipo de tarea",
                        "type": "string"
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsToMany({
                        "name": "usuarios",
                        "label": "Usuarios",
                        "model": "user",
                        "textField": function(data){console.log(arguments); return data?data.nombres + ' ' +data.apellidos:''},
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "default": "",
                        "position": 1,
                        "nullable": true,
                        "form": true,
                        "list": true
                    }),
                    new Module.Model.BelongsTo({
                        "name": "creador",
                        "label": "Creador",
                        "model": "user",
                        "textField": function(data){console.log(arguments); return data?data.nombres + ' ' +data.apellidos:''},
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "default": "",
                        "position": 1,
                        "nullable": true,
                        "form": true,
                        "list": true
                    }),
                    new Module.Model.BelongsTo({
                        "name": "revisor1",
                        "label": "Revisor 1",
                        "model": "user",
                        "nullable": true,
                        "list": false,
                        "textField": function(data){return data?data.nombres + ' ' +data.apellidos:''},
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "form": true
                    }),
                    new Module.Model.BelongsTo({
                        "name": "aprobacion1",
                        "label": "Aprovación 1",
                        "model": "user",
                        "nullable": true,
                        "list": false,
                        "textField": function(data){return data?data.nombres + ' ' +data.apellidos:''},
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "form": true
                    }),
                    new Module.Model.BelongsTo({
                        "name": "revisor2",
                        "label": "Revisor 2",
                        "model": "user",
                        "nullable": true,
                        "list": false,
                        "textField": "username",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "form": true
                    }),
                    new Module.Model.BelongsTo({
                        "name": "aprobacion2",
                        "label": "Aprovación 2",
                        "model": "user",
                        "nullable": true,
                        "list": false,
                        "textField": function(data){return data?data.nombres + ' ' +data.apellidos:''},
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.User"),
                        "form": true
                    }),
                    new Module.Model.HasMany({
                        "name": "adjuntos",
                        "model": "adjunto",
                        "form": true
                    }),
                    new Module.Model.HasMany({
                        "name": "avances",
                        "model": "avance",
                        "form": true
                    }),
                    new Module.Model.HasMany({
                        "name": "asignaciones",
                        "model": "asignacion"
                    }),
                ],
                "events": {
                    "saved": <?php
                    function ($event) {
                        if (!$event->tarea->cod_tarea) {
                            $event->tarea->cod_tarea = "SCEP-" . $event->tarea->id;
                            $event->tarea->save();
                        }
                    }
                    ?>
                },
                "methods": {
                    "-scopeWhereUserAssigned()": <?php
                        function ($query, $userId, $ownerId) {
                            return $query->whereIn('id', function($query) use($userId, $ownerId) {
                                $query->select('tarea_id')
                                ->from('tarea_user')
                                ->where(function ($query) use($userId, $ownerId) {
                                    if ($ownerId!='1') {
                                        $query->where('user_id', $userId)
                                            ->orWhere('creador_id', $ownerId);
                                    }
                                });
                            });
                        }
                    ?>,
                    "-getDiasPasadosAttribute()": <?php
                        function () {
                            return $this->created_at->diff(\Carbon\Carbon::now())->days;
                        }
                    ?>,
                    "-getAvanceAttribute()": <?php
                        function () {
                            $avancesPorPersona = [];
                            $lastAsignation = $this->asignaciones()->max('nro_asignacion');
                            $avances = $this->avances()->with('asignacion')->orderBy('id', 'asc')->get();
                            foreach ($avances as $avance) {
                                if ($avance->asignacion && $avance->asignacion->nro_asignacion==$lastAsignation) {
                                    $avancesPorPersona[$avance->usuario_abm_id] = $avance->avance;
                                }
                            }
                            $total = array_sum($avancesPorPersona);
                            $count = $this->asignaciones()->where('nro_asignacion', $lastAsignation)->count();
                            return $count> 0 ? $total / $count : 0;
                        }
                    ?>,
                    "-getUltimaAsignacionAttribute()": <?php
                        function () {
                            $asignaciones = $this->asignaciones()->orderBy('id', 'desc')->get();
                            $ultimos = [];
                            $first = false;
                            foreach($asignaciones as $asignacion)
                            {
                                $first = $first ?: $asignacion->nro_asignacion;
                                if ($first==$asignacion->nro_asignacion) {
                                    $ultimos[$asignacion->user_id]=$asignacion->id;
                                }
                            }
                            return $ultimos;
                        }
                    ?>,
                },
                "properties": {
                    "protected $appends": [
                        "dias_pasados",
                        "ultima_asignacion",
                    ],
                }
            }),
            /**
             * Asignación
             *
             */
            new Module.Model({
                "name": "asignacion",
                "title": "Asignación",
                "table": "tarea_user",
                "pluralTitle": "Asignaciones",
                "fields": [
                    new Module.Model.Field({
                        "name": "tarea_id",
                        "type": "int",
                        "label": "Tarea"
                    }),
                    new Module.Model.Field({
                        "name": "user_id",
                        "label": "Usuario",
                        "type": "integer"
                    }),
                    new Module.Model.Field({
                        "name": "nro_asignacion",
                        "label": "Nro asignación",
                        "type": "int"
                    }),
                    new Module.Model.Field({
                        "name": "dias_plazo",
                        "label": "Días plazo",
                        "type": "integer"
                    }),
                ],
                "associations": [
                ],
                "events": {
                },
                "methods": {
                    "-avances()": <?php
                    function () {
                        return $this->hasMany('App\Models\UserAdministration\Avance');
                    }
                    ?>
                },
                "properties": {
                }
            }),
            /**
             * Adjuntos de tarea
             */
            new Module.Model({
                "name": "adjunto",
                "fields": [
                    new Module.Model.Field({
                        "name": "archivo",
                        "type": "array",
                        "label": "Archivo",
                        "ui": "file",
                        "textField": function(data){return data?data.name:''},
                    })
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "tarea",
                        "model": "tarea",
                        "nullable": true,
                    }),
                ]
            }),
            /**
             * Actividades de la tarea
             */
            new Module.Model({
                "name": "avance",
                "fields": [
                    new Module.Model.Field({
                        "name": "avance",
                        "type": "integer",
                        "label": "Avance",
                    }),
                    new Module.Model.Field({
                        "name": "descripcion",
                        "type": "string",
                        "label": "Descripción",
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "tarea",
                        "model": "tarea",
                        "nullable": true,
                    }),
                    new Module.Model.BelongsTo({
                        "name": "usuario",
                        "model": "user",
                        "references": "usuario_abm_id",
                        "columns": "id",
                        "form": true
                    }),
                    new Module.Model.BelongsTo({
                        "name": "asignacion",
                        "model": "asignacion",
                        "form": true
                    }),
                ],
                "events": {
                    "saved": <?php
                    function (AvanceSaved $event) {
                        if (!$event->avance->tarea_id) {
                            return;
                        }
                        $event->avance->tarea->avance = $event->avance->tarea->getAvanceAttribute();
                        $event->avance->tarea->save();
                    }
                    ?>
                },
                "methods": {
                    "-getAvanceRelativoAttribute()": <?php
                    function () {
                        if (!$this->asignacion) return 0;
                        $nro_asignacion = $this->asignacion->nro_asignacion;
                        $count = $this->tarea->asignaciones()
                            ->where('nro_asignacion', $nro_asignacion)->count();
                        return $count> 0 ? $this->avance / $count : 0;
                    }
                    ?>
                },
                "properties": {
                    "protected $appends": [
                        "avance_relativo"
                    ],
                }
            }),
            /**
             * Login
             */
            new Module.Model({
                "name": "login",
                "fields": [
                    new Module.Model.Field({
                        "name": "username",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "password",
                        "type": "string",
                        "default": "",
                        "hash": true,
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "token",
                        "type": "string",
                        "default": "",
                        "required": true
                    })
                ],
                "associations": [
                ],
                "methods": {
                    "validate(username, password)": <?php
                        function ($username="", $password="") {
                            $user = User::where('username', '=', $username)
                                ->where('password', '=', md5($password))
                                ->first();
                            $token = uniqid();
                            if(!empty($user)){
                                $login = new Login();
                                $login->username = $username;
                                $login->password = md5($password);
                                $login->token = $token;
                                $login->save();
                            }
                            return !empty($user)?['token'=>$token,'user_id'=>$user->id,'redirect'=>$user->role_id==1?'admin':'basic']:false;
                        }
                    ?>
                }
            }),
            new Module.Model({
                "name": "recover",
                "fields": [
                    new Module.Model.Field({
                        "name": "account",
                        "type": "string",
                        "default": "",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "key",
                        "type": "string",
                        "default": "",
                        "required": true
                    })
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "user",
                        "model": "user",
                        "nullable": true
                    })
                ],
                "methods": {
                    "sendEmail(account)": <?php
                        function ($account) {
                            $enviado = false;
                            $usersByUsername = User::where('username', '=', $account)->get();
                            $usersByEmail = User::where('email', '=', $account)->get();
                            foreach($usersByUsername as $user) {
                                $recover = Recover::create([
                                    'account'=> $account,
                                    'key'=> uniqid('', true),
                                ]);
                                $recover->user()->associate($user);
                                \Mail::to($user->email)
                                    ->send(new \App\Mail\RecoverPassword($user, $recover));
                                $enviado = true;
                            }
                            foreach($usersByEmail as $user) {
                                if($user->username===$user->email) {
                                    continue;
                                }
                                $recover = Recover::create([
                                    'account'=> $account,
                                    'key'=> uniqid('', true),
                                ]);
                                $recover->user()->associate($user);
                                \Mail::to($user->email)
                                    ->send(new \App\Mail\RecoverPassword($user, $recover));
                                $enviado = true;
                            }
                            return $enviado;
                        }
                    ?>
                }
            }),
            /**
             * Documento subido al sistema.
             */
            new Module.Model({
                "name": "documento",
                "fields": [
                    new Module.Model.Field({
                        "name": "nombre",
                        "type": "string",
                        "label": "Nombre",
                        "required": true
                    }),
                    new Module.Model.Field({
                        "name": "archivo",
                        "type": "array",
                        "ui": "file",
                        "label": "Archivo",
                        "required": true
                    }),
                ],
                "associations": [],
                "methods": {
                }
            }),
            /**
             * hoja_trabajo
             */
            new Module.Model({
                "name": "hoja_trabajo",
                "title": "Hoja de trabajo",
                "pluralTitle": "Hojas de trabajo",
                "fields": [
                    new Module.Model.Field({
                        "name": "titulo",
                        "type": "string",
                        "label": "Título de la hoja de trabajo",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "templeta",
                        "type": "string",
                        "label": "ID de templeta",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "gestion",
                        "type": "string",
                        "label": "Gestión",
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "valores",
                        "type": "array",
                        "label": "Valores llenados",
                        "default": "{}"
                    }),
                ],
                "associations": [
                ],
                "events": {
                },
                "methods": {
                }
            }),
            /**
             * Fideicomisos.
             *
             */
            new Module.Model({
                "name": "fideicomiso",
                "title": "FIDEICOMISOS",
                "pluralTitle": "Empresas con asignación de Recursos Económicos",
                "fields": [
                    new Module.Model.Field({
                        "name": "decreto",
                        "type": "array",
                        "label": "Decreto",
                        "ui": "file",
                        "textField": function(data,type,row){
                            if (!data) {
                                return '';
                            }
                            var time = row.attributes.updated_at
                                ? dateFormat(
                                    new Date(row.attributes.updated_at+'Z'),
                                    'yyyy-mm-dd hh:MM:ss'
                                )
                                : '';
                            var $a = $('&lt;a&gt;&lt;/a&gt;');
                            $a.text(data.name);
                            $a.attr('href', data.url);
                            $a.attr('target', '_blank');
                            $a.prepend('&lt;i class="fa fa-download"&gt;&lt;/i&gt; ');
                            return $("&lt;div /&gt;").append($a).html()
                              + '&lt;br&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; '
                              + time;
                        },
                        "default": ""
                    }),
                    new Module.Model.Field({
                        "name": "financiador",
                        "label": "Financiador",
                        "type": "string",
                        "default": ""
                    }),
                ],
                "associations": [
                    new Module.Model.BelongsTo({
                        "name": "empresa",
                        "model": "empresa",
                        "nullable": true,
                        "list": true,
                        "textField": "nombre_empresa",
                        "ui": "select",
                        "source": new Module.View.ModelInstance("UserAdministration.Empresa"),
                        "form": true,
                        "position": 0
                    })
                ]
            }),
            /**
             * Clasificacion de empresas
             */
            new Module.Model({
                "name": "clasificacion_empresa",
                "title": "Clasificacion de empresas",
                "pluralTitle": "Clasificacion de empresas",
                "fields": [
                    new Module.Model.Field({
                        "name": "clasificacion",
                        "type": "string",
                        "label": "Clasificación",
                        "default": "",
                        "ui": "select",
                        "enum": [
                            "Sin clasificar",
                            "Empresas Departamentales",
                            "Empresa Nacional",
                            "Empresa Regional",
                            "Empresa Municipal",
                            "Empresa Productiva"
                        ]
                    }),
                    new Module.Model.Field({
                        "name": "conteo",
                        "label": "Conteo",
                        "type": "string",
                        "default": ""
                    }),
                ],
                "associations": [
                ]
            }),
        ]
    });
</script>
</root>