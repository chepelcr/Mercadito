<?php

namespace App\Controllers;

use App\Librerias\Correo;
use App\Models\UsuariosModel;

/** Clase para iniciar sesion en la aplicacion */
class Contacto extends BaseController
	{
		/** Funcion para mostrar el login */
		public function index()
		{
			$nombreVista = 'contacto/contacto';

			$dataHead = array(
				'titulo' => 'Contacto',
			);

			$data = array(
				'nombreVista' => $nombreVista,
				'dataHead' => $dataHead,
			);

			return view('layout', $data);
		}//Fin de la funcion

		/**Registrar un nuevo usuario en el sistema */
		public function quienes_somos()
		{
			$nombreVista = 'contacto/quienes_somos';

			$data = array(
				'nombreVista' => $nombreVista,
			);

			return view('layout', $data);
		}//Fin de la funcion
	}//Fin del controlador de login

?>