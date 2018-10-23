<?php
class formulario extends kimelu_ei_formulario {
	
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------
	function extender_objeto_js() {
		
		echo "{$this->objeto_js}.evt__nro_factura__procesar = function()
			{
                            if(this.ef('nro_factura').get_estado()!=''){
				if ((this.cascadas_maestros_preparados('monto_factura'))){
                                    this.cascadas_preparar_esclavo('monto_factura');
                                }
                            }
                        }
			"
		
		;
	}
}
?>