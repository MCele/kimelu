<?php
    class ci_busqueda_persona_popup extends abm_ci{
        protected $nombre_tabla='estudiante';
        protected $s__where=null;
        
        function conf__cuadro(toba_ei_cuadro $cuadro) {
            //carga el cuadro para el PopUp
            $cuadro->desactivar_modo_clave_segura();//para que no muestre la posición de la fila en el cuadro al volver del popUp
            if (!is_null($this->s__where)) {
                    $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_apellido_nombre($this->s__where);
                    $cuadro->set_datos($datos);
            } else {
                //no se hace nada para que el cuadro que no tenga datos de entrada (no carga todos los datos al inicio)
                //para evitar cargar todos los alumnos al comienzo
                    //$datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_apellido_nombre();
            }
            
        }
        
        function evt__cuadro__seleccion($datos) {
            $this->set_pantalla('pant_edicion');
            $this->dep('datos')->tabla($this->nombre_tabla)->cargar($datos);
        }
    }
    
    
?>