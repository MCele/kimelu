<?php
class dt_departamento extends kimelu_datos_tabla
{       //LISTO!!!
	
    function get_descripciones()
	{
		$sql = "SELECT id_departamento, nombre "
                        . " FROM departamento"
                        . " ORDER BY nombre";
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

}

?>