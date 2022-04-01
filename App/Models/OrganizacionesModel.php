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
        'id_tipo_organizacion',
        'otras_senias',
        'whatsapp',
        'url_facebook',
        'url_instagram',
        'url_youtube',
        'mision',
        'vision',
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
        'tipo_organizacion',
    ];

    protected $auditorias = true;
    protected $autoIncrement = true;
    
    public function obtener($id = 'all')
    {
        switch ($id) {
            case 'organizacion':
                return $this->getById(getSession('id_organizacion'));
                break;

            case 'ferias':
                return $this->where('id_tipo_organizacion', 4)->getAll();
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