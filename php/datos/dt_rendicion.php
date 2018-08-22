<?php
class dt_rendicion extends kimelu_datos_tabla
{
	function get_listado($where=null)
	{
            if (is_null($where)) {  
                    $where1 = '';
                    $where2 = '';
                    
                } 
            else {
                    $where = str_replace("nro_rendicion", "t_r.nro_rendicion", $where );
                 $where1 = ' WHERE ' . $where;
                 $where2 = ' AND ' . $where;
            }
            //consulta con join para facturacion y cobro 
            //para poder usar filtro en usuario por u_a
		$sql = "SELECT DISTINCT
			t_r.nro_rendicion,
			t_r.fecha_rendicion,
			t_r.id_rendicion,
			t_r.observacion
		FROM    facturacion as f
                        inner join cobro  as c on(c.id_factura=f.id_factura)
                        inner join rendicion as t_r on (c.id_rendicion=t_r.id_rendicion)
                        
                $where1";
                $sql = toba::perfil_de_datos()->filtrar($sql);
                $sql = "$sql "
                        . "Union
                        SELECT DISTINCT
			t_r.nro_rendicion,
			t_r.fecha_rendicion,
			t_r.id_rendicion,
			t_r.observacion
		FROM    facturacion as f
                        inner join cobro  as c on(c.id_factura=f.id_factura)
                        right join rendicion as t_r on (c.id_rendicion=t_r.id_rendicion)
		where f.id_ua isNull $where2
		ORDER BY nro_rendicion";
		return toba::db('kimelu')->consultar($sql);
                
	}
      function get_listado_cobros_asociados($id_rendicion){
        //se obtienen todos los cobros asociados a una rendición
        $sql = "select * from cobro as c
                    inner join rendicion as r on(c.id_rendicion=r.id_rendicion)
                    where r.id_rendicion =  $id_rendicion";
        $sql = toba::perfil_de_datos()->filtrar($sql);
        return toba::db('kimelu')->consultar($sql);
      }
      
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
      
      function get_fecha_rendicion($id_rendicion=NULL){
            if (is_null($id_rendicion)) { 
                $where = '';
            } 
            else {  
                $where = " WHERE id_rendicion = $id_rendicion";
            }
            $sql = "SELECT id_rendicion, nro_rendicion, fecha_rendicion
                    FROM  rendicion
                    $where
                    ORDER BY nro_rendicion";
            //print_r($sql);
            //$sql = toba::perfil_de_datos()->filtrar($sql);//creo que no hace falta
            $consulta = toba::db('kimelu')->consultar($sql);
            if (!is_null($consulta[0]['fecha_rendicion'])){
                $consulta[0]['fecha_rendicion']=Date('d-m-Y',strtotime($consulta[0]['fecha_rendicion']));
                //print_r("Fecha ok");
            }
            else{
                $consulta[0]['fecha_rendicion']='Sin fecha';
                //print_r("Fecha Nula");
            }
            return $consulta;
      }
      
}

?>