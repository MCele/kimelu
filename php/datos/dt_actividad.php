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
                        LEFT OUTER JOIN dpto_actividad as t_da
					ON (t_da.id_actividad = t_a.id_actividad)
                        LEFT OUTER JOIN departamento as t_d 
                                       ON (t_da.id_departamento = t_d.id_departamento)
			LEFT OUTER JOIN tipo_actividad as t_ta 
                                       ON (t_a.tipo_actividad = t_ta.id_tipo_actividad)
			LEFT OUTER JOIN institucion as t_i 
                                       ON (t_a.institucion = t_i.id_institucion)
                        WHERE t_a.id_ua = '$this->u_a' $where  
		ORDER BY id_actividad"; //no cambiar oden porque se usa para el arreglo siguiente
//		if (count($where)>0) {
//			$sql = sql_concatenar_where($sql, $where);
//		}
                //$sql = toba::perfil_de_datos()->filtrar($sql);
		$consulta= toba::db('kimelu')->consultar($sql);
                //print_r($consulta);
                $in = 0;       //recorre actividades
                $nueva_consulta = array();
                if (isset($consulta)){
                //vamos a recorrer el arreglo del resultado de la consulta para conatenar lo departamentos de 
                //las actividades que tengan más de un departamento asociado
                //es importante que el arreglo de consultas esté ordenado por id_actividad
                    array_push($nueva_consulta, $consulta[0]);//agrego la primer actividad al cuadro
                    $cant = sizeof($consulta);
                    for ($i=1;$i<$cant;$i++) {//recorro todas las actividades (menos la primera, ya agregada)
                        if($consulta[$i]['id_actividad']==$nueva_consulta[$in]['id_actividad']){
                            //si la actividad ya fue agregada, entonces concateno los departamentos
                            $dpto1= $nueva_consulta[$in]['departamento_nombre'];
                            $dpto2 = $consulta[$i]['departamento_nombre'];
                            $nueva_consulta[$in]['departamento_nombre'] = "$dpto1 - $dpto2";
                        }
                        else {
                            //si la actividad no fue agregada, la agreo pr primera vez
                            array_push($nueva_consulta,$consulta[$i]);
                            $in++;
                        }
                    }
                    return $nueva_consulta;
                }
                
                return $consulta;
	}

	function get_descripciones()
	{
		$sql = "SELECT id_actividad, denominacion FROM actividad ORDER BY denominacion";
		return toba::db('kimelu')->consultar($sql);
	}

        function get_descripciones_actividad($id_actividad)
	{ //Datos de una determinada actividad
            $where = ' and id_actividad = ' . $id_actividad ." "; 
		$sql = "SELECT id_actividad, denominacion FROM actividad "
                        . " WHERE id_ua = '$this->u_a' $where"
                        . "ORDER BY denominacion";
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
        function get_descripciones_pasantias_asociadas($id_actividad=NULL)
	{   //Datos de actividades para un determinado tipo: 1-->Pasantía
            if (is_null($id_actividad)){ 
                $where = '';} 
            else {   
                $where = ' and a.id_actividad = ' . $id_actividad ." "; 
            
            }
            $tipo =1;
            $sql = "SELECT p.id_pasantia, a.id_actividad, a.denominacion FROM actividad as a "
                    . " inner join pasantia as p on (p.id_actividad = a.id_actividad) "
                    ." Where tipo_actividad = " . $tipo ." "
                    ." and id_ua = '$this->u_a' $where"
                        . " ORDER BY denominacion";
            return toba::db('kimelu')->consultar($sql);
        }
        
        function get_descripciones_facturas_asociadas($id_actividad)
	{   //Datos de facturas asociadas a una actividad
            
            if (is_null($id_actividad)){ 
                return Array();
            } 
            else {   
            
                $tipo =1;
                $sql = "SELECT f.id_factura, f.id_actividad, f.nro_factura FROM actividad as a
                    inner join facturacion as f on (f.id_actividad = a.id_actividad)
                    Where f.id_ua = '$this->u_a' and a.id_actividad = $id_actividad"
                    . " ORDER BY f.nro_factura";
            }
            return toba::db('kimelu')->consultar($sql);
        }
        
        
        function agregar_actividad_departamento($id_actividad,$id_dpto){
            $sql = "insert into dpto_actividad "
                    . " (id_actividad,id_departamento) "
                    . "values ($id_actividad,$id_dpto)";
            return toba::db('kimelu')->consultar($sql);
        }
        
        function borrar_actividad_departamento($id_actividad,$id_dpto=NULL){
          //se borran una o todas las asociación/es a departamento que tenga una actividad
            $where="";
            if (!is_null($id_dpto)){//se borra sólo la asociación al departamento especificado
                $where= " and id_departamento = " . $id_dpto;
            }
            $sql = "delete from dpto_actividad "
                    . " where id_actividad=$id_actividad "
                    . " $where";
            return toba::db('kimelu')->consultar($sql);
        }
        
        //méodo que obtiene todos los departamentos asociados a una actividad(si los hay)
        function obtener_departamentos($id_actividad){
        $sql = "SELECT
			t_da.id_actividad,
			t_da.id_departamento
		FROM
			actividad as t_a
                        inner join dpto_actividad as t_da
                        on (t_da.id_actividad=t_a.id_actividad)
                 WHERE t_a.id_ua = '$this->u_a' and t_a.id_actividad=$id_actividad";
            return toba::db('kimelu')->consultar($sql);
         
        }
}
?>