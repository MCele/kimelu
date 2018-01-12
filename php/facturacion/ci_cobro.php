<?php
class ci_cobro extends abm_ci
{
	protected $nombre_tabla='cobro';
        
        
    function conf__formulario(toba_ei_formulario $form) {        
        if ($this->dep('datos')->esta_cargada()) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
            $factura = $this->dep('datos')->tabla('cobro')->obtener_datos_una_factura($datos['id_factura']);
            $datos['id_punto_venta']= $factura[0]['id_punto_venta'];
            $datos['nro_factura']= $factura[0]['nro_factura'];
            
            $form->set_datos($datos);
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
            $datos['id_factura']= $facturas[0]['id_factura'];
            
            
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->sincronizar();
            $this->resetear();
        }
    }

    function evt__formulario__modificacion($datos) {
        //verifica que la factura cargada exista por si se modifica el nro_factura
        $facturas = $this->dep('datos')->tabla('cobro')->obtener_facturas($datos['id_punto_venta'], $datos['nro_factura']);
        if (empty($facturas)) {
            throw new toba_error('La factura ingresada no existe');
        } else {
            $datos['id_factura']= $facturas[0]['id_factura'];
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->sincronizar();
            $this->resetear();
        }
    }

    /**
      //---- Cuadro -----------------------------------------------------------------------

      function conf__cuadro(toba_ei_cuadro $cuadro)
      {
      $cuadro->set_datos($this->dep('datos')->tabla('cobro')->get_listado());
      }

      function evt__cuadro__seleccion($datos)
      {
      $this->dep('datos')->cargar($datos);
      }

      //---- Formulario -------------------------------------------------------------------

      function conf__formulario(toba_ei_formulario $form)
      {
      if ($this->dep('datos')->esta_cargada()) {
      $form->set_datos($this->dep('datos')->tabla('cobro')->get());
      }
      }

      function evt__formulario__alta($datos)
      {
      $this->dep('datos')->tabla('cobro')->set($datos);
      $this->dep('datos')->sincronizar();
      $this->resetear();
      }

      function evt__formulario__modificacion($datos)
      {
      $this->dep('datos')->tabla('cobro')->set($datos);
      $this->dep('datos')->sincronizar();
      $this->resetear();
      }

      function evt__formulario__baja()
      {
      $this->dep('datos')->eliminar_todo();
      $this->resetear();
      }

      function evt__formulario__cancelar()
      {
      $this->resetear();
      }

      function resetear()
      {
      $this->dep('datos')->resetear();
      }
     * */
}

?>