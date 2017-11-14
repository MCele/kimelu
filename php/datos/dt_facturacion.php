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
			'00'||t_pv.nro_punto_venta||'-'||'0000'||t_f.nro_factura as nro_factura,
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
                        LEFT OUTER JOIN punto_venta as t_pv ON (t_f.id_punto_venta = t_pv.id_punto_venta)
                        WHERE t_f.id_ua = '$this->u_a' $where 
		ORDER BY nro_factura ";
		$datos= toba::db('kimelu')->consultar($sql);
                //print_r($datos);
                //recorrer el arreglo de facturas y ver la longitud de nro_factura1<3 agrego tantos 0 para completar 4 caracteres
                //iden paranro_factura2 hasta 8 caracteres adelante y concatenarlos y guardarlos en nro_factura
                return $datos;
                
	}
        
        function siguiente_factura($id_punto_venta){
            
            $sql = "select max(nro_factura)+1 as nro_factura from facturacion "
                    . "where id_punto_venta = " .$id_punto_venta;
            
            $datos= toba::db('kimelu')->consultar($sql);
            //print_r($datos);
            //print_r($datos[0]['nro_factura']);
            return $datos[0]['nro_factura'];
        }

}

?>