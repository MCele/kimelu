<?php
class ci_abm extends abm_ci     //CI para Instituciones
{                               
     protected $nombre_tabla='institucion';
     //protected $u_a='FAEA';   LISTO!!!
   
     
     
     
     function conf__cuadro(toba_ei_cuadro $cuadro) {
        $this->dep('datos')->resetear(); 
        if (!is_null($this->s__where)) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado($this->s__where);
            $cuadro->set_datos($datos);
        } else {
            //no se hace nada para que el cuadro que no tenga datos de entrada (no carga todos los datos al inicio)
            //$datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado();
        }
        
    }
     
     /*********************** FORMULARIO *************************/
    
    function conf__formulario(toba_ei_formulario $form) {
        if ($this->dep('datos')->tabla($this->nombre_tabla)->esta_cargada()) {
            $form->set_titulo("Datos de la Institucion:");
            $form->set_datos($this->dep('datos')->tabla($this->nombre_tabla)->get());
        }
    }
     
     function evt__formulario__alta($datos) {
        /*
         * 
         */
        $datos['cuil_cuit']= str_replace("-", "", $datos['cuil_cuit']);
        $aux2=$this->dep('datos')->tabla('unidad_academica')->get_descripciones();
        if(!empty ($aux2))
        {//se le asocia la unidad académica del usuario
            $datos['id_ua']= $aux2[0]['sigla'];
        }
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
        $this->resetear();
        
    }

    function evt__formulario__modificacion($datos) {
        //si el cuil o cuit llegara con "-" se elimina el "-"
        $datos['cuil_cuit']= str_replace("-", "", $datos['cuil_cuit']);
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
        $this->resetear();
    }
    
    function evt__formulario__baja() {
        $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
        $actividades = $this->dep('datos')->tabla($this->nombre_tabla)->obtener_actividades_de_institucion($datos['id_institucion'], $datos['id_ua']);
        $cant_activ = sizeof($actividades);
         if(!empty($actividades)){
             toba::notificacion()->agregar("La institucion no se puede eliminar, porque tiene $cant_activ actividad/es asociada/s.", 'info');
         }
         else{
             $this->dep('datos')->eliminar_todo();
             toba::notificacion()->agregar('El registro se ha eliminado correctamente', 'info');
             $this->resetear();
         }   
    }
}

?>