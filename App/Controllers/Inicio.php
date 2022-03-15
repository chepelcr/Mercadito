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
			return $this->inicio();
		}//Fin de la funcion index
	}//Fin de la clase
?>