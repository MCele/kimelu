<?php
class ci_abm extends abm_ci     //Instituciones
{                               
     protected $nombre_tabla='institucion';
     protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
     
     
     function evt__formulario__alta($datos) {
        /*
         * 
         */
        $datos['cuil_cuit']= str_replace("-", "", $datos['cuil_cuit']);
        $datos['id_ua']= $this->u_a;
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->sincronizar();
        $this->resetear();
    }

    function evt__formulario__modificacion($datos) {
        $datos['cuil_cuit']= str_replace("-", "", $datos['cuil_cuit']);
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->sincronizar();
        $this->resetear();
    }
    
    function evt__formulario__baja() {
        $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
        //print_r("Datos --------> ");
        //print_r($datos);
        $actividades = $this->dep('datos')->tabla($this->nombre_tabla)->obtener_actividades_de_institucion($datos['id_institucion'], $datos['id_ua']);
        //print_r($actividades);
        $cant_activ = sizeof($actividades);
        //print_r($cant_activ);
         if(!empty($actividades)){
             toba::notificacion()->agregar("La institucion no se puede eliminar, porque tiene $cant_activ actividad/es asociada/s.", 'info');
         }
         else{
             $this->dep('datos')->eliminar_todo();
             toba::notificacion()->agregar('El registro se ha eliminado correctamente', 'info');
             $this->resetear();
         }
        
    }
    
    /*
    //---- Cuadro -----------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		$cuadro->set_datos($this->dep('datos')->tabla('institucion')->get_listado());
	}

	function evt__cuadro__seleccion($datos)
	{
		$this->dep('datos')->cargar($datos);
	}

	//---- Formulario -------------------------------------------------------------------

	function conf__formulario(toba_ei_formulario $form)
	{
		if ($this->dep('datos')->esta_cargada()) {
			$form->set_datos($this->dep('datos')->tabla('institucion')->get());
		}
	}

	function evt__formulario__alta($datos)
	{
		$this->dep('datos')->tabla('institucion')->set($datos);
		$this->dep('datos')->sincronizar();
		$this->resetear();
	}

	function evt__formulario__modificacion($datos)
	{
		$this->dep('datos')->tabla('institucion')->set($datos);
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