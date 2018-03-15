<?php

class formulario extends kimelu_ei_formulario {
    
    function extender_objeto_js() {
        echo "{$this->objeto_js}.evt__estado__procesar() = function()
            {
                var dni = this.ef('dni').get_estado();
                console.log(dni);
                if (estado === '2') {
                if () {
                       confirma = confirm('Estas seguro que ...?');
                }
                return confirma;
             }
             ";
    }
    
}
?>