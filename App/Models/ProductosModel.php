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
        'id_participante',
		'nombre',
		'descripcion',
        'tipo',
        'precio',
        'nombre_imagen',
		'fecha_creacion',
		'fecha_modificacion',
		'fecha_eliminacion',
		'estado',
	];

	protected $autoIncrement = true;

	protected $auditorias = true;

    /**Obtener todos los productos de un participante por id */
    function getProductos($id_participante)
    {
        return $this->where('id_participante', $id_participante)->getAll();
    }//Fin de la función getProductos
}//Fin de la clase