<?php

namespace App\Controllers;

use App\Models\FeriasModel;
use App\Models\OrganizacionesModel;
use App\Models\TiposModel;
use App\Models\UbicacionesModel;
use Core\Permisos\PermisosModel;
use Core\Permisos\SubmodulosAccionesModel;

/**
 * Descripción: Controlador para la entidad usuario
 */
class Trueque extends BaseController
{
	protected $isModulo = true;

	protected $nombre_modulo = 'trueque';

	protected $objetos = ['organizaciones', 'ferias'];

	protected $campos_validacion = array(
		'organizaciones' => 'nombre_organizacion',
		'ferias' => 'nombre',
	);

	protected $validacion_login = array(
		'organizacion' => true,
		'ferias' => true,
	);

	/**Modulo de inicio de seguridad */
	public function index()
	{
		if (is_login()) {
			$script = '<script>
                $(document).ready(function(){
                    cargar_inicio_modulo("trueque");
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

	/**Obtener todos los organizaciones del sistema */
	public function organizaciones()
	{
		if (!is_login()) {
			header('Location: ' . baseUrl('login'));
		}

		if (!validar_permiso('trueque', 'organizaciones', 'consultar')) {
			$error = $this->object_error(403, 'No tiene permiso para realizar esta acción');

			return  $this->error($error);
		}

		switch (getsegment(3)) {
			case 'listado':
				$organizacionesModel = new OrganizacionesModel();
				$organizaciones = $organizacionesModel->obtener('all');

				$tiposOrganizacionModel = new TiposModel();
				$tiposOrganizacion = $tiposOrganizacionModel->obtener('organizaciones');

				$nombreTabla = 'trueque/organizaciones/table';

				$data_tabla = array(
					'nombreTable' => $nombreTabla,
					'nombre_tabla' => 'listado_trueque_organizaciones',
					'dataTable' => array(
						'organizaciones' => $organizaciones,
						'modulo' => 'trueque',
						'submodulo' => 'organizaciones',
						'objeto' => 'organizaciones',
					),
				);

				$ubicacionesModel = new UbicacionesModel();
				$provincias = $ubicacionesModel->provincias();

				$nombreForm = 'trueque/organizaciones/form';

				$data_form = array(
					'dataForm' => array(
						'panelUbicacion' => array(
							'provincias' => $provincias,
						),
						'panel_informacion' => array(
							'tipos_organizacion' => $tiposOrganizacion,
						),
					),
					'nombreForm' => $nombreForm,
					'nombre_form' => 'frm_trueque_organizaciones'
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
		} //Fin del switch
	} //Fin de la funcion para retornar las organizaciones del sistema

	/**Obtener todos los organizaciones del sistema */
	public function ferias()
	{
		if (!is_login()) {
			header('Location: ' . baseUrl('login'));
		}

		if (!validar_permiso('trueque', 'ferias', 'consultar')) {
			$error = $this->object_error(403, 'No tiene permiso para consultar ferias virtuales');

			return  $this->error($error);
		}

		switch (getsegment(3)) {
			case 'listado':
				$feriasModel = new FeriasModel();
				$organizaciones = $feriasModel->obtener('all');

				$tiposOrganizacionModel = new TiposModel();
				$tiposOrganizacion = $tiposOrganizacionModel->obtener('feria');

				$nombreTabla = 'trueque/organizaciones/table';

				$data_tabla = array(
					'nombreTable' => $nombreTabla,
					'nombre_tabla' => 'listado_trueque_ferias',
					'dataTable' => array(
						'organizaciones' => $organizaciones,
						'modulo' => 'trueque',
						'submodulo' => 'ferias',
						'objeto' => 'feria',
					),
				);

				$ubicacionesModel = new UbicacionesModel();
				$provincias = $ubicacionesModel->provincias();

				$nombreForm = 'trueque/ferias_virtuales/form';

				$data_form = array(
					'dataForm' => array(
						'panelUbicacion' => array(
							'provincias' => $provincias,
						),
						'panel_informacion' => array(
							'tipos_organizacion' => $tiposOrganizacion,
						),
					),
					'nombreForm' => $nombreForm,
					'nombre_form' => 'frm_trueque_ferias'
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
										cargar_listado('trueque', 'ferias', '" . baseUrl('trueque/organizaciones/listado') . "');
									});
								</script>"
				);

				return $this->inicio($data);
				break;
		} //Fin del switch
	} //Fin de la funcion para retornar las organizaciones del sistema

	/**Guardar un objeto en la base de datos */
	public function guardar($objeto = null)
	{
		if (is_login()) {
			if (!is_null($objeto) && in_array($objeto, $this->objetos)) {
				switch ($objeto) {
					case 'organizaciones':
						//Validar el permiso de acceso
						if (validar_permiso('trueque', 'organizaciones', 'insertar')) {
							$nombre_organizacion = post('nombre');

							$model = model('organizaciones');
							$model->where('nombre_organizacion', $nombre_organizacion);

							if (!$model->fila()) {
									$model = model('organizaciones');

									$data = array(
										'nombre' => post('nombre'),
										'id_tipo_organizacion' => post('id_tipo_organizacion'),
										'descripcion' => post('descripcion'),
										'correo' => post('correo'),
										'telefono' => post('telefono'),
										'estado' => 1,
										'id_ubicacion' => post('id_ubicacion'),
										'otras_senias' => post('otras_senias'),
										'cod_pais' => 52,
									);

									$id = $model->insert($data);

									if ($id) {
										return json_encode(array(
											'success' => true,
											'mensaje' => 'Organización creada con éxito',
										));
									} //Fin de validacion de id

									else
										return json_encode(array(
											'error' => 'No se pudo guardar la organizacion.',
										));
							} //Fin de validacion de correo
						} //Fin de validacion de permiso

						else
							return json_encode(array(
								'error' => 'No tiene permisos para realizar esta acción.',
							));
						break;

					case 'roles':
						$model = model('roles');

						$data = array(
							'nombre_rol' => post('nombre_rol'),
						);

						$id = $model->insert($data);

						if ($id != 0) {
							$submodulos_acciones_model = new SubmodulosAccionesModel();

							$modulos = $submodulos_acciones_model->modulos();

							//Recorrer modulos
							foreach ($modulos as $modulo) {
								$nombre_modulo = $modulo->nombre_modulo;
								$submodulos = $modulo->submodulos;

								//Recorrer submodulos
								foreach ($submodulos as $submodulo) {
									$nombre_submodulo = $submodulo->nombre_submodulo;
									$acciones = $submodulo->acciones;

									//Recorrer acciones
									foreach ($acciones as $accion) {
										$nombre_accion = $accion->nombre_accion;

										$data = array(
											'id_rol' => $id,
											'id_modulo' => $modulo->id_modulo,
											'id_submodulo' => $submodulo->id_submodulo,
											'id_accion' => $accion->id_accion,
											'estado' => 0
										);

										$model = new PermisosModel();

										$id_permiso = $model->insert($data);

										if (post('permiso_' . $nombre_modulo . '_' . $nombre_submodulo . '_' . $nombre_accion)) {
											$data = array(
												'estado' => 1
											);

											$model->update($data, $id_permiso);

											//var_dump('Estoy llegando a '.$nombre_modulo.'_'.$nombre_submodulo.'_'.$nombre_accion);
										}
									}
								}
							} //Fin del ciclo

							return json_encode(array(
								'success' => 'El rol se ha registrado correctamente',
							));
						} //Fin de validacion de id

						else
							return json_encode(array(
								'error' => 'No se pudo guardar el rol.',
							));
						break;
				} //Fin del switch
			} //Fin de la validacion

			return json_encode(array(
				'error' => 'Se ha generado un error en la solicitud',
			));
		} //Fin de la validacion de login

		else
			return json_encode(array(
				'error' => 'No se ha iniciado sesión',
			));
	} //Fin del metodo para guardar un objeto

	/**Actualizar un objeto de la base de datos */
	public function update($id, $objeto = null)
	{
		if (is_login()) {
			if ($id == 'perfil' || $id == 'contrasenia')
				$objeto = 'usuarios';

			if (!is_null($objeto) && in_array($objeto, $this->objetos)) {
				switch ($objeto) {
					case 'usuarios':
						switch ($id) {
							case 'perfil':
								$id = getSession('id_usuario');

								$data = array(
									'nombre' => post('nombre'),
									'apellidos' => post('apellidos'),
									'sexo' => post('sexo'),
									'correo' => post('correo'),
									'telefono' => post('telefono'),
									'id_ubicacion' => post('id_ubicacion'),
									'otras_senias' => trim(post('otras_senias')),
								);

								$model = $this->model('usuarios');

								if ($model->update($data, $id)) {
									setSession('nombre', post('nombre'));
									setSession('apellidos', post('apellidos'));
									setSession('correo', post('correo'));
									setSession('telefono', post('telefono'));

									return json_encode(array(
										'estado' => 1,
									));
								} //Fin de validacion de operacion

								else
									return json_encode(array(
										'error' => 'No se pudo actualizar el perfil',
									));
								break;

							default:
								//Si el usuario no tiene permisos para modificar
								if (!validar_permiso('seguridad', 'usuarios', 'modificar'))
									return json_encode(array(
										'error' => 'No tiene permisos para realizar esta acción.',
									));

								$data = array(
									'nombre' => post('nombre'),
									'apellidos' => post('apellidos'),
									'sexo' => post('sexo'),
									'correo' => post('correo'),
									'telefono' => post('telefono'),
									'id_nacionalidad' => post('id_nacionalidad'),
									'fecha_nacimiento' => post('fecha_nacimiento'),
								);

								$model = $this->model('usuarios');

								/**Si el id es diferente de 0 */
								if ($model->update($data, $id))
									return json_encode(array(
										'estado' => 1,
										'success' => 'Se actualizó el usuario correctamente.',
									));

								else
									return json_encode(array(
										'error' => 'No se pudo actualizar el usuario',
									));
								break;
						} //Fin del switch de id
						break;

						/**Roles */
					case 'roles':
						$data = array(
							'nombre_rol' => post('nombre_rol'),
						);

						$model = model('roles');

						if ($model->update($data, $id)) {
							$submodulosModel = new SubmodulosAccionesModel();

							$modulos = $submodulosModel->modulos();

							//Recorrer modulos
							foreach ($modulos as $modulo) {
								$id_modulo = $modulo->id_modulo;
								$nombre_modulo = $modulo->nombre_modulo;

								$submodulos = $modulo->submodulos;

								//Recorrer submodulos
								foreach ($submodulos as $submodulo) {
									$id_submodulo = $submodulo->id_submodulo;
									$nombre_submodulo = $submodulo->nombre_submodulo;

									$acciones = $submodulo->acciones;

									//Recorrer acciones
									foreach ($acciones as $accion) {
										$id_accion = $accion->id_accion;
										$nombre_accion = $accion->nombre_accion;

										$model = new PermisosModel();

										$id_permiso = $model->get_permiso($id, $id_modulo, $id_submodulo, $id_accion);

										$model = new PermisosModel();

										if (post('permiso_' . $nombre_modulo . '_' . $nombre_submodulo . '_' . $nombre_accion)) {
											$estado = 1;
										} else {
											$estado = 0;
										}

										if (!$id_permiso) {
											$data = array(
												'id_rol' => $id,
												'id_modulo' => $modulo->id_modulo,
												'id_submodulo' => $submodulo->id_submodulo,
												'id_accion' => $accion->id_accion,
												'estado' => $estado,
											);

											$model->insert($data);
										} else
											$model->update(array('estado' => $estado), $id_permiso);
									}
								}
							}

							return json_encode(array(
								'success' => 'Se actualizó el rol correctamente.',
							));
						} else
							return json_encode(array(
								'error' => 'No se pudo actualizar el rol',
							));
						break;
				} //Fin del switch de objeto
			} //Fin de la validacion

			else
				return json_encode(array(
					'error' => 'No se pudo actualizar el objeto',
				));
		} //Fin de la validacion de sesion

		return redirect(baseUrl());
	} //Fin del metodo para actualizar un objeto
}//Fin de la clase