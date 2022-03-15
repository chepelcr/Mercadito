<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class UsuariosModel extends Model
{
	protected $nombreTabla = 'usuarios';
	protected $vistaTabla = 'usuarios_view';

	protected $pk_tabla = 'id_usuario';

	protected $dbGroup = 'seguridad';

	protected $camposTabla = [
		'nombre',
		'apellidos',
		'id_tipo_identificacion',
		'identificacion',
		'genero',
		'correo',
		'telefono',
		'cod_pais',
		'id_rol',
		'id_organizacion',
		'id_ubicacion',
		'otras_senias',
		'fecha_nacimiento',
		'fecha_registro',
		'fecha_actualizacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $camposVista = [
        'tipo_identificacion',
        'codigo_telefono',
        'nombre_pais',
		'nombre_organizacion',
		'nombre_rol',
    ];

	protected $autoIncrement = true;

	protected $auditorias = true;

	//Obtener los usuarios de rol 1
	public function getUsuarios()
	{
		return $this->where('id_rol', 1)->getAll();
	}//Fin de la función getAll

	public function getPerfil()
	{
		return $this->getById('2');
	}
}//Fin de la clase
?>