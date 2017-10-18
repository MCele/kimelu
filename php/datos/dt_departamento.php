<?php
class dt_departamento extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
	function get_descripciones()
	{
		$sql = "SELECT id_departamento, nombre "
                        . " FROM departamento"
                        . " WHERE id_ua = '$this->u_a' "
                        . " ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>