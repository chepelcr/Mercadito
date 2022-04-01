<?php
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de tipos de organizacion */
class TiposModel extends Model
{
	protected $nombreTabla = 'tipos_organizacion';
	protected $pk_tabla = 'id_tipo_organizacion';

	protected $camposTabla = [
		'tipo_organizacion',
		'fecha_creacion',
		'fecha_modificacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;

	public function obtener($id)
	{
		switch ($id) {
			case 'all':
				return $this->getAll();
				break;
			
			default:
				return $this->getById($id);
				break;

			case 'feria':
				$this->where('id_tipo_organizacion', 4);
				
				return $this->getAll();
				break;

			case 'organizaciones':
				$this->vista('tipos_organizaciones_vista');
				$this->where('estado', 1);

				return $this->getAll();
				break;
		}
	}
}//Fin de la clase
?>