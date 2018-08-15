------------------------------------------------------------
--[2000070]--  DT - estudiante 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 2
INSERT INTO apex_objeto (proyecto, objeto, anterior, identificador, reflexivo, clase_proyecto, clase, punto_montaje, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion, posicion_botonera) VALUES (
	'kimelu', --proyecto
	'2000070', --objeto
	NULL, --anterior
	NULL, --identificador
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	'2000003', --punto_montaje
	'dt_estudiante', --subclase
	'datos/dt_estudiante.php', --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'DT - estudiante', --nombre
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
	'2017-09-10 20:37:38', --creacion
	NULL  --posicion_botonera
);
--- FIN Grupo de desarrollo 2

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, punto_montaje, ap, ap_clase, ap_archivo, tabla, tabla_ext, alias, modificar_claves, fuente_datos_proyecto, fuente_datos, permite_actualizacion_automatica, esquema, esquema_ext) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'2000003', --punto_montaje
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'estudiante', --tabla
	NULL, --tabla_ext
	NULL, --alias
	'0', --modificar_claves
	'kimelu', --fuente_datos_proyecto
	'kimelu', --fuente_datos
	'1', --permite_actualizacion_automatica
	NULL, --esquema
	'public'  --esquema_ext
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 2
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000075', --col_id
	'id_estudiante', --columna
	'E', --tipo
	'1', --pk
	'datos_pasante_id_pasante_seq', --secuencia
	NULL, --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000076', --col_id
	'email', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'50', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000077', --col_id
	'telefono', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'20', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000078', --col_id
	'dni', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'10', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000079', --col_id
	'cuil', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'12', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000080', --col_id
	'nombre', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'40', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000081', --col_id
	'apellido', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'30', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000082', --col_id
	'legajo', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'15', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000083', --col_id
	'domicilio', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'50', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000168', --col_id
	'ciudad', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'30', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa, tabla) VALUES (
	'kimelu', --objeto_proyecto
	'2000070', --objeto
	'2000205', --col_id
	'id_ua', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'5', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0', --externa
	'estudiante'  --tabla
);
--- FIN Grupo de desarrollo 2
