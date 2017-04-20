<?php

use Illuminate\Database\Seeder;
use App\Models\ReportsFolders\Variable;
use App\Models\ReportsFolders\Dimension;
use App\Models\ReportsFolders\Domain;
use App\Models\ReportsFolders\Family;

class ReportsFoldersSeeder extends Seeder
{
    protected $data = 'Estudios citológicos vaginales (PAP) de mujeres en edad fértil	t_dia	dia	tiempo	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Ingresos Tributarios	t_dia	dia	tiempo	Ingresos originados por los diferentes tributos
Porcentaje de Tipo de Vivienda	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de hogares según el tipo de vivienda
Porcentaje de la Población con Desague del servicio sanitario	r_pais	pais	region	Procentaje de la población con desague del servicio sanitario según el tipo
Credito Vigente	r_comunidad	comunidad	region	Credito Vigente según presupuesto
Deuda Flotante	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Deuda Flotante según Presupuesto
Saldo por Devengar	t_ano	año	tiempo	Saldo por Devengar del Presupuesto
Porcentaje de viviendas según Material en la pared	r_comunidad	comunidad	region	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Deuda Flotante	ordinal_valor_5	Entidad	ordinal	Deuda Flotante según Presupuesto
Mortalidad P-Neonatal (MPN) 	valor_unidad_medida	unidad de medida	unidad de medida	Mortalidad P-Neonatal (MPN)
Deuda Flotante	r_municipio	municipio	region	Deuda Flotante según Presupuesto
Procedencia de Energía Eléctrica	t_mes_cadena	nombre mes	tiempo	Procedencia de Energía Eléctrica según cesno 2012
Saldo por Devengar	t_dia	dia	tiempo	Saldo por Devengar del Presupuesto
Población por género	valor_cargado	valor	valor	Poblacion del censo 2012 por genero
Total Ingreso	t_mes_cadena	nombre mes	tiempo	Total ingreso
Ingresos Tributarios	t_ano	año	tiempo	Ingresos originados por los diferentes tributos
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	t_ano	año	tiempo	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Porcentaje de la Población con Desague del servicio sanitario	valor_tipo	tipo de valor	tipo de valor cargado	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de Tipo de Vivienda	r_pais	pais	region	Porcentaje de hogares según el tipo de vivienda
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	defecto_valor_cargado	valor por defecto	valor	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	t_mes_cadena	nombre mes	tiempo	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Transferencias por coparticipación tributaria	ordinal_valor_4	codigo entidad	ordinal	Transferencias por coparticipación tributaria
Ingresos Tributarios	defecto_valor_cargado	valor por defecto	valor	Ingresos originados por los diferentes tributos
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	r_departamento	departamento	region	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Porcentaje de la Población con Energia eléctrica en el hogar	r_comunidad	comunidad	region	Porcentaje de la Población con Energia eléctrica en el hogar
Presupuesto Devengado	t_fecha	fecha	tiempo	Presupuesto Devengado
Ingresos Tributarios	r_departamento	departamento	region	Ingresos originados por los diferentes tributos
Saldo por Devengar	defecto_valor_cargado	valor por defecto	valor	Saldo por Devengar del Presupuesto
Porcentaje de la Población con Acceso a agua	valor_cargado	valor	valor	Porcentaje de la población con acceso a agua según la procedencia
Control de crecimiento a niños menores de cinco años nuevos y repetidos	r_provincia	provincia	region	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Proyecciones de población, según departamento y municipio	t_mes_cadena	nombre mes	tiempo	Proyecciones de población, según departamento y municipio
Saldo por Devengar	r_departamento	departamento	region	Saldo por Devengar del Presupuesto
Consumo de agua Potable	t_mes_cadena	nombre mes	tiempo	Cantidad en miles de metros cúbicos de consumo de agua Potable
Presupuesto Comprometido	t_mes_cadena	nombre mes	tiempo	Presupuesto Comprometido
Control de crecimiento a niños menores de cinco años nuevos y repetidos	valor_tipo	tipo de valor	tipo de valor cargado	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Impuesto Directo a los Hidrocarburos (IDH)	r_departamento	departamento	region	Impuesto Directo a los Hidrocarburos (IDH)
Procedencia del Agua que utilizan en la vivienda	valor_unidad_medida	unidad de medida	unidad de medida	Procedencia del Agua que utilizan en la vivienda según censo 2012
Transferencias por coparticipación tributaria	t_mes	mes	tiempo	Transferencias por coparticipación tributaria
Población por género	t_fecha	fecha	tiempo	Poblacion del censo 2012 por genero
Impuesto Directo a los Hidrocarburos (IDH)	defecto_valor_cargado	valor por defecto	valor	Impuesto Directo a los Hidrocarburos (IDH)
Regalías Hidrocarburiferas	r_municipio	municipio	region	Regalías Hidrocarburiferas
Regalías Forestales	t_mes_cadena	nombre mes	tiempo	Regalías Forestales
Consulta externa de la población de 5 años y más	t_mes_cadena	nombre mes	tiempo	Consulta externa de la población de 5 años y más
Regalías Hidrocarburiferas	ordinal_valor_5	Entidad	ordinal	Regalías Hidrocarburiferas
Regalías Hidrocarburiferas	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Regalías Hidrocarburiferas
Poblaciòn por rangos de edad	valor_unidad_medida	unidad de medida	unidad de medida	Poblacion por rangos de edad del censo 2012
Control de crecimiento a niños menores de cinco años nuevos y repetidos	r_pais	pais	region	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Porcentaje de la Población según Combustible utilizado para cocinar	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Mortalidad Infantil (1q0)	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	 Mortalidad Infantil (1q0)
Porcentaje de la Población con Disponibilidad de servicio sanitario	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de la Población con Disponibilidad de servicio sanitario
Porcentaje de la Población con Uso del servicio sanitario	r_comunidad	comunidad	region	Porcentaje de la Población con Uso del servicio sanitario
Impuesto Directo a los Hidrocarburos (IDH)	t_dia	dia	tiempo	Impuesto Directo a los Hidrocarburos (IDH)
Mortalidad Neonatal (MN)	r_municipio	municipio	region	Mortalidad Neonatal (MN)
Aplicación de vacuna a niños de un año	t_mes_cadena	nombre mes	tiempo	Vacunas aplicadas a niños de un año
Porcentaje de la Población con Desague del servicio sanitario	r_provincia	provincia	region	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de la Población con Acceso a agua	t_fecha	fecha	tiempo	Porcentaje de la población con acceso a agua según la procedencia
Mortalidad Neonatal (MN)	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Mortalidad Neonatal (MN)
Presupuesto Devengado	valor_cargado	valor	valor	Presupuesto Devengado
Porcentaje de Tipo de Vivienda	r_provincia	provincia	region	Porcentaje de hogares según el tipo de vivienda
Atención de parto y postparto	t_mes_cadena	nombre mes	tiempo	Mujeres atendidas por parto y postparto
Impuesto Directo a los Hidrocarburos (IDH)	t_ano	año	tiempo	Impuesto Directo a los Hidrocarburos (IDH)
Dosis de vacunas aplicadas a menores de 1 año	t_mes_cadena	nombre mes	tiempo	Dosis de vacunas aplicadas a menores de 1 año
Mortalidad Infantil (1q0)	r_municipio	municipio	region	 Mortalidad Infantil (1q0)
Porcentaje de la Población con Energia eléctrica en el hogar	ordinal_valor_2	área greográfica	ordinal	Porcentaje de la Población con Energia eléctrica en el hogar
Número de camas	t_mes_cadena	nombre mes	tiempo	Número de camas en centro de salud
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	r_municipio	municipio	region	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Procentaje según Tenencia de vivienda	defecto_valor_cargado	valor por defecto	valor	Procentaje según Tenencia de vivienda
Procentaje según Tenencia de vivienda	r_departamento	departamento	region	Procentaje según Tenencia de vivienda
Presupuesto Pagado	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Presupuesto Pagado
Porcentaje de la Población con Acceso a agua	t_mes	mes	tiempo	Porcentaje de la población con acceso a agua según la procedencia
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Credito Vigente	ordinal_valor_4	clasificación Entidad	ordinal	Credito Vigente según presupuesto
Mortalidad P-Neonatal (MPN) 	r_provincia	provincia	region	Mortalidad P-Neonatal (MPN)
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	ordinal_valor_5	Entidad	ordinal	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de la Población con Servicio telefónico fijo o móvil
Procedencia del Agua que utilizan en la vivienda	r_pais	pais	region	Procedencia del Agua que utilizan en la vivienda según censo 2012
Procentaje según Tenencia de vivienda	t_dia	dia	tiempo	Procentaje según Tenencia de vivienda
Porcentaje de viviendas según Material en la pared	ordinal_valor_2	área greográfica	ordinal	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Porcentaje de viviendas según Material en el piso	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de viviendas según Material utilizado en la construcción del piso
Poblaciòn por rangos de edad	valor_tipo	tipo de valor	tipo de valor cargado	Poblacion por rangos de edad del censo 2012
Porcentaje de viviendas según Material en el techo	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de viviendas según Material utilizado en la construcción del techo
Transferencias por coparticipación tributaria	t_fecha	fecha	tiempo	Transferencias por coparticipación tributaria
Población por género	t_mes	mes	tiempo	Poblacion del censo 2012 por genero
Procedencia del Agua que utilizan en la vivienda	valor_tipo	tipo de valor	tipo de valor cargado	Procedencia del Agua que utilizan en la vivienda según censo 2012
Poblaciòn por rangos de edad	r_pais	pais	region	Poblacion por rangos de edad del censo 2012
Control de crecimiento a niños menores de cinco años nuevos y repetidos	valor_unidad_medida	unidad de medida	unidad de medida	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Procentaje según Tenencia de vivienda	t_ano	año	tiempo	Procentaje según Tenencia de vivienda
Prevalencia de desnutrición crónica	defecto_valor_cargado	valor por defecto	valor	Prevalencia de desnutrición crónica
Porcentaje de la Población con Uso del servicio sanitario	ordinal_valor_2	área greográfica	ordinal	Porcentaje de la Población con Uso del servicio sanitario
Procedencia del Agua que utilizan en la vivienda	r_provincia	provincia	region	Procedencia del Agua que utilizan en la vivienda según censo 2012
Prevalencia de desnutrición crónica	r_departamento	departamento	region	Prevalencia de desnutrición crónica
Mortalidad En la Niñes (5q0)	r_comunidad	comunidad	region	Mortalidad En la Niñes (5q0)
Poblaciòn por rangos de edad	r_provincia	provincia	region	Poblacion por rangos de edad del censo 2012
Presupuesto Devengado	t_mes	mes	tiempo	Presupuesto Devengado
Consulta externa en la población menor de 5 años	t_mes_cadena	nombre mes	tiempo	Consulta externa en la población menor de 5 años
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	r_comunidad	comunidad	region	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Porcentaje de la Población con Desague del servicio sanitario	valor_unidad_medida	unidad de medida	unidad de medida	Procentaje de la población con desague del servicio sanitario según el tipo
 coberturas de control prenatal	t_mes_cadena	nombre mes	tiempo	Cantidad de mujeres que contaron con controles prenatales
Prevalencia de desnutrición crónica	t_dia	dia	tiempo	Prevalencia de desnutrición crónica
Transferencias por coparticipación tributaria	valor_cargado	valor	valor	Transferencias por coparticipación tributaria
Mortalidad P-Neonatal (MPN) 	valor_tipo	tipo de valor	tipo de valor cargado	Mortalidad P-Neonatal (MPN)
Atención de parto y postparto	ordinal_valor_5	tipo de atención por parto o postparto	ordinal	Mujeres atendidas por parto y postparto
Mortalidad P-Neonatal (MPN) 	r_pais	pais	region	Mortalidad P-Neonatal (MPN)
Prevalencia de desnutrición crónica	t_ano	año	tiempo	Prevalencia de desnutrición crónica
Porcentaje de Tipo de Vivienda	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de hogares según el tipo de vivienda
Porcentaje de viviendas según Material en el techo	r_provincia	provincia	region	Porcentaje de viviendas según Material utilizado en la construcción del techo
Procedencia de Energía Eléctrica	t_mes	mes	tiempo	Procedencia de Energía Eléctrica según cesno 2012
 coberturas de control prenatal	t_fecha	fecha	tiempo	Cantidad de mujeres que contaron con controles prenatales
Mortalidad En la Niñes (5q0)	t_dia	dia	tiempo	Mortalidad En la Niñes (5q0)
Presupuesto Pagado	ordinal_valor_3	codigo Entidad	ordinal	Presupuesto Pagado
Total Ingreso	t_mes	mes	tiempo	Total ingreso
Porcentaje de viviendas según Material en el piso	r_provincia	provincia	region	Porcentaje de viviendas según Material utilizado en la construcción del piso
Mortalidad En la Niñes (5q0)	t_ano	año	tiempo	Mortalidad En la Niñes (5q0)
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	r_departamento	departamento	region	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	defecto_valor_cargado	valor por defecto	valor	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	t_ano	año	tiempo	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Vitamina "A" aplicada a menores de 5 años	r_municipio	municipio	region	Vitamina "A" aplicada a menores de 5 años
Presupuesto Pagado	r_provincia	provincia	region	Presupuesto Pagado
Proyecciones de población, según departamento y municipio	t_mes	mes	tiempo	Proyecciones de población, según departamento y municipio
Tipo de desagüe del servicio sanitario	ordinal_valor_3	tipo de procedencia del agua que utilizan en la vivienda	ordinal	Tipo de desagüe del servicio sanitario según censo 2012
Mortalidad En la Niñes (5q0)	r_departamento	departamento	region	Mortalidad En la Niñes (5q0)
Consumo de agua Potable	t_mes	mes	tiempo	Cantidad en miles de metros cúbicos de consumo de agua Potable
Mortalidad En la Niñes (5q0)	defecto_valor_cargado	valor por defecto	valor	Mortalidad En la Niñes (5q0)
Presupuesto Comprometido	t_mes	mes	tiempo	Presupuesto Comprometido
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	r_provincia	provincia	region	Porcentaje de la Población con Servicio telefónico fijo o móvil
Regalías Forestales	ordinal_valor_4	codigo entidad	ordinal	Regalías Forestales
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	ordinal_valor_3	tiene servicio telefónico	ordinal	Porcentaje de la Población con Servicio telefónico fijo o móvil
Mortalidad P-Neonatal (MPN) 	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Mortalidad P-Neonatal (MPN)
Consulta externa en la población menor de 5 años	t_fecha	fecha	tiempo	Consulta externa en la población menor de 5 años
Número de camas	valor_cargado	valor	valor	Número de camas en centro de salud
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	t_mes	mes	tiempo	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Vitamina "A" aplicada a menores de 5 años	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Vitamina "A" aplicada a menores de 5 años
Prevalencia de desnutrición crónica	r_comunidad	comunidad	region	Prevalencia de desnutrición crónica
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	t_dia	dia	tiempo	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	r_provincia	provincia	region	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Regalías Mineras	r_municipio	municipio	region	Regalías Mineras
Porcentaje de la Población con Disponibilidad de servicio sanitario	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de la Población con Disponibilidad de servicio sanitario
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de la Población con Servicio telefónico fijo o móvil
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	valor_tipo	tipo de valor	tipo de valor cargado	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Presupuesto Pagado	r_pais	pais	region	Presupuesto Pagado
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	r_pais	pais	region	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Saldo por Devengar	ordinal_valor_4	clasificación Entidad	ordinal	Saldo por Devengar del Presupuesto
Aplicación de vacuna a niños de un año	ordinal_valor_5	tipo de servicio	ordinal	Vacunas aplicadas a niños de un año
Presupuesto Pagado	valor_tipo	tipo de valor	tipo de valor cargado	Presupuesto Pagado
 coberturas de control prenatal	valor_cargado	valor	valor	Cantidad de mujeres que contaron con controles prenatales
Regalías Forestales	t_mes	mes	tiempo	Regalías Forestales
Consulta externa de la población de 5 años y más	t_mes	mes	tiempo	Consulta externa de la población de 5 años y más
Regalías Mineras	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Regalías Mineras
Regalías Mineras	ordinal_valor_5	Entidad	ordinal	Regalías Mineras
Transferencias por coparticipación tributaria	t_mes_cadena	nombre mes	tiempo	Transferencias por coparticipación tributaria
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	r_pais	pais	region	Porcentaje de la Población con Servicio telefónico fijo o móvil
Procedencia del Agua que utilizan en la vivienda	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Procedencia del Agua que utilizan en la vivienda según censo 2012
Atención de parto y postparto	t_mes	mes	tiempo	Mujeres atendidas por parto y postparto
Porcentaje de viviendas según Material en el piso	r_pais	pais	region	Porcentaje de viviendas según Material utilizado en la construcción del piso
Consulta externa en la población menor de 5 años	valor_cargado	valor	valor	Consulta externa en la población menor de 5 años
Número de camas	t_fecha	fecha	tiempo	Número de camas en centro de salud
Dosis de vacunas aplicadas a menores de 1 año	t_mes	mes	tiempo	Dosis de vacunas aplicadas a menores de 1 año
Porcentaje de viviendas según Material en el techo	r_pais	pais	region	Porcentaje de viviendas según Material utilizado en la construcción del techo
Porcentaje de viviendas según Material en el techo	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de viviendas según Material utilizado en la construcción del techo
Porcentaje de viviendas según Material en el piso	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de viviendas según Material utilizado en la construcción del piso
Porcentaje de la Población según Combustible utilizado para cocinar	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Procentaje según Tenencia de vivienda	r_comunidad	comunidad	region	Procentaje según Tenencia de vivienda
Poblaciòn por rangos de edad	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Poblacion por rangos de edad del censo 2012
Aplicación de vacuna a niños de un año	t_mes	mes	tiempo	Vacunas aplicadas a niños de un año
Fondo de Compensación Departamental	r_municipio	municipio	region	Fondo de Compensación Departamental
Porcentaje de la Población con Distribución de agua por cañeria	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de la Población con Distribución de agua por cañeria
Porcentaje de la Población según Combustible utilizado para cocinar	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Proyecciones de población, según departamento y municipio	valor_cargado	valor	valor	Proyecciones de población, según departamento y municipio
Aplicación de vacuna a niños de un año	t_fecha	fecha	tiempo	Vacunas aplicadas a niños de un año
Mortalidad Post-Infantil (4q1)	r_municipio	municipio	region	Mortalidad Post-Infantil (4q1)
Porcentaje de la Población con Acceso a agua	t_mes_cadena	nombre mes	tiempo	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de viviendas según Material en el piso	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de viviendas según Material utilizado en la construcción del piso
Porcentaje de viviendas según Material en el techo	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de viviendas según Material utilizado en la construcción del techo
Bebes con bajo peso al nacer	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Bebes que nacieron con bajo peso
Presupuesto Comprometido	valor_cargado	valor	valor	Presupuesto Comprometido
Dosis de vacunas aplicadas a menores de 1 año	t_fecha	fecha	tiempo	Dosis de vacunas aplicadas a menores de 1 año
Porcentaje de la Población con Uso del servicio sanitario	r_departamento	departamento	region	Porcentaje de la Población con Uso del servicio sanitario
Bebes con bajo peso al nacer	r_municipio	municipio	region	Bebes que nacieron con bajo peso
Número de camas	t_mes	mes	tiempo	Número de camas en centro de salud
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	valor_cargado	valor	valor	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Control de crecimiento a niños menores de cinco años nuevos y repetidos	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Fondo de Compensación Departamental	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Fondo de Compensación Departamental
Porcentaje de la Población con Distribución de agua por cañeria	r_municipio	municipio	region	Porcentaje de la Población con Distribución de agua por cañeria
Porcentaje de la Población con Uso del servicio sanitario	defecto_valor_cargado	valor por defecto	valor	Porcentaje de la Población con Uso del servicio sanitario
Porcentaje de la Población según Combustible utilizado para cocinar	r_pais	pais	region	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Mortalidad Post-Infantil (4q1)	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Mortalidad Post-Infantil (4q1)
Atención de parto y postparto	t_fecha	fecha	tiempo	Mujeres atendidas por parto y postparto
Fondo de Compensación Departamental	ordinal_valor_5	Entidad	ordinal	Fondo de Compensación Departamental
Población por género	t_mes_cadena	nombre mes	tiempo	Poblacion del censo 2012 por genero
Presupuesto Aprobado	r_municipio	municipio	region	Presupuesto Aprobado
Procedencia de Energía Eléctrica	valor_cargado	valor	valor	Procedencia de Energía Eléctrica según cesno 2012
Regalías Forestales	t_fecha	fecha	tiempo	Regalías Forestales
Porcentaje de la Población con Disponibilidad de servicio sanitario	r_pais	pais	region	Porcentaje de la Población con Disponibilidad de servicio sanitario
Porcentaje de la Población con Uso del servicio sanitario	t_ano	año	tiempo	Porcentaje de la Población con Uso del servicio sanitario
Consulta externa de la población de 5 años y más	t_fecha	fecha	tiempo	Consulta externa de la población de 5 años y más
Presupuesto Pagado	valor_unidad_medida	unidad de medida	unidad de medida	Presupuesto Pagado
Total Ingreso	valor_cargado	valor	valor	Total ingreso
Ingresos Tributarios	ordinal_valor_4	Impuesto	ordinal	Ingresos originados por los diferentes tributos
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	valor_unidad_medida	unidad de medida	unidad de medida	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Impuesto Directo a los Hidrocarburos (IDH)	r_comunidad	comunidad	region	Impuesto Directo a los Hidrocarburos (IDH)
Presupuesto Aprobado	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Presupuesto Aprobado
Porcentaje de la Población con Uso del servicio sanitario	t_dia	dia	tiempo	Porcentaje de la Población con Uso del servicio sanitario
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de la Población con Servicio telefónico fijo o móvil
Presupuesto Aprobado	ordinal_valor_5	Entidad	ordinal	Presupuesto Aprobado
Porcentaje de la Población con Disponibilidad de servicio sanitario	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de la Población con Disponibilidad de servicio sanitario
Atención de parto y postparto	valor_cargado	valor	valor	Mujeres atendidas por parto y postparto
Presupuesto Devengado	t_mes_cadena	nombre mes	tiempo	Presupuesto Devengado
Porcentaje de la Población con Desague del servicio sanitario	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de la Población con Disponibilidad de servicio sanitario	r_provincia	provincia	region	Porcentaje de la Población con Disponibilidad de servicio sanitario
Consulta externa en la población menor de 5 años	t_mes	mes	tiempo	Consulta externa en la población menor de 5 años
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	t_fecha	fecha	tiempo	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Credito Vigente	t_ano	año	tiempo	Credito Vigente según presupuesto
Dosis de vacunas aplicadas a menores de 1 año	valor_cargado	valor	valor	Dosis de vacunas aplicadas a menores de 1 año
Saldo por Devengar	r_comunidad	comunidad	region	Saldo por Devengar del Presupuesto
Tipo de desagüe del servicio sanitario	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de viviendas según Material en la pared	t_ano	año	tiempo	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Procentaje según Tenencia de vivienda	ordinal_valor_2	área greográfica	ordinal	Procentaje según Tenencia de vivienda
Porcentaje de viviendas según Material en la pared	t_dia	dia	tiempo	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Consumo de agua Potable	t_fecha	fecha	tiempo	Cantidad en miles de metros cúbicos de consumo de agua Potable
Presupuesto Comprometido	t_fecha	fecha	tiempo	Presupuesto Comprometido
Porcentaje de la Población con Energia eléctrica en el hogar	defecto_valor_cargado	valor por defecto	valor	Porcentaje de la Población con Energia eléctrica en el hogar
Credito Vigente	t_dia	dia	tiempo	Credito Vigente según presupuesto
Tipo de desagüe del servicio sanitario	r_municipio	municipio	region	Tipo de desagüe del servicio sanitario según censo 2012
Ingresos Tributarios	r_comunidad	comunidad	region	Ingresos originados por los diferentes tributos
Porcentaje de la Población con Energia eléctrica en el hogar	r_departamento	departamento	region	Porcentaje de la Población con Energia eléctrica en el hogar
Aplicación de vacuna a niños de un año	valor_cargado	valor	valor	Vacunas aplicadas a niños de un año
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	r_comunidad	comunidad	region	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Proyecciones de población, según departamento y municipio	t_fecha	fecha	tiempo	Proyecciones de población, según departamento y municipio
Porcentaje de Tipo de Vivienda	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de hogares según el tipo de vivienda
Porcentaje de la Población con Energia eléctrica en el hogar	t_ano	año	tiempo	Porcentaje de la Población con Energia eléctrica en el hogar
Porcentaje de la Población con Energia eléctrica en el hogar	t_dia	dia	tiempo	Porcentaje de la Población con Energia eléctrica en el hogar
Total Ingreso	t_fecha	fecha	tiempo	Total ingreso
Porcentaje de viviendas según Material en la pared	defecto_valor_cargado	valor por defecto	valor	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Población por género	ordinal_valor_1	genero	ordinal	Poblacion del censo 2012 por genero
 coberturas de control prenatal	t_mes	mes	tiempo	Cantidad de mujeres que contaron con controles prenatales
Credito Vigente	defecto_valor_cargado	valor por defecto	valor	Credito Vigente según presupuesto
Porcentaje de la Población según Combustible utilizado para cocinar	r_provincia	provincia	region	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Procedencia de Energía Eléctrica	t_fecha	fecha	tiempo	Procedencia de Energía Eléctrica según cesno 2012
Regalías Forestales	valor_cargado	valor	valor	Regalías Forestales
Consulta externa de la población de 5 años y más	valor_cargado	valor	valor	Consulta externa de la población de 5 años y más
Porcentaje de viviendas según Material en la pared	r_departamento	departamento	region	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Credito Vigente	r_departamento	departamento	region	Credito Vigente según presupuesto
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	t_fecha	fecha	tiempo	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Vitamina "A" aplicada a menores de 5 años	valor_tipo	tipo de valor	tipo de valor cargado	Vitamina "A" aplicada a menores de 5 años
Proyecciones de población, según departamento y municipio	r_comunidad	comunidad	region	Proyecciones de población, según departamento y municipio
Presupuesto Devengado	r_departamento	departamento	region	Presupuesto Devengado
Ingresos Tributarios	t_fecha	fecha	tiempo	Ingresos originados por los diferentes tributos
Tipo de desagüe del servicio sanitario	valor_unidad_medida	unidad de medida	unidad de medida	Tipo de desagüe del servicio sanitario según censo 2012
Presupuesto Comprometido	r_comunidad	comunidad	region	Presupuesto Comprometido
Presupuesto Devengado	defecto_valor_cargado	valor por defecto	valor	Presupuesto Devengado
Consumo de agua Potable	r_comunidad	comunidad	region	Cantidad en miles de metros cúbicos de consumo de agua Potable
Saldo por Devengar	t_fecha	fecha	tiempo	Saldo por Devengar del Presupuesto
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	r_comunidad	comunidad	region	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Regalías Mineras	r_provincia	provincia	region	Regalías Mineras
Prevalencia de desnutrición crónica	t_mes	mes	tiempo	Prevalencia de desnutrición crónica
Vitamina "A" aplicada a menores de 5 años	r_pais	pais	region	Vitamina "A" aplicada a menores de 5 años
Porcentaje de la Población con Energia eléctrica en el hogar	t_mes_cadena	nombre mes	tiempo	Porcentaje de la Población con Energia eléctrica en el hogar
Procedencia de Energía Eléctrica	r_comunidad	comunidad	region	Procedencia de Energía Eléctrica según cesno 2012
Presupuesto Devengado	t_dia	dia	tiempo	Presupuesto Devengado
Total Ingreso	r_comunidad	comunidad	region	Total ingreso
Presupuesto Devengado	t_ano	año	tiempo	Presupuesto Devengado
Porcentaje de la Población con Desague del servicio sanitario	ordinal_valor_3	tipo de servicio sanitario utilizado en la vivienda	ordinal	Procentaje de la población con desague del servicio sanitario según el tipo
Impuesto Directo a los Hidrocarburos (IDH)	valor_cargado	valor	valor	Impuesto Directo a los Hidrocarburos (IDH)
Porcentaje de viviendas según Material en la pared	t_mes_cadena	nombre mes	tiempo	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Credito Vigente	t_mes_cadena	nombre mes	tiempo	Credito Vigente según presupuesto
Atención de parto y postparto	r_comunidad	comunidad	region	Mujeres atendidas por parto y postparto
Porcentaje de viviendas según Material en el piso	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de viviendas según Material utilizado en la construcción del piso
Porcentaje de la Población con Acceso a agua	r_departamento	departamento	region	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de la Población con Distribución de agua por cañeria	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de la Población con Distribución de agua por cañeria
Población por género	t_dia	dia	tiempo	Poblacion del censo 2012 por genero
Bebes con bajo peso al nacer	valor_unidad_medida	unidad de medida	unidad de medida	Bebes que nacieron con bajo peso
Saldo por Devengar	valor_cargado	valor	valor	Saldo por Devengar del Presupuesto
Porcentaje de la Población con Acceso a agua	defecto_valor_cargado	valor por defecto	valor	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de viviendas según Material en el techo	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de viviendas según Material utilizado en la construcción del techo
Dosis de vacunas aplicadas a menores de 1 año	r_comunidad	comunidad	region	Dosis de vacunas aplicadas a menores de 1 año
Porcentaje de la Población con Uso del servicio sanitario	t_mes_cadena	nombre mes	tiempo	Porcentaje de la Población con Uso del servicio sanitario
Porcentaje de viviendas según Material en el techo	r_municipio	municipio	region	Porcentaje de viviendas según Material utilizado en la construcción del techo
Población por género	t_ano	año	tiempo	Poblacion del censo 2012 por genero
Mortalidad Post-Infantil (4q1)	valor_unidad_medida	unidad de medida	unidad de medida	Mortalidad Post-Infantil (4q1)
Ingresos Tributarios	valor_cargado	valor	valor	Ingresos originados por los diferentes tributos
Porcentaje de viviendas según Material en el piso	r_municipio	municipio	region	Porcentaje de viviendas según Material utilizado en la construcción del piso
Aplicación de vacuna a niños de un año	r_comunidad	comunidad	region	Vacunas aplicadas a niños de un año
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	valor_cargado	valor	valor	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Fondo de Compensación Departamental	valor_unidad_medida	unidad de medida	unidad de medida	Fondo de Compensación Departamental
Procentaje según Tenencia de vivienda	t_mes	mes	tiempo	Procentaje según Tenencia de vivienda
Regalías Mineras	valor_tipo	tipo de valor	tipo de valor cargado	Regalías Mineras
Población por género	r_departamento	departamento	region	Poblacion del censo 2012 por genero
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	ordinal_valor_5	número de dosis	ordinal	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	r_municipio	municipio	region	Porcentaje de la Población con Servicio telefónico fijo o móvil
Presupuesto Pagado	ordinal_valor_5	Entidad	ordinal	Presupuesto Pagado
Población por género	defecto_valor_cargado	valor por defecto	valor	Poblacion del censo 2012 por genero
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	r_municipio	municipio	region	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Impuesto Directo a los Hidrocarburos (IDH)	t_fecha	fecha	tiempo	Impuesto Directo a los Hidrocarburos (IDH)
Presupuesto Pagado	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Presupuesto Pagado
Porcentaje de la Población con Acceso a agua	t_dia	dia	tiempo	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de la Población con Acceso a agua	t_ano	año	tiempo	Porcentaje de la población con acceso a agua según la procedencia
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Total Ingreso	ordinal_valor_4	clasificación entidad	ordinal	Total ingreso
Vitamina "A" aplicada a menores de 5 años	r_provincia	provincia	region	Vitamina "A" aplicada a menores de 5 años
Presupuesto Pagado	r_municipio	municipio	region	Presupuesto Pagado
Consulta externa de la población de 5 años y más	r_comunidad	comunidad	region	Consulta externa de la población de 5 años y más
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Regalías Mineras	r_pais	pais	region	Regalías Mineras
Regalías Forestales	r_comunidad	comunidad	region	Regalías Forestales
Presupuesto Aprobado	valor_unidad_medida	unidad de medida	unidad de medida	Presupuesto Aprobado
Ingresos Tributarios	ordinal_valor_3	Impuesto de hidrocarburos	ordinal	Ingresos originados por los diferentes tributos
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de la Población con Servicio telefónico fijo o móvil
Presupuesto Aprobado	valor_tipo	tipo de valor	tipo de valor cargado	Presupuesto Aprobado
Porcentaje de viviendas según Material en la pared	ordinal_valor_3	tipo de material de construcción	ordinal	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Mortalidad Infantil (1q0)	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	 Mortalidad Infantil (1q0)
Tipo de desagüe del servicio sanitario	r_provincia	provincia	region	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de la Población con Disponibilidad de servicio sanitario	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de la Población con Disponibilidad de servicio sanitario
Presupuesto Comprometido	ordinal_valor_4	clasificación Entidad	ordinal	Presupuesto Comprometido
Mortalidad Neonatal (MN)	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Mortalidad Neonatal (MN)
Transferencias por coparticipación tributaria	defecto_valor_cargado	valor por defecto	valor	Transferencias por coparticipación tributaria
Impuesto Directo a los Hidrocarburos (IDH)	t_mes	mes	tiempo	Impuesto Directo a los Hidrocarburos (IDH)
Presupuesto Aprobado	r_pais	pais	region	Presupuesto Aprobado
Regalías Mineras	valor_unidad_medida	unidad de medida	unidad de medida	Regalías Mineras
Transferencias por coparticipación tributaria	r_departamento	departamento	region	Transferencias por coparticipación tributaria
Porcentaje de la Población con Disponibilidad de servicio sanitario	r_municipio	municipio	region	Porcentaje de la Población con Disponibilidad de servicio sanitario
Porcentaje de la Población con Distribución de agua por cañeria	r_pais	pais	region	Porcentaje de la Población con Distribución de agua por cañeria
Fondo de Compensación Departamental	valor_tipo	tipo de valor	tipo de valor cargado	Fondo de Compensación Departamental
Porcentaje de la Población según Combustible utilizado para cocinar	r_municipio	municipio	region	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Procentaje según Tenencia de vivienda	t_fecha	fecha	tiempo	Procentaje según Tenencia de vivienda
Mortalidad Post-Infantil (4q1)	valor_tipo	tipo de valor	tipo de valor cargado	Mortalidad Post-Infantil (4q1)
Transferencias por coparticipación tributaria	t_ano	año	tiempo	Transferencias por coparticipación tributaria
Población por género	ordinal_valor_2	codigo comunidad	ordinal	Poblacion del censo 2012 por genero
Bebes con bajo peso al nacer	r_pais	pais	region	Bebes que nacieron con bajo peso
Bebes con bajo peso al nacer	valor_tipo	tipo de valor	tipo de valor cargado	Bebes que nacieron con bajo peso
Número de camas	r_comunidad	comunidad	region	Número de camas en centro de salud
Regalías Hidrocarburiferas	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Regalías Hidrocarburiferas
Transferencias por coparticipación tributaria	t_dia	dia	tiempo	Transferencias por coparticipación tributaria
Fondo de Compensación Departamental	r_pais	pais	region	Fondo de Compensación Departamental
Prevalencia de desnutrición crónica	valor_cargado	valor	valor	Prevalencia de desnutrición crónica
Porcentaje de la Población con Distribución de agua por cañeria	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de la Población con Distribución de agua por cañeria
Porcentaje de la Población según Combustible utilizado para cocinar	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Mortalidad Post-Infantil (4q1)	r_pais	pais	region	Mortalidad Post-Infantil (4q1)
 coberturas de control prenatal	ordinal_valor_5	tipo de consulta prenatal	ordinal	Cantidad de mujeres que contaron con controles prenatales
Bebes con bajo peso al nacer	r_provincia	provincia	region	Bebes que nacieron con bajo peso
Porcentaje de la Población con Distribución de agua por cañeria	r_provincia	provincia	region	Porcentaje de la Población con Distribución de agua por cañeria
Mortalidad Post-Infantil (4q1)	r_provincia	provincia	region	Mortalidad Post-Infantil (4q1)
 coberturas de control prenatal	r_comunidad	comunidad	region	Cantidad de mujeres que contaron con controles prenatales
Fondo de Compensación Departamental	r_provincia	provincia	region	Fondo de Compensación Departamental
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	t_mes_cadena	nombre mes	tiempo	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Presupuesto Aprobado	ordinal_valor_3	codigo Entidad	ordinal	Presupuesto Aprobado
Porcentaje de la Población con Energia eléctrica en el hogar	ordinal_valor_3	existencia de energía electrica	ordinal	Porcentaje de la Población con Energia eléctrica en el hogar
Prevalencia de desnutrición crónica	t_fecha	fecha	tiempo	Prevalencia de desnutrición crónica
Mortalidad En la Niñes (5q0)	t_mes_cadena	nombre mes	tiempo	Mortalidad En la Niñes (5q0)
Consulta externa en la población menor de 5 años	r_comunidad	comunidad	region	Consulta externa en la población menor de 5 años
Deuda Flotante	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Deuda Flotante según Presupuesto
Saldo por Devengar	t_mes	mes	tiempo	Saldo por Devengar del Presupuesto
Tipo de desagüe del servicio sanitario	r_pais	pais	region	Tipo de desagüe del servicio sanitario según censo 2012
Tipo de desagüe del servicio sanitario	valor_tipo	tipo de valor	tipo de valor cargado	Tipo de desagüe del servicio sanitario según censo 2012
Presupuesto Aprobado	r_provincia	provincia	region	Presupuesto Aprobado
Impuesto Directo a los Hidrocarburos (IDH)	ordinal_valor_4	codigo entidad	ordinal	Impuesto Directo a los Hidrocarburos (IDH)
Ingresos Tributarios	t_mes	mes	tiempo	Ingresos originados por los diferentes tributos
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	t_mes	mes	tiempo	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Vitamina "A" aplicada a menores de 5 años	valor_unidad_medida	unidad de medida	unidad de medida	Vitamina "A" aplicada a menores de 5 años
 coberturas de control prenatal	t_dia	dia	tiempo	Cantidad de mujeres que contaron con controles prenatales
Prevalencia de desnutrición crónica	t_mes_cadena	nombre mes	tiempo	Prevalencia de desnutrición crónica
Mortalidad En la Niñes (5q0)	t_fecha	fecha	tiempo	Mortalidad En la Niñes (5q0)
Porcentaje de la Población con Energia eléctrica en el hogar	t_mes	mes	tiempo	Porcentaje de la Población con Energia eléctrica en el hogar
 coberturas de control prenatal	t_ano	año	tiempo	Cantidad de mujeres que contaron con controles prenatales
Consulta externa en la población menor de 5 años	defecto_valor_cargado	valor por defecto	valor	Consulta externa en la población menor de 5 años
Regalías Hidrocarburiferas	r_provincia	provincia	region	Regalías Hidrocarburiferas
Consulta externa en la población menor de 5 años	r_departamento	departamento	region	Consulta externa en la población menor de 5 años
Procedencia de Energía Eléctrica	ordinal_valor_2	codigo comunidad	ordinal	Procedencia de Energía Eléctrica según cesno 2012
Porcentaje de la Población con Acceso a agua	ordinal_valor_2	área greográfica	ordinal	Porcentaje de la población con acceso a agua según la procedencia
 coberturas de control prenatal	r_departamento	departamento	region	Cantidad de mujeres que contaron con controles prenatales
Porcentaje de la Población con Desague del servicio sanitario	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de Tipo de Vivienda	r_municipio	municipio	region	Porcentaje de hogares según el tipo de vivienda
Deuda Flotante	r_pais	pais	region	Deuda Flotante según Presupuesto
 coberturas de control prenatal	defecto_valor_cargado	valor por defecto	valor	Cantidad de mujeres que contaron con controles prenatales
Consulta externa en la población menor de 5 años	t_ano	año	tiempo	Consulta externa en la población menor de 5 años
Credito Vigente	t_mes	mes	tiempo	Credito Vigente según presupuesto
Mortalidad Infantil (1q0)	r_provincia	provincia	region	 Mortalidad Infantil (1q0)
Tipo de desagüe del servicio sanitario	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de viviendas según Material en la pared	t_mes	mes	tiempo	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Deuda Flotante	valor_tipo	tipo de valor	tipo de valor cargado	Deuda Flotante según Presupuesto
Consulta externa en la población menor de 5 años	t_dia	dia	tiempo	Consulta externa en la población menor de 5 años
Mortalidad Neonatal (MN)	r_provincia	provincia	region	Mortalidad Neonatal (MN)
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	t_fecha	fecha	tiempo	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Porcentaje de la Población con Desague del servicio sanitario	r_municipio	municipio	region	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de Tipo de Vivienda	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de hogares según el tipo de vivienda
Mortalidad Infantil (1q0)	r_pais	pais	region	 Mortalidad Infantil (1q0)
Número de camas	r_departamento	departamento	region	Número de camas en centro de salud
Deuda Flotante	r_provincia	provincia	region	Deuda Flotante según Presupuesto
Porcentaje de la Población con Uso del servicio sanitario	t_mes	mes	tiempo	Porcentaje de la Población con Uso del servicio sanitario
Mortalidad Neonatal (MN)	valor_tipo	tipo de valor	tipo de valor cargado	Mortalidad Neonatal (MN)
Número de camas	defecto_valor_cargado	valor por defecto	valor	Número de camas en centro de salud
Procentaje según Tenencia de vivienda	t_mes_cadena	nombre mes	tiempo	Procentaje según Tenencia de vivienda
Mortalidad Neonatal (MN)	r_pais	pais	region	Mortalidad Neonatal (MN)
Mortalidad En la Niñes (5q0)	valor_cargado	valor	valor	Mortalidad En la Niñes (5q0)
Mortalidad Infantil (1q0)	valor_tipo	tipo de valor	tipo de valor cargado	 Mortalidad Infantil (1q0)
Presupuesto Aprobado	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Presupuesto Aprobado
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	valor_unidad_medida	unidad de medida	unidad de medida	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Control de crecimiento a niños menores de cinco años nuevos y repetidos	r_municipio	municipio	region	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Porcentaje de la Población con Distribución de agua por cañeria	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de la Población con Distribución de agua por cañeria
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	valor_cargado	valor	valor	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Número de camas	t_dia	dia	tiempo	Número de camas en centro de salud
Deuda Flotante	ordinal_valor_3	codigo Entidad	ordinal	Deuda Flotante según Presupuesto
Procedencia del Agua que utilizan en la vivienda	ordinal_valor_3	tipo de procedencia del agua que utilizan en la vivienda	ordinal	Procedencia del Agua que utilizan en la vivienda según censo 2012
Transferencias por coparticipación tributaria	r_comunidad	comunidad	region	Transferencias por coparticipación tributaria
Presupuesto Devengado	ordinal_valor_4	clasificación Entidad	ordinal	Presupuesto Devengado
Bebes con bajo peso al nacer	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Bebes que nacieron con bajo peso
Regalías Hidrocarburiferas	valor_tipo	tipo de valor	tipo de valor cargado	Regalías Hidrocarburiferas
Regalías Hidrocarburiferas	r_pais	pais	region	Regalías Hidrocarburiferas
Número de camas	t_ano	año	tiempo	Número de camas en centro de salud
Control de crecimiento a niños menores de cinco años nuevos y repetidos	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Fondo de Compensación Departamental	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Fondo de Compensación Departamental
Mortalidad Post-Infantil (4q1)	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Mortalidad Post-Infantil (4q1)
Aplicación de vacuna a niños de un año	t_dia	dia	tiempo	Vacunas aplicadas a niños de un año
Procedencia del Agua que utilizan en la vivienda	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Procedencia del Agua que utilizan en la vivienda según censo 2012
Atención de parto y postparto	t_ano	año	tiempo	Mujeres atendidas por parto y postparto
Impuesto Directo a los Hidrocarburos (IDH)	t_mes_cadena	nombre mes	tiempo	Impuesto Directo a los Hidrocarburos (IDH)
Regalías Forestales	defecto_valor_cargado	valor por defecto	valor	Regalías Forestales
Poblaciòn por rangos de edad	r_municipio	municipio	region	Poblacion por rangos de edad del censo 2012
Consulta externa de la población de 5 años y más	defecto_valor_cargado	valor por defecto	valor	Consulta externa de la población de 5 años y más
Credito Vigente	valor_cargado	valor	valor	Credito Vigente según presupuesto
Dosis de vacunas aplicadas a menores de 1 año	t_ano	año	tiempo	Dosis de vacunas aplicadas a menores de 1 año
Regalías Forestales	r_departamento	departamento	region	Regalías Forestales
Consulta externa de la población de 5 años y más	r_departamento	departamento	region	Consulta externa de la población de 5 años y más
Dosis de vacunas aplicadas a menores de 1 año	t_dia	dia	tiempo	Dosis de vacunas aplicadas a menores de 1 año
Regalías Hidrocarburiferas	valor_unidad_medida	unidad de medida	unidad de medida	Regalías Hidrocarburiferas
Población por género	r_comunidad	comunidad	region	Poblacion del censo 2012 por genero
Procedencia del Agua que utilizan en la vivienda	r_municipio	municipio	region	Procedencia del Agua que utilizan en la vivienda según censo 2012
Atención de parto y postparto	t_dia	dia	tiempo	Mujeres atendidas por parto y postparto
Poblaciòn por rangos de edad	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Poblacion por rangos de edad del censo 2012
Aplicación de vacuna a niños de un año	t_ano	año	tiempo	Vacunas aplicadas a niños de un año
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	valor_tipo	tipo de valor	tipo de valor cargado	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Aplicación de vacuna a niños de un año	defecto_valor_cargado	valor por defecto	valor	Vacunas aplicadas a niños de un año
Mortalidad Infantil (1q0)	valor_unidad_medida	unidad de medida	unidad de medida	 Mortalidad Infantil (1q0)
Consulta externa de la población de 5 años y más	t_dia	dia	tiempo	Consulta externa de la población de 5 años y más
Regalías Forestales	t_dia	dia	tiempo	Regalías Forestales
Aplicación de vacuna a niños de un año	r_departamento	departamento	region	Vacunas aplicadas a niños de un año
Porcentaje de la Población con Energia eléctrica en el hogar	valor_cargado	valor	valor	Porcentaje de la Población con Energia eléctrica en el hogar
Dosis de vacunas aplicadas a menores de 1 año	defecto_valor_cargado	valor por defecto	valor	Dosis de vacunas aplicadas a menores de 1 año
Porcentaje de la Población con Acceso a agua	r_comunidad	comunidad	region	Porcentaje de la población con acceso a agua según la procedencia
Mortalidad Neonatal (MN)	valor_unidad_medida	unidad de medida	unidad de medida	Mortalidad Neonatal (MN)
Atención de parto y postparto	r_departamento	departamento	region	Mujeres atendidas por parto y postparto
Dosis de vacunas aplicadas a menores de 1 año	r_departamento	departamento	region	Dosis de vacunas aplicadas a menores de 1 año
Regalías Forestales	t_ano	año	tiempo	Regalías Forestales
Porcentaje de la Población con Uso del servicio sanitario	t_fecha	fecha	tiempo	Porcentaje de la Población con Uso del servicio sanitario
Procentaje según Tenencia de vivienda	ordinal_valor_3	tipo de tenencia de vivienda	ordinal	Procentaje según Tenencia de vivienda
Consulta externa de la población de 5 años y más	t_ano	año	tiempo	Consulta externa de la población de 5 años y más
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	r_pais	pais	region	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Regalías Mineras	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Regalías Mineras
Atención de parto y postparto	defecto_valor_cargado	valor por defecto	valor	Mujeres atendidas por parto y postparto
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	t_mes	mes	tiempo	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Proyecciones de población, según departamento y municipio	t_ano	año	tiempo	Proyecciones de población, según departamento y municipio
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	t_dia	dia	tiempo	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Consumo de agua Potable	t_ano	año	tiempo	Cantidad en miles de metros cúbicos de consumo de agua Potable
Mortalidad P-Neonatal (MPN) 	r_municipio	municipio	region	Mortalidad P-Neonatal (MPN)
Presupuesto Comprometido	t_ano	año	tiempo	Presupuesto Comprometido
Deuda Flotante	valor_unidad_medida	unidad de medida	unidad de medida	Deuda Flotante según Presupuesto
Presupuesto Comprometido	t_dia	dia	tiempo	Presupuesto Comprometido
Procedencia de Energía Eléctrica	r_departamento	departamento	region	Procedencia de Energía Eléctrica según cesno 2012
Total Ingreso	defecto_valor_cargado	valor por defecto	valor	Total ingreso
Porcentaje de viviendas según Material en la pared	t_fecha	fecha	tiempo	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Consumo de agua Potable	t_dia	dia	tiempo	Cantidad en miles de metros cúbicos de consumo de agua Potable
Mortalidad P-Neonatal (MPN) 	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Mortalidad P-Neonatal (MPN)
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	t_ano	año	tiempo	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Credito Vigente	t_fecha	fecha	tiempo	Credito Vigente según presupuesto
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	r_provincia	provincia	region	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Procedencia de Energía Eléctrica	defecto_valor_cargado	valor por defecto	valor	Procedencia de Energía Eléctrica según cesno 2012
Vitamina "A" aplicada a menores de 5 años	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Vitamina "A" aplicada a menores de 5 años
Total Ingreso	r_departamento	departamento	region	Total ingreso
Proyecciones de población, según departamento y municipio	t_dia	dia	tiempo	Proyecciones de población, según departamento y municipio
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	r_departamento	departamento	region	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Procedencia de Energía Eléctrica	t_ano	año	tiempo	Procedencia de Energía Eléctrica según cesno 2012
Porcentaje de la Población con Uso del servicio sanitario	valor_cargado	valor	valor	Porcentaje de la Población con Uso del servicio sanitario
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	t_mes_cadena	nombre mes	tiempo	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	defecto_valor_cargado	valor por defecto	valor	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Total Ingreso	t_ano	año	tiempo	Total ingreso
Ingresos Tributarios	t_mes_cadena	nombre mes	tiempo	Ingresos originados por los diferentes tributos
Presupuesto Devengado	r_comunidad	comunidad	region	Presupuesto Devengado
Total Ingreso	t_dia	dia	tiempo	Total ingreso
Consumo de agua Potable	defecto_valor_cargado	valor por defecto	valor	Cantidad en miles de metros cúbicos de consumo de agua Potable
Mortalidad En la Niñes (5q0)	t_mes	mes	tiempo	Mortalidad En la Niñes (5q0)
Presupuesto Comprometido	defecto_valor_cargado	valor por defecto	valor	Presupuesto Comprometido
Porcentaje de la Población con Energia eléctrica en el hogar	t_fecha	fecha	tiempo	Porcentaje de la Población con Energia eléctrica en el hogar
Proyecciones de población, según departamento y municipio	r_departamento	departamento	region	Proyecciones de población, según departamento y municipio
Saldo por Devengar	t_mes_cadena	nombre mes	tiempo	Saldo por Devengar del Presupuesto
Consumo de agua Potable	r_departamento	departamento	region	Cantidad en miles de metros cúbicos de consumo de agua Potable
Número de camas	ordinal_valor_5	tipo de centro de salud	ordinal	Número de camas en centro de salud
Presupuesto Comprometido	r_departamento	departamento	region	Presupuesto Comprometido
Procedencia de Energía Eléctrica	t_dia	dia	tiempo	Procedencia de Energía Eléctrica según cesno 2012
Proyecciones de población, según departamento y municipio	defecto_valor_cargado	valor por defecto	valor	Proyecciones de población, según departamento y municipio
Presupuesto Aprobado	ordinal_valor_4	clasificación Entidad	ordinal	Presupuesto Aprobado
Prevalencia de desnutrición crónica	r_municipio	municipio	region	Prevalencia de desnutrición crónica
Proyecciones de población, según departamento y municipio	r_pais	pais	region	Proyecciones de población, según departamento y municipio
Consulta externa en la población menor de 5 años	valor_unidad_medida	unidad de medida	unidad de medida	Consulta externa en la población menor de 5 años
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	valor_tipo	tipo de valor	tipo de valor cargado	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Consumo de agua Potable	r_pais	pais	region	Cantidad en miles de metros cúbicos de consumo de agua Potable
Presupuesto Comprometido	r_pais	pais	region	Presupuesto Comprometido
Porcentaje de la Población con Distribución de agua por cañeria	ordinal_valor_2	área greográfica	ordinal	Porcentaje de la Población con Distribución de agua por cañeria
Presupuesto Comprometido	valor_tipo	tipo de valor	tipo de valor cargado	Presupuesto Comprometido
Regalías Forestales	r_provincia	provincia	region	Regalías Forestales
Consulta externa de la población de 5 años y más	r_provincia	provincia	region	Consulta externa de la población de 5 años y más
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	r_pais	pais	region	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Consumo de agua Potable	valor_tipo	tipo de valor	tipo de valor cargado	Cantidad en miles de metros cúbicos de consumo de agua Potable
Vitamina "A" aplicada a menores de 5 años	r_comunidad	comunidad	region	Vitamina "A" aplicada a menores de 5 años
Proyecciones de población, según departamento y municipio	valor_tipo	tipo de valor	tipo de valor cargado	Proyecciones de población, según departamento y municipio
Prevalencia de desnutrición crónica	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Prevalencia de desnutrición crónica
Porcentaje de la Población según Combustible utilizado para cocinar	valor_cargado	valor	valor	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Procedencia de Energía Eléctrica	r_pais	pais	region	Procedencia de Energía Eléctrica según cesno 2012
Porcentaje de la Población con Disponibilidad de servicio sanitario	valor_cargado	valor	valor	Porcentaje de la Población con Disponibilidad de servicio sanitario
Dosis de vacunas aplicadas a menores de 1 año	r_provincia	provincia	region	Dosis de vacunas aplicadas a menores de 1 año
Atención de parto y postparto	r_provincia	provincia	region	Mujeres atendidas por parto y postparto
Total Ingreso	r_pais	pais	region	Total ingreso
Porcentaje de Tipo de Vivienda	t_mes_cadena	nombre mes	tiempo	Porcentaje de hogares según el tipo de vivienda
Total Ingreso	valor_tipo	tipo de valor	tipo de valor cargado	Total ingreso
Consumo de agua Potable	ordinal_valor_2	tipo de servicio	ordinal	Cantidad en miles de metros cúbicos de consumo de agua Potable
 coberturas de control prenatal	valor_unidad_medida	unidad de medida	unidad de medida	Cantidad de mujeres que contaron con controles prenatales
Aplicación de vacuna a niños de un año	r_provincia	provincia	region	Vacunas aplicadas a niños de un año
Presupuesto Devengado	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Presupuesto Devengado
Porcentaje de la Población con Desague del servicio sanitario	t_mes_cadena	nombre mes	tiempo	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de la Población con Distribución de agua por cañeria	ordinal_valor_3	lugar de distribución de agua por cañería	ordinal	Porcentaje de la Población con Distribución de agua por cañeria
Procedencia de Energía Eléctrica	valor_tipo	tipo de valor	tipo de valor cargado	Procedencia de Energía Eléctrica según cesno 2012
Aplicación de vacuna a niños de un año	valor_tipo	tipo de valor	tipo de valor cargado	Vacunas aplicadas a niños de un año
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	defecto_valor_cargado	valor por defecto	valor	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Porcentaje de la Población según Combustible utilizado para cocinar	t_fecha	fecha	tiempo	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Procentaje según Tenencia de vivienda	r_municipio	municipio	region	Procentaje según Tenencia de vivienda
Atención de parto y postparto	r_pais	pais	region	Mujeres atendidas por parto y postparto
Total Ingreso	r_provincia	provincia	region	Total ingreso
Porcentaje de viviendas según Material en el piso	t_mes	mes	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del piso
Dosis de vacunas aplicadas a menores de 1 año	r_pais	pais	region	Dosis de vacunas aplicadas a menores de 1 año
Porcentaje de viviendas según Material en el techo	t_mes	mes	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del techo
Presupuesto Comprometido	ordinal_valor_3	codigo Entidad	ordinal	Presupuesto Comprometido
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	r_departamento	departamento	region	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Procedencia de Energía Eléctrica	r_provincia	provincia	region	Procedencia de Energía Eléctrica según cesno 2012
Población por género	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Poblacion del censo 2012 por genero
Dosis de vacunas aplicadas a menores de 1 año	valor_tipo	tipo de valor	tipo de valor cargado	Dosis de vacunas aplicadas a menores de 1 año
Número de camas	valor_unidad_medida	unidad de medida	unidad de medida	Número de camas en centro de salud
Prevalencia de desnutrición crónica	ordinal_valor_5	Genero	ordinal	Prevalencia de desnutrición crónica
Aplicación de vacuna a niños de un año	r_pais	pais	region	Vacunas aplicadas a niños de un año
Procentaje según Tenencia de vivienda	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Procentaje según Tenencia de vivienda
Atención de parto y postparto	valor_tipo	tipo de valor	tipo de valor cargado	Mujeres atendidas por parto y postparto
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	ordinal_valor_5	tipo de servicio	ordinal	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	t_dia	dia	tiempo	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Consulta externa de la población de 5 años y más	valor_tipo	tipo de valor	tipo de valor cargado	Consulta externa de la población de 5 años y más
Consumo de agua Potable	r_provincia	provincia	region	Cantidad en miles de metros cúbicos de consumo de agua Potable
Presupuesto Comprometido	r_provincia	provincia	region	Presupuesto Comprometido
Regalías Forestales	valor_tipo	tipo de valor	tipo de valor cargado	Regalías Forestales
Control de crecimiento a niños menores de cinco años nuevos y repetidos	t_mes_cadena	nombre mes	tiempo	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Presupuesto Pagado	t_mes	mes	tiempo	Presupuesto Pagado
Proyecciones de población, según departamento y municipio	r_provincia	provincia	region	Proyecciones de población, según departamento y municipio
Vitamina "A" aplicada a menores de 5 años	ordinal_valor_5	número de dosis	ordinal	Vitamina "A" aplicada a menores de 5 años
Porcentaje de la Población con Acceso a agua	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de la población con acceso a agua según la procedencia
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	t_mes	mes	tiempo	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	t_mes	mes	tiempo	Porcentaje de la Población con Servicio telefónico fijo o móvil
Regalías Mineras	r_comunidad	comunidad	region	Regalías Mineras
Regalías Forestales	r_pais	pais	region	Regalías Forestales
Porcentaje de la Población con Disponibilidad de servicio sanitario	t_fecha	fecha	tiempo	Porcentaje de la Población con Disponibilidad de servicio sanitario
Consulta externa de la población de 5 años y más	r_pais	pais	region	Consulta externa de la población de 5 años y más
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	r_provincia	provincia	region	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	t_ano	año	tiempo	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Porcentaje de la Población con Disponibilidad de servicio sanitario	t_mes	mes	tiempo	Porcentaje de la Población con Disponibilidad de servicio sanitario
Consulta externa en la población menor de 5 años	r_provincia	provincia	region	Consulta externa en la población menor de 5 años
Regalías Hidrocarburiferas	r_departamento	departamento	region	Regalías Hidrocarburiferas
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	t_fecha	fecha	tiempo	Porcentaje de la Población con Servicio telefónico fijo o móvil
Mortalidad Infantil (1q0)	t_ano	año	tiempo	 Mortalidad Infantil (1q0)
Mortalidad Neonatal (MN)	t_dia	dia	tiempo	Mortalidad Neonatal (MN)
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	t_fecha	fecha	tiempo	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Impuesto Directo a los Hidrocarburos (IDH)	r_municipio	municipio	region	Impuesto Directo a los Hidrocarburos (IDH)
Regalías Hidrocarburiferas	defecto_valor_cargado	valor por defecto	valor	Regalías Hidrocarburiferas
Poblaciòn por rangos de edad	t_mes_cadena	nombre mes	tiempo	Poblacion por rangos de edad del censo 2012
Procedencia del Agua que utilizan en la vivienda	t_mes_cadena	nombre mes	tiempo	Procedencia del Agua que utilizan en la vivienda según censo 2012
Transferencias por coparticipación tributaria	ordinal_valor_3	Fuente transferencia	ordinal	Transferencias por coparticipación tributaria
Impuesto Directo a los Hidrocarburos (IDH)	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Impuesto Directo a los Hidrocarburos (IDH)
Impuesto Directo a los Hidrocarburos (IDH)	ordinal_valor_5	Entidad	ordinal	Impuesto Directo a los Hidrocarburos (IDH)
Mortalidad Neonatal (MN)	t_ano	año	tiempo	Mortalidad Neonatal (MN)
Presupuesto Pagado	t_fecha	fecha	tiempo	Presupuesto Pagado
Mortalidad Infantil (1q0)	t_dia	dia	tiempo	 Mortalidad Infantil (1q0)
Consulta externa de la población de 5 años y más	valor_unidad_medida	unidad de medida	unidad de medida	Consulta externa de la población de 5 años y más
Regalías Forestales	valor_unidad_medida	unidad de medida	unidad de medida	Regalías Forestales
Presupuesto Aprobado	r_comunidad	comunidad	region	Presupuesto Aprobado
Atención de parto y postparto	valor_unidad_medida	unidad de medida	unidad de medida	Mujeres atendidas por parto y postparto
Mortalidad Neonatal (MN)	r_departamento	departamento	region	Mortalidad Neonatal (MN)
Porcentaje de la Población con Distribución de agua por cañeria	r_comunidad	comunidad	region	Porcentaje de la Población con Distribución de agua por cañeria
Bebes con bajo peso al nacer	r_comunidad	comunidad	region	Bebes que nacieron con bajo peso
Número de camas	valor_tipo	tipo de valor	tipo de valor cargado	Número de camas en centro de salud
Mortalidad Neonatal (MN)	defecto_valor_cargado	valor por defecto	valor	Mortalidad Neonatal (MN)
Transferencias por coparticipación tributaria	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Transferencias por coparticipación tributaria
Dosis de vacunas aplicadas a menores de 1 año	valor_unidad_medida	unidad de medida	unidad de medida	Dosis de vacunas aplicadas a menores de 1 año
Regalías Hidrocarburiferas	t_dia	dia	tiempo	Regalías Hidrocarburiferas
Regalías Hidrocarburiferas	t_ano	año	tiempo	Regalías Hidrocarburiferas
Mortalidad Infantil (1q0)	r_departamento	departamento	region	 Mortalidad Infantil (1q0)
Número de camas	r_pais	pais	region	Número de camas en centro de salud
Porcentaje de viviendas según Material en el techo	t_fecha	fecha	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del techo
Mortalidad Infantil (1q0)	defecto_valor_cargado	valor por defecto	valor	 Mortalidad Infantil (1q0)
Mortalidad Post-Infantil (4q1)	r_comunidad	comunidad	region	Mortalidad Post-Infantil (4q1)
Porcentaje de viviendas según Material en el piso	t_fecha	fecha	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del piso
Aplicación de vacuna a niños de un año	valor_unidad_medida	unidad de medida	unidad de medida	Vacunas aplicadas a niños de un año
 coberturas de control prenatal	r_provincia	provincia	region	Cantidad de mujeres que contaron con controles prenatales
Fondo de Compensación Departamental	r_comunidad	comunidad	region	Fondo de Compensación Departamental
Porcentaje de la Población según Combustible utilizado para cocinar	t_mes	mes	tiempo	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Mortalidad P-Neonatal (MPN) 	t_mes_cadena	nombre mes	tiempo	Mortalidad P-Neonatal (MPN)
Procedencia de Energía Eléctrica	valor_unidad_medida	unidad de medida	unidad de medida	Procedencia de Energía Eléctrica según cesno 2012
 coberturas de control prenatal	valor_tipo	tipo de valor	tipo de valor cargado	Cantidad de mujeres que contaron con controles prenatales
Presupuesto Pagado	valor_cargado	valor	valor	Presupuesto Pagado
Total Ingreso	valor_unidad_medida	unidad de medida	unidad de medida	Total ingreso
Deuda Flotante	defecto_valor_cargado	valor por defecto	valor	Deuda Flotante según Presupuesto
 coberturas de control prenatal	r_pais	pais	region	Cantidad de mujeres que contaron con controles prenatales
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	valor_cargado	valor	valor	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Deuda Flotante	r_departamento	departamento	region	Deuda Flotante según Presupuesto
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	valor_cargado	valor	valor	Porcentaje de la Población con Servicio telefónico fijo o móvil
Control de crecimiento a niños menores de cinco años nuevos y repetidos	ordinal_valor_5	edad de niño	ordinal	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Número de camas	r_provincia	provincia	region	Número de camas en centro de salud
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	r_municipio	municipio	region	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Proyecciones de población, según departamento y municipio	valor_unidad_medida	unidad de medida	unidad de medida	Proyecciones de población, según departamento y municipio
Ingresos Tributarios	r_municipio	municipio	region	Ingresos originados por los diferentes tributos
Saldo por Devengar	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Saldo por Devengar del Presupuesto
Tipo de desagüe del servicio sanitario	r_comunidad	comunidad	region	Tipo de desagüe del servicio sanitario según censo 2012
Presupuesto Comprometido	valor_unidad_medida	unidad de medida	unidad de medida	Presupuesto Comprometido
Deuda Flotante	t_ano	año	tiempo	Deuda Flotante según Presupuesto
Consulta externa en la población menor de 5 años	r_pais	pais	region	Consulta externa en la población menor de 5 años
Saldo por Devengar	ordinal_valor_5	Entidad	ordinal	Saldo por Devengar del Presupuesto
Consumo de agua Potable	valor_unidad_medida	unidad de medida	unidad de medida	Cantidad en miles de metros cúbicos de consumo de agua Potable
Saldo por Devengar	r_municipio	municipio	region	Saldo por Devengar del Presupuesto
Deuda Flotante	t_dia	dia	tiempo	Deuda Flotante según Presupuesto
Consulta externa en la población menor de 5 años	valor_tipo	tipo de valor	tipo de valor cargado	Consulta externa en la población menor de 5 años
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	valor_unidad_medida	unidad de medida	unidad de medida	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Ingresos Tributarios	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Ingresos originados por los diferentes tributos
Transferencias por coparticipación tributaria	r_provincia	provincia	region	Transferencias por coparticipación tributaria
Porcentaje de la Población con Energia eléctrica en el hogar	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de la Población con Energia eléctrica en el hogar
Presupuesto Devengado	valor_unidad_medida	unidad de medida	unidad de medida	Presupuesto Devengado
 coberturas de control prenatal	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Cantidad de mujeres que contaron con controles prenatales
Porcentaje de la Población con Energia eléctrica en el hogar	r_municipio	municipio	region	Porcentaje de la Población con Energia eléctrica en el hogar
Tipo de desagüe del servicio sanitario	defecto_valor_cargado	valor por defecto	valor	Tipo de desagüe del servicio sanitario según censo 2012
Tipo de desagüe del servicio sanitario	r_departamento	departamento	region	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de la Población con Desague del servicio sanitario	t_mes	mes	tiempo	Procentaje de la población con desague del servicio sanitario según el tipo
Procedencia del Agua que utilizan en la vivienda	valor_cargado	valor	valor	Procedencia del Agua que utilizan en la vivienda según censo 2012
Credito Vigente	ordinal_valor_5	Entidad	ordinal	Credito Vigente según presupuesto
Tipo de desagüe del servicio sanitario	t_ano	año	tiempo	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de viviendas según Material en la pared	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Mortalidad P-Neonatal (MPN) 	t_fecha	fecha	tiempo	Mortalidad P-Neonatal (MPN)
Consulta externa en la población menor de 5 años	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Consulta externa en la población menor de 5 años
Credito Vigente	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Credito Vigente según presupuesto
Deuda Flotante	r_comunidad	comunidad	region	Deuda Flotante según Presupuesto
Porcentaje de viviendas según Material en la pared	r_municipio	municipio	region	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Tipo de desagüe del servicio sanitario	t_dia	dia	tiempo	Tipo de desagüe del servicio sanitario según censo 2012
Total Ingreso	ordinal_valor_3	codigo entidad	ordinal	Total ingreso
Credito Vigente	r_municipio	municipio	region	Credito Vigente según presupuesto
Poblaciòn por rangos de edad	valor_cargado	valor	valor	Poblacion por rangos de edad del censo 2012
Porcentaje de Tipo de Vivienda	t_mes	mes	tiempo	Porcentaje de hogares según el tipo de vivienda
Presupuesto Aprobado	t_dia	dia	tiempo	Presupuesto Aprobado
Fondo de Compensación Departamental	defecto_valor_cargado	valor por defecto	valor	Fondo de Compensación Departamental
Porcentaje de la Población con Uso del servicio sanitario	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de la Población con Uso del servicio sanitario
Mortalidad Infantil (1q0)	r_comunidad	comunidad	region	 Mortalidad Infantil (1q0)
Mortalidad Post-Infantil (4q1)	defecto_valor_cargado	valor por defecto	valor	Mortalidad Post-Infantil (4q1)
Fondo de Compensación Departamental	r_departamento	departamento	region	Fondo de Compensación Departamental
Mortalidad Post-Infantil (4q1)	r_departamento	departamento	region	Mortalidad Post-Infantil (4q1)
Porcentaje de la Población con Distribución de agua por cañeria	r_departamento	departamento	region	Porcentaje de la Población con Distribución de agua por cañeria
Porcentaje de la Población con Acceso a agua	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de viviendas según Material en el piso	t_mes_cadena	nombre mes	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del piso
Mortalidad Neonatal (MN)	r_comunidad	comunidad	region	Mortalidad Neonatal (MN)
Bebes con bajo peso al nacer	defecto_valor_cargado	valor por defecto	valor	Bebes que nacieron con bajo peso
Porcentaje de la Población con Distribución de agua por cañeria	defecto_valor_cargado	valor por defecto	valor	Porcentaje de la Población con Distribución de agua por cañeria
Porcentaje de la Población con Uso del servicio sanitario	r_municipio	municipio	region	Porcentaje de la Población con Uso del servicio sanitario
Porcentaje de viviendas según Material en el techo	t_mes_cadena	nombre mes	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del techo
Bebes con bajo peso al nacer	r_departamento	departamento	region	Bebes que nacieron con bajo peso
Presupuesto Aprobado	t_ano	año	tiempo	Presupuesto Aprobado
Presupuesto Aprobado	defecto_valor_cargado	valor por defecto	valor	Presupuesto Aprobado
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	t_mes_cadena	nombre mes	tiempo	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Fondo de Compensación Departamental	t_dia	dia	tiempo	Fondo de Compensación Departamental
Porcentaje de la Población con Distribución de agua por cañeria	t_ano	año	tiempo	Porcentaje de la Población con Distribución de agua por cañeria
Poblaciòn por rangos de edad	t_fecha	fecha	tiempo	Poblacion por rangos de edad del censo 2012
Mortalidad Post-Infantil (4q1)	t_dia	dia	tiempo	Mortalidad Post-Infantil (4q1)
Bebes con bajo peso al nacer	t_ano	año	tiempo	Bebes que nacieron con bajo peso
Presupuesto Aprobado	r_departamento	departamento	region	Presupuesto Aprobado
Transferencias por coparticipación tributaria	r_pais	pais	region	Transferencias por coparticipación tributaria
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	t_mes_cadena	nombre mes	tiempo	Porcentaje de la Población con Servicio telefónico fijo o móvil
Mortalidad P-Neonatal (MPN) 	valor_cargado	valor	valor	Mortalidad P-Neonatal (MPN)
Número de camas	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Número de camas en centro de salud
Regalías Hidrocarburiferas	r_comunidad	comunidad	region	Regalías Hidrocarburiferas
Población por género	valor_unidad_medida	unidad de medida	unidad de medida	Poblacion del censo 2012 por genero
Bebes con bajo peso al nacer	t_dia	dia	tiempo	Bebes que nacieron con bajo peso
Transferencias por coparticipación tributaria	valor_tipo	tipo de valor	tipo de valor cargado	Transferencias por coparticipación tributaria
Mortalidad Post-Infantil (4q1)	t_ano	año	tiempo	Mortalidad Post-Infantil (4q1)
Procedencia del Agua que utilizan en la vivienda	t_fecha	fecha	tiempo	Procedencia del Agua que utilizan en la vivienda según censo 2012
Porcentaje de la Población con Distribución de agua por cañeria	t_dia	dia	tiempo	Porcentaje de la Población con Distribución de agua por cañeria
Control de crecimiento a niños menores de cinco años nuevos y repetidos	t_mes	mes	tiempo	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Fondo de Compensación Departamental	t_ano	año	tiempo	Fondo de Compensación Departamental
Presupuesto Pagado	t_mes_cadena	nombre mes	tiempo	Presupuesto Pagado
Control de crecimiento a niños menores de cinco años nuevos y repetidos	t_fecha	fecha	tiempo	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Regalías Mineras	defecto_valor_cargado	valor por defecto	valor	Regalías Mineras
Porcentaje de la Población con Desague del servicio sanitario	valor_cargado	valor	valor	Procentaje de la población con desague del servicio sanitario según el tipo
Procedencia del Agua que utilizan en la vivienda	t_mes	mes	tiempo	Procedencia del Agua que utilizan en la vivienda según censo 2012
Atención de parto y postparto	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Mujeres atendidas por parto y postparto
Población por género	valor_tipo	tipo de valor	tipo de valor cargado	Poblacion del censo 2012 por genero
Dosis de vacunas aplicadas a menores de 1 año	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Dosis de vacunas aplicadas a menores de 1 año
Regalías Mineras	r_departamento	departamento	region	Regalías Mineras
Transferencias por coparticipación tributaria	valor_unidad_medida	unidad de medida	unidad de medida	Transferencias por coparticipación tributaria
Población por género	r_pais	pais	region	Poblacion del censo 2012 por genero
Porcentaje de la Población con Disponibilidad de servicio sanitario	t_mes_cadena	nombre mes	tiempo	Porcentaje de la Población con Disponibilidad de servicio sanitario
Poblaciòn por rangos de edad	t_mes	mes	tiempo	Poblacion por rangos de edad del censo 2012
Aplicación de vacuna a niños de un año	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Vacunas aplicadas a niños de un año
Presupuesto Devengado	r_provincia	provincia	region	Presupuesto Devengado
Regalías Mineras	t_dia	dia	tiempo	Regalías Mineras
Porcentaje de la Población según Combustible utilizado para cocinar	t_mes_cadena	nombre mes	tiempo	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Porcentaje de la Población con Acceso a agua	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de la población con acceso a agua según la procedencia
Deuda Flotante	ordinal_valor_4	clasificación Entidad	ordinal	Deuda Flotante según Presupuesto
Porcentaje de la Población con Acceso a agua	r_pais	pais	region	Porcentaje de la población con acceso a agua según la procedencia
Presupuesto Devengado	ordinal_valor_3	codigo Entidad	ordinal	Presupuesto Devengado
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	r_comunidad	comunidad	region	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Regalías Forestales	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Regalías Forestales
Consulta externa de la población de 5 años y más	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Consulta externa de la población de 5 años y más
Regalías Mineras	t_ano	año	tiempo	Regalías Mineras
Vitamina "A" aplicada a menores de 5 años	t_dia	dia	tiempo	Vitamina "A" aplicada a menores de 5 años
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Proyecciones de población, según departamento y municipio	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Proyecciones de población, según departamento y municipio
Porcentaje de Tipo de Vivienda	t_fecha	fecha	tiempo	Porcentaje de hogares según el tipo de vivienda
Consumo de agua Potable	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Cantidad en miles de metros cúbicos de consumo de agua Potable
Dosis de vacunas aplicadas a menores de 1 año	ordinal_valor_5	vacuna	ordinal	Dosis de vacunas aplicadas a menores de 1 año
Presupuesto Comprometido	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Presupuesto Comprometido
Tipo de desagüe del servicio sanitario	ordinal_valor_2	codigo comunidad	ordinal	Tipo de desagüe del servicio sanitario según censo 2012
Mortalidad P-Neonatal (MPN) 	t_mes	mes	tiempo	Mortalidad P-Neonatal (MPN)
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Porcentaje de la Población con Acceso a agua	r_provincia	provincia	region	Porcentaje de la población con acceso a agua según la procedencia
Control de crecimiento a niños menores de cinco años nuevos y repetidos	valor_cargado	valor	valor	Control de crecimiento a niños menores de cinco años nuevos y repetidos
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	r_municipio	municipio	region	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Vitamina "A" aplicada a menores de 5 años	t_ano	año	tiempo	Vitamina "A" aplicada a menores de 5 años
Porcentaje de la Población con Desague del servicio sanitario	t_fecha	fecha	tiempo	Procentaje de la población con desague del servicio sanitario según el tipo
Procedencia de Energía Eléctrica	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Procedencia de Energía Eléctrica según cesno 2012
Vitamina "A" aplicada a menores de 5 años	defecto_valor_cargado	valor por defecto	valor	Vitamina "A" aplicada a menores de 5 años
Porcentaje de viviendas según Material en el techo	ordinal_valor_3	tipo de material de construcción	ordinal	Porcentaje de viviendas según Material utilizado en la construcción del techo
Porcentaje de viviendas según Material en el piso	ordinal_valor_3	tipo de material de construcción	ordinal	Porcentaje de viviendas según Material utilizado en la construcción del piso
Vitamina "A" aplicada a menores de 5 años	r_departamento	departamento	region	Vitamina "A" aplicada a menores de 5 años
Total Ingreso	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Total ingreso
Presupuesto Devengado	valor_tipo	tipo de valor	tipo de valor cargado	Presupuesto Devengado
Mortalidad En la Niñes (5q0)	r_municipio	municipio	region	Mortalidad En la Niñes (5q0)
Mortalidad En la Niñes (5q0)	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Mortalidad En la Niñes (5q0)
Presupuesto Devengado	r_pais	pais	region	Presupuesto Devengado
Población por género	r_provincia	provincia	region	Poblacion del censo 2012 por genero
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	valor_unidad_medida	unidad de medida	unidad de medida	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Porcentaje de la Población con Desague del servicio sanitario	r_comunidad	comunidad	region	Procentaje de la población con desague del servicio sanitario según el tipo
Saldo por Devengar	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Saldo por Devengar del Presupuesto
Bebes con bajo peso al nacer	ordinal_valor_5	nacimientos con bajo peso	ordinal	Bebes que nacieron con bajo peso
Porcentaje de viviendas según Material en la pared	r_pais	pais	region	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Deuda Flotante	t_mes	mes	tiempo	Deuda Flotante según Presupuesto
Porcentaje de la Población con Uso del servicio sanitario	r_provincia	provincia	region	Porcentaje de la Población con Uso del servicio sanitario
Credito Vigente	r_pais	pais	region	Credito Vigente según presupuesto
Porcentaje de viviendas según Material en la pared	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Credito Vigente	valor_tipo	tipo de valor	tipo de valor cargado	Credito Vigente según presupuesto
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Porcentaje de Tipo de Vivienda	r_comunidad	comunidad	region	Porcentaje de hogares según el tipo de vivienda
Ingresos Tributarios	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Ingresos originados por los diferentes tributos
Vitamina "A" aplicada a menores de 5 años	t_mes_cadena	nombre mes	tiempo	Vitamina "A" aplicada a menores de 5 años
Porcentaje de la Población con Energia eléctrica en el hogar	r_pais	pais	region	Porcentaje de la Población con Energia eléctrica en el hogar
Mortalidad En la Niñes (5q0)	valor_unidad_medida	unidad de medida	unidad de medida	Mortalidad En la Niñes (5q0)
Porcentaje de la Población con Energia eléctrica en el hogar	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de la Población con Energia eléctrica en el hogar
Poblaciòn por rangos de edad	ordinal_valor_3	rango de edad	ordinal	Poblacion por rangos de edad del censo 2012
Regalías Hidrocarburiferas	ordinal_valor_4	codigo entidad	ordinal	Regalías Hidrocarburiferas
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	valor_cargado	valor	valor	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Porcentaje de la Población según Combustible utilizado para cocinar	t_dia	dia	tiempo	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Porcentaje de la Población con Energia eléctrica en el hogar	r_provincia	provincia	region	Porcentaje de la Población con Energia eléctrica en el hogar
Regalías Mineras	t_mes_cadena	nombre mes	tiempo	Regalías Mineras
Transferencias por coparticipación tributaria	ordinal_valor_5	Entidad	ordinal	Transferencias por coparticipación tributaria
Transferencias por coparticipación tributaria	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Transferencias por coparticipación tributaria
Credito Vigente	ordinal_valor_3	codigo Entidad	ordinal	Credito Vigente según presupuesto
Regalías Hidrocarburiferas	t_mes	mes	tiempo	Regalías Hidrocarburiferas
Transferencias por coparticipación tributaria	r_municipio	municipio	region	Transferencias por coparticipación tributaria
Porcentaje de la Población con Disponibilidad de servicio sanitario	r_departamento	departamento	region	Porcentaje de la Población con Disponibilidad de servicio sanitario
Porcentaje de la Población con Disponibilidad de servicio sanitario	defecto_valor_cargado	valor por defecto	valor	Porcentaje de la Población con Disponibilidad de servicio sanitario
Control de crecimiento a niños menores de cinco años nuevos y repetidos	r_comunidad	comunidad	region	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Porcentaje de la Población según Combustible utilizado para cocinar	t_ano	año	tiempo	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Porcentaje de la Población con Disponibilidad de servicio sanitario	t_ano	año	tiempo	Porcentaje de la Población con Disponibilidad de servicio sanitario
Porcentaje de la Población con Uso del servicio sanitario	r_pais	pais	region	Porcentaje de la Población con Uso del servicio sanitario
Credito Vigente	r_provincia	provincia	region	Credito Vigente según presupuesto
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	t_fecha	fecha	tiempo	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Porcentaje de la Población según Combustible utilizado para cocinar	defecto_valor_cargado	valor por defecto	valor	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Mortalidad Infantil (1q0)	t_mes	mes	tiempo	 Mortalidad Infantil (1q0)
Porcentaje de viviendas según Material en la pared	r_provincia	provincia	region	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Porcentaje de la Población según Combustible utilizado para cocinar	r_departamento	departamento	region	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Impuesto Directo a los Hidrocarburos (IDH)	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Impuesto Directo a los Hidrocarburos (IDH)
Mortalidad Neonatal (MN)	t_mes	mes	tiempo	Mortalidad Neonatal (MN)
Porcentaje de la Población con Uso del servicio sanitario	valor_tipo	tipo de valor	tipo de valor cargado	Porcentaje de la Población con Uso del servicio sanitario
Porcentaje de la Población con Acceso a agua	ordinal_valor_3	tipo de procedencia del agua que utilizan en la vivienda	ordinal	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de la Población con Disponibilidad de servicio sanitario	t_dia	dia	tiempo	Porcentaje de la Población con Disponibilidad de servicio sanitario
Porcentaje de la Población con Uso del servicio sanitario	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de la Población con Uso del servicio sanitario
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	t_dia	dia	tiempo	Porcentaje de la Población con Servicio telefónico fijo o móvil
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	t_dia	dia	tiempo	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Fondo de Compensación Departamental	t_mes_cadena	nombre mes	tiempo	Fondo de Compensación Departamental
Mortalidad Neonatal (MN)	t_fecha	fecha	tiempo	Mortalidad Neonatal (MN)
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	r_provincia	provincia	region	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Presupuesto Pagado	t_ano	año	tiempo	Presupuesto Pagado
Mortalidad Post-Infantil (4q1)	t_mes_cadena	nombre mes	tiempo	Mortalidad Post-Infantil (4q1)
Porcentaje de la Población con Acceso a agua	r_municipio	municipio	region	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de la Población con Distribución de agua por cañeria	t_mes_cadena	nombre mes	tiempo	Porcentaje de la Población con Distribución de agua por cañeria
Porcentaje de viviendas según Material en el piso	r_departamento	departamento	region	Porcentaje de viviendas según Material utilizado en la construcción del piso
Presupuesto Pagado	t_dia	dia	tiempo	Presupuesto Pagado
Porcentaje de la Población con Acceso a agua	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Porcentaje de la población con acceso a agua según la procedencia
Porcentaje de viviendas según Material en el techo	defecto_valor_cargado	valor por defecto	valor	Porcentaje de viviendas según Material utilizado en la construcción del techo
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	t_ano	año	tiempo	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	t_ano	año	tiempo	Porcentaje de la Población con Servicio telefónico fijo o móvil
Mortalidad Infantil (1q0)	t_fecha	fecha	tiempo	 Mortalidad Infantil (1q0)
Porcentaje de viviendas según Material en el piso	defecto_valor_cargado	valor por defecto	valor	Porcentaje de viviendas según Material utilizado en la construcción del piso
Porcentaje de viviendas según Material en el techo	r_departamento	departamento	region	Porcentaje de viviendas según Material utilizado en la construcción del techo
Bebes con bajo peso al nacer	t_mes_cadena	nombre mes	tiempo	Bebes que nacieron con bajo peso
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	t_mes	mes	tiempo	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	r_departamento	departamento	region	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	defecto_valor_cargado	valor por defecto	valor	Porcentaje de la Población con Servicio telefónico fijo o móvil
Consulta externa en la población menor de 5 años	ordinal_valor_5	tipo de consulta externa	ordinal	Consulta externa en la población menor de 5 años
Procedencia del Agua que utilizan en la vivienda	r_comunidad	comunidad	region	Procedencia del Agua que utilizan en la vivienda según censo 2012
Porcentaje de viviendas según Material en el piso	t_ano	año	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del piso
Porcentaje de viviendas según Material en el techo	t_ano	año	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del techo
Población por género	r_municipio	municipio	region	Poblacion del censo 2012 por genero
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	defecto_valor_cargado	valor por defecto	valor	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Presupuesto Aprobado	t_mes_cadena	nombre mes	tiempo	Presupuesto Aprobado
Deuda Flotante	valor_cargado	valor	valor	Deuda Flotante según Presupuesto
Regalías Hidrocarburiferas	t_fecha	fecha	tiempo	Regalías Hidrocarburiferas
Porcentaje de la Población con Desague del servicio sanitario	ordinal_valor_2	área greográfica	ordinal	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	r_departamento	departamento	region	Porcentaje de la Población con Servicio telefónico fijo o móvil
Población por género	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Poblacion del censo 2012 por genero
Porcentaje de Tipo de Vivienda	ordinal_valor_2	área greográfica	ordinal	Porcentaje de hogares según el tipo de vivienda
Presupuesto Pagado	defecto_valor_cargado	valor por defecto	valor	Presupuesto Pagado
Porcentaje de viviendas según Material en el techo	t_dia	dia	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del techo
Poblaciòn por rangos de edad	r_comunidad	comunidad	region	Poblacion por rangos de edad del censo 2012
Porcentaje de viviendas según Material en el piso	t_dia	dia	tiempo	Porcentaje de viviendas según Material utilizado en la construcción del piso
Mortalidad En la Niñes (5q0)	r_provincia	provincia	region	Mortalidad En la Niñes (5q0)
Procentaje según Tenencia de vivienda	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Procentaje según Tenencia de vivienda
Porcentaje de la Población con Uso del servicio sanitario	ordinal_valor_3	uso de servicio sanitario	ordinal	Porcentaje de la Población con Uso del servicio sanitario
Presupuesto Pagado	r_departamento	departamento	region	Presupuesto Pagado
Mortalidad Infantil (1q0)	valor_cargado	valor	valor	 Mortalidad Infantil (1q0)
Mortalidad En la Niñes (5q0)	valor_tipo	tipo de valor	tipo de valor cargado	Mortalidad En la Niñes (5q0)
Porcentaje de la Población con Energia eléctrica en el hogar	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de la Población con Energia eléctrica en el hogar
Presupuesto Devengado	r_municipio	municipio	region	Presupuesto Devengado
Presupuesto Devengado	ordinal_valor_5	Entidad	ordinal	Presupuesto Devengado
Mortalidad Neonatal (MN)	valor_cargado	valor	valor	Mortalidad Neonatal (MN)
Mortalidad En la Niñes (5q0)	r_pais	pais	region	Mortalidad En la Niñes (5q0)
Presupuesto Devengado	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Presupuesto Devengado
Tipo de desagüe del servicio sanitario	t_mes_cadena	nombre mes	tiempo	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de la Población según Combustible utilizado para cocinar	ordinal_valor_3	tipo conbustible	ordinal	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	r_pais	pais	region	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Credito Vigente	valor_unidad_medida	unidad de medida	unidad de medida	Credito Vigente según presupuesto
Porcentaje de viviendas según Material en la pared	valor_unidad_medida	unidad de medida	unidad de medida	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Mortalidad P-Neonatal (MPN) 	r_comunidad	comunidad	region	Mortalidad P-Neonatal (MPN)
Deuda Flotante	t_fecha	fecha	tiempo	Deuda Flotante según Presupuesto
Regalías Hidrocarburiferas	valor_cargado	valor	valor	Regalías Hidrocarburiferas
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	ordinal_valor_4	codigo entidad	ordinal	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	valor_tipo	tipo de valor	tipo de valor cargado	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Prevalencia de desnutrición crónica	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Prevalencia de desnutrición crónica
Procedencia de Energía Eléctrica	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Procedencia de Energía Eléctrica según cesno 2012
Mortalidad P-Neonatal (MPN) 	r_departamento	departamento	region	Mortalidad P-Neonatal (MPN)
Total Ingreso	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Total ingreso
Total Ingreso	ordinal_valor_5	Entidad	ordinal	Total ingreso
Mortalidad P-Neonatal (MPN) 	defecto_valor_cargado	valor por defecto	valor	Mortalidad P-Neonatal (MPN)
Porcentaje de la Población con Disponibilidad de servicio sanitario	ordinal_valor_2	área greográfica	ordinal	Porcentaje de la Población con Disponibilidad de servicio sanitario
Total Ingreso	r_municipio	municipio	region	Total ingreso
Porcentaje de Tipo de Vivienda	ordinal_valor_3	tipo de vivienda	ordinal	Porcentaje de hogares según el tipo de vivienda
Mortalidad En la Niñes (5q0)	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Mortalidad En la Niñes (5q0)
Procentaje según Tenencia de vivienda	r_provincia	provincia	region	Procentaje según Tenencia de vivienda
Deuda Flotante	t_mes_cadena	nombre mes	tiempo	Deuda Flotante según Presupuesto
Procedencia de Energía Eléctrica	r_municipio	municipio	region	Procedencia de Energía Eléctrica según cesno 2012
Presupuesto Aprobado	valor_cargado	valor	valor	Presupuesto Aprobado
Porcentaje de la Población con Distribución de agua por cañeria	valor_cargado	valor	valor	Porcentaje de la Población con Distribución de agua por cañeria
cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	cantidad de dosis única de vitamina "A", aplicada a mujeres en post parto
Proyecciones de población, según departamento y municipio	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Proyecciones de población, según departamento y municipio
Prevalencia de desnutrición crónica	valor_tipo	tipo de valor	tipo de valor cargado	Prevalencia de desnutrición crónica
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	ordinal_valor_5	tipo de estudio en mujeres	ordinal	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Consumo de agua Potable	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Cantidad en miles de metros cúbicos de consumo de agua Potable
Bebes con bajo peso al nacer	valor_cargado	valor	valor	Bebes que nacieron con bajo peso
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	r_municipio	municipio	region	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Presupuesto Comprometido	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Presupuesto Comprometido
Mortalidad P-Neonatal (MPN) 	t_dia	dia	tiempo	Mortalidad P-Neonatal (MPN)
Presupuesto Comprometido	ordinal_valor_5	Entidad	ordinal	Presupuesto Comprometido
Saldo por Devengar	valor_unidad_medida	unidad de medida	unidad de medida	Saldo por Devengar del Presupuesto
Porcentaje de la Población según Combustible utilizado para cocinar	ordinal_valor_2	área greográfica	ordinal	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Consumo de agua Potable	r_municipio	municipio	region	Cantidad en miles de metros cúbicos de consumo de agua Potable
Mortalidad P-Neonatal (MPN) 	t_ano	año	tiempo	Mortalidad P-Neonatal (MPN)
Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Dosis de vitamina "A", aplicada a niños y niñas de 1 a 4 años
Presupuesto Comprometido	r_municipio	municipio	region	Presupuesto Comprometido
Regalías Mineras	ordinal_valor_4	codigo entidad	ordinal	Regalías Mineras
Tipo de desagüe del servicio sanitario	t_fecha	fecha	tiempo	Tipo de desagüe del servicio sanitario según censo 2012
Mortalidad Post-Infantil (4q1)	valor_cargado	valor	valor	Mortalidad Post-Infantil (4q1)
Ingresos Tributarios	valor_unidad_medida	unidad de medida	unidad de medida	Ingresos originados por los diferentes tributos
Fondo de Compensación Departamental	valor_cargado	valor	valor	Fondo de Compensación Departamental
Prevalencia de desnutrición crónica	r_pais	pais	region	Prevalencia de desnutrición crónica
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	valor_unidad_medida	unidad de medida	unidad de medida	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Vitamina "A" aplicada a menores de 5 años	t_mes	mes	tiempo	Vitamina "A" aplicada a menores de 5 años
Proyecciones de población, según departamento y municipio	r_municipio	municipio	region	Proyecciones de población, según departamento y municipio
Presupuesto Aprobado	t_fecha	fecha	tiempo	Presupuesto Aprobado
Regalías Hidrocarburiferas	t_mes_cadena	nombre mes	tiempo	Regalías Hidrocarburiferas
Regalías Forestales	r_municipio	municipio	region	Regalías Forestales
Poblaciòn por rangos de edad	defecto_valor_cargado	valor por defecto	valor	Poblacion por rangos de edad del censo 2012
Consulta externa de la población de 5 años y más	r_municipio	municipio	region	Consulta externa de la población de 5 años y más
Presupuesto Pagado	r_comunidad	comunidad	region	Presupuesto Pagado
Poblaciòn por rangos de edad	r_departamento	departamento	region	Poblacion por rangos de edad del censo 2012
Procedencia del Agua que utilizan en la vivienda	r_departamento	departamento	region	Procedencia del Agua que utilizan en la vivienda según censo 2012
Prevalencia de desnutrición crónica	r_provincia	provincia	region	Prevalencia de desnutrición crónica
Número aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año	r_comunidad	comunidad	region	Aplicaciones de dosis única de vacuna antisarampionosa a niños y niñas de 1 año
Impuesto Directo a los Hidrocarburos (IDH)	valor_unidad_medida	unidad de medida	unidad de medida	Impuesto Directo a los Hidrocarburos (IDH)
Procedencia del Agua que utilizan en la vivienda	defecto_valor_cargado	valor por defecto	valor	Procedencia del Agua que utilizan en la vivienda según censo 2012
Regalías Forestales	ordinal_valor_5	Entidad	ordinal	Regalías Forestales
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	r_comunidad	comunidad	region	Porcentaje de la Población con Servicio telefónico fijo o móvil
Regalías Forestales	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Regalías Forestales
Consulta externa de la población de 5 años y más	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Consulta externa de la población de 5 años y más
Regalías Mineras	t_mes	mes	tiempo	Regalías Mineras
Control de crecimiento a niños menores de cinco años nuevos y repetidos	ordinal_valor_4	tipo de estudio	ordinal	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Fondo de Compensación Departamental	t_fecha	fecha	tiempo	Fondo de Compensación Departamental
Procentaje según Tenencia de vivienda	valor_tipo	tipo de valor	tipo de valor cargado	Procentaje según Tenencia de vivienda
Mortalidad Neonatal (MN)	t_mes_cadena	nombre mes	tiempo	Mortalidad Neonatal (MN)
Aplicación de vacuna a niños de un año	r_municipio	municipio	region	Vacunas aplicadas a niños de un año
Poblaciòn por rangos de edad	t_dia	dia	tiempo	Poblacion por rangos de edad del censo 2012
Mortalidad Post-Infantil (4q1)	t_fecha	fecha	tiempo	Mortalidad Post-Infantil (4q1)
Procedencia del Agua que utilizan en la vivienda	t_ano	año	tiempo	Procedencia del Agua que utilizan en la vivienda según censo 2012
Porcentaje de viviendas según Material en el piso	r_comunidad	comunidad	region	Porcentaje de viviendas según Material utilizado en la construcción del piso
Atención de parto y postparto	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Mujeres atendidas por parto y postparto
Dosis de vacunas aplicadas a menores de 1 año	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Dosis de vacunas aplicadas a menores de 1 año
Tipo de desagüe del servicio sanitario	valor_cargado	valor	valor	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de viviendas según Material en el techo	r_comunidad	comunidad	region	Porcentaje de viviendas según Material utilizado en la construcción del techo
Consulta externa de la población de 5 años y más	ordinal_valor_5	tipo consulta externa	ordinal	Consulta externa de la población de 5 años y más
Porcentaje de la Población con Disponibilidad de servicio sanitario	ordinal_valor_3	disponibilidad de servicio sanitario	ordinal	Porcentaje de la Población con Disponibilidad de servicio sanitario
Dosis de vacunas aplicadas a menores de 1 año	r_municipio	municipio	region	Dosis de vacunas aplicadas a menores de 1 año
Mortalidad Infantil (1q0)	t_mes_cadena	nombre mes	tiempo	 Mortalidad Infantil (1q0)
Bebes con bajo peso al nacer	t_fecha	fecha	tiempo	Bebes que nacieron con bajo peso
Porcentaje de la Población con Distribución de agua por cañeria	t_fecha	fecha	tiempo	Porcentaje de la Población con Distribución de agua por cañeria
Poblaciòn por rangos de edad	t_ano	año	tiempo	Poblacion por rangos de edad del censo 2012
Aplicación de vacuna a niños de un año	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Vacunas aplicadas a niños de un año
Procedencia del Agua que utilizan en la vivienda	t_dia	dia	tiempo	Procedencia del Agua que utilizan en la vivienda según censo 2012
Procentaje según Tenencia de vivienda	r_pais	pais	region	Procentaje según Tenencia de vivienda
Atención de parto y postparto	r_municipio	municipio	region	Mujeres atendidas por parto y postparto
Poblaciòn por rangos de edad	ordinal_valor_2	codigo comunidad	ordinal	Poblacion por rangos de edad del censo 2012
Control de crecimiento a niños menores de cinco años nuevos y repetidos	t_dia	dia	tiempo	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Porcentaje de la Población con Distribución de agua por cañeria	t_mes	mes	tiempo	Porcentaje de la Población con Distribución de agua por cañeria
Saldo por Devengar	ordinal_valor_3	codigo Entidad	ordinal	Saldo por Devengar del Presupuesto
Bebes con bajo peso al nacer	t_mes	mes	tiempo	Bebes que nacieron con bajo peso
Número de camas	r_municipio	municipio	region	Número de camas en centro de salud
Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)	t_mes_cadena	nombre mes	tiempo	Impuesto Especial a los Hidrocarburos y sus Derivados (IEHD)
Número de camas	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Número de camas en centro de salud
Mortalidad Post-Infantil (4q1)	t_mes	mes	tiempo	Mortalidad Post-Infantil (4q1)
Control de crecimiento a niños menores de cinco años nuevos y repetidos	t_ano	año	tiempo	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Fondo de Compensación Departamental	t_mes	mes	tiempo	Fondo de Compensación Departamental
Porcentaje de la Población según Combustible utilizado para cocinar	r_comunidad	comunidad	region	Porcentaje de la Población según tipo de Combustible utilizado para cocinar
Procentaje según Tenencia de vivienda	valor_unidad_medida	unidad de medida	unidad de medida	Procentaje según Tenencia de vivienda
Vitamina "A" aplicada a menores de 5 años	valor_cargado	valor	valor	Vitamina "A" aplicada a menores de 5 años
Procedencia del Agua que utilizan en la vivienda	ordinal_valor_2	codigo comunidad	ordinal	Procedencia del Agua que utilizan en la vivienda según censo 2012
Control de crecimiento a niños menores de cinco años nuevos y repetidos	defecto_valor_cargado	valor por defecto	valor	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Porcentaje de la Población con Uso del servicio sanitario	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de la Población con Uso del servicio sanitario
Regalías Mineras	t_fecha	fecha	tiempo	Regalías Mineras
Porcentaje de la Población con Disponibilidad de servicio sanitario	r_comunidad	comunidad	region	Porcentaje de la Población con Disponibilidad de servicio sanitario
Saldo por Devengar	r_provincia	provincia	region	Saldo por Devengar del Presupuesto
Control de crecimiento a niños menores de cinco años nuevos y repetidos	r_departamento	departamento	region	Control de crecimiento a niños menores de cinco años nuevos y repetidos
Impuesto Directo a los Hidrocarburos (IDH)	valor_tipo	tipo de valor	tipo de valor cargado	Impuesto Directo a los Hidrocarburos (IDH)
Impuesto Directo a los Hidrocarburos (IDH)	r_pais	pais	region	Impuesto Directo a los Hidrocarburos (IDH)
Ingresos Tributarios	r_provincia	provincia	region	Ingresos originados por los diferentes tributos
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	r_provincia	provincia	region	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Presupuesto Aprobado	t_mes	mes	tiempo	Presupuesto Aprobado
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	valor_tipo	tipo de valor	tipo de valor cargado	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Vitamina "A" aplicada a menores de 5 años	t_fecha	fecha	tiempo	Vitamina "A" aplicada a menores de 5 años
Porcentaje de la Población con Desague del servicio sanitario	t_ano	año	tiempo	Procentaje de la población con desague del servicio sanitario según el tipo
Ingresos Tributarios	valor_tipo	tipo de valor	tipo de valor cargado	Ingresos originados por los diferentes tributos
Porcentaje de Tipo de Vivienda	t_dia	dia	tiempo	Porcentaje de hogares según el tipo de vivienda
Porcentaje de viviendas según Material en el techo	ordinal_valor_2	área greográfica	ordinal	Porcentaje de viviendas según Material utilizado en la construcción del techo
Saldo por Devengar	r_pais	pais	region	Saldo por Devengar del Presupuesto
Porcentaje de viviendas según Material en el piso	ordinal_valor_2	área greográfica	ordinal	Porcentaje de viviendas según Material utilizado en la construcción del piso
Tipo de desagüe del servicio sanitario	t_mes	mes	tiempo	Tipo de desagüe del servicio sanitario según censo 2012
Porcentaje de viviendas según Material en la pared	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de viviendas según Material utilizado en la construcción de la pared
Consulta externa en la población menor de 5 años	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Consulta externa en la población menor de 5 años
Credito Vigente	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Credito Vigente según presupuesto
Saldo por Devengar	valor_tipo	tipo de valor	tipo de valor cargado	Saldo por Devengar del Presupuesto
Presupuesto Pagado	ordinal_valor_4	clasificación Entidad	ordinal	Presupuesto Pagado
Consulta externa en la población menor de 5 años	r_municipio	municipio	region	Consulta externa en la población menor de 5 años
Estudios citológicos vaginales (PAP) de mujeres en edad fértil	r_pais	pais	region	Estudios citológicos vaginales (PAP) de mujeres en edad fértil
Prevalencia de desnutrición crónica	valor_unidad_medida	unidad de medida	unidad de medida	Prevalencia de desnutrición crónica
Porcentaje de Tipo de Vivienda	t_ano	año	tiempo	Porcentaje de hogares según el tipo de vivienda
Porcentaje de la Población con Desague del servicio sanitario	t_dia	dia	tiempo	Procentaje de la población con desague del servicio sanitario según el tipo
Impuesto Directo a los Hidrocarburos (IDH)	r_provincia	provincia	region	Impuesto Directo a los Hidrocarburos (IDH)
Ingresos Tributarios	r_pais	pais	region	Ingresos originados por los diferentes tributos
Porcentaje de Tipo de Vivienda	defecto_valor_cargado	valor por defecto	valor	Porcentaje de hogares según el tipo de vivienda
 coberturas de control prenatal	r_municipio	municipio	region	Cantidad de mujeres que contaron con controles prenatales
Procedencia de Energía Eléctrica	ordinal_valor_3	tipo de procedencia del agua que utilizan en la vivienda	ordinal	Procedencia de Energía Eléctrica según cesno 2012
Porcentaje de la Población con Energia eléctrica en el hogar	defecto_valor_unidad_medida	unidad de medida por defecto	unidad de medida	Porcentaje de la Población con Energia eléctrica en el hogar
Porcentaje de Tipo de Vivienda	r_departamento	departamento	region	Porcentaje de hogares según el tipo de vivienda
Fondo de Compensación Departamental	ordinal_valor_4	codigo entidad	ordinal	Fondo de Compensación Departamental
 coberturas de control prenatal	valor_frecuencia_medicion	frecuencia de medicion	frecuencia de medicion	Cantidad de mujeres que contaron con controles prenatales
Porcentaje de la Población con Desague del servicio sanitario	r_departamento	departamento	region	Procentaje de la población con desague del servicio sanitario según el tipo
Porcentaje de la Población con Servicio telefónico (fijo o móvil)	ordinal_valor_2	área greográfica	ordinal	Porcentaje de la Población con Servicio telefónico fijo o móvil
Regalías Mineras	valor_cargado	valor	valor	Regalías Mineras
Porcentaje de la Población con Desague del servicio sanitario	defecto_valor_cargado	valor por defecto	valor	Procentaje de la población con desague del servicio sanitario según el tipo';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* @var Variable $variable */
        /* @var Dimension $dimension */
        /* @var Family $family */
        $variables = [];
        $dimensions = [];
        $families = [];
        foreach (explode("\n", $this->data) as $line) {
            $data = explode("\t", $line);
            if (!isset($variables[$data[0]])) {
                $variables[$data[0]] = Variable::firstOrNew([
                    "name" => $data[0],
                ]);
                if (!$variables[$data[0]]->exists) {
                    $variables[$data[0]]->description = $data[4];
                    $variables[$data[0]]->save();
                }
            }
            if (!isset($dimensions[$data[1] . ';' . $data[2]])) {
                $dimensions[$data[1] . ';' . $data[2]] = Dimension::firstOrNew([
                    "name" => $data[2],
                    "column" => $data[1],
                ]);
                if (!$dimensions[$data[1] . ';' . $data[2]]->exists) {
                    $dimensions[$data[1] . ';' . $data[2]]->save();
                }
            }
            if (!isset($families[$data[3]])) {
                $families[$data[3]] = Domain::firstOrNew([
                    "name" => $data[3],
                ]);
                if (!$families[$data[3]]->exists) {
                    $families[$data[3]]->save();
                }
            }
            $variable = $variables[$data[0]];
            $dimension = $dimensions[$data[1] . ';' . $data[2]];
            $family = $families[$data[3]];
            $variable->dimensions()->attach($dimension);
            $dimension->family()->associate($family);
            $dimension->save();
        }
    }
}
