<?php
class dt_estudiante extends kimelu_datos_tabla
{
	function get_listado($where = null)
	{
            if (is_null($where)) {  $where = '';} 
            else {   $where = ' where ' . $where; }
		$sql = "SELECT
			t_e.id_estudiante,
			t_e.email,
			t_e.telefono,
			t_e.dni,
			t_e.cuil,
			t_e.nombre,
			t_e.apellido,
			t_e.legajo,
			t_e.domicilio
		FROM
			estudiante as t_e
                $where 
		ORDER BY apellido";
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones_apellido_nombre($id_est=NULL)
	{ //datos de un estudiante con apellido y nombre en un sólo string
            if (is_null($id_est)) { 
                $where = '';
            } 
            else {  
                $where = ' Where id_estudiante = ' . $id_est; 
                
            }
		$sql = "SELECT id_estudiante, apellido||' '|| nombre as apellido_nombre, cuil"
                        . " FROM estudiante "
                        . $where
                        . " ORDER BY (apellido,nombre)";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_listado_apellido_nombre($where=NULL)
	{
            if (is_null($where)) {  
                $where = '';
                
            } 
            else {   
                $where = ' where ' . $where; 
                
            }
            $sql = "SELECT id_estudiante, apellido||' '|| nombre as apellido_nombre, cuil"
                . " FROM estudiante "
                .   $where
                . " ORDER BY (apellido,nombre)";
                
            return toba::db('kimelu')->consultar($sql);
	}
        
        function get_descripciones_cuil($id=NULL)
	{
            if (is_null($id)) { 
                $where = '';
            } 
            else {  
                $where = ' Where id_estudiante = ' . $id; 
                
            }
		$sql = "SELECT id_estudiante, cuil"
                        . " FROM estudiante "
                        . $where;
		return toba::db('kimelu')->consultar($sql);
	}


}
?>