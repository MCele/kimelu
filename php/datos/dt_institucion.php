<?php
class dt_institucion extends kimelu_datos_tabla
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
			institucion as t_i    
                        LEFT OUTER JOIN tipo_institucion as t_ti 
                        ON (t_i.tipo = t_ti.id_tipo)
                        WHERE t_i.id_ua = '$this->u_a' $where
		ORDER BY nombre";
                //$sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}

       

	function get_descripciones()
	{
		$sql = "SELECT id_institucion, nombre FROM institucion ORDER BY nombre";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function obtener_actividades_de_institucion($id_institucion,$id_ua)
	{
		$sql = "SELECT t_a.institucion, t_a.id_actividad, t_i.nombre as nombre_institucion, t_a.denominacion"
                        . " FROM institucion as t_i inner join actividad as t_a on (t_i.id_institucion=t_a.institucion)"
                        . " Where t_i.id_institucion = $id_institucion and t_i.id_ua = '$id_ua' "
                        . " ORDER BY nombre_institucion";
		return toba::db('kimelu')->consultar($sql);
	}

}
?>