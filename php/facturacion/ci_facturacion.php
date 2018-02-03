<?php
class ci_facturacion extends abm_ci
{
    
    protected $nombre_tabla='facturacion';
    protected $u_a='FAEA';
    protected $id_pv=1;
    protected $s__id_fact='';
    
     // la factura contiene estado 1: Correcta y 2:Anulada
    // $this->pantalla('pant_docente')->set_titulo($this->pantalla('pant_docente')->get_titulo()."  ".date_format($f, 'd-m-Y'));
    function conf()
	{
            $this->pantalla()->tab('pant_cuadro_cobros')->ocultar();
                    $nueva="Vacia";
            $this->pantalla('pant_edicion')->set_etiqueta($nueva);
	}  
        
    //--------------- FORMULARIO ---------------------------------
    function conf__formulario(toba_ei_formulario $form) {
         
        //get_descripciones_punto_actual()
        if ($this->dep('datos')->esta_cargada()) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
            //print_r($form);
            $form->set_titulo("Datos de la factura");
            //print_r($form->get_nombres_ef());
            $efs=['id_punto_venta','nro_factura'];
            $form->set_solo_lectura($efs, TRUE);
            
           
            
            //$form->ef('nro_factura')->set_cuando_cambia_valor();
            $form->set_datos($datos);
        }else{
            $efs=['nro_factura'];
            $form->set_solo_lectura($efs, TRUE);
            
        }
    }
    function avisar_anular(){
        throw new toba_error('Cambia datos');
    }
    function evt__formulario__alta($datos) {
        /*
         * todo: el periodo por defecto
         */
        $datos['id_ua'] = $this->u_a;
        $datos['id_punto_venta'] = $this->id_pv;
        $datos['estado'] = 1; // la factura contiene estado 1: Correcta y 2:Anulada
        $facturas= $this->dep('datos')->tabla($this->nombre_tabla)->obtener_facturas($datos['id_punto_venta'],$datos['nro_factura']);
       
        if(empty($facturas)){   
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->sincronizar();
            $this->resetear();
        }
        else{
            throw new toba_error('Ya existe una factura con ese numero');
        }
    }
    
    function evt__formulario__modificacion($datos) {
        $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
        $this->dep('datos')->sincronizar();
        if($datos['estado']==='2'){
          toba::notificacion()->agregar('Los datos de la factura se han guardado correctamente como Anulada', 'info');
        }
        else{
            toba::notificacion()->agregar('Los datos de la factura se han guardado correctamente', 'info');
        }
        $this->resetear();
    }
    
    //---- Cuadro -----------------------------------------------------------------------
    function evt__cuadro__cobros($datos) {
        $this->set_pantalla('pant_cuadro_cobros');
        $this->dep('datos')->cargar($datos);
        $this->s__id_fact=$datos['id_factura'];
    }
    
    
	//---- Cuadro cobros -----------------------------------------------------------------------


    function conf__cuadro_cobros(toba_ei_cuadro $cuadro) {
        $this->dep('datos')->resetear();
        //$this->dep('datos')->sincronizar();
        if (!is_null($this->s__id_fact)) {    
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_cobros($this->s__id_fact);
        } 
        $cuadro->set_datos($datos);
    }
    
}

?>