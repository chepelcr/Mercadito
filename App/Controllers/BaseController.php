<?php
    
namespace App\Controllers;

require_once('../App/helper/login_helper.php');

use Core\Controller;

class BaseController extends Controller
{
    public function error()
    {
        $nombreVista = 'error/error';

        $data = array(
            'nombreVista'=>$nombreVista,
        );

        return view('layout', $data);
    }//Fin de la funcion error
}//Fin de la clase
