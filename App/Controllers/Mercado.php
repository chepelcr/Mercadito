<?php

namespace App\Controllers;

use App\Librerias\Correo;
use App\Models\CodigosPaisesModel;
use App\Models\ParticipantesModel;
use App\Models\UbicacionesModel;
use App\Models\UsuariosModel;

/** Clase para iniciar sesion en la aplicacion */
class Mercado extends BaseController
{
	protected $isModulo = true;

	protected $nombre_modulo = 'mercado';

	protected $objetos = ['participantes', 'productos', 'producto'];

	protected $campos_validacion = array(
		'participantes' => 'cedula_participante',
	);

	/** Funcion para mostrar el login */
	public function index()
	{
		$nombreVista = 'mercadito/index';

		$script = '<!-- Mercado -->
				<script src="' . getFile('dist/js/mercado/mercado.js') . '"></script>';

		$data = array(
			'nombreVista' => $nombreVista,
			'script' => $script
		);

		return view('layout', $data);
	} //Fin de la funcion

	/**Mostrar los participantes de la feria */
	public function inscripciones()
	{
		if (!is_login()) {
			$nombreVista = 'mercadito/nueva_inscripcion';

			$data = array(
				'nombreVista' => $nombreVista,
			);

			return view('layout', $data);
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
				'titulo' => 'Inscripciones',
				'head' => $head
			);

			$panelInformacion = array(
				'nacionalidades' => $codigos_paises,
			);

			$panelUbicacion = array(
				'provincias' => $provincias,
			);

			$dataModal = array(
				'nombreForm' =>	'mercadito/frm_participante',
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
	}//Fin de la funcion

	public function productos()
	{
		if(is_login()&&!is_admin())
		{
			$nombreVista = 'mercadito/productos/listado';

			$head = '<!--DataTables-->
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>';

			$dataHead = array(
				'head' => $head,
				'titulo' => 'Productos',
			);

			$script = '<!--DataTables-->
				<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

				<!-- Listado -->
				<script src="' . getFile('dist/js/base/listado.js') . '"></script>

				<!-- Mercado -->
				<script src="' . getFile('dist/js/mercado/productos.js') . '"></script>';

			$data = array(
				'nombreVista' => $nombreVista,
				'dataHead' => $dataHead,
				'script' => $script
			);

			return view('layout', $data);
		}
	}

	public function validar($codigo = '', $objeto = null)
	{
		if (!is_login()) {
			return redirect(baseUrl('seguridad/login'));
		} //Fin del if

		else {
			if ($objeto == 'participantes') {
				return json_encode($this->validarParticipante($codigo));
			}
		} //Fin del else

		return json_encode(array('error' => true));
	} //Fin de la funcion

	/**Validar si un usuario ya se encuentra registrado */
	private function validarParticipante($cedula)
	{
		$usuariosModel = new UsuariosModel();

		$usuariosModel->where('cedula_usuario', $cedula)->where('id_rol', 2);

		if ($usuariosModel->fila())
			return true;

		return false;
	} //Fin de la funcion para validar si un usuario existe

	//Guardar participantes o productos
	public function guardar($objeto = null)
	{
		if (!is_login()) {
			return redirect(baseUrl());
		} //Fin del if

		else {
			switch ($objeto) {
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
		}
	} //Fin del metodo guardar
}//Fin del controlador de login
