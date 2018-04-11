<?php

class formulario extends kimelu_ei_formulario {
    
    //-----------------------------------------------------------------------------------
    //---- JAVASCRIPT -------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    function extender_objeto_js() {
        
        echo "{$this->objeto_js}.evt__nro_factura__procesar = function()
            {
                var factura = this.ef('nro_factura').get_estado();
                console.log(factura);
                if (this.cascadas_maestros_preparados('monto_cobrado')) {
                    console.log('Entro a actualizar maestros');                   
                    this.cascadas_preparar_esclavo('monto_cobrado');
                    var monto = this.ef('monto_cobrado').get_estado();
                    console.log(monto);  
                    /*if(monto!='false'){
                        console.log('Si existe factura'); 
                    }
                    else{
                        console.log('No existe factura'); 
                        alert('No se encuentra la factura');
                    }*/
                }
                else{
                    console.log('No se alctualizaron maestros');
                }
             }
             {$this->objeto_js}.evt__monto_cobrado__procesar = function()
                 {
                        if (this.cascadas_maestros_preparados('monto_cobrado')) {
                           var m = this.ef('monto_cobrado').get_estado();
                           console.log('actualizo Monto');
                                console.log(m);
                                if(m===''){ 
                                    //this.ef('nro_factura').set_estado(0);
                                   // alert('No se encuentra la factura');
                                }
                        }
                 }
             "
        
        ;
    }
}
?>