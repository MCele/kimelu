
------------------------------------------------------------
-- apex_dimension_gatillo
------------------------------------------------------------

--- INICIO Grupo de desarrollo 2
INSERT INTO apex_dimension_gatillo (proyecto, dimension, gatillo, tipo, orden, tabla_rel_dim, columnas_rel_dim, tabla_gatillo, ruta_tabla_rel_dim) VALUES (
	'kimelu', --proyecto
	'2000001', --dimension
	'2000001', --gatillo
	'directo', --tipo
	'1', --orden
	'unidad_academica', --tabla_rel_dim
	'sigla', --columnas_rel_dim
	NULL, --tabla_gatillo
	NULL  --ruta_tabla_rel_dim
);
INSERT INTO apex_dimension_gatillo (proyecto, dimension, gatillo, tipo, orden, tabla_rel_dim, columnas_rel_dim, tabla_gatillo, ruta_tabla_rel_dim) VALUES (
	'kimelu', --proyecto
	'2000001', --dimension
	'2000002', --gatillo
	'directo', --tipo
	'2', --orden
	'facturacion', --tabla_rel_dim
	'id_ua', --columnas_rel_dim
	NULL, --tabla_gatillo
	NULL  --ruta_tabla_rel_dim
);
INSERT INTO apex_dimension_gatillo (proyecto, dimension, gatillo, tipo, orden, tabla_rel_dim, columnas_rel_dim, tabla_gatillo, ruta_tabla_rel_dim) VALUES (
	'kimelu', --proyecto
	'2000001', --dimension
	'2000003', --gatillo
	'directo', --tipo
	'3', --orden
	'institucion', --tabla_rel_dim
	'id_ua', --columnas_rel_dim
	NULL, --tabla_gatillo
	NULL  --ruta_tabla_rel_dim
);
INSERT INTO apex_dimension_gatillo (proyecto, dimension, gatillo, tipo, orden, tabla_rel_dim, columnas_rel_dim, tabla_gatillo, ruta_tabla_rel_dim) VALUES (
	'kimelu', --proyecto
	'2000001', --dimension
	'2000004', --gatillo
	'directo', --tipo
	'4', --orden
	'actividad', --tabla_rel_dim
	'id_ua', --columnas_rel_dim
	NULL, --tabla_gatillo
	NULL  --ruta_tabla_rel_dim
);
INSERT INTO apex_dimension_gatillo (proyecto, dimension, gatillo, tipo, orden, tabla_rel_dim, columnas_rel_dim, tabla_gatillo, ruta_tabla_rel_dim) VALUES (
	'kimelu', --proyecto
	'2000001', --dimension
	'2000005', --gatillo
	'directo', --tipo
	'5', --orden
	'estudiante', --tabla_rel_dim
	'id_ua', --columnas_rel_dim
	NULL, --tabla_gatillo
	NULL  --ruta_tabla_rel_dim
);
INSERT INTO apex_dimension_gatillo (proyecto, dimension, gatillo, tipo, orden, tabla_rel_dim, columnas_rel_dim, tabla_gatillo, ruta_tabla_rel_dim) VALUES (
	'kimelu', --proyecto
	'2000001', --dimension
	'2000006', --gatillo
	'directo', --tipo
	'6', --orden
	'carrera', --tabla_rel_dim
	'id_ua', --columnas_rel_dim
	NULL, --tabla_gatillo
	NULL  --ruta_tabla_rel_dim
);
--- FIN Grupo de desarrollo 2
