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
            else {  
                //cambia el nombre de referencia a la tabla
                //$where = str_replace("institucion_nombre", "t_i.nombre", $where );
                //print_r($where);
                $where = ' Where ' . $where; 
            }
            //falta calcular total de cobrados para esa factura (cobro) y luego hacer resta entre cobrado y onto (saldo)
		$sql = " select * from (SELECT
			'00'||t_pv.nro_punto_venta||'-'||'0000'||t_f.nro_factura as nro_factura,
			t_f.fecha,
			t_f.concepto as concepto_factura,
			t_f.monto,
			t_f.id_factura,
                        t_ta.tipo,
			t_i.nombre as institucion_nombre,
                        t_i.cuil_cuit as cuit_institucion,
			t_a.denominacion as id_actividad_nombre,
                        sum(t_c.monto_cobrado) as cobrado,
                        sum(t_c.monto_cobrado) - t_f.monto as saldo
                        
		FROM
			facturacion as t_f	
                        LEFT OUTER JOIN institucion as t_i ON (t_f.id_institucion = t_i.id_institucion)
			LEFT OUTER JOIN actividad as t_a ON (t_f.id_actividad = t_a.id_actividad)
                        LEFT OUTER JOIN tipo_actividad as t_ta ON (t_ta.id_tipo_actividad = t_a.tipo_actividad)
			LEFT OUTER JOIN sede as t_s ON (t_f.id_sede = t_s.id_sede)
			LEFT OUTER JOIN unidad_academica as t_ua ON (t_f.id_ua = t_ua.sigla)
                        LEFT OUTER JOIN punto_venta as t_pv ON (t_f.id_punto_venta = t_pv.id_punto_venta)
                        LEFT OUTER JOIN cobro as t_c ON (t_c.id_Factura = t_f.id_factura)
                        WHERE t_f.id_ua = '$this->u_a'
                        group by 1,2,3,4,5,6,7,8,9--(t_pv.nro_punto_venta,nro_factura,t_f.fecha,t_f.concepto,t_f.monto,t_f.id_factura,t_ta.tipo,t_i.nombre,t_i.cuil_cuit,t_a.denominacion)
		ORDER BY nro_factura ) aux 
                        $where ";
		$datos= toba::db('kimelu')->consultar($sql);
                //print_r($datos);
                //ARREGLAR PARA:
                //recorrer el arreglo de facturas y ver la longitud de nro_factura1<3 agrego tantos 0 para completar 4 caracteres
                //idem para nro_factura2 hasta 8 caracteres adelante y concatenarlos y guardarlos en nro_factura
                return $datos;
                
	}
        function obtener_facturas($id_punto_venta,$nro_fact){
            $datos = null;
            $where = "";
            if(!is_null($id_punto_venta)){
                if(!is_null($nro_fact)){
                    $where = " and nro_factura = $nro_fact";
                }
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta "
                        . "from facturacion "
                        . "where id_ua = $this->u_a "
                        . "and id_punto_venta = " .$id_punto_venta 
                        . $where;
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
        
        function siguiente_factura($id_punto_venta){
            if (is_null($id_punto_venta)){
                return '';
            }
            else{
                $sql = "select max(nro_factura)+1 as nro_factura from facturacion "
                    . "where id_punto_venta = " .$id_punto_venta;
            
                     $datos= toba::db('kimelu')->consultar($sql);
                    // print_r($datos);
                   return $datos[0]['nro_factura'];
            }
        }

}

?>