<?php

namespace App\Controllers;

use App\Librerias\FileUpload;
use App\Models\ParticipantesModel;
use App\Models\ProductosModel;
use App\Models\PuestosModel;

/** Clase para iniciar sesion en la aplicacion */
class Mercado extends BaseController
{
	protected $isModulo = true;

	protected $nombre_modulo = 'mercado';

	protected $objetos = ['productos', 'puestos'];

	/** Funcion para mostrar el mercadito */
	public function index()
	{
		$nombreVista = 'mercadito/mercado/listado';

		$puestosModel = new PuestosModel();
		$puestos = $puestosModel->getPuestosActivos();

		$dataHead = array(
			'titulo' => 'Mercadito del trueque',
		);

		$dataView = array(
			'puestos' => $puestos,
		);

		$script = '<!-- Mercado -->
				<script src="' . getFile('dist/js/mercado/mercado.js') . '"></script>';

		$data = array(
			'nombreVista' => $nombreVista,
			'dataView' => $dataView,
			'dataHead' => $dataHead,
			'script' => $script
		);

		return view('layout', $data);
	} //Fin de la funcion

	/**Mostrar la informacion del puesto de un participante */
	public function puesto()
	{
		if(!is_login())
			return redirect('mercado');

		$puestosModel = new PuestosModel();
		$puesto = $puestosModel->getPuesto(getSession('id_usuario'));

		$nombreVista = 'mercadito/participantes/puesto';

		$dataHead = array(
			'titulo' => 'Puesto',
		);

		$dataView = array(
			'puesto' => $puesto,
		);

		$script = '<!-- Mercado -->
				<script src="' . getFile('dist/js/mercado/puesto.js') . '"></script>';

		$data = array(
			'nombreVista' => $nombreVista,
			'dataView' => $dataView,
			'dataHead' => $dataHead,
			'script' => $script
		);

		return view('layout', $data);
	}

	public function catalogo()
	{
		if(is_login())
		{
			$productosModel = new ProductosModel();
			$productos = $productosModel->getProductos(getSession('id_usuario'));

			$nombreVista = 'mercadito/productos/listado';

			$head = '<!--DataTables-->
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>';

			$dataHead = array(
				'head' => $head,
				'titulo' => 'Catalogo',
			);

			$script = '<!--DataTables-->
				<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>

				<!-- Mercado -->
				<script src="' . getFile('dist/js/mercado/productos.js') . '"></script>';

			$dataModal = array(
				'nombreForm' =>	'mercadito/productos/form',
			);

			$dataView = array(
				'productos' => $productos,
				'dataModal'	=> $dataModal,
			);

			$data = array(
				'nombreVista' => $nombreVista,
				'dataHead' => $dataHead,
				'dataView' => $dataView,
				'script' => $script
			);

			return view('layout', $data);
		}

		return redirect('mercado');
	}

	//Guardar productos
	public function guardar($objeto = null)
	{
		if (!is_login()) {
			return redirect(baseUrl());
		} //Fin del if

		else {
			switch ($objeto) {
				case 'productos':
					if(post())
					{
						$data = array(
							'id_participante' => getSession('id_usuario'),
							'nombre' => post('nombre'),
							'descripcion' => post('descripcion'),
							'tipo' => post('tipo'),
							'precio' => post('precio')
						);

						$productosModel = new ProductosModel();
						$id = $productosModel->insert($data);

						if($id)
						{
							$file = new FileUpload($_FILES["nombre_imagen"]);

							$target_dir = "productos\\";

							$target_name = getSession('id_usuario')."_" . post('nombre');
							
							if($file->subir_imagen($target_name, $target_dir))
							{
								$nombre_imagen = $target_name . "." . $file->getExtension();

								$data = array(
									'id_producto' => $id,
									'nombre_imagen' => $nombre_imagen
								);

								$productosModel->update($data);

								return json_encode(array(
									'success' => 'El producto se ha guardado correctamente.'
								));
							} else {
								return json_encode(array(
									'estado' => 2,
									'error' => 'Ha ocurrido un error al guardar la imagen.'
								));
							}
						}

						return json_encode(array(
							'error' => 'Ha ocurrido un error al guardar el producto.'
						));
					}
				break;

				case 'puestos':
					if(post())
					{
						$data = array(
							'id_participante' => getSession('id_usuario'),
							'nombre_puesto' => post('nombre_puesto'),
							'descripcion' => post('descripcion'),
						);

						$puestosModel = new PuestosModel();
						$id = $puestosModel->insert($data);

						if($id)
						{
							//Si la imagen_puesto no continene una archivo
							if(isset($_FILES["imagen_puesto"]) && $_FILES["imagen_puesto"]['name'] == '')
							{
								return json_encode(array(
									'success' => 'El puesto se ha guardado correctamente.'
								));
							}
							 
							else {
								$file = new FileUpload($_FILES["imagen_puesto"]);

								$target_dir = "puestos\\";

								$target_name = getSession('id_usuario')."_" . post('nombre_puesto');
								
								if($file->subir_imagen($target_name, $target_dir))
								{
									$nombre_imagen = $target_name . "." . $file->getExtension();

									$data = array(
										'imagen_puesto' => $nombre_imagen
									);

									$puestosModel->update($data, $id);

									return json_encode(array(
										'success' => 'El puesto se ha guardado correctamente.'
									));
								} else {
									return json_encode(array(
										'estado' => 2,
										'error' => 'Ha ocurrido un error al guardar la imagen.'
									));
								}
							}
						}
					}
				break;
			} //Fin del switch
		}
	} //Fin del metodo guardar
}//Fin del controlador de login
