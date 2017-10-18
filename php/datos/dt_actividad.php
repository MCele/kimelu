<?php
class dt_actividad extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
	function get_listado($where = null)
	{
		if (is_null($where)) {  
                    $where = '';
                    
                } 
                else {   
                    $where = ' and ' . $where;
                }
		/*if (isset($filtro['tipo_actividad'])) {
			$where[] = "tipo_actividad = ".quote($filtro['tipo_actividad']);
		}*/
                
		$sql = "SELECT
			t_a.denominacion,
			t_a.participantes,
			t_a.fecha_inicio,
			t_a.fecha_fin,
			t_a.observacion,
			t_a.lugar,
			t_a.id_actividad,
			t_d.nombre as departamento_nombre,
			t_ta.tipo as tipo_actividad,
			t_i.nombre as institucion_nombre,
			t_a.nro_resolucion
		FROM
			actividad as t_a	
                        LEFT OUTER JOIN departamento as t_d 
                                       ON (t_a.departamento = t_d.id_departamento)
			LEFT OUTER JOIN tipo_actividad as t_ta 
                                       ON (t_a.tipo_actividad = t_ta.id_tipo_actividad)
			LEFT OUTER JOIN institucion as t_i 
                                       ON (t_a.institucion = t_i.id_institucion)
                        WHERE t_a.id_ua = '$this->u_a' $where
		ORDER BY denominacion";
//		if (count($where)>0) {
//			$sql = sql_concatenar_where($sql, $where);
//		}
                //$sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones()
	{
		$sql = "SELECT id_actividad, denominacion "
                        ." FROM actividad WHERE id_ua = '$this->u_a' "
                        ." ORDER BY denominacion";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_institucion()
	{
		$sql = "SELECT id_actividad, institucion FROM actividad "
                        ." WHERE id_ua = '$this->u_a' " 
                        . "ORDER BY denominacion";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_descripciones_tipo($tipo=null)
	{ //Datos de actividades para un determinado tipo: 1-->Pasantía, 2-->Curso, 3-->Capacitación, etc
            if (is_null($tipo)){ 
                $where = '';} 
            else {   
                $where = ' and tipo_actividad = ' . $tipo ." "; 
            
            }
		$sql = "SELECT id_actividad, denominacion FROM actividad "
                        . " WHERE id_ua = '$this->u_a' $where"
                        . "ORDER BY denominacion";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function get_descripciones_pasantia()
	{   //Datos de actividades para un determinado tipo: 1-->Pasantía
            $tipo =1;
            $sql = "SELECT id_actividad, denominacion FROM actividad "
                    ."Where tipo_actividad = " . $tipo ." "
                    ." and id_ua = '$this->u_a' "
                        . "ORDER BY denominacion";
            return toba::db('kimelu')->consultar($sql);
        }
        
}
?>