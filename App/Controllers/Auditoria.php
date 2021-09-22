<?php 

namespace App\Controllers;

use Core\Auditorias\AuditoriaModel ;
use Core\Auditorias\ErroresModel;

/**
* Descripción: Controlador para la entidad usuario
*/
class Auditoria extends BaseController
	{
		public function auditorias()
		{
			if(is_login())
			{
				$auditoriaModel = new AuditoriaModel();

				$head = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/listado.js').'"></script>

				<script>
				$(document).on("click", "#btnAgregar", function(e) {
					e.preventDefault();
			
					mensajeAutomatico("Atencion", "Funcionalidad a implementar", "info");
				});
				</script>';

				$dataView = array(
					'auditorias'=> $auditoriaModel->getAll(),
				);


				$dataHead = array(
					'head'=>$head
				);

				$data = array(
					'nombreVista' => 'auditoria/listado',
					'dataView'=>$dataView,
					'dataHead'=> $dataHead,
					'script'=> $script
				);

				return view('layout', $data);
			}//Fin de la validacion
		}//Fin de la funcion para mostrar el listado de auditorias

		public function obtener($id)
		{
			if(is_login())
			{
				$auditoriaModel = new AuditoriaModel();
				$auditoria = $auditoriaModel->getById($id);

				return json_decode($auditoria);
			}//Fin de la validacion
		}//Fin de la funcion para obtener un error

		public function errores()
		{
			if(is_login())
			{
				$erroresModel = new ErroresModel();

				$errores = $erroresModel->getAll();
				
				$nombreVista = 'auditoria/errores';
				
				$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
            
                <!--Estilos-->
			    <link rel="stylesheet" type="text/css" href="'.getFile('dist/css/estilos.css').'">';

				$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="'.getFile('dist/js/listado.js').'"></script>';

				$dataView = array(
					'errores'=> $errores,
				);

				$dataHead = array(
					'head'=>$head
				);

				$data = array(
					'nombreVista' => $nombreVista,
					'dataView'=>$dataView,
					'dataHead'=> $dataHead,
					'script'=> $script
				);

				return view('layout', $data);
			}//Fin de la validacion
		}//Fin de la funcion para mostrar todos los errores

		public function obtener_error()
		{
			if(is_login())
			{
				$erroresModel = new ErroresModel();
				$error = $erroresModel->getById(getSegment(3));

				return json_decode($error);
			}//Fin de la validacion
		}//Fin de la funcion para obtener un error


	}//Fin de la clase