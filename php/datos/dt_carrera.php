<?php
class dt_carrera extends kimelu_datos_tabla
{
    
    function get_descripciones()
	{
		$sql = "select id_carrera, "
                        . "nombre,"
                        . "id_plan,"
                        . "iniciales_siu,"
                        . "ordenanza, "
                        . "id_ua "
                        . " FROM carrera ";
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	} 
    function get_descripciones_ua()
	{
		$sql = "select id_carrera, "
                        . "nombre,"
                        . "id_plan,"
                        . "iniciales_siu,"
                        . "ordenanza, "
                        . "id_ua "
                        . " FROM carrera "
                        . "ORDER BY nombre";
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

}
?>