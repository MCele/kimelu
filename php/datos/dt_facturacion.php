<?php
class dt_facturacion extends kimelu_datos_tabla
{
    //protected $u_a='FAEA';//LISTO!!!!!
    
	function get_listado($where = null)
	{
            if (is_null($where)){  
                //siempre se muestran las facturas que estén anuladas y las que correctas
                $where = "where id_estado = '1' or id_estado = '2' "; 
             }
             
            else {  
                //cambia el nombre de referencia a la tabla
                  //$where = str_replace("institucion_nombre", "t_i.nombre", $where );
                  //$where = str_replace("actividad", "t_a.denominacion", $where );
                $where = ' Where ' . $where; 
                $pos = strpos($where, 'id_estado');//no se uso
                 /*// se filtra solo por facturas de estado correcto para mostrar
                  * if (empty($pos)) {
                    $where = $where . " and id_estado = '1'"; //estado de factura correcto
                }*/
            }
		$sql = " SELECT
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
			--LEFT OUTER JOIN unidad_academica as t_ua ON (t_f.id_ua = t_ua.sigla)
                        LEFT OUTER JOIN punto_venta as t_pv ON (t_f.id_punto_venta = t_pv.id_punto_venta)
                        LEFT OUTER JOIN cobro as t_c ON (t_c.id_factura = t_f.id_factura)
                        LEFT OUTER JOIN estado_factura as t_ef ON (t_ef.id_estado = t_f.estado)
                       
                        group by 1,2,3,4,5,6,7,8,9,10,11,12
                        --(t_pv.nro_punto_venta,nro_factura,t_f.fecha,t_f.concepto,t_f.monto,t_f.id_factura,t_ta.tipo,t_i.nombre,t_i.cuil_cuit,t_a.denominacion, t_ef.descripcion...estado)
		ORDER BY pv desc, nro_factura desc ";
               
		$sql=toba::perfil_de_datos()->filtrar($sql);
               
                $sql = "SELECT * FROM ($sql) as aux";
                
                $sql = "$sql $where ";// agregamos where del filtro
                $datos= toba::db('kimelu')->consultar($sql);
                //Para Nro_factura: se completan con 0 a la izquierda del punto de venta(4 caracteres) y de número factura (8 caracteres)
                /*//No lo necesitan por eso se comenta
                 * for($i=0;$i<sizeof($datos);$i++){
                    //completo con "0" a la izquierda al punto de venta (hasta 4 caracteres)
                    $pv = str_pad($datos[$i]['pv'],4,"0",STR_PAD_LEFT);
                    //completo con "0" a la izquierda el número de factura (hasta 8 caracteres)
                    $nro_f = str_pad($datos[$i]['nro_factura'],8,"0",STR_PAD_LEFT);
                    $datos[$i]['nro_factura'] = "$pv-$nro_f";   //se concatena el Punto de Venta y el número de Factura
                }*/
                return $datos;
                
	}
        //se listan los cobros asociados a una factura
        function get_listado_cobros($id_factura)
	{
		$sql =
                    "SELECT
			t_f.concepto as id_factura_nombre,
                        t_f.id_factura,
                        t_f.nro_factura,
			t_c.monto_cobrado,
			t_c.fecha_cobro,
			t_c.nro_rendicion,
			t_r.nro_rendicion,
                        t_pv.id_punto_venta,
                        t_pv.nro_punto_venta,
			t_c.id_cobro
		FROM
			cobro as t_c	
                            LEFT OUTER JOIN facturacion as t_f 
                                ON (t_c.id_factura = t_f.id_factura)
                            LEFT OUTER JOIN punto_venta as t_pv 
                                ON (t_pv.id_punto_venta = t_f.id_punto_venta)
                            LEFT OUTER JOIN rendicion as t_r 
                                ON (t_r.id_rendicion = t_c.id_rendicion)
                        WHERE t_f.id_factura = $id_factura ";
                //creo que no es necesaria la restricción de perfil de datos
                $sql=toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}
        
        //dado un punto de venta y un número de factura (opcional) se listan la/s factura/s asociadas
        function obtener_facturas($id_punto_venta,$nro_fact=NULL){
            $datos = null;
            $where = "";
            if(!is_null($id_punto_venta)){
                if(!is_null($nro_fact)){
                    $where = " and nro_factura = $nro_fact";
                }
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta, monto "
                        . "from facturacion "
                        . " where id_punto_venta = " .$id_punto_venta 
                        . $where;
                $sql=toba::perfil_de_datos()->filtrar($sql);
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
        
        function obtener_monto_factura($id_punto_venta, $nro_factura){
            $datos = $this->obtener_facturas($id_punto_venta, $nro_factura);
            if(is_null($datos)){
                return 0;
            }
            else {
                return $datos[0]['monto'];
            
            }
        }
        
        function obtener_factura($id_fact){
            $datos = null;
            $where = "";
            if(!is_null($id_fact)){
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta, monto, id_institucion, id_actividad, estado "
                        . "from facturacion "
                        .  "where id_factura = " . $id_fact;
                $datos= toba::db('kimelu')->consultar($sql);
                $sql=toba::perfil_de_datos()->filtrar($sql);
            }
            return $datos;
        }
        
        
        function siguiente_factura($id_punto_venta=NULL){
            if (is_null($id_punto_venta)){
                return '';
            }
            else{
                $sql = "select max(nro_factura)+1 as nro_factura from facturacion "
                        ." where id_punto_venta = " .$id_punto_venta;
                $sql=toba::perfil_de_datos()->filtrar($sql);
                $datos= toba::db('kimelu')->consultar($sql);
                return $datos[0]['nro_factura'];
            }
        }
        function obtener_punto_venta_actual (){
            //se obtienen los puntos de venta asociados a un usuario 
            ///se devuelven ordenados en forma descendente
             $sql = " select id_punto_venta, nro_punto_venta from punto_venta "
                     . "order by nro_punto_venta desc";
             $sql=toba::perfil_de_datos()->filtrar($sql);
             return toba::db('kimelu')->consultar($sql);
        }
}

?>