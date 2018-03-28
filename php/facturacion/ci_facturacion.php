<?php
class ci_facturacion extends abm_ci
{
///CORREGIR ALTA Y MODIFICACIOÓN DE ACUERDO AL PUNTO DE VENTA    
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
        //deberia cargar los datos del p_v del usuario para que aparezca en el combo ya elegido
        //idem para unidad academica
            if ($this->dep('datos')->esta_cargada()) {
                $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
                //print_r($datos);
                $form->set_titulo("Datos de la factura");
                //print_r($form->get_nombres_ef());
                $efs=Array('id_punto_venta','nro_factura');
                //$form->set_solo_lectura($efs, TRUE);
                //$form->ef('nro_factura')->set_cuando_cambia_valor();
                $form->set_datos($datos); //guardo los datos en el formulario
                $this->s__id_fact=$datos['id_factura'];
            }
            else{
                //select * from punto_venta
                //filtro
                
                $pv= $this->dep('datos')->tabla('facturacion')->obtener_punto_venta_actual();
               // print_r($pv);
                
                $nro_fact = $this->dep('datos')->tabla('facturacion')->siguiente_factura($pv[0]['id_punto_venta']);
                //print_r($nro_fact);
                $datos=Array('id_punto_venta'=>$pv[0]['id_punto_venta'],'nro_factura'=>$nro_fact);
                $form->set_datos($datos,false);//guardo los datos en el formulario VERRR!!! Pasa a estado cargado (muestra botones de modificar, cancelar)
            //$efs=['nro_factura'];
            //$form->set_solo_lectura($efs, TRUE);
            //$form->ef('nro_factura')->(TRUE);
            }
            
        
    }
    function avisar_anular(){
        throw new toba_error('Cambia datos');
    }
    function evt__formulario__alta($datos) {///CORREGIR ALTA Y MODIFICACIOÓN DE ACUERDO AL PUNTO DE VENTA
        /*
         * todo: el periodo por defecto
         */
        $this->s__id_fact=null;
        $datos['id_ua'] = $this->u_a;
        $datos['id_punto_venta'] = $this->id_pv;
        $facturas= $this->dep('datos')->tabla($this->nombre_tabla)->obtener_facturas($datos['id_punto_venta'],$datos['nro_factura']);
       //el punto de venta es para toda la Universidad (se aocian al CUIL de la UNCO)
        if(empty($facturas)){ 
            if($datos['estado']==='2'){//factura anulada se asocia a un cliente anulada y monto 0
                 $datos['monto']=0;
                 $datos['id_institucion'] = 881;//REVISAR!!! Asignación de institucion ANULADA!!!????
                 $datos['id_actividad'] = NULL; 
                 toba::notificacion()->agregar('La Factura Anulada se guardo correctamente', 'info');
            }
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->sincronizar();
            toba::notificacion()->agregar('Los datos de la factura se han guardado correctamente', 'info');
        }
        else{
            throw new toba_error('Ya existe una factura con ese numero');
        }
    }
    
    function evt__formulario__modificacion($datos) {//REVISAR!!! Asignación de institucion ANULADA!!!????
        
        $cobros = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_cobros($datos['id_factura']);
        $cant_cobros = sizeof($cobros);
        if($datos['estado']==='2' && $cant_cobros>0){
            if($cant_cobros===1)
                toba::notificacion()->agregar("La Factura no puede ser anulada porque tiene $cant_cobros cobro asociado", 'info');
            else
                toba::notificacion()->agregar("La Factura no puede ser anulada porque tiene $cant_cobros cobros asociados", 'info');
        }
        else{
               if($datos['estado']==='2'){//factura anulada se asocia a un cliente anulada y monto 0
                 $datos['monto']=0;
                 $datos['id_institucion'] = 881;//Ver!!! Asignación de institucion ANULADA!!!????
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
        //$this->dep('datos')->sincronizar();
        if (!is_null($this->s__id_fact)) {    
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_cobros($this->s__id_fact);
        } 
        $cuadro->set_datos($datos);
    }
    
}

?>