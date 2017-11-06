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
			t_e.domicilio,
                        t_e.ciudad
		FROM
			estudiante as t_e
                WHERE t_e.id_ua = '$this->u_a' $where 
		ORDER BY (apellido, nombre)";
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones_apellido_nombre($id_est=NULL)
	{ //datos de un estudiante con apellido y nombre en un sólo string
            if (is_null($id_est)) { 
                $where = '';
            } 
            else {  
                $where = " and id_estudiante = $id_est"; 
                
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
            $sql = "SELECT e.id_estudiante, e.apellido||' '|| e.nombre as apellido_nombre, e.cuil"
                . " FROM estudiante as e "
                . " WHERE e.id_ua = '$this->u_a' ". $where 
                . " ORDER BY (apellido_nombre)";
            /*
            $sql = "SELECT e.id_estudiante, e.apellido||' '|| e.nombre as apellido_nombre, e.cuil, c.id_carrera as carrera"
                . " FROM estudiante as e inner join cursa as c on (e.id_estudiante = c.id_estudiante)"
                . " WHERE e.id_ua = '$this->u_a' ". $where 
                . " ORDER BY (apellido_nombre)";
              */  
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
        //insertamos nueva carrera del alumno
        function agregar_carrera($id_alumno,$id_carrera){
            $sql = "insert into cursa "
                    . " (id_estudiante,id_carrera) "
                    . "values ($id_alumno,$id_carrera)";
            return toba::db('kimelu')->consultar($sql);
        }
        function borrar_carrera($id_alumno,$id_carrera=NULL){
            $where="";//se borran todas las asociaciones a carreras que tenga el alumno
            if (!is_null($id_carrera)){//se borra sólo la asociación a la carrera especificada
                $where= " and id_carrera = " . $id_carrera;
            }
            $sql = "delete from cursa "
                    . " where id_estudiante=$id_alumno "
                    . " $where";
            return toba::db('kimelu')->consultar($sql);
        }
         
        
        // obtener carreras de un alumno
        function get_carreras($id_est)
	{
            $sql = "SELECT
			t_e.id_estudiante,
			cu.id_carrera
		FROM
			estudiante as t_e
                        inner join cursa as cu 
                        on (cu.id_estudiante=t_e.id_estudiante)
                 WHERE t_e.id_ua = '$this->u_a' and $id_est=t_e.id_estudiante ";
		return toba::db('kimelu')->consultar($sql);
	}
        //método que está en pasantías, pero sólo está asociado estudiante al ci_estudante
        function get_listado_actividad_estudiante($id_actividad=NULL,$id_estudiante=NULL)
	{   //obtiene todas las pasantías en las que está un estudiante ($id_estudiante!=NULL) para una determinada actividad(tipo pasantía $id_actividad!=NULL) o no
            //obtiene todas las pasantías de los estudiantes que están anotados en una determinada actividad del tipo pasantía
            $where = "";
            if (!is_null($id_actividad)) {  
                $where = " and t_a.id_actividad = $id_actividad";
            } 
            if (!is_null($id_estudiante)) {  
                if (strlen($where)===0){
                  $where = " and t_e.id_estudiante = $id_estudiante";
                }
                else{
                    $where = "$where and t_e.id_estudiante = $id_estudiante";
                }
            }            
		$sql = "SELECT
                        t_p.id_pasantia,
                        t_p.id_estudiante,
                        t_p.estado,
			t_e.nombre as estudiante_nombre,
                        t_e.apellido as estudiante_apellido,
			t_p.id_carrera,
			t_p.inicio_convenio,
			t_p.fin_convenio,
			t_a.denominacion as id_actividad_nombre
		FROM
			pasantia as t_p	LEFT OUTER JOIN estudiante as t_e 
                                ON (t_p.id_estudiante = t_e.id_estudiante)
			LEFT OUTER JOIN actividad as t_a 
                            ON (t_p.id_actividad = t_a.id_actividad)
                       WHERE t_a.id_ua = '$this->u_a' $where";
		return toba::db('kimelu')->consultar($sql);
	}
}
?>