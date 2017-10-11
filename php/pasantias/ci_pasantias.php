<?php
class ci_pasantias extends abm_ci
{
    protected $nombre_tabla='pasantia';
    
    //---- Cuadro -----------------------------------------------------------------------
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
    function get_estudiante_apellido_nombre($id_estudiante=NULL){
        //$datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_apellido_nombre($id);
        //return $datos;
    }
    
    
    //---- Formulario -----------------------------------------------------------------------
    
    function evt__formulario__alta($datos) {
        /*
         * métodos redeinidos para chequear datos al momento de cargar una nueva pasantía
         */
       //print_r($datos);
        $hs_sem=$datos['horas_diarias']*$datos['dias_semana'];
        if($hs_sem<=20){    
            if($this->menor_18meses($datos['inicio_convenio'], $datos['fin_convenio'],$datos['id_estudiante'],$datos['id_actividad'])){
                if($this->estado_vigente($datos['fin_convenio'])){ 
                //compara la fecha de hoy para cambiar el estado de la pasantía
                $datos['estado']=0;//estado vigente
                
                }
                else{
                    $datos['estado']=1; //estado finalizado
                }
                //consulta si el estudiante no se encuentra en otra pasantía que esté vigente
                $pasantias = $this->dep('datos')->tabla('pasantia')->get_listado_estudiante_vigente($datos['id_estudiante']);
                if ((sizeof($pasantias) >= 1) && ($datos['estado'] == 0)) {
                    throw new toba_error('El estudiante ya se encuentra en otra pasantia vigente');
                } else {
                    $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
                    $this->dep('datos')->sincronizar();
                    toba::notificacion()->agregar('El registro se ha guardado correctamente', 'info');
                    $this->resetear();    
                }
            }
           else{
              throw new toba_error('No puede superar los 18 meses de pasantias para la misma Institucion'); 
           }   
        }
        else{
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            throw new toba_error('La cantidad de horas semanales no puede ser mayor a 20');  
        }
    }

    function evt__formulario__modificacion($datos) {
         /*
         * métodos redeinidos para chequear datos al momento de modificar pasantía
         */
        //print_r($datos);
        $hs_sem=$datos['horas_diarias']*$datos['dias_semana'];
        if($hs_sem<=20){
            
            if($this->menor_18meses($datos['inicio_convenio'], $datos['fin_convenio'],$datos['id_estudiante'],$datos['id_actividad'],$datos['id_pasantia'])){
                if ($this->estado_vigente($datos['fin_convenio'])) {
                    //compara la fecha de hoy para cambiar el estado de la pasantía
                    $datos['estado'] = 0; //estado vigente
                } else {
                    $datos['estado'] = 1; //estado finalizado
                }
                //consulta si el estudiante no se encuentra en otra pasantía que esté vigente
                $pasantias = $this->dep('datos')->tabla('pasantia')->get_listado_estudiante_vigente($datos['id_estudiante']);
                
                for($i=0;$i<sizeof($pasantias);$i++){//elimino la pasantía actual del arreglo de pasantías vigentes
                    if($pasantias[$i]['id_pasantia']==$datos['id_pasantia']){
                        unset($pasantias[$i]);
                    }
                }
                if ((sizeof($pasantias) >= 1) && ($datos['estado'] == 0)) {//si ya hay una pasantía vigente no se puede cargar
                    throw new toba_error('El estudiante ya se encuentra en otra pasantia vigente');
                } else {
                    $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
                    $this->dep('datos')->sincronizar();
                    toba::notificacion()->agregar('El registro se ha guardado correctamente', 'info');
                    $this->resetear();
                }
            }
            else{
              throw new toba_error('No puede superar los 18 meses de pasantias para la misma Institucion'); 
            }
        }
        else{
            throw new toba_error('La cantidad de horas semanales no puede ser mayor a 20');
        }
    }
    
    function estado_vigente($fecha_fin){
    //Consulta si el estado es viente o no y hay que cambiarlo
    //($fecha_fin ya tiene el formato aaaa-mm-dd)
        $hoy = getdate();
        return($this->formato_fecha($hoy) <= $fecha_fin);
    }
    
    function formato_fecha($fecha){ 
    //Usa una fecha del tipo date y 
    //Conveierte una fecha al formato aaaa-mm-dd
        $f_hoy=$fecha['year']."";
        if($fecha['mon']<10){ //agregar el 0 al mes si es menos a 10
            $f_hoy = $f_hoy . "-0".$fecha['mon'];
        }
        else{
            $f_hoy = $f_hoy ."-".$fecha['mon'];
        }
        
        if($fecha['mday']<10){//agregar el 0 al dia si es menos a 10
            $f_hoy = $f_hoy . "-0".$fecha['mday'];
        }
        else{
            $f_hoy = $f_hoy ."-".$fecha['mday'];
        }
        return $f_hoy;
    }
    
    function total_meses_pasantia_estudiante($id_estudiante,$id_actividad,$id_pasantia=NULL){ 
        /* Método que calcula la cantidad de tiempo en meses que está un estudiante($id_estudiante)
         * en una misma actividad del tipo pasantía($id_actividad) 
         * (pueden ser varias pasantías sobre una misma actividad)
         * se devuelve la diferenca en fechas de todas las pasantias existentes en cantidad de meses
         */
        $pasantias=$this->dep('datos')->tabla($this->nombre_tabla)->get_listado_actividad_estudiante($id_actividad,$id_estudiante);
        
        $dif=array();
        $k=0;
        $meses=0;
        $dias=0;
        $total=array();
        for($i=0;$i< sizeof($pasantias);$i++){//calcula el total de los meses y dias en todas las pasantías
             if((is_null($id_pasantia))||((!is_null($id_pasantia)) && ($id_pasantia != $pasantias[$i]['id_pasantia'])))
              {//para el caso en el que se esté contando la pasantía actual a modificar
                 //evaluamos todas menos la pasantía actual a modificar o la nueva a cargar
                 if ((!is_null($pasantias[$i]['inicio_convenio']))&&(!is_null($pasantias[$i]['fin_convenio']))){
                     $f1=new DateTime($pasantias[$i]['inicio_convenio']);
                     $f2=new DateTime($pasantias[$i]['fin_convenio']);
                     $d=$f1->diff($f2);
                     //print_r($d);
                     $dif[$k]['d']= $d->d;   
                     $dif[$k]['m']= $d->m + $d->y*12;
                     //$dif[$k]['a']= $d->y;
                     $k++;
                 }
              }
          
        }
        //print_r($dif);
        for($i=0;$i< sizeof($dif);$i++){//sumo todos los meses y días
           $meses+= $dif[$i]['m'];
           $dias+=$dif[$i]['d'];
        }
        $meses+= intdiv($dias,30);
        $dias=$dias%30;
        $total['m']=$meses;
        $total['d']=$dias;
        //print_r($total);
        return $total;
    }
    function menor_18meses($f_inicio,$f_fin,$id_estudiante,$id_actividad,$id_pasantia=NULL)
    {
        //Verifica si la cantidad de meses entre todas las pasantías + la actual es menor a 18
        $total = $this->total_meses_pasantia_estudiante($id_estudiante, $id_actividad,$id_pasantia);
        $f1 = new DateTime($f_fin);
        $f2 = new DateTime($f_inicio);
        $d = $f1->diff($f2);
        $total['d'] += $d->d;
        $total['m'] += $d->m + $d->y * 12;
        $total['m'] += intdiv($total['d'], 30);
        $total['d'] = $total['d'] % 30;
        //print_r($total);
        return($total['m'] < 18);
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