<?php
class ci_carga_actividad extends abm_ci
{   
    protected $nombre_tabla='actividad';
    //protected $u_a='FAEA'; LISTO!!!
    //se cambió por una variable que la provea el usuario que esté logueado
    
    //---- Formulario -------------------------------------------------------------------

    function conf__formulario(toba_ei_formulario $form) {
        if ($this->dep('datos')->tabla($this->nombre_tabla)->esta_cargada()) 
        { //si es un formulario de modificación (Actividad ya creada)
            //obtengo los datos de la actividad
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
            
            $dpto_act=Array();
            if(isset($datos['id_actividad'])){
                //se carga/n lo/s departamento/s de la BD para esta actividad (si los tiene)
                $dpto_act= $this->dep('datos')->tabla($this->nombre_tabla)->obtener_departamentos($datos['id_actividad']);
                $dptos = Array();
                foreach ($dpto_act  as  $da){ 
                //guardo en $dptos sólo los departamentos asociados a la actividad del formulario
                    array_push($dptos, $da['id_departamento']);
                }
                if(!empty($dptos)){
                    $datos['departamento']= $dptos;
                }
            }
            $form->set_datos($datos);
        }
    }
    
    function evt__formulario__alta($datos) {
        /*
         * todo: el periodo por defecto
         */
        $aux2=$this->dep('datos')->tabla('unidad_academica')->get_descripciones();
        if(!empty ($aux2)){//se le asocia la unidad académica del usuario
            $datos['id_ua']= $aux2[0]['sigla'];
        }
        $fechas_ok = TRUE;//se usa para verificar que fecha inicio sea menor a fecha fin
        if(($datos['fecha_inicio']) && ($datos['fecha_fin'])){
            $fecha1 = date($datos['fecha_inicio']);
            $fecha2 = $datos['fecha_fin'];
            $fechas_ok = $fecha1<=$fecha2;//fecha de inicio debe ser menor o igual que fecha fin
        }
        if($fechas_ok){
            $departamentos = $datos['departamento'];
            //se  crea y guarda una actividad en la tabla actividad (ok)
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
            $id_actividad = toba::db('kimelu')->ultimo_insert_id(); //obtenemos el último insert de la BD (actividad actual en este caso)
            if(sizeof($departamentos)!==0){
                //se recorre el arreglo de departamentos 
                    foreach ($departamentos as $i => $d){
                        //y crear un registro en la tabla dpto_actividad por cada departamento asociado a la actividad creada
                        $this->dep('datos')->tabla($this->nombre_tabla)->agregar_actividad_departamento( $id_actividad,$d);
                    }
            }
            $this->resetear();
        }
        else{
            throw new toba_error("La actividad no se puede guardar, porque la fecha fin: $fecha2 es menor a la fecha inicio:$fecha1.");
        }
    }
    
    function evt__formulario__modificacion($datos) {
        $fechas_ok = TRUE;//se usa para verificar que fecha inicio sea menor a fecha fin
        if(($datos['fecha_inicio']) && ($datos['fecha_fin'])){
            $fecha1 = date($datos['fecha_inicio']);
            $fecha2 = $datos['fecha_fin'];
            $fechas_ok = $fecha1<=$fecha2;
        }
        if($fechas_ok){
            $this->dep('datos')->tabla($this->nombre_tabla)->borrar_actividad_departamento($datos['id_actividad'],null);
            if(sizeof($datos['departamento'])!==0){
                //se recorre el arreglo de departamentos 
                foreach ($datos['departamento'] as $i => $d){
                   //y se crea un registro en la tabla dpto_actividad por cada departamento asociado a la actividad creada
                   $this->dep('datos')->tabla($this->nombre_tabla)->agregar_actividad_departamento( $datos['id_actividad'],$d);
                }
            }
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
            $this->resetear();
        }
        else{
            toba::notificacion()->agregar("La actividad no se puede guardar, porque la fecha fin: $fecha2 es menor a la fecha inicio:$fecha1.", 'info');
        }
         
    }

    function evt__formulario__baja() {
        //Revisa que no se quiera eliminar una actividad que tenga pasantías asociadas
        $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
        $pasantias = $this->dep('datos')->tabla('actividad')->get_descripciones_pasantias_asociadas($datos['id_actividad']);
        if(!empty($pasantias)){
            toba::notificacion()->agregar('La actividad no se puede eliminar, porque tiene pasantias asociadas. Primero debe eliminar dicha pasantia.', 'info');
        }
        else{
            $facturas = $this->dep('datos')->tabla('actividad')->get_descripciones_facturas_asociadas($datos['id_actividad']);
            $cant_facturas = sizeof($facturas);
            if(!empty($facturas)){
                toba::notificacion()->agregar("La actividad no se puede eliminar, porque tiene $cant_facturas facturas asociadas.", 'info');
            }
            else{
                $this->dep('datos')->tabla($this->nombre_tabla)->borrar_actividad_departamento($datos['id_actividad'],null);
                $this->dep('datos')->eliminar_todo();
                toba::notificacion()->agregar('El registro se ha eliminado correctamente', 'info');
                $this->resetear();
            }
        }
       
    }
    
}

?>