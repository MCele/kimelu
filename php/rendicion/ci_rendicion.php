<?php
class ci_rendicion extends abm_ci
{
    protected $nombre_tabla='rendicion';
    
    //------------------CUADRO-----------------
    function conf__cuadro(toba_ei_cuadro $cuadro) {
        $this->dep('datos')->resetear(); 
        $cuadro->desactivar_modo_clave_segura();//para que no muestre la posición de la fila en el cuadro al volver del popUp
        if (!is_null($this->s__where)) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado($this->s__where);
        } else {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado();
        }
        $cuadro->set_datos($datos);
    }
    
    //--------------- PopUp ---------------
    function evt__cuadro__seleccion($datos) {
        $this->set_pantalla('pant_edicion');
        $ver=$this->dep('datos')->tabla($this->nombre_tabla)->cargar($datos);
    }
    
    //--------------FORMULARIO-------------
    
    function evt__formulario__baja(){
        //Se verifica que no tenga cobros asociados para poder eliminarla
        $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
        $cobros = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_cobros_asociados($datos['id_rendicion']);
        if(!empty($cobros)){
		toba::notificacion()->agregar('La rendicion no se puede eliminar porque tiene cobros asociados', 'info');
	}
        else{
           $this->dep('datos')->eliminar_todo();
            toba::notificacion()->agregar('El registro se ha eliminado correctamente', 'info');
            $this->resetear(); 
        }
    }
}

?>