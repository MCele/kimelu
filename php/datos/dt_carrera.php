<?php
class dt_carrera extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
    function get_descripciones()
	{
		$sql = "select id_carrera, "
                        . "nombre,"
                        . "id_plan,"
                        . "iniciales_siu,"
                        . "ordenanza, "
                        . "id_ua "
                        . " FROM carrera ";
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
                        . " WHERE id_ua = '$this->u_a'";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>