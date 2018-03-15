<?php
class dt_sede extends kimelu_datos_tabla
{
    //falta VERRRR!!!!
	function get_descripciones()
	{
		$sql = "SELECT id_sede, id_ua FROM sede ORDER BY id_ua";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>