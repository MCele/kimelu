<?php
class dt_tipo_institucion extends kimelu_datos_tabla
{   
    //LISTO!!!
    //aparentemente no haría falta filtrar por Usuario ya que no contiene ningún atributo que lo restrinja
	function get_descripciones()
	{
		$sql = "SELECT id_tipo, descripcion "
                        . "FROM tipo_institucion "
                        . "ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}
}
?>