<?php
namespace App\Models;

use Core\Model;

/**Manejador de la tabla Feria Virtual */
class FeriasModel extends Model
{
    protected $nombreTabla = 'feria_virtual';
    protected $vistaTabla = 'ferias_virtuales_view';

    protected $pk_tabla = 'id_feria';

    protected $camposTabla = [
        'id_organizacion',
        'cod_pais',
        'id_ubicacion',
        'otras_senias',
        'fecha_apertura',
        'fecha_cierre',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'fecha_eliminacion',
        ];

    protected $camposVista = [
        'nombre',
        'descripcion',
        'logo',
        'telefono',
        'id_tipo_organizacion',
        'url_facebook',
        'url_instagram',
        'url_youtube',
        'mision',
        'vision',
        'correo',
        'whatsapp',
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
    
    public function obtener($id = 'all')
    {
        switch ($id) {
            case 'all':
                return $this->getAll();
                break;
            
            default:
                return $this->getById($id);
                break;

            case 'activas':
                return $this->where('estado', 1)->getAll();
                break;
        }
    }
}//Fin de la clase