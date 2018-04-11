<?php
class dt_docente_guia extends kimelu_datos_tabla
{   
    //protected $u_a='FAEA'; //LISTO!!!
    
    
	function get_descripciones_ua()
	{
		$sql = "SELECT distinct dg.id_docente, apellido||' '|| nombre as apellido_nombre, cuil, des.id_ua "
                        . "FROM docente_guia as dg "
                        . "inner join designacion as des on (des.id_docente = dg.id_docente) "
                        . "ORDER BY apellido_nombre";
                 $sql = toba::perfil_de_datos()->filtrar($sql);             
		return toba::db('kimelu')->consultar($sql);
	}

}

?>