<?php
    
namespace App\Controllers;

use Core\Controller;
use Core\Model;

class BaseController extends Controller
{
    protected $helpers = ['login', 'modulos'];

    public function inicio($data = array())
    {
        $data = (object) $data;
        $data->modulos = getModulos();

        return view('layout', $data);
    }//Fin de la funcion index

    protected function listado($data)
    {
        return view('base/listado', $data);
    }
}//Fin de la clase
