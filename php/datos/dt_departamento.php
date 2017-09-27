<?php
class dt_departamento extends kimelu_datos_tabla
{
	function get_descripciones()
	{
		$sql = "SELECT id_departamento, nombre FROM departamento ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>