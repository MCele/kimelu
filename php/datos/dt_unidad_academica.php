<?php
class dt_unidad_academica extends kimelu_datos_tabla
{
    //falta VERRR!!!!!!
	function get_descripciones()
	{
		$sql = "SELECT sigla, nombre FROM unidad_academica ORDER BY nombre";
                $sql=toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

}

?>