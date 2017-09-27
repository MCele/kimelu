<?php
class dt_actividad extends kimelu_datos_tabla
{
	function get_listado($filtro=array())
	{
		$where = array();
		if (isset($filtro['tipo_actividad'])) {
			$where[] = "tipo_actividad = ".quote($filtro['tipo_actividad']);
		}
		$sql = "SELECT
			t_a.denominacion,
			t_a.participantes,
			t_a.fecha_inicio,
			t_a.fecha_fin,
			t_a.observacion,
			t_a.lugar,
			t_a.id_actividad,
			t_d.nombre as departamento_nombre,
			t_ta.tipo as tipo_actividad_nombre,
			t_i.nombre as institucion_nombre,
			t_a.nombre_corto,
			t_a.nro_resolucion
		FROM
			actividad as t_a	
                        LEFT OUTER JOIN departamento as t_d 
                                       ON (t_a.departamento = t_d.id_departamento)
			LEFT OUTER JOIN tipo_actividad as t_ta 
                                       ON (t_a.tipo_actividad = t_ta.id_tipo_actividad)
			LEFT OUTER JOIN institucion as t_i 
                                       ON (t_a.institucion = t_i.id_institucion)
		ORDER BY denominacion";
		if (count($where)>0) {
			$sql = sql_concatenar_where($sql, $where);
		}
		return toba::db('kimelu')->consultar($sql);
	}

	function get_descripciones()
	{
		$sql = "SELECT id_actividad, denominacion FROM actividad ORDER BY denominacion";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>