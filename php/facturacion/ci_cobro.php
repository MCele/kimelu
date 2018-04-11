<?php
class ci_cobro extends abm_ci
{
	protected $nombre_tabla='cobro';
        //LISTO!!!
        //Ver si se puede solucionar lo de cascada para monto_cobrado desde JS formulario.php
    function conf__formulario(toba_ei_formulario $form) {        
        if ($this->dep('datos')->tabla($this->nombre_tabla)->esta_cargada()) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
            $factura = $this->dep('datos')->tabla('cobro')->obtener_datos_una_factura($datos['id_factura']);
            $datos['id_punto_venta']= $factura[0]['id_punto_venta'];
            $datos['nro_factura']= $factura[0]['nro_factura'];
            
            //$form->ef('monto_cobrado')->quitar_maestro('id_punto_venta');
            //$form->ef('monto_cobrado')->quitar_maestro('nro_factura');
            //print_r($form->ef('monto_cobrado')->get_estado());
            $form->set_datos($datos);
        }
        else{
             $pv= $this->dep('datos')->tabla('cobro')->obtener_punto_venta_actual();
             $datos=Array('id_punto_venta'=>$pv[0]['id_punto_venta']);
             $form->set_datos($datos, false);//guardo los datos en el formulario VERRR!!! Pasa a estado cargado (muestra botones de modificar, cancelar)
        }
    }

    function evt__formulario__alta($datos) {
        /*
         * 
         */
        //verifica que la factura cargada exista
        $facturas = $this->dep('datos')->tabla('cobro')->obtener_facturas($datos['id_punto_venta'], $datos['nro_factura']);
        if (empty($facturas)) {
            throw new toba_error('La factura ingresada no existe');
        } else {
            if($facturas[0]['estado']===1){//estado correcto de la factura
                $datos['id_factura']= $facturas[0]['id_factura'];
                $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
                $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();;
                toba::notificacion()->agregar('El cobro se ha guardado correctamente', 'info');
                $this->resetear();
            }
            else{//estado anulado d la factura
                throw new toba_error('No se pueden cargar cobross de una factura anulada');
            }
            
        } 
    }

    function evt__formulario__modificacion($datos) {
        //verifica que la factura cargada exista por si se modifica el nro_factura
        $facturas = $this->dep('datos')->tabla('cobro')->obtener_facturas($datos['id_punto_venta'], $datos['nro_factura']);
        if (empty($facturas)) {
            throw new toba_error('La factura ingresada no existe');
        } else {
            if($facturas[0]['estado']===1){//estado correcto de la factura
                $datos['id_factura']= $facturas[0]['id_factura'];
                $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
                $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
                toba::notificacion()->agregar('El cobro se ha guardado correctamente', 'info');
                $this->resetear();
           }
           else{//estado anulado d la factura
                throw new toba_error('No se pueden cargar cobros de una factura anulada');
            }
        }
    }
}

?>