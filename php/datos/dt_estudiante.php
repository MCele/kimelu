<?php
class dt_estudiante extends kimelu_datos_tabla
{
	function get_listado($where = null)
	{
            if (is_null($where)) {  $where = '';} 
            else {   $where = ' where ' . $where; }
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
                $where 
		ORDER BY apellido";
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones()
	{
		$sql = "SELECT id_estudiante, apellido, cuil"
                        . " FROM estudiante ORDER BY apellido";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>