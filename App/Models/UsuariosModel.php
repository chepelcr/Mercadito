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
		'id_ubicacion',
		'otras_senias',
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
		return $this->where('id_rol', 1)->getAll();
	}//Fin de la función getAll

	//Obtener un usuario con rol 1, por su id
	public function getById($id)
	{
		return $this->where('id_rol', 1)->where('id_usuario', $id)->fila();
	}//Fin de la función getById
}//Fin de la clase
?>