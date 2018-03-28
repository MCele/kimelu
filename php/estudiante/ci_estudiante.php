<?php
class ci_estudiante extends abm_ci
{
	protected $nombre_tabla='estudiante';
	protected $u_a='FAEA';
	
       // Para tener en cuenta si el alumno esa inscripto en carreras distintas en distintas Unidades Académicas
        // entonces cuando se ingrese por una unidad académica a editarlo se borrarán las carreras a la que esté inscrito 
        // en las otras unidades académicas!!! Se solucionaría con la Conexion al SIU Guaraní
        
        function conf__cuadro(toba_ei_cuadro $cuadro) {
            $this->dep('datos')->resetear(); 
            if (!is_null($this->s__where)) {
                $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado($this->s__where);
                $cuadro->set_datos($datos);
            } else {
                //$datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado();
                //$cuadro->set_datos($datos);
            }
            
        }
	
	//-+-+-+-+-+-+-+-+--- Formulario ---+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
	
	function conf__formulario(toba_ei_formulario $form) {
		if ($this->dep('datos')->esta_cargada()) {
			$datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
			if(isset($datos['id_estudiante'])){
			//se debería cargar las carreras de la BD para este alumno
                            $resp= $this->dep('datos')->tabla($this->nombre_tabla)->get_carreras($datos['id_estudiante']);
                            $carreras = Array();
			foreach ($resp  as  $c){
				array_push($carreras, $c['id_carrera']);
			}
			$datos['id_carreras']=$carreras;
			}
			$form->set_datos($datos);
		}
	}
	
	function evt__formulario__alta($datos) { // se dan de alta estudiante que no estén cargados con el mismo CUIL o DNI
		$estudiantes = NULL;
		$existe = false;//verifica si existe ya estudiante con los datos de cuil y dni ingresados
                //$datos['id_ua'] = $this->u_a;
                $ua = $this->dep('datos')->tabla('estudiante')->get_ua();
		$datos['cuil']= str_replace("-", "", $datos['cuil']);
		if (!is_null($datos['cuil'])){ //si ingresaron datos del cuil
			$estudiante = $this->dep('datos')->tabla('estudiante')->get_alumno_cuil($datos['cuil'],NULL);
			$existe=(sizeof($estudiante)!=0);
			if ($existe){
                            $unidades_est = $this->dep('datos')->tabla('estudiante')->get_estudiante_ua($estudiante[0]['id_estudiante']);
                            if (sizeof($unidades_est)==1){
                                $nombre = $unidades_est[0]['nombre'];
                                throw new toba_error("Ya existe otro estudiante con el mismo CUIL en la $nombre" );
                            }
                            else{
                                if (sizeof($unidades_est)>0){
                                    throw new toba_error('Ya existe otro estudiante con el mismo CUIL en mas de una Unidad Academica');
                                }
                                else{
                                    throw new toba_error('Ya existe otro estudiante con el mismo CUIL');
                                }    
                            }
			}
			else{
                            if((!is_null($datos['dni']))&&(!$existe)){
				$estudiante= $this->dep('datos')->tabla('estudiante')->get_alumno_dni($datos['dni'],NULL);  
				$existe=(sizeof($estudiante)!=0);
				if($existe){
                                    $unidades_est = $this->dep('datos')->tabla('estudiante')->get_estudiante_ua($estudiante[0]['id_estudiante']);
                                    if (sizeof($unidades_est)==1){
                                        $nombre = $unidades_est[0]['nombre'];
                                        throw new toba_error("Ya existe otro estudiante con el mismo DNI en la $nombre");
                                    }
                                    else{
                                        throw new toba_error('Ya existe otro estudiante con el mismo DNI');
                                    }
				}
                            }
			} 
		}
                  //[id_carreras] => Array ( [0] => 623 [1] => 634 ) 
		if(!$existe){//solo se da de alta un estudiante si no existe ya en la BD con igual cuil o dni
                    $carreras = $datos['id_carreras'];
                    	
                    $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
                    $this->dep('datos')->sincronizar(); //actualiza datos enla BD
                    $estudiante = $this->dep('datos')->tabla('estudiante')->get_alumno_cuil($datos['cuil'],NULL);
                    if (sizeof($ua)==1){ //Se restringe 1 USUARIO por UNIDAD ACADEMICA (lo mismo para PUNTO DE VENTA)
                        $this->dep('datos')->tabla('estudiante')->agregar_ua($estudiante[0]['id_estudiante'],$ua[0]['sigla']);
                    }
                    if(sizeof($carreras)!==0){
			foreach ($carreras as $i => $c){
                            $this->dep('datos')->tabla('estudiante')->agregar_carrera($estudiante[0]['id_estudiante'],$c);
			}
                    }
                    $this->resetear();
		}
                
                
                
	}
	
	function evt__formulario__modificacion($datos){
		$existe = false;    //verifica si existe ya estudiante con los datos de cuil y dni ingresados
		//Quita los '-' si el CUIL lo tiene
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
				$unidades_est = $this->dep('datos')->tabla('estudiante')->get_estudiante_ua($estudiante[0]['id_estudiante']);
                                if (sizeof($unidades_est)==1){
                                    $nombre = $unidades_est[0]['nombre'];
                                    throw new toba_error("Ya existe otro estudiante con el mismo CUIL en la $nombre" );
                                }
                                else{
                                    if (sizeof($unidades_est)>0){
                                        throw new toba_error('Ya existe otro estudiante con el mismo CUIL en más de una Unidad Académica');
                                    }
                                    else{
                                        throw new toba_error('Ya existe otro estudiante con el mismo CUIL');
                                    }

                                }
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
                                    $unidades_est = $this->dep('datos')->tabla('estudiante')->get_estudiante_ua($estudiante[0]['id_estudiante']);
                                    if (sizeof($unidades_est)==1){
                                        $nombre = $unidades_est[0]['nombre'];
                                        throw new toba_error("Ya existe otro estudiante con el mismo DNI en la $nombre");
                                    }
                                    else{
                                        throw new toba_error('Ya existe otro estudiante con el mismo DNI');
                                    }
				}
                            }
			}
		}
		
		if(!$existe){   //si el alumno ingresado no está duplicado con ese cuil o dni
			$carreras = $datos['id_carreras'];//carreras elegidas en el formulario
			$this->dep('datos')->tabla('estudiante')->borrar_carrera($datos['id_estudiante']);
			/*ya no hace falta por que se soluciona borrando todo(anterior) y cargando lo del formulario nuevamente
				* $total=sizeof($carreras);  
			$car = $this->dep('datos')->tabla('estudiante')->get_carreras($datos['id_estudiante']);
			//$car carreras en las que ya está inscripto el alumno $car[id_estudiante],$car[id_carrera]
			$total=sizeof($carreras);
			for($i=0;$i<$total;$i++){    
				$encont=false;
				//verifica: No cargar alumnos con la misma carrera que ya están cargadas
				for($j=0;$j<sizeof($car);$j++){
					//elimino el estudiante actual del arreglo de estudiantes con ese cuil
					if((!$encont) && (empty($carreras)||(sizeof($carreras)!=0))){
						if(((int)($car[$j]['id_carrera']))===((int)$carreras[$i])){
							unset($datos['id_carreras'][$i]);
							$encont=true;                            
						//elimino las carreras en las que el alumno ya está inscripto para que no se vuelvan a guardar
						}                         
					}
				} 
				$carreras = $datos['id_carreras'];
			}
			*/
			if(sizeof($datos['id_carreras'])!==0){
				foreach ($datos['id_carreras'] as $i => $c){
					$estudiante= $this->dep('datos')->tabla('estudiante')->agregar_carrera($datos['id_estudiante'],$c);
				}
			}            
			$this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
			$this->dep('datos')->sincronizar();
			$this->resetear();
		}
	}
	function evt__formulario__baja() {
		//se elimina un alumno de la BD
		$datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
		//se elimina el alumno con las asociaciones a la/s carreras que cursa
		//Se ve si el alumno no está en una pasantía para poder eliminarlo
		$pasantias = $this->dep('datos')->tabla('estudiante')->get_listado_actividad_estudiante(NULL,$datos['id_estudiante']);
		if(!empty($pasantias)){
			toba::notificacion()->agregar('El alumno no se puede eliminar porque tiene pasantias asociadas', 'info');
		}
		else{
			$this->dep('datos')->tabla('estudiante')->borrar_carrera($datos['id_estudiante']);
			//se elimina el registro del alumno de la BD vinculado a la UA del usuario loguado
                        $ua = $this->dep('datos')->tabla('estudiante')->get_ua();//obtenemos UA de usuario
                        foreach ($ua as $pos => $unidad)
                        {   //eliminamos registros de UA del usuario en la que esté el estudiante
                            $this->dep('datos')->tabla('estudiante')->borrar_ua($datos['id_estudiante'],$unidad['sigla']);
                        }
                        $unidades_est = $this->dep('datos')->tabla('estudiante')->get_estudiante_ua($datos['id_estudiante']);
                        if (sizeof($unidades_est)==0){
                        //el estudiante ya no está asociado a ninguna unidad academica, entonces lo podemos eliminar
                        //si el alumno está asociado a otras UA entonces no se elimina su registro
                            $this->dep('datos')->eliminar_todo();
                        }                        
			toba::notificacion()->agregar('El registro se ha eliminado correctamente', 'info');
			$this->resetear();
		}
		
	}
}

?>  