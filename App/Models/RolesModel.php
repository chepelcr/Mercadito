<?php

namespace App\Models;

use Core\Model;
use Core\Permisos\PermisosModel;

/**
* Modelo para el acceso a la base de datos y funciones CRUD
*/
class RolesModel extends Model
{
	protected $nombreTabla = "roles";
	protected $pk_tabla = "id_rol";

	protected $dbGroup = 'seguridad';

	protected $camposTabla = [
		'nombre_rol',
		'id_tipo_rol',
		'fecha_creacion',
		'fecha_actualizacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $camposVista = [
		'tipo_rol',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;

	/**Obtener un rol de la base de datos */
	public function obtener($id)
	{
		switch ($id) {
			case 'all':
				return $this->getAll();
			break;

			case 'organizacion':
				return $this->where('id_tipo_rol', getSession('id_tipo_organizacion'))->getAll();
			
			default:
				$rol = $this->getById($id);

				$permisosModel = new PermisosModel();

				$rol->modulos = (object) $permisosModel->modulos($id);
				
				return $rol;
				break;
		}

		return null;
	}
}
?>