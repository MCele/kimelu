<?php
class dt_cobro extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    
    
    
	function get_listado()
	{
            //solucionar lo de concatenación de números (idem dt_facturacion)
            //'00'||t_pv.nro_punto_venta||'-'||'0000'||t_f.nro_factura as nro_factura,
		$sql = "SELECT
			t_f.concepto as id_factura_nombre,
                        t_f.id_factura,
                        t_f.nro_factura,
			t_c.monto_cobrado,
			t_c.fecha_cobro,
			t_c.nro_rendicion,
                        t_pv.id_punto_venta,
                        t_pv.nro_punto_venta,
			t_c.id_cobro,
                        t_c.nro_rendicion
		FROM
			cobro as t_c	
                        LEFT OUTER JOIN facturacion as t_f 
                        ON (t_c.id_factura = t_f.id_factura)
                        LEFT OUTER JOIN punto_venta as t_pv 
                        ON (t_pv.id_punto_venta = t_f.id_punto_venta) ";
		return toba::db('kimelu')->consultar($sql);
	}
        
        function obtener_facturas($id_punto_venta,$nro_fact){
            $datos = null;
            $where = "";
            if(!is_null($id_punto_venta)){
                if(!is_null($nro_fact)){
                    $where = " and nro_factura = $nro_fact";
                }
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta, estado "
                        . "from facturacion "
                        . "where id_ua = '$this->u_a' "
                        . "and id_punto_venta = " .$id_punto_venta 
                        . $where;
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
        function obtener_datos_factura($id_punto_venta=null,$id_fact=null){
            $datos = null;
            $where = "";
            if(!is_null($id_punto_venta)){
                if(!is_null($id_fact)){
                    $where = " and id_factura = $id_fact";
                }
                $sql = "select id_factura, nro_factura, fecha, concepto "
                        . "from facturacion "
                        . "where id_ua = '$this->u_a' "
                        . "and id_punto_venta = " .$id_punto_venta 
                        . $where;
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
        
        function obtener_datos_una_factura($id_factura=null){
            $datos = null;
            if(!is_null($id_factura)){
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta "
                        . "from facturacion "
                        . "where id_ua = '$this->u_a' "
                        . " and id_factura = $id_factura";
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
}

?>