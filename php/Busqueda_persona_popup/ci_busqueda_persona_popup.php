<?php
    class ci_busqueda_persona_popup extends abm_ci{
        protected $nombre_tabla='estudiante';
        protected $s__where=null;
        
        function conf__cuadro(toba_ei_cuadro $cuadro) {
            //para que no muestre la posición del cuando al responder al popUp
            $cuadro->desactivar_modo_clave_segura();
            if (!is_null($this->s__where)) {
                    $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_apellido_nombre($this->s__where);
            } else {
                    $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_apellido_nombre();
            }
            //print_r($datos);
            $cuadro->set_datos($datos);
        }
        
        function evt__cuadro__seleccion($datos) {
            $this->set_pantalla('pant_edicion');
            $this->dep('datos')->cargar($datos);
        }
    }
    
    
?>