<?php

use Core\Config\Controllers;

/**Clase para manejar el routeo del controlador y acciones */
class Routes
{
	private $default_controller = '';
	private $default_action = '';

	public function __construct()
	{
		$this->init_load();
	}

	/**Carga inicial de la aplicacion */
	private function init_load()
	{
		require_once '../vendor/autoload.php';
		require_once '../Core/helper/load_helper.php';
	}//Fin de la funcion

	public function setDefault($controller, $action)
	{
		$this->default_controller = $controller;
		$this->default_action = $action;

		return $this;
	}//Fin del metodo para establecer el controlador y funcion por defecto

	/**función que llama al controlador y su respectiva acción, que son pasados como parámetros */
	private function call( $controller, $action )
	{

		$controller = "App\\Controllers\\".$controller;

		//crea el controlador
		$controller = new $controller();

		/**Validar el tipo de solicitud que entra a la aplicacion */
		switch($action)
		{
			/**Si se va a guardar un objeto */
			case 'guardar':
				/**Si la solicitud contiene datos */
				if(post())
					echo $controller->guardar();

				else
					header('Location: '.baseUrl(getSegment(1)));
			break;
			
			case 'update':
				if(post())
					echo $controller->update();

				else
					header('Location: '.baseUrl(getSegment(1)));
			break;

			case 'obtener':
				if(getSegment(3))
					echo $controller->obtener(getSegment(3));

				else
					header('Location: '.baseUrl(getSegment(1)));
			break;

			case 'index':
				echo $controller->index();
			break;
				
			default:
				echo $controller->{$action}();
			break;
		}//Fin del switch
	}//Fin de la funcion

	/**Realizar una solicitud a la aplicacion */
	public function llamar()
	{
		$default_controller = $this->default_controller;
		$default_action = $this->default_action;

		$controllers = new Controllers($default_controller, $default_action);

		$controller = $controllers->controller();
		$action = $controllers->accion();

		//Poner la primera letra en mayuscula
		$controller = ucfirst($controller);

		$lista_controller = $controllers->listar_metodos($controller);

		//verifica que el controlador obtenido desde la url esté dentro del arreglo controllers
		if ( array_key_exists( $controller, $lista_controller ) ) {
			//verifica que el arreglo controllers con la clave que es la variable controller del index exista la acción
			if (in_array($action, $lista_controller[$controller]) ) {
				//llama  la función call y le pasa el controlador a llamar y la acción (método) que está dentro del controlador
				$this->call( $controller, $action );
			}else{
				header('Location: '.baseUrl(getSegment(1)));
			}
		}

		else{
			// le pasa el nombre del controlador y la pagina de error
			$this->call ( $controllers->getDefaultController(), 'error');
		}
	}//Fin de la fucion
}//Fin de la clase
?>
