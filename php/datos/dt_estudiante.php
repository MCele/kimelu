<?php
class dt_estudiante extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
	function get_listado($where = null)
	{
            if (is_null($where)){  
                $where = '';
                
             } 
            else {   $where = ' and ' . $where; }
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
                WHERE t_e.id_ua = '$this->u_a' $where 
		ORDER BY apellido";
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones_apellido_nombre($id_est=NULL)
	{ //datos de un estudiante con apellido y nombre en un sólo string
            if (is_null($id_est)) { 
                $where = '';
            } 
            else {  
                $where = ' and id_estudiante = ' . $id_est; 
                
            }
		$sql = "SELECT id_estudiante, apellido||' '|| nombre as apellido_nombre, cuil"
                        . " FROM estudiante "
                        . " WHERE id_ua = '$this->u_a'". $where 
                        . " ORDER BY (apellido,nombre)";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_listado_apellido_nombre($where=NULL)
	{
            if (is_null($where)) {  
                $where = '';
                
            } 
            else {   
                $where = ' and ' . $where; 
                
            }
            $sql = "SELECT id_estudiante, apellido||' '|| nombre as apellido_nombre, cuil"
                . " FROM estudiante "
                . " WHERE id_ua = '$this->u_a'". $where 
                . " ORDER BY (apellido,nombre)";
                
            return toba::db('kimelu')->consultar($sql);
	}
        
        function get_descripciones_cuil($id=NULL)
	{
            if (is_null($id)) { 
                $where = '';
            } 
            else {  
                $where = ' and id_estudiante = ' . $id; 
                
            }
		$sql = "SELECT id_estudiante, cuil"
                        . " FROM estudiante "
                        . " WHERE t_e.id_ua = '$this->u_a'". $where ;
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_alumno_cuil($cuil=NULL,$id_estudiante=NULL)
	{
            if (is_null($cuil)) { 
                $where = '';
            } 
            else {  
                $where = " and cuil = '$cuil' "; 
                
            }
            if (!is_null($id_estudiante)) { 
                $where = "$where and id_estudiante = $id_estudiante "; 
            } 
		$sql = "SELECT id_estudiante, cuil, dni"
                        . " FROM estudiante "
                        . " WHERE id_ua = '$this->u_a'". $where ;
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_alumno_dni($dni=NULL,$id_estudiante=NULL)
	{
            if (is_null($dni)) { 
                $where = '';
            } 
            else {  
                $where = " and dni =  '$dni' "; 
                
            }
             if (!is_null($id_estudiante)) { 
                $where = "$where and id_estudiante = $id_estudiante "; 
            }
		$sql = "SELECT id_estudiante, cuil,dni "
                        . " FROM estudiante "
                        . " WHERE id_ua = '$this->u_a'". $where ;
		return toba::db('kimelu')->consultar($sql);
	}

}
?>