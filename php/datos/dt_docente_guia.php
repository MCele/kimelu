<?php
class dt_docente_guia extends kimelu_datos_tabla
{
	function get_descripciones()
	{
		$sql = "SELECT id_docente, nombre FROM docente_guia ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>