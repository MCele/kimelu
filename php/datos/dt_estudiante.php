<?php
class dt_estudiante extends kimelu_datos_tabla
{
	function get_listado()
	{
		$sql = "SELECT
			t_e.id_estudiante,
			t_e.email,
			t_e.telefono,
			t_e.dni,
			t_e.cuil,
			t_e.nombre,
			t_e.apellido,
			t_e.legajo,
			t_e.domicilio
		FROM
			estudiante as t_e
		ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones()
	{
		$sql = "SELECT id_estudiante, nombre FROM estudiante ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>