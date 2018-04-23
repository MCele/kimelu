<?php
class ci_facturacion extends abm_ci
{    
    protected $nombre_tabla='facturacion';
    //protected $u_a='FAEA';    //LISTO!!!!
    protected $s__id_fact=NULL;//Ver si se puede sacar 
            ////(aparentemente se usa para cargar el cuadro_cobros de una factura determunada)
    
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
            if ($this->dep('datos')->tabla($this->nombre_tabla)->esta_cargada()) {
                $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get();
                $form->set_titulo("Datos de la factura");
                //print_r($form->get_nombres_ef());
                $efs=Array('id_punto_venta','nro_factura');
                //$form->set_solo_lectura($efs, TRUE);
                //$form->ef('nro_factura')->set_cuando_cambia_valor();
                $form->set_datos($datos); //carga los datos en el formulario
                $this->s__id_fact = $datos['id_factura'];
            }
            else{//Si la factura es nueva (Alta)
                //se filtra el punto de venta de acuerdo al usuario logueado
                $pv= $this->dep('datos')->tabla('facturacion')->obtener_punto_venta_actual();
                //se obtiene el siguiente número de la nueva factura
                $nro_fact = $this->dep('datos')->tabla('facturacion')->siguiente_factura($pv[0]['id_punto_venta']);
                //el punto de venta es para toda la Universidad (se asocia al CUIL de la UNCO) y es uno por usuario
                $datos=Array('id_punto_venta'=>$pv[0]['id_punto_venta'],'nro_factura'=>$nro_fact);
                $aux2=$this->dep('datos')->tabla('unidad_academica')->get_descripciones();
                if(!empty ($aux2)){
                    $datos['id_ua']= $aux2[0]['sigla'];
                }
                $form->set_datos($datos,false);//guardo los datos en el formulario de nueva factura (false es para que siga en estado "no cargado")
            }
        
    }
    function avisar_anular(){
        throw new toba_error('Cambia datos');
    }
    function evt__formulario__alta($datos) {
        /*
         * se da de alta una factura donde  hay que tener en cuenta que 
         * toda factura anulada se asocia a un cliente (institucion) ANULADA y monto $0!!!
         */
        $this->s__id_fact=null;
        //se buscan facturas con los mismos datos en puto de venta y número
        //print_r($datos);
        $facturas= $this->dep('datos')->tabla($this->nombre_tabla)->obtener_facturas($datos['id_punto_venta'],$datos['nro_factura']);
        //se le asocia la unidad académica del usuario
        /*Ya No es necesario porque ya oculta en el formulario
         * $aux2=$this->dep('datos')->tabla('unidad_academica')->get_descripciones();
        if(!empty ($aux2)){
            $datos['id_ua']= $aux2[0]['sigla'];
        }*/
        
        //revise actualizar el arreglo de $datos o ver funcion de toba
        if(empty($facturas)){ 
            if($datos['estado']==='2')
            {//toda factura anulada se asocia a un cliente anulada y monto $0
                 $datos['monto']=0;
               // ¡¡¡Importante!!! Asignación de institucion ANULADA!!! para una factura anulada
                 $datos['id_institucion'] = 881;
                
                 $datos['id_actividad'] = NULL; 
                 toba::notificacion()->agregar('La Factura Anulada se guardo correctamente', 'info');
            }
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
            toba::notificacion()->agregar('Los datos de la factura se han guardado correctamente', 'info');
            $this->dep('datos')->resetear();// no se puede usar $this->resetear(); de abm_ci
                            //porque no de debe volver al cuadro
        }
        else{
            throw new toba_error('Ya existe una factura con ese numero');
        }
    }
    
    function evt__formulario__modificacion($datos) 
    {
         /* se modifica una factura donde  hay que tener en cuenta que 
         * toda factura anulada se asocia a un cliente (institucion) ANULADA y monto $0 por defecto
         */
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
              // ¡¡¡IIMPORTANTE!!! Asignación de institucion ANULADA!!! para una factura anulada
                 $datos['id_institucion'] = 881;
                 $datos['id_actividad'] = NULL; 
                 toba::notificacion()->agregar('La Factura Anulada se guardo correctamente', 'info');
                }
            else{
                toba::notificacion()->agregar('Los datos de la factura se han guardado correctamente', 'info');
            }
            $this->dep('datos')->tabla($this->nombre_tabla)->set($datos);
            $this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
            $this->resetear();
            $this->s__id_fact=null;
        }
        
    }
    
    function evt__formulario__cobros($datos) {
        $this->set_pantalla('pant_cuadro_cobros');
        $this->dep('datos')->tabla($this->nombre_tabla)->cargar($datos);
        $this->s__id_fact=$datos['id_factura'];
    }
    
    //---- Cuadro -----------------------------------------------------------------------
    function evt__cuadro__cobros($datos) {//no se usa el boton
        $this->set_pantalla('pant_cuadro_cobros');
        $this->dep('datos')->tabla($this->nombre_tabla)->cargar($datos);
        $this->s__id_fact=$datos['id_factura'];
    }
    
    
//---- Cuadro cobros -----------------------------------------------------------------------


    function conf__cuadro_cobros(toba_ei_cuadro $cuadro) {
        //$this->dep('datos')->tabla($this->nombre_tabla)->sincronizar();
        if (!is_null($this->s__id_fact)) {    
            $datos = $this->dep('datos')->tabla($this->nombre_tabla)->get_listado_cobros($this->s__id_fact);
        } 
        $cuadro->set_datos($datos);
    }
    
}

?>