<?php
class dt_institucion extends kimelu_datos_tabla
{
	function get_listado()
	{
		$sql = "SELECT
			t_i.cuil_cuit,
			t_i.id_institucion,
			t_ti.descripcion as tipo_nombre,
			t_i.nombre,
			t_i.direccion,
			t_i.observacion,
                        t_i.telefono,
                        t_i.email
		FROM
			institucion as t_i    LEFT OUTER JOIN tipo_institucion as t_ti ON (t_i.tipo = t_ti.id_tipo)
		ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}





	function ini()
	{
	}

	function get_descripciones()
	{
		$sql = "SELECT id_institucion, nombre FROM institucion ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>