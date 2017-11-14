<?php
class ci_carga_actividad extends abm_ci
{   
    protected $nombre_tabla='actividad';
    protected $u_a='FAEA';
    //se debería cambiar por una variable que la provea el usuario que esté logueado
    
    function evt__formulario__alta($datos) {
        /*
         * todo: el periodo por defecto
         */
        $datos['id_ua']= $this->u_a;
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