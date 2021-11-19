<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class UsuariosModel extends Model
{
	protected $nombreTabla = 'usuarios';
	protected $pk_tabla = 'id_usuario';

	protected $dbGroup = 'seguridad';

	protected $camposTabla = [
		'nombre',
		'apellidos',
		'tipo_identificacion',
		'cedula_usuario',
		'sexo',
		'correo',
		'telefono',
		'id_nacionalidad',
		'id_rol',
		'fecha_nacimiento',
		'fecha_registro',
		'fecha_actualizacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;

	//Obtener los usuarios de rol 1
	public function getUsuarios()
	{
		$this->where('id_rol', 1);

		return $this->getAll();
	}//fIN de la funcion
}//Fin de la clase
?>