<?php
    class dt_cursa extends kimelu_datos_tabla
    {
        //falta verrrr!!!
        //busca las carreras en las que está inscripto un alumno, 
        //puede ser de una unidad académica especifica o de toda la Universidad
        function get_carreras_alumno($id_est, $id_ua=NULL){
            $where= "";
            if(!is_null($id_ua)){
              $where = " and ca.id_ua = $id_ua";
            }
            $sql = "SELECT ca.id_carrera, ca.nombre "
                    ." FROM cursa cu inner join carrera ca on "
                    ."(cu.id_carrera=ca.id_carrera) "
                    . "where cu.id_estudiante = $id_est"
                    . $where;
            $datos = toba::db('kimelu')->consultar($sql);
            print_r($datos);
            return $datos;
        }
        
    }
    
?>