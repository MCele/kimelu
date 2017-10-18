<?php
class dt_docente_guia extends kimelu_datos_tabla
{   
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
    
	function get_descripciones_ua()
	{
		$sql = "SELECT distinct dg.id_docente, apellido||' '|| nombre as apellido_nombre, cuil, des.id_ua "
                        . "FROM docente_guia as dg "
                        . "inner join designacion as des on (des.id_docente = dg.id_docente) "
                        . "WHERE des.id_ua = '$this->u_a' "
                        . "ORDER BY apellido_nombre";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>