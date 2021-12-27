<?php 
	/**
	* Descripción: Controlador para la entidad Rol
	*/

namespace App\Controllers;

use App\Models\PuntosVentaModel;

class Inicio extends BaseController
	{
		/** Devolver el inicio de la pagina web */
		public function index()
		{
			$nombreVista = 'inicio/index';

			$script = '<!-- Documentos -->
			<script src="'.getFile('dist/js/base/inicio.js').'"></script>';

			$data = array(
				'nombreVista'=>$nombreVista,
				'script'=>$script
			);
	
			return view('layout', $data);
		}//Fin de la funcion index
	}//Fin de la clase
?>