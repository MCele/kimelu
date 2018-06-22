
------------------------------------------------------------
-- apex_usuario_grupo_acc
------------------------------------------------------------
INSERT INTO apex_usuario_grupo_acc (proyecto, usuario_grupo_acc, nombre, nivel_acceso, descripcion, vencimiento, dias, hora_entrada, hora_salida, listar, permite_edicion, menu_usuario) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	'Administrador', --nombre
	'0', --nivel_acceso
	'Accede a toda la funcionalidad', --descripcion
	NULL, --vencimiento
	NULL, --dias
	NULL, --hora_entrada
	NULL, --hora_salida
	NULL, --listar
	'1', --permite_edicion
	NULL  --menu_usuario
);

------------------------------------------------------------
-- apex_usuario_grupo_acc_item
------------------------------------------------------------

--- INICIO Grupo de desarrollo 0
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2'  --item
);
--- FIN Grupo de desarrollo 0

--- INICIO Grupo de desarrollo 2
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000016'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000017'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000019'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000020'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000022'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000023'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000024'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000028'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000029'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000032'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000033'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000034'  --item
);
INSERT INTO apex_usuario_grupo_acc_item (proyecto, usuario_grupo_acc, item_id, item) VALUES (
	'kimelu', --proyecto
	'admin', --usuario_grupo_acc
	NULL, --item_id
	'2000036'  --item
);
--- FIN Grupo de desarrollo 2
