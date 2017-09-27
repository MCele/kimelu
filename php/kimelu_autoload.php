<?php
/**
 * Esta clase fue y ser� generada autom�ticamente. NO EDITAR A MANO.
 * @ignore
 */
class kimelu_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static protected $clases = array(
                'abm_ci' => 'extension_toba/componentes/abm_ci.php',
                'kimelu_ci' => 'extension_toba/componentes/kimelu_ci.php',
		'kimelu_cn' => 'extension_toba/componentes/kimelu_cn.php',
		'kimelu_datos_relacion' => 'extension_toba/componentes/kimelu_datos_relacion.php',
		'kimelu_datos_tabla' => 'extension_toba/componentes/kimelu_datos_tabla.php',
		'kimelu_ei_arbol' => 'extension_toba/componentes/kimelu_ei_arbol.php',
		'kimelu_ei_archivos' => 'extension_toba/componentes/kimelu_ei_archivos.php',
		'kimelu_ei_calendario' => 'extension_toba/componentes/kimelu_ei_calendario.php',
		'kimelu_ei_codigo' => 'extension_toba/componentes/kimelu_ei_codigo.php',
		'kimelu_ei_cuadro' => 'extension_toba/componentes/kimelu_ei_cuadro.php',
		'kimelu_ei_esquema' => 'extension_toba/componentes/kimelu_ei_esquema.php',
		'kimelu_ei_filtro' => 'extension_toba/componentes/kimelu_ei_filtro.php',
		'kimelu_ei_firma' => 'extension_toba/componentes/kimelu_ei_firma.php',
		'kimelu_ei_formulario' => 'extension_toba/componentes/kimelu_ei_formulario.php',
		'kimelu_ei_formulario_ml' => 'extension_toba/componentes/kimelu_ei_formulario_ml.php',
		'kimelu_ei_grafico' => 'extension_toba/componentes/kimelu_ei_grafico.php',
		'kimelu_ei_mapa' => 'extension_toba/componentes/kimelu_ei_mapa.php',
		'kimelu_servicio_web' => 'extension_toba/componentes/kimelu_servicio_web.php',
		'kimelu_comando' => 'extension_toba/kimelu_comando.php',
		'kimelu_modelo' => 'extension_toba/kimelu_modelo.php',
	);
}
?>