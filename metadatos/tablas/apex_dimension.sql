
------------------------------------------------------------
-- apex_dimension
------------------------------------------------------------

--- INICIO Grupo de desarrollo 2
INSERT INTO apex_dimension (proyecto, dimension, nombre, descripcion, schema, tabla, col_id, col_desc, col_desc_separador, multitabla_col_tabla, multitabla_id_tabla, fuente_datos_proyecto, fuente_datos) VALUES (
	'kimelu', --proyecto
	'2000001', --dimension
	'u_a', --nombre
	'Unidad Académica', --descripcion
	NULL, --schema
	'unidad_academica', --tabla
	'sigla', --col_id
	'nombre', --col_desc
	NULL, --col_desc_separador
	NULL, --multitabla_col_tabla
	NULL, --multitabla_id_tabla
	'kimelu', --fuente_datos_proyecto
	'kimelu'  --fuente_datos
);
INSERT INTO apex_dimension (proyecto, dimension, nombre, descripcion, schema, tabla, col_id, col_desc, col_desc_separador, multitabla_col_tabla, multitabla_id_tabla, fuente_datos_proyecto, fuente_datos) VALUES (
	'kimelu', --proyecto
	'2000002', --dimension
	'p_v', --nombre
	'Punto de Venta', --descripcion
	NULL, --schema
	'punto_venta', --tabla
	'id_punto_venta', --col_id
	'nro_punto_venta, descripcion', --col_desc
	NULL, --col_desc_separador
	NULL, --multitabla_col_tabla
	NULL, --multitabla_id_tabla
	'kimelu', --fuente_datos_proyecto
	'kimelu'  --fuente_datos
);
--- FIN Grupo de desarrollo 2
