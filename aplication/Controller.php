<?php

/**
 * @author Moises Olan Gonzalez <itic722014@gmail.com>
 *@version 1.0 Mi primera versión
 * @package Mi Framework
 * 
 * 
 * clase Appcontroller sirve para renderizar vistas, ademas de redireccionar
 * @param  string $_view es un atributo protegido de la clase
 * @param  string $db es el objeto de la clase PDO 
 */

abstract class Appcontroller
{
	protected $_view;
	protected $db;

	abstract public function index();

	public function __construct(){
		$this->_view = new View(new Request);
		$this->db = new classPDO();
	}

/**
	 * redirect sirve para hacer la redireccion de archivos
	 * @param   array $url tiene todos los parametros necesarios para realizar la redirección
	 * @var  string $path esta variable sirve para que almacene la ruta completa de la redirección
	 * **/

	protected function set($name = null, $value=array()){
		$GLOBALS[$name] = $value;
	}




	protected function redirect($url = array()){
		$path = "";

		if ($url['controller']) {
			$path .= $url['controller'];
		}
		if ($url['action']) {
			$path .= "/".$url['action'];
		}
		header("location: ".APP_URL.$path);

	}

}
