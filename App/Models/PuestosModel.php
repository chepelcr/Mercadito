<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class PuestosModel extends Model
{
	protected $nombreTabla = 'feria_organizaciones';
	protected $pk_tabla = 'id_puesto';

	protected $vistaTabla = 'puestos_view';

	protected $camposTabla = [
		'id_feria',
        'id_organizacion',
		'fecha_creacion',
		'fecha_modificacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $camposVista =[
		'nombre_feria',
		'nombre_organizacion',
		'descripcion',
		'logo',
		'telefono',
		'correo',
		'id_ubicacion',
		'cod_provincia',
		'cod_canton',
		'cod_distrito',
		'cod_barrio',
		'provincia',
		'canton',
		'distrito',
		'barrio',
		'otras_senias',
		'whatsapp',
		'cod_pais',
		'codigo_telefono',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;

	function obtener($id)
	{
		switch ($id) {
			case 'organizacion':
				$this->where('id_organizacion', getSession('id_organizacion'));
				return $this->getAll();
				break;

			case 'feria':
				$this->where('id_feria', getSession('id_feria'));
				return $this->getAll();
				break;

			case 'all':
				return $this->getAll();
				break;

			case 'activos':
				$this->where('estado', 1);
				return $this->getAll();
				break;
			
			default:
				$this->getById($id);
				break;
		}
	}
}//Fin de la clase