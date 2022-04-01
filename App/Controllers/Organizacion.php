<?php

namespace App\Controllers;

use App\Librerias\FileUpload;
use App\Models\ProductosModel;
use App\Models\PuestosModel;
use App\Models\TiposModel;
use App\Models\TiposOrganizacionModel;

/** Clase para iniciar sesion en la aplicacion */
class Organizacion extends BaseController
{
	protected $isModulo = true;

	protected $nombre_modulo = 'organizacion';
	
	protected $objetos = ['productos', 'tipos'];

	protected $campos_validacion = array(
		'productos' => 'nombre_producto',
	);

	protected $validacion_login = array(
		'productos' => true,
	);

	/**Modulo de inicio de seguridad */
	public function index()
	{
		if (is_login()) {
			$script = '<script>
                $(document).ready(function(){
                    cargar_inicio_modulo("organizacion");
                });
            </script>';

			$data = array(
				'script' => $script,
			);

			return $this->inicio($data);
		} //Fin de la validacion

		else
			header('Location: ' . baseUrl('login'));
	} //Fin de la funcion index

	/**Obtener todos los productos de la organizacion */
	public function productos()
	{
		if(is_login())
		{
			if (!validar_permiso('organizacion', 'productos', 'consultar')) {
				$error = $this->object_error(403, 'No tiene permiso para realizar esta acción');
	
				return  $this->error($error);
			}
	
			switch (getsegment(3)) {
				case 'listado':
					$productosModel = new ProductosModel();
					$productos = $productosModel->obtener('organizacion');

					$nombreTabla = 'organizacion/productos/table';
	
					$data_tabla = array(
						'nombreTable' => $nombreTabla,
						'nombre_tabla' => 'listado_organizacion_productos',
						'dataTable' => array(
							'productos' => $productos,
							'modulo' => 'organizacion',
							'submodulo' => 'productos',
							'objeto' => 'producto',
						),
					);
	
					$nombreForm = 'organizacion/productos/form';
	
					$data_form = array(
						'dataForm' => array(
						),
						'nombreForm' => $nombreForm,
						'nombre_form' => 'frm_organizacion_productos'
					);
	
					$data = array(
						'data_tabla' => $data_tabla,
						'data_form' => $data_form,
					);
	
					return $this->listado($data);
					break;
	
				default:
					$data = array(
						'script' => "<script>
										$(document).ready(function(){
											cargar_listado('trueque', 'organizaciones', '" . baseUrl('trueque/organizaciones/listado') . "');
										});
									</script>"
					);
	
					return $this->inicio($data);
					break;
			}//Fin del switch
		}//Fin de validacion de login

		header('Location: ' . baseUrl('login'));
	}

	/**Obtener los tipos de organizaciones que se encuentran en el sistema */
	public function tipos()
	{
		if(is_login())
		{
			if (!validar_permiso('organizacion', 'tipos', 'consultar')) {
				$error = $this->object_error(403, 'No tiene permiso para realizar esta acción');
	
				return  $this->error($error);
			}
	
			switch (getsegment(3)) {
				case 'listado':
					$tiposModel = new TiposModel();
					$tipos = $tiposModel->obtener('all');

					$nombreTabla = 'organizacion/tipos/table';
	
					$data_tabla = array(
						'nombreTable' => $nombreTabla,
						'nombre_tabla' => 'listado_organizacion_tipos',
						'dataTable' => array(
							'tipos' => $tipos,
							'modulo' => 'organizacion',
							'submodulo' => 'tipos',
							'objeto' => 'tipo',
						),
					);
	
					$nombreForm = 'organizacion/tipos/form';
	
					$data_form = array(
						'dataForm' => array(
						),
						'nombreForm' => $nombreForm,
						'nombre_form' => 'frm_organizacion_tipos'
					);
	
					$data = array(
						'data_tabla' => $data_tabla,
						'data_form' => $data_form,
					);
	
					return $this->listado($data);
					break;
	
				default:
					$data = array(
						'script' => "<script>
										$(document).ready(function(){
											cargar_listado('trueque', 'organizaciones', '" . baseUrl('trueque/organizaciones/listado') . "');
										});
									</script>"
					);
	
					return $this->inicio($data);
					break;
			}//Fin del switch
		}//Fin de validacion de login

		header('Location: ' . baseUrl('login'));
	}

	//Guardar productos o puesto
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
									'warning' => 'Ha ocurrido un error al guardar la imagen: ' . $file->getError()
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
