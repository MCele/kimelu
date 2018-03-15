<?php
class dt_tipo_institucion extends kimelu_datos_tabla
{
    //falta VERR!!!
	function get_descripciones()
	{
		$sql = "SELECT id_tipo, descripcion "
                        . "FROM tipo_institucion "
                        . "ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}
//se repiten los dos métodos
       /* function get_datos_tipo()
	{
		$sql = "SELECT id_tipo, descripcion "
                        . "FROM tipo_institucion "
                        . "ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}
        * 
        */
}
?>