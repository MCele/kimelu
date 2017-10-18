
<?php
class ci_estudiante extends abm_ci
{
    protected $nombre_tabla='estudiante';
    protected $u_a='FAEA';
    
    function evt__formulario__alta($datos) { // se dan de alta estudiante que no estén cargados con el mismo CUIL o DNI
        $estudiantes = NULL;
        $existe = false;//verifica si existe ya estudiante con los datos de cuil y dni ingresados
        $datos['id_ua'] = $this->u_a;
        $datos['cuil']= str_replace("-", "", $datos['cuil']);
        if (!is_null($datos['cuil'])){ //si ingresaron datos del cuil
          $estudiante = $this->dep('datos')->tabla('estudiante')->get_alumno_cuil($datos['cuil'],NULL);
          $existe=(sizeof($estudiante)!=0);
                    if ($existe){
              throw new toba_error('Ya existe otro estudiante con el mismo CUIL');
          }
          else{
              if((!is_null($datos['dni']))&&(!$existe)){
                    $estudiante= $this->dep('datos')->tabla('estudiante')->get_alumno_dni($datos['dni'],NULL);  
                    $existe=(sizeof($estudiante)!=0);
                    if($existe){
                        throw new toba_error('Ya existe otro estudiante con el mismo DNI');
                    }
            }
          } 
        }
        if(!$existe){//solo se da de alta un estudiante si no existe ya en la BD con igual cuil o dni
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->sincronizar();
            $this->resetear();  
        }
        
    }

    function evt__formulario__modificacion($datos) {
        $estudiantes = NULL;
        $existe = false;//verifica si existe ya estudiante con los datos de cuil y dni ingresados
        $datos['cuil']= str_replace("-", "", $datos['cuil']);
        if (!is_null($datos['cuil']))
            { //si no ingresaron datos del cuil (en general no pasa porque es obligatorio)
            $estudiante = $this->dep('datos')->tabla('estudiante')->get_alumno_cuil($datos['cuil'],NULL);
            for($i=0;$i<sizeof($estudiante);$i++){//elimino el estudiante actual del arreglo de estudiantes con ese cuil
                if($estudiante[$i]['id_estudiante']==$datos['id_estudiante']){
                    unset($estudiante[$i]);
                }
             }
            $existe=(sizeof($estudiante)!=0);
            if ($existe){
                throw new toba_error('Ya existe otro estudiante con el mismo CUIL');
               }
            else{
                  if ((!is_null($datos['dni']))&&(!$existe)){
                    $estudiante= $this->dep('datos')->tabla('estudiante')->get_alumno_dni($datos['dni'],NULL);
                    for($i=0;$i<sizeof($estudiante);$i++){//elimino el estudiante actual del arreglo de estudiantes con ese dni
                        if($estudiante[$i]['id_estudiante']==$datos['id_estudiante']){
                            unset($estudiante[$i]);
                        }
                    }
                    $existe=(sizeof($estudiante)!=0);
                    if ($existe){
                        throw new toba_error('Ya existe otro estudiante con el mismo DNI');
                      }
                   }
              }
            }
        if(!$existe){
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->sincronizar();
            $this->resetear();
        }
       
    }
    /*
	//---- Cuadro -----------------------------------------------------------------------

	function conf__cuadro(toba_ei_cuadro $cuadro)
	{
		$cuadro->set_datos($this->dep('datos')->tabla('estudiante')->get_listado());
	}

	function evt__cuadro__seleccion($datos)
	{
		$this->dep('datos')->cargar($datos);
	}

	//---- Formulario -------------------------------------------------------------------

	function conf__formulario(toba_ei_formulario $form)
	{
		if ($this->dep('datos')->esta_cargada()) {
			$form->set_datos($this->dep('datos')->tabla('estudiante')->get());
		}
	}

	function evt__formulario__alta($datos)
	{
		$this->dep('datos')->tabla('estudiante')->set($datos);
		$this->dep('datos')->sincronizar();
		$this->resetear();
	}

	function evt__formulario__modificacion($datos)
	{
		$this->dep('datos')->tabla('estudiante')->set($datos);
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