<?php
class dt_tipo_institucion extends kimelu_datos_tabla
{
	function get_descripciones()
	{
		$sql = "SELECT id_tipo, descripcion FROM tipo_institucion ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}





	function ini()
	{
	}
        function get_datos_tipo()
	{
		$sql = "SELECT id_tipo, descripcion "
                        . "FROM tipo_institucion "
                        . "ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}
}
?>