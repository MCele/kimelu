<?php
class ci_facturacion extends abm_ci
{
    
    protected $nombre_tabla='facturacion';
    protected $u_a='FAEA';
    protected $id_pv=1;
    protected $s__id_fact=NULL;
    
     // la factura contiene estado 1: Correcta y 2:Anulada
    // $this->pantalla('pant_docente')->set_titulo($this->pantalla('pant_docente')->get_titulo()."  ".date_format($f, 'd-m-Y'));
    function conf()
	{
            $this->pantalla()->tab('pant_cuadro_cobros')->ocultar();
            $nueva="Nueva";
            $this->pantalla('pant_edicion')->set_etiqueta($nueva);
	}  
    
    //--------------- CUADRO --------------------------------- 
    function conf__cuadro(toba_ei_cuadro $cuadro) {
        $this->dep('datos')->resetear(); 
        if (!is_null($this->s__where)) {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado($this->s__where);
        } else {
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado();
        }
        $cuadro->set_datos($datos);
        $this->s__id_fact=null;
    }

        
    //--------------- FORMULARIO ---------------------------------
    function conf__formulario(toba_ei_formulario $form) {
         //print_r("id fact: ");
         //print_r($this->s__id_fact);
        //get_descripciones_punto_actual()
        
            if ($this->dep('datos')->esta_cargada()) {
                $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
                //print_r($datos);
                $form->set_titulo("Datos de la factura");
                //print_r($form->get_nombres_ef());
                $efs=['id_punto_venta','nro_factura'];
                $form->set_solo_lectura($efs, TRUE);
                //$form->ef('nro_factura')->set_cuando_cambia_valor();
                $form->set_datos($datos);
                $this->s__id_fact=$datos['id_factura'];
            }else{
                if (!is_null($this->s__id_fact)){
                    //se carga la factura con el conteido $this->s__id_fact
                    $datos = $this->dep('datos')->tabla($this->nombre_tabla)->obtener_factura($this->s__id_fact);
                    
                }
                else{
                    //se carga una nueva factura
                    
                }
                
            //$efs=['nro_factura'];
            //$form->set_solo_lectura($efs, TRUE);
            //$form->ef('nro_factura')->(TRUE);
            }
        //}
        //else{
              //
            //}
            
        
    }
    function avisar_anular(){
        throw new toba_error('Cambia datos');
    }
    function evt__formulario__alta($datos) {
        /*
         * todo: el periodo por defecto
         */
        $this->s__id_fact=null;
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
        
        $cobros = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_cobros($datos['id_factura']);
        $cant_cobros = sizeof($cobros);
        if($datos['estado']==='2' && $cant_cobros>0){
            if($cant_cobros===1)
                toba::notificacion()->agregar("La Factura no puede ser anulada porque tiene $cant_cobros cobro asociado", 'info');
            else
                toba::notificacion()->agregar("La Factura no puede ser anulada porque tiene $cant_cobros cobros asociados", 'info');
        }
        else{
               if($datos['estado']==='2'){//factura anulada se asocia a un cleinte anulada y monto 0
                 $datos['monto']=0;
                 $datos['id_institucion'] = 881;
                 $datos['id_actividad'] = NULL; 
                 toba::notificacion()->agregar('La Factura Anulada se guardo correctamente', 'info');
            }
            else{
                toba::notificacion()->agregar('Los datos de la factura se han guardado correctamente', 'info');
        }
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->sincronizar();
         
            $this->resetear();
            $this->s__id_fact=null;
        }
        
    }
    
    function evt__formulario__cobros($datos) {
        $this->set_pantalla('pant_cuadro_cobros');
        $this->dep('datos')->cargar($datos);
        $this->s__id_fact=$datos['id_factura'];
    }
    
    //---- Cuadro -----------------------------------------------------------------------
    function evt__cuadro__cobros($datos) {
        $this->set_pantalla('pant_cuadro_cobros');
        $this->dep('datos')->cargar($datos);
        $this->s__id_fact=$datos['id_factura'];
    }
    
    
//---- Cuadro cobros -----------------------------------------------------------------------


    function conf__cuadro_cobros(toba_ei_cuadro $cuadro) {
        //$this->dep('datos')->resetear();
        //$this->dep('datos')->sincronizar();
        if (!is_null($this->s__id_fact)) {    
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_cobros($this->s__id_fact);
        } 
        $cuadro->set_datos($datos);
    }
    
}

?>