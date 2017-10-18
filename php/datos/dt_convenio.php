<?php
class dt_convenio extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
	function get_descripciones()
	{
		$sql = "SELECT id_convenio, sigla, descripcion "
                        . "FROM convenio ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}

	function get_listado()
	{
		$sql = "SELECT
			t_c.id_convenio,
			t_c.sigla,
			t_c.descripcion
		FROM
			convenio as t_c
		ORDER BY descripcion";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>