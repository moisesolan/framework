<?php

class Bootstrap
{
	public static function run(Request $peticion){
		$controller = $peticion->getControlador().'Controller';
		$rutaControlador = ROOT.'controllers'. DS . $controller . '.php';
		$metodo = $peticion->getMetodo();
		$args = $peticion->getArgs();

		/*echo $rutaControlador;
		exit;*/
		if (is_readable($rutaControlador)) {
			include_once $rutaControlador;
			$controlador = new $controller;

				if (is_callable(array($controller, $metodo))) {
					$metodo = $peticion->getMetodo();
				}else{
					$metodo = 'index';
				}

				if ($metodo =='login') {
					
				}else{
					Authorization::logged();
				}


				if(isset($args)){
					call_user_func_array(array($controlador, $metodo), $args);
				}else{
					call_user_func_array(array($controller, $metodo));
				}
		}else{
			throw new Exception("Controlador no encontrado");
			
		}

	}
}