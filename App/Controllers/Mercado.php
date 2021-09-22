<?php

namespace App\Controllers;

/** Clase para iniciar sesion en la aplicacion */
class Mercado extends BaseController
	{
		/** Funcion para mostrar el login */
		public function index()
		{
            $nombreVista = 'catalogo/mercado';

			$script = '<!-- Mercado -->
				<script src="'.getFile('js/mercado.js').'"></script>';

			$data = array(
				'nombreVista' => $nombreVista,
				'script'=>$script
			);

			return view('layout', $data);
		}//Fin de la funcion
	}//Fin del controlador de login

?>