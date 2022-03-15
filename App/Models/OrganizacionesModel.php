<?php
namespace App\Models;

use Core\Model;

/**Manejador de la tabla Empresas */
class OrganizacionesModel extends Model
{
    protected $nombreTabla = 'organizaciones';
    protected $vistaTabla = 'organizaciones_view';

    protected $pk_tabla = 'id_organizacion';

    protected $camposTabla = [
        'nombre',
        'descripcion',
        'logo',
        'telefono',
        'cod_pais',
        'correo',
        'id_ubicacion',
        'otras_senas',
        'whatsapp',
        'id_region',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'fecha_eliminacion',
        ];

    protected $camposVista = [
        'nombre_organizacion',
        'codigo_telefono',
        'cod_provincia',
        'cod_canton',
        'cod_distrito',
        'cod_barrio',
        'provincia',
        'canton',
        'distrito',
        'barrio',
    ];

    protected $auditorias = true;
    protected $autoIncrement = true;

    /**Obtener un cliente por numero de identificacion */
    public function getByIdentificacion($identificacion)
    {
        $this->where('identificacion', $identificacion);

        return $this->fila();
    }

    function getEmpresa()
    {
        return $this->getById(getSession('id_empresa'));
    }
}//Fin de la clase