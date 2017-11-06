<?php
class dt_pasantia extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
	function get_listado($where=null)
	{
            if (is_null($where)) {  $where = '';} 
            else {   $where = ' and ' . $where; }
		$sql = "SELECT
			t_e.nombre as estudiante_nombre,
                        t_e.apellido as estudiante_apellido,
			t_ca.nombre as carrera,
			t_p.inicio_convenio,
			t_p.fin_convenio,
			t_p.horas_diarias,
			t_p.dias_semana,
			t_p.retribucion_mensual,
			t_dg.apellido||' '|| t_dg.nombre as docente_nombre,
			t_p.estado,
			t_p.id_pasantia,
			t_a.denominacion as id_actividad_nombre,
			t_c.descripcion as id_convenio_nombre
		FROM
			pasantia as t_p	LEFT OUTER JOIN estudiante as t_e ON (t_p.id_estudiante = t_e.id_estudiante)
			LEFT OUTER JOIN docente_guia as t_dg ON (t_p.docente = t_dg.id_docente)
			LEFT OUTER JOIN actividad as t_a ON (t_p.id_actividad = t_a.id_actividad)
			LEFT OUTER JOIN convenio as t_c ON (t_p.id_convenio = t_c.id_convenio)
                        LEFT OUTER JOIN carrera as t_ca ON (t_p.id_carrera = t_ca.id_carrera)
                        WHERE t_a.id_ua = '$this->u_a' $where 
		ORDER BY t_ca.nombre";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_listado_estado($where=null)
	{
            if (is_null($where)) {  $where = '';} 
            else {   $where = ' and ' . $where; }
		$sql = "SELECT
			t_e.nombre as estudiante_nombre,
                        t_e.apellido as estudiante_apellido,
			t_p.id_carrera,
			t_p.inicio_convenio,
			t_p.fin_convenio,
			t_p.horas_diarias,
			t_p.dias_semana,
			t_p.retribucion_mensual,
			t_dg.nombre as docente_nombre,
			t_p.estado,
			t_p.id_pasantia,
			t_a.denominacion as id_actividad_nombre,
			t_c.descripcion as id_convenio_nombre
		FROM
			pasantia as t_p	LEFT OUTER JOIN estudiante as t_e 
                        ON (t_p.id_estudiante = t_e.id_estudiante)
			LEFT OUTER JOIN docente_guia as t_dg ON (t_p.docente = t_dg.id_docente)
			LEFT OUTER JOIN actividad as t_a ON (t_p.id_actividad = t_a.id_actividad)
			LEFT OUTER JOIN convenio as t_c ON (t_p.id_convenio = t_c.id_convenio)
                        WHERE t_a.id_ua = '$this->u_a' $where 
		ORDER BY t_p.id_carrera";
                
		return toba::db('kimelu')->consultar($sql);
	}
        
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
        
        function get_listado_estudiante_vigente($id_estudiante=NULL)
	{   //obtiene todas las pasantias en las que esta un estudiante que esten vigentes
            //obtiene todas las pasantías de los estudiantes que están anotados en una determinada actividad del tipo pasantía vigente
            $where = " and t_p.estado = 0"; //0: estado vigente, 1: estado finalizado 
            if (!is_null($id_estudiante)) {  
                   $where = "$where and t_e.id_estudiante = $id_estudiante";
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
}       

?>