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
     'created_at' => '2017-04-05 17:55:19',
     'updated_at' => '2017-04-05 17:55:19',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('be_dimensions')->insert(array (
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
try{DB::table('be_domains')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'La Paz',
     'synonyms' => NULL,
     'dimension_id' => 26,
     'created_at' => '2017-04-05 20:27:02',
     'updated_at' => '2017-04-05 20:27:02',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'Cochabamba',
     'synonyms' => NULL,
     'dimension_id' => 26,
     'created_at' => '2017-04-05 20:27:13',
     'updated_at' => '2017-04-05 20:27:13',
     'deleted_at' => NULL,
  )),
  2 => 
  (array(
     'id' => 3,
     'name' => 'Santa Cruz',
     'synonyms' => NULL,
     'dimension_id' => 26,
     'created_at' => '2017-04-05 20:27:19',
     'updated_at' => '2017-04-05 20:27:19',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('be_folders')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'Mis Reportes',
     'type' => 'FOLDER',
     'folder_id' => NULL,
     'created_at' => '2017-04-05 17:53:28',
     'updated_at' => '2017-04-05 17:53:28',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('be_reports')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'Mi Reporte',
     'variables' => '1',
     'aggregator' => 'sum',
     'rows' => '1',
     'cols' => NULL,
     'folder_id' => 1,
     'created_at' => '2017-04-05 17:55:43',
     'updated_at' => '2017-04-05 17:55:43',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('be_variables')->insert(array (
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
     'id' => 11,
     'name' => 'cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  11 => 
  (array(
     'id' => 12,
     'name' => 'Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  12 => 
  (array(
     'id' => 13,
     'name' => 'coberturas de control prenatal',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  13 => 
  (array(
     'id' => 14,
     'name' => 'Consulta externa de la población de 5 años y más',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  14 => 
  (array(
     'id' => 15,
     'name' => 'Consulta externa en la población menor de 5 años',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  15 => 
  (array(
     'id' => 16,
     'name' => 'Control de crecimiento a niños menores de cinco años nuevos y repetidos',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  16 => 
  (array(
     'id' => 17,
     'name' => 'Estudios citológicos vaginales (PAP) de mujeres en edad fértil',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  17 => 
  (array(
     'id' => 18,
     'name' => 'Número de camas',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  18 => 
  (array(
     'id' => 19,
     'name' => 'Dosis de vacunas aplicadas a menores de 1 año',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  19 => 
  (array(
     'id' => 20,
     'name' => 'Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  20 => 
  (array(
     'id' => 21,
     'name' => 'Vitamina "A" aplicada a menores de 5 años',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  21 => 
  (array(
     'id' => 22,
     'name' => 'Presupuesto Aprobado',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  22 => 
  (array(
     'id' => 23,
     'name' => 'Credito Vigente',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  23 => 
  (array(
     'id' => 24,
     'name' => 'Presupuesto Comprometido',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  24 => 
  (array(
     'id' => 25,
     'name' => 'Presupuesto Devengado',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  25 => 
  (array(
     'id' => 26,
     'name' => 'Presupuesto Pagado',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  26 => 
  (array(
     'id' => 27,
     'name' => 'Saldo por Devengar',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  27 => 
  (array(
     'id' => 28,
     'name' => 'Deuda Flotante',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  28 => 
  (array(
     'id' => 29,
     'name' => 'Proyecciones de población, según departamento y municipio',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  29 => 
  (array(
     'id' => 30,
     'name' => 'Procedencia del Agua que utilizan en la vivienda',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  30 => 
  (array(
     'id' => 31,
     'name' => 'Tipo de desagüe del servicio sanitario',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  31 => 
  (array(
     'id' => 32,
     'name' => 'Procedencia de Energía Eléctrica',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  32 => 
  (array(
     'id' => 33,
     'name' => 'Total Ingreso',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  33 => 
  (array(
     'id' => 34,
     'name' => 'Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  34 => 
  (array(
     'id' => 35,
     'name' => 'Impuesto Directo a los Hidrocarburos (IDH)',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  35 => 
  (array(
     'id' => 36,
     'name' => 'Fondo de Compensación Departamental',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  36 => 
  (array(
     'id' => 37,
     'name' => 'Regalías Mineras',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  37 => 
  (array(
     'id' => 38,
     'name' => 'Regalías Hidrocarburiferas',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  38 => 
  (array(
     'id' => 39,
     'name' => 'Regalías Forestales',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  39 => 
  (array(
     'id' => 40,
     'name' => 'Ingresos Tributarios',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  40 => 
  (array(
     'id' => 41,
     'name' => 'Transferencias por coparticipación tributaria',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
  41 => 
  (array(
     'id' => 42,
     'name' => 'Prevalencia de desnutrición crónica',
     'tags' => NULL,
     'description' => NULL,
     'created_at' => NULL,
     'updated_at' => NULL,
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('usradm_logins')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'username' => 'admin',
     'password' => 'admin',
     'token' => '58e50ad56c972',
     'created_at' => '2017-04-05 15:18:45',
     'updated_at' => '2017-04-05 15:18:45',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'username' => 'davidcallizaya@gmail.com',
     'password' => 'diccionario',
     'token' => '58e52906b31f4',
     'created_at' => '2017-04-05 17:27:34',
     'updated_at' => '2017-04-05 17:27:34',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('usradm_roles')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'name' => 'Administrador',
     'status' => 'ACTIVE',
     'dashboard' => 'dashboard1',
     'created_at' => '2017-04-05 15:17:32',
     'updated_at' => '2017-04-05 15:17:32',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'name' => 'Básico',
     'status' => 'ACTIVE',
     'dashboard' => 'dashboard1',
     'created_at' => '2017-04-05 15:17:44',
     'updated_at' => '2017-04-05 15:17:44',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
try{DB::table('usradm_users')->insert(array (
  0 => 
  (array(
     'id' => 1,
     'username' => 'admin',
     'password' => 'admin',
     'nombres' => 'admin',
     'paterno' => '',
     'materno' => '',
     'email' => '',
     'unidad' => '',
     'role_id' => 1,
     'created_at' => '2017-04-05 15:18:34',
     'updated_at' => '2017-04-05 15:18:34',
     'deleted_at' => NULL,
  )),
  1 => 
  (array(
     'id' => 2,
     'username' => 'davidcallizaya@gmail.com',
     'password' => 'diccionario',
     'nombres' => 'David',
     'paterno' => 'Callizaya',
     'materno' => 'davidcallizaya@gmail.com',
     'email' => '',
     'unidad' => '',
     'role_id' => 1,
     'created_at' => '2017-04-05 17:27:24',
     'updated_at' => '2017-04-05 17:27:24',
     'deleted_at' => NULL,
  )),
));}catch(\Exception $e){echo $e->getMessage(),"\n";}
