<?php
class dt_punto_venta extends kimelu_datos_tabla
{
    //protected $u_a='FAEA';  //LISTO!!!
    //protected $id_pv=1;
    
	function get_descripciones()
	{
		$sql = "SELECT id_punto_venta, nro_punto_venta, descripcion "
                        . "FROM punto_venta ORDER BY nro_punto_venta";
                $sql=toba::perfil_de_datos()->filtrar($sql);
		return toba::db('kimelu')->consultar($sql);
	}
        function get_descripciones_punto_actual()
	{
		$sql = "SELECT id_punto_venta, nro_punto_venta, descripcion "
                        . " FROM punto_venta "
                        . " ORDER BY nro_punto_venta";
                $sql=toba::perfil_de_datos()->filtrar($sql);
		$datos= toba::db('kimelu')->consultar($sql);
                return($datos);
	}
        
        function get_descripciones_punto($id_pto_vta)
	{
		$sql = "SELECT id_punto_venta, nro_punto_venta, descripcion "
                        . " FROM punto_venta where id_punto_venta =  ".$id_pto_vta
                        . " ORDER BY nro_punto_venta";
                $sql=toba::perfil_de_datos()->filtrar($sql);
		$datos= toba::db('kimelu')->consultar($sql);
                return($datos);
	}
}
?>