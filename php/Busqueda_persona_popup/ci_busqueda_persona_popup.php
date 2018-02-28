<?php
    class ci_busqueda_persona_popup extends abm_ci{
        protected $nombre_tabla='estudiante';
        protected $s__where=null;
        
        function conf__cuadro(toba_ei_cuadro $cuadro) {
            //para que no muestre la posición del cuando al responder al popUp
            $cuadro->desactivar_modo_clave_segura();
            if (!is_null($this->s__where)) {
                    $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_apellido_nombre($this->s__where);
                    $cuadro->set_datos($datos);
            } else {
                    //$datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_apellido_nombre();
            }
            
        }
        
        function evt__cuadro__seleccion($datos) {
            $this->set_pantalla('pant_edicion');
            $this->dep('datos')->cargar($datos);
        }
    }
    
    
?>