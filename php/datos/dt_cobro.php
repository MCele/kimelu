<?php
class dt_cobro extends kimelu_datos_tabla
{ 
    
    
	function get_listado($where=null)
	{
            //solucionar lo de concatenación de números (idem dt_facturacion)
            //'00'||t_pv.nro_punto_venta||'-'||'0000'||t_f.nro_factura as nro_factura,
            
            if (is_null($where)) {  
                    $where = '';
                    
                } 
            else {
                 $where = ' where ' . $where;
                 $where = str_replace("nro_rendicion", "t_r.nro_rendicion", $where );
            }
		$sql = "SELECT
			t_f.concepto as id_factura_nombre,
                        t_f.id_factura,
                        t_f.nro_factura,
			t_c.monto_cobrado,
			t_c.fecha_cobro,
			t_r.nro_rendicion,
                        t_r.fecha_rendicion,
                        t_pv.id_punto_venta,
                        t_pv.nro_punto_venta,
			t_c.id_cobro
                        
		FROM
			facturacion as t_f 
                        RIGHT OUTER JOIN  cobro as t_c 
                        ON (t_c.id_factura = t_f.id_factura)
                        LEFT OUTER JOIN punto_venta as t_pv 
                        ON (t_pv.id_punto_venta = t_f.id_punto_venta)
                        LEFT OUTER JOIN rendicion as t_r on(t_c.id_rendicion=t_r.id_rendicion)
                        $where
                        ORDER BY id_cobro desc";
                //se ven los últimos cobros cargados en el cuadro
                
                $sql = toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}
        
        function obtener_facturas($id_punto_venta,$nro_fact){
            $datos = null;
            $where = "";
            if(!is_null($id_punto_venta)){
                if(!is_null($nro_fact)){
                    $where = " where nro_factura = $nro_fact";
                }
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta, estado, monto "
                        . "from facturacion " 
                        . $where;
                $sql = toba::perfil_de_datos()->filtrar($sql);
                
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
        
        function obtener_monto_factura($id_punto_venta, $nro_factura){
            $datos = $this->obtener_facturas($id_punto_venta, $nro_factura);
            if(is_null($datos)||empty($datos)){
                return NULL;
            }
            else {
                return $datos[0]['monto'];
            
            }
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
                        . "WHERE id_punto_venta = " .$id_punto_venta 
                        . $where;
                $sql = toba::perfil_de_datos()->filtrar($sql);
                $datos= toba::db('kimelu')->consultar($sql);
            }
            
            return $datos;
        }
        
        function obtener_datos_una_factura($id_factura=null){
            $datos = null;
            if(!is_null($id_factura)){
                $sql = "select id_factura, nro_factura, fecha, concepto, id_punto_venta "
                        . "from facturacion "
                        . " WHERE id_factura = $id_factura";
                $sql = toba::perfil_de_datos()->filtrar($sql);
                $datos= toba::db('kimelu')->consultar($sql);
            }
            return $datos;
        }
        function obtener_punto_venta_actual (){
             $sql = " select id_punto_venta, nro_punto_venta from punto_venta";
             $sql=toba::perfil_de_datos()->filtrar($sql);
             return toba::db('kimelu')->consultar($sql);
        }
        //Método para PopUp de Rendición
        function get_descripciones_nro_rendicion($id_rendicion=NULL){
            if (is_null($id_rendicion)) { 
                $where = '';
            } 
            else {  
                $where = " WHERE id_rendicion = $id_rendicion";
            }
            $sql = "SELECT  nro_rendicion, fecha_rendicion, 
                            id_rendicion, observacion
                    FROM  rendicion
                    $where
                    ORDER BY nro_rendicion";
            $sql = toba::perfil_de_datos()->filtrar($sql);
            return toba::db('kimelu')->consultar($sql);
      }
}

?>