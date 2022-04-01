<?php
    
namespace App\Controllers;

use Core\Controller;
use Core\Model;

class BaseController extends Controller
{
    protected $helpers = ['login', 'modulos','mercadito'];

    public function inicio($data = array())
    {
        $data = (object) $data;
        $data->modulos = getModulos();

        $feriasModel = model('Ferias');

        if(feria_activa())
        {
            $script = '<script>
                $(document).ready(function(){
                    id_feria_activo = '.getSession('id_feria').'
                });
            </script>';

            //Si la data tiene script, concatena el script
            if(isset($data->script))
                $data->script .= $script;
            else
                $data->script = $script;

            $nav = array(
                'nombre_feria' => getSession('nombre_feria'),
                'modulos' => $data->modulos
            );
        }

        else
        {
            $nav = array(
                'nombre_feria' => getEnt('app.nombre_feria'),
                'modulos' => $data->modulos
            );
        }

        $data_inicio = array(
            'modulos' => $data->modulos,
            'ferias' => $feriasModel->obtener('activas'),
        );

        $data->data_inicio = $data_inicio;
        $data->nav = $nav;

        return view('layout', $data);
    }//Fin de la funcion index

    protected function listado($data)
    {
        return view('base/listado', $data);
    }
}//Fin de la clase
