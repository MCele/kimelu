<?php
class dt_estado_factura extends kimelu_datos_tabla
{
    
    //LISTO!!!
    // No es necesario el filtro ya que solo se usa estado_factura 
    // que no esta vinculada a un tipo de usuario específico
	function get_descripciones()
	{
		$sql = "SELECT id_estado, nro_estado, descripcion FROM "
                        . "estado_factura "
                        . "ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>