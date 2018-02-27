<?php
class dt_facturacion extends kimelu_datos_tabla
{
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
    
	function get_listado($where = null)
	{
            if (is_null($where)){  
                $where = "where id_estado = '1'"; 
             }
             
            else {  
                //cambia el nombre de referencia a la tabla
                  //$where = str_replace("institucion_nombre", "t_i.nombre", $where );
                  //$where = str_replace("actividad", "t_a.denominacion", $where );
                $where = ' Where ' . $where; 
                $pos = strpos($where, 'id_estado');
                
               // if (is_null($pos)) {
                   // $where = $where . " and estado = '1'"; //estado de factura correcto
                //print_r($where);
                //}
            }
            
		$sql = " select * from (SELECT
			t_pv.nro_punto_venta as pv,
                        t_f.nro_factura as nro_factura,
			t_f.fecha,
			t_f.concepto as concepto_factura,
			t_f.monto,
			t_f.id_factura,
                        t_ta.tipo,
			t_i.nombre as institucion_nombre,
                        t_i.cuil_cuit as cuit_institucion,
			t_a.denominacion as id_actividad_nombre,
                        t_ef.id_estado,
                        t_ef.descripcion as estado,
                        sum(COALESCE(t_c.monto_cobrado,0)) as cobrado,
                        sum(COALESCE(t_c.monto_cobrado,0)) - t_f.monto as saldo
                        
		FROM
			facturacion as t_f	
                        LEFT OUTER JOIN institucion as t_i ON (t_f.id_institucion = t_i.id_institucion)
			LEFT OUTER JOIN actividad as t_a ON (t_f.id_actividad = t_a.id_actividad)
                        LEFT OUTER JOIN tipo_actividad as t_ta ON (t_ta.id_tipo_actividad = t_a.tipo_actividad)
			LEFT OUTER JOIN sede as t_s ON (t_f.id_sede = t_s.id_sede)
			LEFT OUTER JOIN unidad_academica as t_ua ON (t_f.id_ua = t_ua.sigla)
                        LEFT OUTER JOIN punto_venta as t_pv ON (t_f.id_punto_venta = t_pv.id_punto_venta)
                        LEFT OUTER JOIN cobro as t_c ON (t_c.id_factura = t_f.id_factura)
                        LEFT OUTER JOIN estado_factura as t_ef ON (t_ef.id_estado = t_f.estado)
                       
                        group by 1,2,3,4,5,6,7,8,9,10,11--(t_pv.nro_punto_venta,nro_factura,t_f.fecha,t_f.concepto,t_f.monto,t_f.id_factura,t_ta.tipo,t_i.nombre,t_i.cuil_cuit,t_a.denominacion, t_ef.descripcion)
		ORDER BY nro_factura desc ) aux 
                       $where ";
                
		//$sql=toba::perfil_de_datos()->filtrar($sql);
                $datos= toba::db('kimelu')->consultar($sql);
                
                for($i=0;$i<sizeof($datos);$i++){
                    //completo con "0" a la izquierda al punto de venta (hasta 4 caracteres)
                    $pv = str_pad($datos[$i]['pv'],4,"0",STR_PAD_LEFT);
                    //completo con "0" a la izquierda el número de factura (hasta 8 caracteres)
                    $nro_f = str_pad($datos[$i]['nro_factura'],8,"0",STR_PAD_LEFT);
                    $datos[$i]['nro_factura'] = "$pv-$nro_f";   
                }
                return $datos;
                
	}
        //se listan los cobros asciados a una factura
        function get_listado_cobros($id_factura)
	{
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
                        ON (t_pv.id_punto_venta = t_f.id_punto_venta) 
                        WHERE t_f.id_factura = $id_factura ";
		return toba::db('kimelu')->consultar($sql);
	}
        
        
        //function agregar0_nro($nro,$cant_numeros){
        //dado un string: número de factura ($nro) se agregan ceros hasta completar el total de caracteres ($cant_numeros)
          //  return(str_pad($nro,$cant_numeros,"0",STR_PAD_LEFT));
        //}
        
        //dado un punto de venta y un número de factura (opcional) se listan la/s factura/s asociadas
        function obtener_facturas($id_punto_venta,$nro_fact){
            $datos = null;
            $where = "";
            if(!is_null($id_punto_venta)){
                if(!is_null($nro_fact)){
                    $where = " and nro_factura = $nro_fact";
                }
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta "
                        . "from facturacion "
                        . "where id_ua = '$this->u_a' "
                        . "and id_punto_venta = " .$id_punto_venta 
                        . $where;
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
        
        function obtener_factura($id_fact){
            $datos = null;
            $where = "";
            if(!is_null($id_fact)){
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta, monto, id_institucion, id_actividad, estado "
                        . "from facturacion "
                        . "where id_ua = '$this->u_a' "
                        .  "and id_factura = " . $id_fact;
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