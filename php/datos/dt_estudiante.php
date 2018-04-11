<?php
class dt_estudiante extends kimelu_datos_tabla
{
    //protected $u_a='FAEA'; //LISTO!!!
    
	function get_listado($where = null)
	{
            if (is_null($where)){  
                $where = '';
                
             } 
            else {   $where = ' WHERE ' . $where; }
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
                        inner join estudiante_ua as t_eua 
                        on (t_e.id_estudiante=t_eua.id_estudiante)
                $where 
		ORDER BY (apellido, nombre)";
               
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones_apellido_nombre($id_est=NULL)
	{ //datos de un estudiante con apellido y nombre en un sólo string
            if (is_null($id_est)) { 
                $where = '';
            } 
            else {  
                $where = " WHERE id_estudiante = $id_est"; 
                
            }
		$sql = "SELECT t_e.id_estudiante, t_e.apellido||' '|| t_e.nombre as apellido_nombre, cuil"
                        . " FROM estudiante as t_e
                        inner join estudiante_ua as t_eua 
                        on (t_e.id_estudiante=t_eua.id_estudiante)"
                        . $where 
                        . " ORDER BY (apellido,nombre)";
                print_r($sql);
                $sql = toba::perfil_de_datos()->filtrar($sql);
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
            $sql = "SELECT t_e.id_estudiante, t_e.apellido||' '|| t_e.nombre as apellido_nombre, t_e.cuil"
                . " FROM estudiante as t_e
                    inner join estudiante_ua as t_eua 
                    on (t_e.id_estudiante = t_eua.id_estudiante)"
                . " ORDER BY (apellido_nombre)";
            $sql = toba::perfil_de_datos()->filtrar($sql);
            return toba::db('kimelu')->consultar($sql);
	}
        
        function get_descripciones_cuil($id=NULL)
	{
            if (is_null($id)) { 
                $where = '';
            } 
            else {  
                $where = ' WHERE id_estudiante = ' . $id; 
                
            }
		$sql = "SELECT id_estudiante, cuil"
                        . " FROM estudiante "
                        . $where ;
            $sql = toba::perfil_de_datos()->filtrar($sql);
            return toba::db('kimelu')->consultar($sql);
	}
        
        function get_alumno_cuil($cuil=NULL,$id_estudiante=NULL)
	{
            $where = '';
            if (is_null($cuil)) { 
                if (!is_null($id_estudiante)) { 
                    $where = "WHERE id_estudiante = $id_estudiante "; 
                } 
            } 
            else {  
                $where = " WHERE cuil = '$cuil' ";
                if (!is_null($id_estudiante)) { 
                    $where = "$where and id_estudiante = $id_estudiante "; 
                } 
                
            } 
            $sql = "SELECT id_estudiante, cuil, dni"
                    . " FROM estudiante "
                    . $where ;
                
            $sql = toba::perfil_de_datos()->filtrar($sql);
            return toba::db('kimelu')->consultar($sql);
	}
        
        function get_alumno_dni($dni=NULL,$id_estudiante=NULL)
	{
            $where = '';
            if (is_null($dni)){
                if (!is_null($id_estudiante)) { 
                    $where = " WHERE id_estudiante = $id_estudiante "; 
                }      
            } 
            else {
                $where = " WHERE dni =  '$dni' "; 
                if (!is_null($id_estudiante)) { 
                    $where = " and  id_estudiante = $id_estudiante "; 
                }
                
            }
            $sql = "SELECT id_estudiante, cuil,dni "
                    . " FROM estudiante "
                    . $where ;
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}
        
        //insertamos nueva carrera del alumno: se agrega carrera para un alumno existente en la BD
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
                 WHERE $id_est=t_e.id_estudiante ";
            $sql = toba::perfil_de_datos()->filtrar($sql);
            $datos =  toba::db('kimelu')->consultar($sql);
            return ($datos);
            
	}
        
        //método que está en pasantías, pero sólo está asociado estudiante al ci_estudante
        function get_listado_actividad_estudiante($id_actividad=NULL,$id_estudiante=NULL)
	{   // obtiene todas las pasantías en las que está un estudiante 
            // ($id_estudiante!=NULL) para una determinada actividad (tipo pasantía $id_actividad!=NULL) o no
            // obtiene todas las pasantías de los estudiantes que están anotados en una determinada actividad del tipo pasantía
            $where = "";
            if (!is_null($id_actividad)) {  
                $where = " WHERE t_a.id_actividad = $id_actividad";
            }                 
            if (!is_null($id_estudiante)) { 
                if (strlen($where)===0){
                  $where = " Where t_e.id_estudiante = $id_estudiante";
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
                        $where";
            $sql = toba::perfil_de_datos()->filtrar($sql);
            return toba::db('kimelu')->consultar($sql);
	}
        
        function get_ua(){
            $sql = "SELECT sigla, nombre FROM unidad_academica ORDER BY nombre";
            $sql=toba::perfil_de_datos()->filtrar($sql);
            return toba::db('kimelu')->consultar($sql);
        }
        function agregar_ua($id_estudiante = null,$ua = null) 
        { //se ejecuta un insert para estudiante_UA
            if (!is_null($id_estudiante)&&(!is_null($ua)))
            {
                $sql = "insert into estudiante_ua "
                        . " (id_estudiante,id_ua) "
                        . "values ($id_estudiante,'$ua')";
                return toba::db('kimelu')->consultar($sql);
            }
            return null;
        }
        
        function get_estudiante_ua($id_estudiante){
            //obtiene las unidades académicas asociadas al estudiante
            //NO se filtra usuario en este caso!!!
            if (!is_null($id_estudiante)){
                $sql = "SELECT e_ua.id_estudiante, e_ua.id_ua, t_ua.nombre "
                        . "FROM estudiante_ua as e_ua "
                        . " inner join unidad_academica as t_ua "
                        . " on(t_ua.sigla = e_ua.id_ua)"
                        .   " where e_ua.id_estudiante = $id_estudiante";
                return toba::db('kimelu')->consultar($sql);
            }
            return null;
        }
        
        function borrar_ua($id_alumno,$ua=null){
            $where="";//se borran todas las asociaciones a las unidades académicas que tenga el alumno en la tabla estudiante_ua
            if (!is_null($ua)){ //se borra sólo la asociación a la unidad académica especificada
                $where= " and id_ua = " . "'$ua'";
            }
            $sql = "delete from estudiante_ua "
                    . " where id_estudiante=$id_alumno "
                    . " $where";
            return toba::db('kimelu')->consultar($sql);
        }
}
?>