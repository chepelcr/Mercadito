<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class ProductosModel extends Model
{
	protected $nombreTabla = 'productos';
	protected $pk_tabla = 'id_producto';

	protected $camposTabla = [
        'id_organizacion',
		'nombre',
		'descripcion',
        'tipo',
        'precio',
        'imagen',
		'fecha_creacion',
		'fecha_modificacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;

	/**Obtener un producto para una organizacion */
	function obtener($id)
	{
		switch ($id) {
			case 'organizacion':
				$this->where('id_organizacion', getSession('id_organizacion'));
				return $this->getAll();
				break;

			case 'all':
				return $this->getAll();
				break;
			
			default:
				return $this->getById($id);
				break;
		}
	}
}//Fin de la clase