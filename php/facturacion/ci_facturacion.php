<?php
class ci_facturacion extends abm_ci
{
    
    protected $nombre_tabla='facturacion';
    protected $u_a='FAEA';
    protected $id_pv=1;
    
     // la factura contiene estado 1: Correcta y 2:Anulada
    
    //--------------- FORMULARIO ---------------------------------
    function conf__formulario(toba_ei_formulario $form) {
        //get_descripciones_punto_actual()
        if ($this->dep('datos')->esta_cargada()) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
            //print_r($datos);
            $form->set_datos($datos);
        }
    }
    function evt__formulario__alta($datos) {
        /*
         * todo: el periodo por defecto
         */
        $datos['id_ua'] = $this->u_a;
        $datos['id_punto_venta'] = $this->id_pv;
        $datos['estado'] = 1; // la factura contiene estado 1: Correcta y 2:Anulada
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->sincronizar();
        $this->resetear();
    }
    
    /*
	//---- Cuadro -----------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		$cuadro->set_datos($this->dep('datos')->tabla('facturacion')->get_listado());
	}

	function evt__cuadro__seleccion($datos)
	{
		$this->dep('datos')->cargar($datos);
	}

	//---- Formulario -------------------------------------------------------------------

	function conf__formulario(toba_ei_formulario $form)
	{
		if ($this->dep('datos')->esta_cargada()) {
			$form->set_datos($this->dep('datos')->tabla('facturacion')->get());
		}
	}

	function evt__formulario__alta($datos)
	{
		$this->dep('datos')->tabla('facturacion')->set($datos);
		$this->dep('datos')->sincronizar();
		$this->resetear();
	}

	function evt__formulario__modificacion($datos)
	{
		$this->dep('datos')->tabla('facturacion')->set($datos);
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
        */
}

?>