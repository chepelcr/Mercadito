<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

/** Clase para iniciar sesion en la aplicacion */
class Login extends BaseController
	{
		/**Modulo de inicio de seguridad */
		public function index()
		{
			if(!is_login())
			{
				$script = '<script>
					$(document).ready(function(){
						//Esperar 5 segundos para mostrar login
						setTimeout(function(){
							cargar_login();
						}, 5000);
					});
				</script>';
			}

			elseif(getSession('contrasenia_expiro'))
			{
				$script = '<script>
					$(document).ready(function(){
						//Esperar 5 segundos para mostrar cambio de contraseña
						setTimeout(function(){
							cargar_cambio_contrasenia();
						}, 5000);
					});
				</script>';
			}

			else
			{
				//Cargar la pagina principal
				return redirect(baseUrl());
			}

			$data = array(
				'script' => $script,
			);

			return $this->inicio($data);
		} //Fin de la funcion index

		/** Funcion para consultar si el usuario existe en la base de datos */
		public function consultar()
		{
			$respuesta = array(
				'estado' => 0,
				'error' => 'Usuario o contraseña incorrectos.'
			);

			//Validar si el usuario ha iniciado sesion
			if (!is_login())
			{
				$user = post('user');
				$pswd = post('pswd');

				$usuariosModel = new UsuariosModel();

				$usuariosModel->where('correo', $user);
			
				$usuario = $usuariosModel->fila();

				if($usuario)
				{
					$estado_contrasenia = validar_contrasenia($usuario->id_usuario, $pswd);

					//Validar si la contrasenia es correcta
					switch ($estado_contrasenia)
					{
						case '1':
							$data = array(
								'id_usuario'=>$usuario->id_usuario,
								'nombre'=>$usuario->nombre,
								'correo'=>$usuario->correo,
								'telefono' => $usuario->telefono,
								'id_organizacion' => $usuario->id_organizacion,
								'id_tipo_organizacion' => $usuario->id_tipo_organizacion,
								'login' => true,
								'id_rol'=>$usuario->id_rol,
								'estado' => $usuario->estado,
							);
							
							setDataSession($data);

							$respuesta = array(
								'estado' => '1');
						break;

						case '2':
							$data = array(
								'id_usuario'=>$usuario->id_usuario,
								'nombre'=>$usuario->nombre,
								'correo' => $usuario->correo,
								'telefono' => $usuario->telefono,
								'id_organizacion' => $usuario->id_organizacion,
								'id_tipo_organizacion' => $usuario->id_tipo_organizacion,
								'id_rol'=>$usuario->id_rol,
								'login' => true,
								'id_estado' => $usuario->id_estado,
								'contrasenia_expiro' => true,
							);
							
							setDataSession($data);

							$respuesta = array(
								'estado' => '2',
								'error' => 'La contraseña ha expirado, debe cambiarla para continuar.');
						break;

						case '3':
							$respuesta = array(
								'estado' => '3',
								'error' => 'Debe esperar un momento para volver a intentar.');
						break;
					}//Fin del switch
				}//Fin del if

				return json_encode($respuesta);
			}//Fin de la validacion
			
			else
				return redirect(baseUrl());
		}//Fin de la funcion para consultar un usuario

		public function salir()
		{
			destroy();

			return json_encode(array(
				'estado' => '1',
			));
		}//Fin de la funcion


		public function olvido(){
			if(!is_login())
				return view('seguridad/login/olvido');

			else
				return redirect(baseUrl());
		}//Fin de la funcion

		/**Recuperar la contrasenia de un usuario */
		public function recuperar()
		{
			if(!is_login())
			{
				if(post('user'))
				{
					$correo = post('user');

					$usuariosModel = new UsuariosModel();

					$usuariosModel->where('correo', $correo);

					$usuario = $usuariosModel->fila();

					//Si el usuario existe inserte la data
					if($usuario)
					{
						return json_encode(enviar_contrasenia_temporal($usuario));
					}//Fin de la validacion del usuario

					return json_encode(
						array(
							'estado' => '0',
							'error' => 'El correo no existe.'
						)
					);
				}//Fin de la validacion

				return json_encode(
					array(
						'estado' => '0',
						'error' => 'No se ha ingresado el correo.'
					)
				);
			}//Fin de la validacion de logueo

			return json_encode(
				array(
					'estado' => '0',
					'error' => 'Ya ha iniciado sesión.'
				)
			);
		}//Fin del metodo para recuperar la contrasenia
	}//Fin del controlador de login

?>