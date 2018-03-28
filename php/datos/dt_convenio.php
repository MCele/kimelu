<?php
class dt_convenio extends kimelu_datos_tabla
{
    //protected $u_a='FAEA'; //ver!!!
    
	function get_descripciones()
	{
		$sql = "SELECT id_convenio, sigla, descripcion "
                        . "FROM convenio ORDER BY descripcion";
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

	function get_listado($where = null)
	{
            if (is_null($where)){  
                $where = '';
                
             } 
            else {
                $where = ' WHERE ' . $where; 
                
            }
		$sql = "SELECT
			t_c.id_convenio,
			t_c.sigla,
			t_c.descripcion
		FROM
			convenio as t_c 
                $where 
		ORDER BY descripcion  ";
                
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

}
?>