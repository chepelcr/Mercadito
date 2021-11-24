<?php
//Usar la base para el modelo que tenemos creado
namespace App\Models;

use Core\Model;

/** Modelo para la tabla de usuarios */
class PuestosModel extends Model
{
	protected $nombreTabla = 'puestos';
	protected $pk_tabla = 'id_puesto';

	protected $camposTabla = [
        'id_participante',
		'nombre_puesto',
		'descripcion',
        'imagen_puesto',
		'fecha_creacion',
		'fecha_modificacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;

    /**Obtener todos los productos de un participante por id */
    function getPuesto($id_participante)
    {
        return $this->where('id_participante', $id_participante)->fila();
    }//Fin de la función getProductos

    function getPuestosActivos()
    {
        return $this->where('estado', 1)->getAll();
    }//Fin de la función getProductos
}//Fin de la clase