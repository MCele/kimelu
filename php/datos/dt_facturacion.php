<?php
class dt_facturacion extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
    
	function get_listado($where = null)
	{
            if (is_null($where)){  
                $where = '';
                
             } 
            else {   $where = ' and ' . $where; }
		$sql = "SELECT
			t_f.nro_factura,
			t_f.fecha,
			t_f.concepto,
			t_f.monto,
			t_f.id_factura,
			t_i.nombre as id_institucion_nombre,
			t_a.denominacion as id_actividad_nombre
		FROM
			facturacion as t_f	LEFT OUTER JOIN institucion as t_i ON (t_f.id_institucion = t_i.id_institucion)
			LEFT OUTER JOIN actividad as t_a ON (t_f.id_actividad = t_a.id_actividad)
			LEFT OUTER JOIN sede as t_s ON (t_f.id_sede = t_s.id_sede)
			LEFT OUTER JOIN unidad_academica as t_ua ON (t_f.id_ua = t_ua.sigla)
                        WHERE t_f.id_ua = '$this->u_a' $where 
		ORDER BY nro_factura ";
		return toba::db('kimelu')->consultar($sql);
	}

}

?>