<?php
try{DB::table('conn_connections')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'datos',
     'driver' => 'pgsql',
     'host' => 'entreparentesys.com',
     'port' => '5432',
     'database' => 'base_estadistica',
     'username' => 'postgres',
     'password' => 'secret',
     'charset' => 'utf-8',
     'collation' => '',
     'created_at' => '2017-03-07 13:31:46',
     'updated_at' => '2017-03-27 22:46:23',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'finanzas',
     'driver' => 'mysql',
     'host' => '127.0.0.1',
     'port' => '',
     'database' => 'finanzas',
     'username' => 'dsss',
     'password' => 'dddd',
     'charset' => '',
     'collation' => '',
     'created_at' => '2017-03-11 01:41:56',
     'updated_at' => '2017-03-27 22:16:10',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('repfol_dimensions')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'valor por defecto',
     'column' => 'defecto_valor_cargado',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'clasificación entidad',
     'column' => 'ordinal_valor_4',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  2 => 
  (array(
     'id' => 3,
     'name' => 'tipo de consulta externa',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  3 => 
  (array(
     'id' => 4,
     'name' => 'número de dosis',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  4 => 
  (array(
     'id' => 5,
     'name' => 'nombre mes',
     'column' => 't_mes_cadena',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  5 => 
  (array(
     'id' => 6,
     'name' => 'tipo de consulta prenatal',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  6 => 
  (array(
     'id' => 7,
     'name' => 'Impuesto',
     'column' => 'ordinal_valor_4',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  7 => 
  (array(
     'id' => 8,
     'name' => 'clasificación Entidad',
     'column' => 'ordinal_valor_4',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  8 => 
  (array(
     'id' => 9,
     'name' => 'rango de edad',
     'column' => 'ordinal_valor_3',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  9 => 
  (array(
     'id' => 10,
     'name' => 'tipo consulta externa',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  10 => 
  (array(
     'id' => 11,
     'name' => 'codigo comunidad',
     'column' => 'ordinal_valor_2',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  11 => 
  (array(
     'id' => 12,
     'name' => 'tipo de estudio',
     'column' => 'ordinal_valor_4',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  12 => 
  (array(
     'id' => 13,
     'name' => 'Entidad',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  13 => 
  (array(
     'id' => 14,
     'name' => 'tipo de centro de salud',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  14 => 
  (array(
     'id' => 15,
     'name' => 'mes',
     'column' => 't_mes',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  15 => 
  (array(
     'id' => 16,
     'name' => 'Genero',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  16 => 
  (array(
     'id' => 17,
     'name' => 'fecha',
     'column' => 't_fecha',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  17 => 
  (array(
     'id' => 18,
     'name' => 'pais',
     'column' => 'r_pais',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  18 => 
  (array(
     'id' => 19,
     'name' => 'tipo de valor',
     'column' => 'valor_tipo',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  19 => 
  (array(
     'id' => 20,
     'name' => 'tipo de procedencia del agua que utilizan en la vivienda',
     'column' => 'ordinal_valor_3',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  20 => 
  (array(
     'id' => 21,
     'name' => 'provincia',
     'column' => 'r_provincia',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  21 => 
  (array(
     'id' => 22,
     'name' => 'unidad de medida',
     'column' => 'valor_unidad_medida',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  22 => 
  (array(
     'id' => 23,
     'name' => 'frecuencia de medicion',
     'column' => 'valor_frecuencia_medicion',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  23 => 
  (array(
     'id' => 24,
     'name' => 'valor',
     'column' => 'valor_cargado',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  24 => 
  (array(
     'id' => 25,
     'name' => 'codigo Entidad',
     'column' => 'ordinal_valor_3',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  25 => 
  (array(
     'id' => 26,
     'name' => 'departamento',
     'column' => 'r_departamento',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  26 => 
  (array(
     'id' => 27,
     'name' => 'genero',
     'column' => 'ordinal_valor_1',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  27 => 
  (array(
     'id' => 28,
     'name' => 'edad de niño',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  28 => 
  (array(
     'id' => 29,
     'name' => 'municipio',
     'column' => 'r_municipio',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  29 => 
  (array(
     'id' => 30,
     'name' => 'tipo de atención por parto o postparto',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  30 => 
  (array(
     'id' => 31,
     'name' => 'nacimientos con bajo peso',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  31 => 
  (array(
     'id' => 32,
     'name' => 'tipo de estudio en mujeres',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  32 => 
  (array(
     'id' => 33,
     'name' => 'codigo entidad',
     'column' => 'ordinal_valor_3',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  33 => 
  (array(
     'id' => 34,
     'name' => 'unidad de medida por defecto',
     'column' => 'defecto_valor_unidad_medida',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  34 => 
  (array(
     'id' => 35,
     'name' => 'tipo de servicio',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  35 => 
  (array(
     'id' => 36,
     'name' => 'codigo entidad',
     'column' => 'ordinal_valor_4',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  36 => 
  (array(
     'id' => 37,
     'name' => 'año',
     'column' => 't_ano',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  37 => 
  (array(
     'id' => 38,
     'name' => 'dia',
     'column' => 't_dia',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  38 => 
  (array(
     'id' => 39,
     'name' => 'comunidad',
     'column' => 'r_comunidad',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  39 => 
  (array(
     'id' => 40,
     'name' => 'vacuna',
     'column' => 'ordinal_valor_5',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  40 => 
  (array(
     'id' => 41,
     'name' => 'Impuesto de hidrocarburos',
     'column' => 'ordinal_valor_3',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  41 => 
  (array(
     'id' => 42,
     'name' => 'Fuente transferencia',
     'column' => 'ordinal_valor_3',
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('repfol_domains')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'Tarija',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:45:50',
     'updated_at' => '2017-03-07 18:45:50',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'Chuquisaca',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:45:56',
     'updated_at' => '2017-03-07 18:45:56',
     'deleted_at' => NULL,
  )),
  2 => 
  (array(
     'id' => 3,
     'name' => 'Pando',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:46:04',
     'updated_at' => '2017-03-07 18:46:04',
     'deleted_at' => NULL,
  )),
  3 => 
  (array(
     'id' => 4,
     'name' => 'La Paz',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:46:13',
     'updated_at' => '2017-03-07 18:46:13',
     'deleted_at' => NULL,
  )),
  4 => 
  (array(
     'id' => 5,
     'name' => 'Cochabamba',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:46:20',
     'updated_at' => '2017-03-07 18:46:20',
     'deleted_at' => NULL,
  )),
  5 => 
  (array(
     'id' => 6,
     'name' => 'Potosi',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:46:28',
     'updated_at' => '2017-03-07 18:46:28',
     'deleted_at' => NULL,
  )),
  6 => 
  (array(
     'id' => 7,
     'name' => 'Santa Cruz',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:46:37',
     'updated_at' => '2017-03-07 18:46:37',
     'deleted_at' => NULL,
  )),
  7 => 
  (array(
     'id' => 8,
     'name' => 'Oruro',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:46:43',
     'updated_at' => '2017-03-07 18:46:43',
     'deleted_at' => NULL,
  )),
  8 => 
  (array(
     'id' => 9,
     'name' => 'Beni',
     'synonyms' => NULL,
     'dimension_id' => 1,
     'created_at' => '2017-03-07 18:46:52',
     'updated_at' => '2017-03-07 18:46:52',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('repfol_folders')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'Mis Reportes',
     'type' => 'FOLDER',
     'folder_id' => NULL,
     'created_at' => '2017-03-08 03:34:19',
     'updated_at' => '2017-03-08 03:34:19',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'Pendientes',
     'type' => 'FOLDER',
     'folder_id' => NULL,
     'created_at' => '2017-03-09 19:31:17',
     'updated_at' => '2017-03-09 19:31:17',
     'deleted_at' => NULL,
  )),
  2 => 
  (array(
     'id' => 3,
     'name' => 'Observados',
     'type' => 'FOLDER',
     'folder_id' => NULL,
     'created_at' => '2017-03-09 19:31:23',
     'updated_at' => '2017-03-09 19:31:23',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('repfol_reports')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'el reporte',
     'variables' => '1,2',
     'aggregator' => 'sum',
     'rows' => '',
     'cols' => '26',
     'folder_id' => 1,
     'created_at' => '2017-03-28 16:41:59',
     'updated_at' => '2017-03-28 20:26:51',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('repfol_variables')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'Población por género',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'Poblaciòn por rangos de edad',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  2 => 
  (array(
     'id' => 3,
     'name' => 'Bebes con bajo peso al nacer',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  3 => 
  (array(
     'id' => 4,
     'name' => 'Atención de parto y postparto',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  4 => 
  (array(
     'id' => 5,
     'name' => 'Mortalidad Neonatal (MN)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  5 => 
  (array(
     'id' => 6,
     'name' => 'Mortalidad P-Neonatal (MPN) ',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  6 => 
  (array(
     'id' => 7,
     'name' => 'Mortalidad Infantil (1q0)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  7 => 
  (array(
     'id' => 8,
     'name' => 'Mortalidad Post-Infantil (4q1)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  8 => 
  (array(
     'id' => 9,
     'name' => 'Mortalidad En la Niñes (5q0)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  9 => 
  (array(
     'id' => 10,
     'name' => 'Aplicación de vacuna a niños de un año',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  10 => 
  (array(
     'id' => 12,
     'name' => 'Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  11 => 
  (array(
     'id' => 13,
     'name' => 'coberturas de control prenatal',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  12 => 
  (array(
     'id' => 14,
     'name' => 'Consulta externa de la población de 5 años y más',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  13 => 
  (array(
     'id' => 15,
     'name' => 'Consulta externa en la población menor de 5 años',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  14 => 
  (array(
     'id' => 16,
     'name' => 'Control de crecimiento a niños menores de cinco años nuevos y repetidos',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  15 => 
  (array(
     'id' => 17,
     'name' => 'Estudios citológicos vaginales (PAP) de mujeres en edad fértil',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  16 => 
  (array(
     'id' => 18,
     'name' => 'Número de camas',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  17 => 
  (array(
     'id' => 19,
     'name' => 'Dosis de vacunas aplicadas a menores de 1 año',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  18 => 
  (array(
     'id' => 22,
     'name' => 'Presupuesto Aprobado',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  19 => 
  (array(
     'id' => 23,
     'name' => 'Credito Vigente',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  20 => 
  (array(
     'id' => 24,
     'name' => 'Presupuesto Comprometido',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  21 => 
  (array(
     'id' => 25,
     'name' => 'Presupuesto Devengado',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  22 => 
  (array(
     'id' => 26,
     'name' => 'Presupuesto Pagado',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  23 => 
  (array(
     'id' => 27,
     'name' => 'Saldo por Devengar',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  24 => 
  (array(
     'id' => 28,
     'name' => 'Deuda Flotante',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  25 => 
  (array(
     'id' => 29,
     'name' => 'Proyecciones de población, según departamento y municipio',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  26 => 
  (array(
     'id' => 30,
     'name' => 'Procedencia del Agua que utilizan en la vivienda',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  27 => 
  (array(
     'id' => 31,
     'name' => 'Tipo de desagüe del servicio sanitario',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  28 => 
  (array(
     'id' => 32,
     'name' => 'Procedencia de Energía Eléctrica',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  29 => 
  (array(
     'id' => 33,
     'name' => 'Total Ingreso',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  30 => 
  (array(
     'id' => 34,
     'name' => 'Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  31 => 
  (array(
     'id' => 35,
     'name' => 'Impuesto Directo a los Hidrocarburos (IDH)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  32 => 
  (array(
     'id' => 36,
     'name' => 'Fondo de Compensación Departamental',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  33 => 
  (array(
     'id' => 37,
     'name' => 'Regalías Mineras',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  34 => 
  (array(
     'id' => 38,
     'name' => 'Regalías Hidrocarburiferas',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  35 => 
  (array(
     'id' => 39,
     'name' => 'Regalías Forestales',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  36 => 
  (array(
     'id' => 40,
     'name' => 'Ingresos Tributarios',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  37 => 
  (array(
     'id' => 41,
     'name' => 'Transferencias por coparticipación tributaria',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  38 => 
  (array(
     'id' => 42,
     'name' => 'Prevalencia de desnutrición crónica',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  39 => 
  (array(
     'id' => 43,
     'name' => 'test',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('repfol_variable_tags')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'comercio',
     'created_at' => '2017-03-05 12:21:40',
     'updated_at' => '2017-03-05 12:21:40',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'construcción',
     'created_at' => '2017-03-05 12:21:56',
     'updated_at' => '2017-03-05 12:21:56',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('usradm_logins')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'username' => 'admin',
     'password' => 'admin',
     'token' => '58be9ec98b6ac',
     'created_at' => '2017-03-07 11:51:37',
     'updated_at' => '2017-03-07 11:51:37',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('usradm_roles')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'Administradores',
     'status' => 'ACTIVE',
     'dashboard' => 'dashboard1',
     'created_at' => '2017-03-07 11:47:19',
     'updated_at' => '2017-03-07 11:47:19',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'Básicos',
     'status' => 'ACTIVE',
     'dashboard' => 'dashboard1',
     'created_at' => '2017-03-07 11:47:52',
     'updated_at' => '2017-03-07 11:47:52',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('usradm_users')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'username' => 'admin',
     'password' => 'admin',
     'nombres' => 'Administrador',
     'paterno' => '',
     'materno' => '',
     'email' => 'davidcallizaya@gmail.com',
     'unidad' => '',
     'role_id' => 1,
     'created_at' => '2017-03-07 11:48:51',
     'updated_at' => '2017-03-07 11:48:51',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
