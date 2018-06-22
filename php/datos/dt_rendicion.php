<?php
class dt_rendicion extends kimelu_datos_tabla
{
	function get_listado()
	{
		$sql = "SELECT
			t_r.nro_rendicion,
			t_r.fecha_rendicion,
			t_r.id_rendicion,
			t_r.observacion
		FROM
			rendicion as t_r
		ORDER BY observacion";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>