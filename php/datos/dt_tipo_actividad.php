<?php
class dt_tipo_actividad extends kimelu_datos_tabla
{

	function get_descripciones()
	{
		$sql = "SELECT id_tipo_actividad, tipo "
                        . "FROM tipo_actividad "
                        . "ORDER BY id_tipo_actividad";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>