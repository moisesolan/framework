<?php

/**
 * @author Moises Olan Gonzalez <itic722014@gmail.com>
 * @version 1.0 Mi primera versión
 * @package Mi Framework
 * 
 * 
 * */

/**
 * Esta es la clase Bootstrap
 */
class Bootstrap
{

	/**
	 * el run nos ejecuta la clase Request
	 * @param  string $peticion parametro que se recibe de Request
	 * @var  string controller nos almacena controlador
	 * @var  string rutaControlador se guarda en la ruta del controlador
	 * @var  string $metodo manda a llamar a la funcion getMetodo de request
	 * @var  string $args manda a llamar a la funcion getArgs de request
	 * */


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