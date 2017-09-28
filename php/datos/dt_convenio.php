<?php
class dt_convenio extends kimelu_datos_tabla
{
	function get_descripciones()
	{
		$sql = "SELECT id_convenio, sigla, descripcion "
                        . "FROM convenio ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>