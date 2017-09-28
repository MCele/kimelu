<?php
class ci_pasantias extends abm_ci
{
    protected $nombre_tabla='pasantia';
    function conf__cuadro(toba_ei_cuadro $cuadro) 
    {               //redefino el método heredado de abm_ci para mostrado "estado" como cadena (no como número)
        if (!is_null($this->s__where)) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado($this->s__where);
        } else {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado();
        }
        //print_r($datos);
        
        for($i=0;$i<sizeof($datos);$i++) { //0--> estado Vigente/ 1--> estado Finalizado
            if ($datos[$i]['estado'] == 0) {
                $datos[$i]['estado'] = 'Vigente';
                
            } else {
                $datos[$i]['estado'] = 'Finalizado';
            }
        }
        
        $cuadro->set_datos($datos);
    }
    /*
	//---- Cuadro -----------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		$cuadro->set_datos($this->dep('datos')->tabla('pasantia')->get_listado());
	}

	function evt__cuadro__seleccion($datos)
	{
		$this->dep('datos')->cargar($datos);
	}

	//---- Formulario -------------------------------------------------------------------

	function conf__formulario(toba_ei_formulario $form)
	{
		if ($this->dep('datos')->esta_cargada()) {
			$form->set_datos($this->dep('datos')->tabla('pasantia')->get());
		}
	}

	function evt__formulario__alta($datos)
	{
		$this->dep('datos')->tabla('pasantia')->set($datos);
		$this->dep('datos')->sincronizar();
		$this->resetear();
	}

	function evt__formulario__modificacion($datos)
	{
		$this->dep('datos')->tabla('pasantia')->set($datos);
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