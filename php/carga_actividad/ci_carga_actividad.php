<?php
class ci_carga_actividad extends abm_ci
{   
    protected $nombre_tabla='actividad';
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
    
    //---- Formulario -------------------------------------------------------------------

    function conf__formulario(toba_ei_formulario $form) {
        if ($this->dep('datos')->esta_cargada()) { //si es un formulario de modificación (Actividad ya creada)
            //obtengo los datos de la actividad
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
            print_r($datos);
            $dpto_act=Array();
            if(isset($datos['id_actividad'])){
                //se carga/n lo/s departamento/s de la BD para esta actividad (si los tiene)
                $dpto_act= $this->dep('datos')->tabla($this->nombre_tabla)->obtener_departamentos($datos['id_actividad']);
                print_r($dpto_act);
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
        $datos['id_ua']= $this->u_a;
        print_r($datos);
        $departamentos = $datos['departamento'];
        //print_r($departamentos);
        
        //se  crea y guarda una actividad en la tabla actividad (ok)
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->sincronizar();
        $id_actividad = toba::db('kimelu')->ultimo_insert_id(); //obtenemos el último insert de la BD (actividad actual en este caso)
        print_r($id_actividad);
        if(sizeof($departamentos)!==0){
            //se recorre el arreglo de departamentos 
                foreach ($departamentos as $i => $d){
                    //y crear un registro en la tabla dpto_actividad por cada departamento asociado a la actividad creada
                    $this->dep('datos')->tabla($this->nombre_tabla)->agregar_actividad_departamento( $id_actividad,$d);
                }
        }
        $this->resetear();
    }
    
    function evt__formulario__modificacion($datos) {
        //$dpto_act= $datos['id_departamento'];
        $this->dep('datos')->tabla($this->nombre_tabla)->borrar_departamento($datos['id_actividad'],null);
        if(sizeof($datos['id_departamento'])!==0){
            //se recorre el arreglo de departamentos 
            foreach ($datos['id_departamento'] as $i => $d){
               //y se crea un registro en la tabla dpto_actividad por cada departamento asociado a la actividad creada
               $this->dep('datos')->tabla($this->nombre_tabla)->agregar_actividad_departamento( $datos['id_actividad'],$d);
            }
        }
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->sincronizar();
        $this->resetear();
    }

    function evt__formulario__baja() {
        //Revisa que no se quiera eliminar una actividad que tenga pasantías asociadas
        $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
        //print_r($datos);
        $pasantias = $this->dep('datos')->tabla('actividad')->get_descripciones_pasantias_asociadas($datos['id_actividad']);
        //print_r($pasantias);
        if(!empty($pasantias)){
            toba::notificacion()->agregar('El registro no se puede eliminar porque tiene pasantias asociadas', 'info');
        }
        else{
             $this->dep('datos')->eliminar_todo();
            toba::notificacion()->agregar('El registro se ha eliminado correctamente', 'info');
            $this->resetear();
        }
       
    }
    
}

?>