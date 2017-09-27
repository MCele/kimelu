<?php
class dt_pasantia extends kimelu_datos_tabla
{
	function get_listado()
	{
		$sql = "SELECT
			t_e.nombre as id_estudiante_nombre,
			t_p.disciplina,
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
			pasantia as t_p	LEFT OUTER JOIN estudiante as t_e ON (t_p.id_estudiante = t_e.id_estudiante)
			LEFT OUTER JOIN docente_guia as t_dg ON (t_p.docente = t_dg.id_docente)
			LEFT OUTER JOIN actividad as t_a ON (t_p.id_actividad = t_a.id_actividad)
			LEFT OUTER JOIN convenio as t_c ON (t_p.id_convenio = t_c.id_convenio)
		ORDER BY disciplina";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>