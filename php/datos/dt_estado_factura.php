<?php
class dt_estado_factura extends kimelu_datos_tabla
{
	function get_descripciones()
	{
		$sql = "SELECT id_estado, nro_estado, descripcion FROM "
                        . "estado_factura "
                        . "ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>