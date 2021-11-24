<?php

namespace App\Controllers;

use App\Librerias\Correo;
use App\Models\CodigosPaisesModel;
use App\Models\ParticipantesModel;
use App\Models\UbicacionesModel;
use App\Models\UsuariosModel;
use Core\Auditorias\AuditoriaModel;
use Core\Auditorias\ErroresModel;

/**
 * Descripción: Controlador para la entidad usuario
 */
class Seguridad extends BaseController
{
	protected $isModulo = true;

	protected $nombre_modulo = 'seguridad';

	protected $objetos = ['usuarios', 'participantes'];

	protected $campos_validacion = array(
		'usuarios' => 'cedula_usuario',
	);

	protected $validacion_login = array(
		'usuarios' => true,
	);

	/**Guardar un objeto en la base de datos */
	public function guardar($objeto = null)
	{
		if (is_login()) {
			if (!is_null($objeto) && in_array($objeto, $this->objetos)) {
				switch ($objeto) {
					case 'usuarios':
						//Validar el permiso de acceso
						if (is_admin()) {
							if ($this->validarUsuario(post('cedula_usuario'))) {
								return json_encode(array(
									'error' => 'El usuario indicado ya se encuentra registrado',
								));
							} //Fin de validacion de cedula

							else {
								$model = $this->model('usuarios');

								$pass = generar_password_complejo(10);
								//$pass = 1234;

								$data = array(
									'nombre' => post('nombre'),
									'apellidos' => post('apellidos'),
									'tipo_identificacion' => post('tipo_identificacion'),
									'cedula_usuario' => post('cedula_usuario'),
									'sexo' => post('sexo'),
									'correo' => post('correo'),
									'telefono' => post('telefono'),
									'id_nacionalidad' => post('id_nacionalidad'),
									'id_rol' => 1,
									'fecha_nacimiento' => post('fecha_nacimiento'),
									'estado' => 1,
								);

								$id = $model->insert($data);

								if ($id != 0) {
									$data_pass = array(
										'id_usuario' => $id,
										'contrasenia' => encriptar_texto($pass),
										'fecha_expiracion' => date('Y-m-d H:i:s'),
										'estado' => 1
									);

									$model = $this->model('contrasenia');

									$id_contrasenia = $model->insert($data_pass);

									//Si el id de la contraseña es mayor a cero, se envia el correo
									if ($id_contrasenia != 0) {
										$mensaje = 'Estimado ' . post('nombre') . ' ' . post('apellidos') . '<br><br>
											
											Se ha completado su registro en la plataforma del Mercadito de Trueque. <br> Su usuario es <b>' . post('correo') . '</b> y su contraseña es <b>' . $pass . '</b>. 
											Debe realizar el cambio de la contraseña la primera vez que inicia sesión.';

										$data = array(
											'receptor' => post('correo'),
											'asunto' => 'Registro de usuario',
											'body' => $mensaje
										);

										$correo = new Correo();

										if ($correo->enviarCorreo($data))
											return json_encode(array(
												'success' => 'El usuario se ha registrado correctamente',
											));
										else
											return json_encode(array(
												'error' => 'No se pudo enviar el correo, debe indicar contraseña manualmente: ' + $pass,
											));
									} //Fin de validacion de id_contrasenia

									else
										return json_encode(array(
											'error' => 'No se pudo guardar la contraseña.',
										));
								} //Fin de validacion de id

								else
									return json_encode(array(
										'error' => 'No se pudo guardar el usuario.',
									));
							} //Fin de validacion de cedula
						} //Fin de validacion de permiso

						else
							return json_encode(array(
								'error' => 'No tiene permisos para realizar esta acción.',
							));
						break;

						//Participantes
						case 'participantes':
							if ($this->validarParticipante(post('cedula_usuario'))) {
								return json_encode(array(
									'error' => 'La cedula indicada ya se encuentra en uso.',
								));
							} //Fin de validacion de cedula
		
							elseif (!validarCorreo(post('correo'))) {
								$model = $this->model('participantes');
		
								$pass = generar_password_complejo(10);
								//$pass = 1234;
		
								$data = array(
									'nombre' => post('nombre'),
									'apellidos' => post('apellidos'),
									'tipo_identificacion' => post('tipo_identificacion'),
									'cedula_usuario' => post('cedula_usuario'),
									'sexo' => post('sexo'),
									'correo' => post('correo'),
									'telefono' => post('telefono'),
									'id_nacionalidad' => post('id_nacionalidad'),
									'id_rol' => 2,
									'id_ubicacion' => post('id_ubicacion'),
									'otras_senias' => post('otras_senias'),
									'fecha_nacimiento' => post('fecha_nacimiento'),
									'estado' => 2,
								);
		
								$id = $model->insert($data);
		
								if ($id != 0) {
									$data_pass = array(
										'id_usuario' => $id,
										'contrasenia' => encriptar_texto($pass),
										'fecha_expiracion' => date('Y-m-d H:i:s'),
										'estado' => 1
									);
		
									$model = $this->model('contrasenia');
		
									$id_contrasenia = $model->insert($data_pass);
		
									//Si el id de la contraseña es mayor a cero, se envia el correo
									if ($id_contrasenia != 0) {
										//Vlidar el genero del participante
										//Estimado, Estimada, Estimade
										if(post('sexo') == 'M')
											$genero = 'Estimado';
										elseif(post('sexo') == 'F')
											$genero = 'Estimada';
										else
											$genero = 'Estimade';
		
										$mensaje = $genero.' ' . post('nombre') . ' ' . post('apellidos') . '<br><br>
													
													Se ha completado su registro en la plataforma del Mercadito de Trueque. <br> 
													Para completar su registro, debe subir una copia de su documento de identidad y una foto de su perfil. <br>
		
													Su usuario es el siguiente: <br>
													Usuario: ' . post('correo') . ' <br>
													Contraseña: ' . $pass . ' <br> <br>
		
													Para ingresar al sistema, debe hacer click en el siguiente enlace: <br>
													<a href:"' . baseUrl('login') . '">Mercadito del Trueque</a> <br> <br>';
		
										$data = array(
											'receptor' => post('correo'),
											'asunto' => 'Registro de usuario',
											'body' => $mensaje
										);
		
										$correo = new Correo();
		
										if ($correo->enviarCorreo($data))
											return json_encode(array(
												'success' => 'El usuario se ha registrado correctamente',
											));
										else
											return json_encode(array(
												'error' => 'No se pudo enviar el correo, debe indicar contraseña manualmente: ' + $pass,
											));
									} //Fin de validacion de id_contrasenia
		
									else
										return json_encode(array(
											'error' => 'No se pudo guardar la contraseña.',
											'then' => 'location.reload();'
										));
								} //Fin de validacion de id
		
								else
									return json_encode(array(
										'error' => 'No se pudo guardar el usuario.',
									));
							} //Fin de validacion de correo
		
							else
								return json_encode(array(
									'error' => 'El correo ya se encuentra registrado.',
								));
		
							break;
				} //Fin del switch
			} //Fin de la validacion

			return json_encode(array(
				'error' => 'Se ha generado un error en la solicitud',
			));
		} //Fin de la validacion de login

		else
			return redirect(baseUrl());
	} //Fin del metodo para guardar un objeto

	public function validar($codigo = '', $objeto = null)
	{
		if (!is_login()) {
			return redirect(baseUrl('seguridad/login'));
		} //Fin del if

		else {
			if ($objeto == 'participantes') {
				return json_encode($this->validarParticipante($codigo));
			}

			elseif ($objeto == 'usuarios') {
				return json_encode($this->validarUsuario($codigo));
			}
		} //Fin del else

		return json_encode(false);
	} //Fin de la funcion

	/**Validar si un usuario ya se encuentra registrado */
	private function validarParticipante($cedula)
	{
		$usuariosModel = new ParticipantesModel();

		$usuariosModel->where('cedula_usuario', $cedula)->where('id_rol', 2);

		if ($usuariosModel->fila())
			return true;

		return false;
	} //Fin de la funcion para validar si un usuario existe

	/**Cambiar la contrasenia de un usuario */
	private function actualizar_contrasenia($id, $pass, $old_pass)
	{
		$id_usuario = $id;

		$model = $this->model('contrasenia');

		$contrasenia = $model->where('id_usuario', $id_usuario)->fila();

		//Si la contrasenia actual es correcta
		if ($old_pass == desencriptar_texto($contrasenia->contrasenia)) {
			//Si la nueva contrasenia es igual a la actual
			if ($pass == desencriptar_texto($contrasenia->contrasenia))
				return json_encode(array(
					'error' => 'La nueva contraseña no puede ser igual a la actual',
				));

			elseif (validar($pass)) {
				$data = array(
					'contrasenia' => encriptar_texto($pass),
					'fecha_expiracion' => date('Y-m-d H:i:s', strtotime('+1 year')),
					'estado' => 1
				);

				$model = $this->model('contrasenia');

				$id = $model->update($data, $contrasenia->id_contrasenia);

				if ($id != 0) {
					setSession('contrasenia_expiro', false);

					$model = $this->model('usuarios');

					$correo = getSession('correo');

					$mensaje = 'Estimado ' . getSession('nombre') . ',
							<br>
							
							Se ha cambiado su contraseña en la plataforma de inventario. <br> Su nueva contraseña es <b>' . $pass . '</b>.';

					$data = array(
						'receptor' => $correo,
						'asunto' => 'Cambio de contraseña',
						'body' => $mensaje
					);

					$correo = new Correo();

					if ($correo->enviarCorreo($data))
						return json_encode(array(
							'estado' => '1',
						));

					else
						return json_encode(array(
							'error' => 'No se pudo enviar el correo',
						));
				} //Fin de validacion de envio

				else
					return json_encode(array(
						'error' => 'No se pudo cambiar la contraseña',
					));
			} //Fin de validacion de contrasenia nueva

			else
				return json_encode(array(
					'error' => 'La contraseña no cumple con los requisitos',
				));
		} //Fin de validacion de contrasenia correcta

		else
			return json_encode(array(
				'error' => 'La contraseña actual no es correcta',
			));
	} //Fin del metodo para cambiar la contrasenia

	/**Enviar una contraseña temporal a un usuario */
	public function enviar_contrasenia()
	{
		if (getSegment(3)) {
			//Validar permiso
			if (!is_admin())
				return json_encode(array(
					'error' => 'No tiene permisos para realizar esta acción.',
				));

			$id_usuario = getSegment(3);

			$model = $this->model('usuarios');
			$usuario = $model->getById($id_usuario);

			if ($usuario) {
				$estado = enviar_contrasenia_temporal($usuario);

				if ($estado != 1)
					return json_encode(array(
						'estado' => 1,
					));

				else
					return json_encode(array(
						'error' => $estado,
					));
			} //Fin de validacion de usuario

			else
				return json_encode(array(
					'error' => 'No se encontro el usuario',
				));
		} else
			return json_encode(array(
				'error' => 'No se ha indicado el usuario',
			));
	} //Fin del metodo para enviar una contraseña temporal

	/**Validar si un usuario ya se encuentra registrado */
	private function validarUsuario($cedula)
	{
		$usuariosModel = new UsuariosModel();

		$usuariosModel->where('cedula_usuario', $cedula);

		if ($usuariosModel->fila())
			return true;

		return false;
	} //Fin de la funcion para validar si un usuario existe

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
									'id_nacionalidad' => post('id_nacionalidad'),
									'id_ubicacion' => post('id_ubicacion'),
									'otras_senias' => trim(post('otras_senias')),
									'fecha_nacimiento' => post('fecha_nacimiento'),
								);

								$model = $this->model('usuarios');
								
								if(!is_admin())
									$model = $this->model('participantes');

								if ($model->update($data, $id) != 0) {
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

							case 'contrasenia':
								$id = getSession('id_usuario');

								return $this->actualizar_contrasenia($id, post('conf_pswd'), post('pswd'));
								break;

							default:
								//Si el usuario no tiene permisos para modificar
								if (!is_admin())
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

								$model = $this->model($objeto);
								$id = $model->update($data, $id);

								/**Si el id es diferente de 0 */
								if ($id != 0) {
									return json_encode(array(
										'estado' => '1',
									));
								} //Fin de la validacion del id

								/**Si el id es 0 */
								else {
									$error = $model->getError();

									return json_encode(array(
										'error' => $error->sentencia,
									));
								} //Fin de la validacion del id
								break;
						} //Fin del switch de id
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

	public function index()
	{
		if (!is_login())
			return redirect(baseUrl());

		if (is_admin()) {
			$usuariosModel = new UsuariosModel();
			$usuarios = $usuariosModel->getUsuarios();

			$codigosPaisesModel = new CodigosPaisesModel();
			$codigos_paises = $codigosPaisesModel->getAll();

			$nombreVista = 'seguridad/usuario/listado';

			$head = '<!--DataTables-->
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>';

			$script = '<!--DataTables-->
			<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
				
				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>
				
				<!-- Usuarios -->
				<script src="' . getFile('dist/js/seguridad/usuarios.js') . '"></script>';

			$nombreForm = 'seguridad/usuario/form';

			$panelInformacion = array(
				'nacionalidades' => $codigos_paises,
			);

			$dataModal = array(
				'nombreForm' =>	$nombreForm,
				'dataForm' => array(
					'panelInformacion' => $panelInformacion,
				),
			);

			$dataView = array(
				'usuarios' => $usuarios,
				'dataModal' => $dataModal
			);

			$dataHead = array(
				'titulo' => 'Administradores',
				'head' => $head
			);

			$data = array(
				'nombreVista' => $nombreVista,
				'dataView' => $dataView,
				'dataHead' => $dataHead,
				'script' => $script
			);

			return view('layout', $data);
		} //Fin de la validacion

		else {
			$error = $this->object_error(500, 'No tiene permisos para acceder a esta página.');

			return $this->error($error);
		}
	} //Fin de la funcion para retornar los usuarios del sistema

	/**Mostrar los participantes de la feria */
	public function participantes()
	{
		if (!is_login()) {
			return redirect(baseUrl());
		} //Fin del if

		elseif (!is_admin()) {
			return redirect(baseUrl('seguridad/perfil'));
		} else {
			$nombreVista = 'mercadito/participantes/listado';

			$participantesModel = new ParticipantesModel();
			$participantes = $participantesModel->getParticipantes();

			$codigosPaisesModel = new CodigosPaisesModel();
			$codigos_paises = $codigosPaisesModel->getAll();

			$ubicacionesModel = new UbicacionesModel();
			$provincias = $ubicacionesModel->provincias();

			$head = '<!--DataTables-->
				<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>';

			$script = '<!--DataTables-->
				<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
					
					<!-- Listado -->
					<script src="' . getFile('dist/js/base/listado.js') . '"></script>

					<!-- Ubicaciones-->
					<script src="' . getFile('dist/js/base/ubicaciones.js') . '"></script>
					
					<!-- Inscripciones -->
					<script src="' . getFile('dist/js/mercado/inscripciones.js') . '"></script>';

			$dataHead = array(
				'titulo' => 'Participantes',
				'head' => $head
			);

			$panelInformacion = array(
				'nacionalidades' => $codigos_paises,
			);

			$panelUbicacion = array(
				'provincias' => $provincias,
			);

			$dataModal = array(
				'nombreForm' =>	'mercadito/participantes/form',
				'dataForm' => array(
					'panelInformacion' => $panelInformacion,
					'panelUbicacion' => $panelUbicacion,
				),
			);

			$dataView = array(
				'participantes' => $participantes,
				'dataModal'	=> $dataModal,
			);

			$data = array(
				'nombreVista' => $nombreVista,
				'dataView' => $dataView,
				'script' => $script,
				'dataHead' => $dataHead
			);

			return view('layout', $data);
		}
	} //Fin de la funcion

	public function perfil()
	{
		if (is_login()) {

			$script = '<!-- Contrasenia-->
					<script src="' . getFile('dist/js/seguridad/contrasenia.js') . '"></script>

					<!-- Perfil de usuario -->
					<script src="' . getFile('dist/js/seguridad/perfil.js') . '"></script>
					
					<!-- Ubicaciones-->
					<script src="' . getFile('dist/js/base/ubicaciones.js') . '"></script>';

			if (!is_admin()) {
				$usuariosModel = new ParticipantesModel();
				$perfil = $usuariosModel->getById(getSession('id_usuario'));
			} else {
				$usuariosModel = new UsuariosModel();
				$perfil = $usuariosModel->getById(getSession('id_usuario'));
			}

			$ubicacionesModel = new UbicacionesModel();
			$ubicacion = $ubicacionesModel->getById($perfil->id_ubicacion);

			$ubicacionesModel = new UbicacionesModel();
			$provincias = $ubicacionesModel->provincias();

			$ubicacionesModel = new UbicacionesModel();
			$cantones = $ubicacionesModel->cantones($ubicacion->cod_provincia);

			$ubicacionesModel = new UbicacionesModel();
			$distritos = $ubicacionesModel->distritos($ubicacion->cod_provincia, $ubicacion->cod_canton);

			$ubicacionesModel = new UbicacionesModel();
			$barrios = $ubicacionesModel->barrios($ubicacion->cod_provincia, $ubicacion->cod_canton, $ubicacion->cod_distrito);

			$ubicacion->provincias = $provincias;
			$ubicacion->cantones = $cantones;
			$ubicacion->distritos = $distritos;
			$ubicacion->barrios = $barrios;
			$ubicacion->otras_senias = $perfil->otras_senias;

			$perfil->ubicacion = $ubicacion;

			$codigosPaisesModel = new CodigosPaisesModel();
			$codigos_paises = $codigosPaisesModel->getAll();

			$perfil->nacionalidades = $codigos_paises;

			$dataHead = array(
				'titulo' => 'Perfil de usuario',
			);

			$dataForm = array(
				'nombreForm' => 'seguridad/perfil/contrasenia'
			);

			$dataView = array(
				'perfil' => $perfil,
				'dataForm' => $dataForm,
			);

			$data = array(
				'nombreVista' => 'seguridad/perfil/perfil',
				'dataHead' => $dataHead,
				'dataView' => $dataView,
				'script' => $script
			);

			return view('layout', $data);
		} //Fin de la validacion

		else
			header('Location: ' . baseUrl());
	} //Fin de la funcion para retornar el perfil del usuario

	public function auditorias()
	{
		if (is_login()) {
			$auditoriaModel = new AuditoriaModel();

			$head = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

			$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>

				<script>
				$(document).on("click", "#btnAgregar", function(e) {
					e.preventDefault();
			
					mensajeAutomatico("Atencion", "Funcionalidad a implementar", "info");
				});
				</script>';

			$dataView = array(
				'auditorias' => $auditoriaModel->getAll(),
			);


			$dataHead = array(
				'head' => $head,
				'titulo' => 'Auditorias',
			);

			$titulo = 'Seguridad';
			$objeto = 'Auditorias';
			$pagina = 'Listado';

			$dataHeader = array(
				'titulo' => $titulo,
				'objeto' => $objeto,
				'pagina' => $pagina
			);

			$data = array(
				'nombreVista' => 'seguridad/auditoria/listado',
				'dataView' => $dataView,
				'dataHeader' => $dataHeader,
				'dataHead' => $dataHead,
				'script' => $script
			);

			return view('layout', $data);
		} //Fin de la validacion
	} //Fin de la funcion para mostrar el listado de auditorias

	public function errores()
	{
		if (is_login()) {
			$erroresModel = new ErroresModel();

			$errores = $erroresModel->getAll();

			$nombreVista = 'seguridad/auditoria/errores';

			$head = '<!--DataTables-->
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">';

			$script = '<!--DataTables-->
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
				
				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>';

			$dataView = array(
				'errores' => $errores,
			);

			$dataHead = array(
				'head' => $head,
				'titulo' => 'Errores',
			);

			$titulo = 'Seguridad';
			$objeto = 'Auditorias';
			$pagina = 'Errores';

			$dataHeader = array(
				'titulo' => $titulo,
				'objeto' => $objeto,
				'pagina' => $pagina
			);

			$data = array(
				'nombreVista' => $nombreVista,
				'dataView' => $dataView,
				'dataHeader' => $dataHeader,
				'dataHead' => $dataHead,
				'script' => $script
			);

			return view('layout', $data);
		} //Fin de la validacion
	} //Fin de la funcion para mostrar todos los errores
}//Fin de la clase