<?php
class ci_convenios extends abm_ci
{
    protected $nombre_tabla='convenio';
    
    function conf__formulario(toba_ei_formulario $form) {
        if ($this->dep('datos')->tabla($this->nombre_tabla)->esta_cargada()) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
            $form->set_titulo("Datos de la factura");
            $form->set_datos($datos); //se setea el formulario
        }
        else{
            $aux2=$this->dep('datos')->tabla('unidad_academica')->get_descripciones();
            if(!empty ($aux2)){
                $datos['id_ua']= $aux2[0]['sigla'];
            }
            $form->set_datos($datos,false); //se setea el formulario es false para que siga en estado 'no cargado' (ALTA)
        }
    }
    
    function evt__formulario__baja() {
        //Revisa que no se quiera eliminar una convenio que tenga pasantías asociadas
        $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
        $pasantias = $this->dep('datos')->tabla('convenio')->get_descripciones_pasantias_asociadas($datos['id_convenio']);
        if(!empty($pasantias)){
            $cant = sizeof($pasantias);
            toba::notificacion()->agregar("El Convenio no se puede eliminar, porque tiene $cant pasantia/s asociada/s.", 'info');
        }
        else{
            $this->dep('datos')->eliminar_todo();
            toba::notificacion()->agregar('El registro se ha eliminado correctamente', 'info');
            $this->resetear();
        }
    }
}

?>