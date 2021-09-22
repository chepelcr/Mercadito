<?php
use Dotenv\Dotenv;

    /**Obtener una variable de entorno */
    function getEnt($name = false)
    {
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();

        if(!$name||!isset($_ENV[$name]))
        {
            return false;
        }

        return $_ENV[$name];
    }//Fin de la funcion

    /**Obtener el ambiente de la aplicacion */
    function getEnviroment()
    {
        return getEnt('app.ENVIROMENT');
    }

    function load_helpers($helpers = array(), $tipo = 'App')
    {
        if(is_array($helpers))
        {
            foreach ($helpers as $helper) {
                
            }//Fin de la inclusion de los helpers
        }
    }

    function load_helper($name='', $tipo='Core')
    {
        if($tipo='App')
        {
            $file = '../App/helper/'.$name.'_helper.php';
        }//Fin de la vaidacion

        else
            $file = '../Core/helper/'.$name.'_helper.php';

        if(file_exists($file))
        {
            require_once($file);

            return true;
        }

        return false;
    }//Fin de la funcion