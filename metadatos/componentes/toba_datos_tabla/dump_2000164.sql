------------------------------------------------------------
--[2000164]--  DT - estado_factura 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 2
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'kimelu', --proyecto
	'2000164', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	'2000003', --punto_montaje
	'dt_estado_factura', --subclase
	'datos/dt_estado_factura.php', --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'DT - estado_factura', --nombre
	NULL, --titulo
	NULL, --colapsable
	NULL, --descripcion
	'kimelu', --fuente_datos_proyecto
	'kimelu', --fuente_datos
	NULL, --solicitud_registrar
	NULL, --solicitud_obj_obs_tipo
	NULL, --solicitud_obj_observacion
	NULL, --parametro_a
	NULL, --parametro_b
	NULL, --parametro_c
	NULL, --parametro_d
	NULL, --parametro_e
	NULL, --parametro_f
	NULL, --usuario
	'2018-02-26 17:45:03', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 2

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'kimelu', --objeto_proyecto
	'2000164', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'2000003', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'estado_factura', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'kimelu', --fuente_datos_proyecto
	'kimelu', --fuente_datos
	'1', --permite_actualizacion_automatica
	'public', --esquema
	'public'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 2
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000164', --objeto
	'2000192', --col_id
	'id_estado', --columna
	'E', --tipo
	'1', --pk
	'estado_factura_id_estado_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'estado_factura'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000164', --objeto
	'2000193', --col_id
	'nro_estado', --columna
	'E', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'estado_factura'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000164', --objeto
	'2000194', --col_id
	'descripcion', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estado_factura'  --tabla
);
--- FIN Grupo de desarrollo 2