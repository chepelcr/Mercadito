<?php

use App\Librerias\Correo;
use App\Models\ContraseniaModel;
use App\Models\UsuariosModel;

	/** Validar si el usuario ha iniciado sesion */
    function is_login()
    {
		return getSession();
		//return true;
    }//Fin de la validacion para el login

	/**Generar una contraseña aleatoriamente */
	function generar_password_complejo($largo)
	{
		$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$cadena_base .= '0123456789' ;
		$cadena_base .= '!@#%&*';
		  
		$password = '';
		$limite = strlen($cadena_base) - 1;
		  
		for ($i=0; $i < $largo; $i++)
		  $password .= $cadena_base[rand(0, $limite)];
		  
		return $password;
	}//Fin del metodo para generar una contraseña aleatoriamente

	/**Encriptar un texto */
	function encriptar_texto($texto)
	{
		$key = 'sistema_inventario';
		$result = '';
		$texto = utf8_encode($texto);
		for($i=0; $i<strlen($texto); $i++)
		{
			$char = substr($texto, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}//Fin del metodo para encriptar un texto

	/**Desencriptar un texto */
	function desencriptar_texto($texto)
	{
		$key = 'sistema_inventario';
		$result = '';
		$texto = base64_decode($texto);
		for($i=0; $i<strlen($texto); $i++)
		{
			$char = substr($texto, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return utf8_decode($result);
	}//Fin del metodo para desencriptar un texto

	//Validar si un texto esta vacio
	function validar($texto)
	{
		if($texto && $texto != '')
			return true;
		
		return false;
	}//Fin de la funcion para validar si un texto esta vacio

	/**Validar la contrasenia de un usuario */
	function validar_contrasenia($id_usuario, $pswd)
	{

		$contraseniaModel = new ContraseniaModel();
		$contraseniaModel->where('id_usuario', $id_usuario);

		$contrasenia = $contraseniaModel->fila();

		//Si la contrasenia esta bloqueada
		if($contrasenia->bloqueado == 1)
		{
			//Validar fecha de bloqueo
			if($contrasenia->fecha_desbloqueo > date('Y-m-d H:i:s'))
			{
				return 3;
			}
		}

		elseif($pswd == desencriptar_texto($contrasenia->contrasenia))
		{
			//Si la fecha de expiracion es menor a la fecha actual
			if($contrasenia->fecha_expiracion < date('Y-m-d H:i:s'))
			{
				return 2;
			}//Fin de validacion de expiracion

			//Si la contrasenia esta bloqueada
			elseif($contrasenia->bloqueado == 1)
			{
				//Validar fecha de bloqueo
				if($contrasenia->fecha_desbloqueo < date('Y-m-d H:i:s'))
				{
					//Desbloquear la contrasenia
					$data = array(
						'bloqueado' => 0,
						'intentos_fallidos' => 0,
						'fecha_bloqueo' => null,
						'fecha_desbloqueo'=> null
					);

					$contraseniaModel = new ContraseniaModel();
					$contraseniaModel->update($data, $contrasenia->id_contrasenia);

					return 1;
				}//Fin de validacion de fecha de bloqueo

				return 3;
			}//Fin de validacion de bloqueo

			else
				return 1;
		}//Fin de validacion de contrasenia

		//Si la contrasenia no coincide
		else
		{
			//Aumentar los interntos fallidos
			$contrasenia->intentos_fallidos = $contrasenia->intentos_fallidos + 1;

			//Si el usuario tiene mas de 5 intentos fallidos
			if($contrasenia->intentos_fallidos>=5)
			{
				//Bloquear la cuenta
				$data = array(
					'intentos_fallidos'=>$contrasenia->intentos_fallidos,
					'bloqueado' => 1,
					'fecha_bloqueo' => date('Y-m-d H:i:s'),
					'fecha_desbloqueo'=> date('Y-m-d H:i:s', strtotime('+1 minutes'))
				);

				$contraseniaModel = new ContraseniaModel();
				$contraseniaModel->update($data, $contrasenia->id_contrasenia);

				return 3;
			}//Fin de validacion de intentos

			//Actualizar los intentos fallidos
			$data = array(
				'intentos_fallidos'=>$contrasenia->intentos_fallidos
			);

			$contraseniaModel = new ContraseniaModel();
			$contraseniaModel->update($data, $contrasenia->id_contrasenia);

			return 0;
		}//Fin de actualizacion de intentos fallidos
	}//Fin del metodo para validar la contraseña

	/**Enviar una contrasenia temporal a un usuario por correo electronico */
	function enviar_contrasenia_temporal($usuario)
	{
		$pass = generar_password_complejo(8);

		$contraseniaModel = new ContraseniaModel();
		$contrasenia = $contraseniaModel->contrasenia($usuario->id_usuario);

		if($contrasenia)
		{
			$data = array(
				'contrasenia' => encriptar_texto($pass),
				'fecha_expiracion' => date('Y-m-d H:i:s')
			);

			$contraseniaModel = new ContraseniaModel();
			$id = $contraseniaModel->update($data, $contrasenia->id_contrasenia);
		}//Fin de validacion de contrasenia

		else
		{
			$data = array(
				'id_usuario' => $usuario->id_usuario,
				'contrasenia' => $pass,
				'fecha_expiracion' => date('Y-m-d H:i:s'),
				'estado' => 1
			);

			$contraseniaModel = new ContraseniaModel();
			$id = $contraseniaModel->insert($data);
		}//Fin de validacion de contrasenia

		if($id!=0)
		{
			$correos = array(
				$usuario->nombre => $usuario->correo,
			);

			$mensaje = 'Estimado ' . $usuario->nombre . ',
			<br>
			
			Su clave temporal es "<b>'. $pass .'</b>", debe cambiarla la proxima vez que inicie sesión.
			<br>

			Presione el siguiente enlace para iniciar sesión:
			<br>
			<a href="' . baseUrl('login') . '">Iniciar sesion</a>
			<br>
			<br>
			Saludos,
			<br>
			<br>
			<b>Equipo de Red de Trueque</b>';

			$data = array(
				'receptor' => $correos,
				'asunto' => 'Cambio de contraseña',
				'body' => $mensaje
			);

			$correo = new Correo();

			if($correo->enviarCorreo($data))
				return array('estado' => 1,
							 'mensaje' => 'Se ha enviado un correo electronico con la nueva contraseña.');

			else
			{
				//Volver a colocar la contraseña anterior si hay una contraseña ya establecida
				if($contrasenia)
				{
					$data = array(
						'contrasenia' => $contrasenia->contrasenia,
						'fecha_expiracion' => $contrasenia->fecha_expiracion
					);

					$contraseniaModel = new ContraseniaModel();
					$id = $contraseniaModel->update($data, $contrasenia->id_contrasenia);
				}//Fin de validacion de contrasenia

				return array('estado' => 0,
								 'mensaje' => 'No se pudo enviar el correo electronico con la nueva contraseña.');
			}//Fin de validacion de envio de correo electronico
		}//Fin de validacion de id
		
		else
			return array('estado' => 0,
						 'mensaje' => 'No se ha podido actualizar la contraseña.');
	}//Fin del metodo para enviar una contrasenia temporal a un usuario

	/**Obtener el perfil del usuario que ha iniciado sesion */
	function getPerfil()
	{
		if(is_login())
		{
			$usuariosModel = new UsuariosModel();
			$perfil = $usuariosModel->getPerfil();

			$datos_personales = array(
				'nombre' => $perfil->nombre,
				'identificacion' => $perfil->identificacion,
				'id_tipo_identificacion' => $perfil->id_tipo_identificacion,
				'cod_pais' => $perfil->cod_pais,
				'identificaciones'=>array(
					(object) array( 
						'id_tipo_identificacion' => $perfil->id_tipo_identificacion,
						'tipo_identificacion' => $perfil->tipo_identificacion ),
				),
				'codigos'=>
					array(
						(object) array( 
							'cod_pais' => $perfil->cod_pais,
							'nombre' => $perfil->nombre_pais ),
					),
			);

			$datos_contacto = array(
				'telefono' => $perfil->telefono,
				'correo' => $perfil->correo,
			);

			$datos_usuario = array(
				'id_organizacion' => $perfil->id_organizacion,
				'organizaciones' => array(
					(object) array( 
						'id_organizacion' => $perfil->id_organizacion, 
						'nombre' => $perfil->nombre_organizacion),
				),
				'id_rol' => $perfil->id_rol,
				'roles' => array(
					(object) array( 
						'id_rol' => $perfil->id_rol, 
						'nombre_rol' => $perfil->nombre_rol ),
				),
			);

			$arrayPerfil = array(
				'datos_personales' => $datos_personales,
				'datos_contacto' => $datos_contacto,
				'datos_usuario' => $datos_usuario,
			);

			return $arrayPerfil;
		}

		return false;
	}//Fin del metodo para obtener el perfil del usuario