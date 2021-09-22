<?php

namespace App\Controllers;

/** Clase para iniciar sesion en la aplicacion */
class Inicio extends BaseController
	{
		/** Funcion para mostrar el login */
		public function index()
		{
			$nombreVista = 'inicio/index';

			$data = array(
				'nombreVista' => $nombreVista,
			);

			return view('layout', $data);
		}//Fin de la funcion
	}//Fin del controlador de login

?>