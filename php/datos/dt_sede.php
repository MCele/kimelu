<?php
class dt_sede extends kimelu_datos_tabla
{
    // Ver pero no se usa y aparentemente no haría falta filtrar por Usuario 
    // (eso va a depender del uso que se llegara a dar)
	function get_descripciones()
	{
		$sql = "SELECT id_sede, id_ua FROM sede "
                        . " ORDER BY id_ua";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>