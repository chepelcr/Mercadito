<?php
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de participantes */
class ParticipantesModel extends Model
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

	/**Obtener todos los participantes */
	public function getParticipantes()
	{
		return $this->where('id_rol', 2)->getAll();
	}

	/**Obtener por id */
	public function getById($id)
	{
		return $this->where('id_usuario', $id)->where('id_rol', 2)->fila();
	}//Fin de la función getById

	/**Obtener todos los participantes activos */
	function getParticipantesFeria()
	{
		return $this->where('estado', 1)->getAll();
	}//Fin de la función getParticipantesFeria
}//Fin de la clase
?>