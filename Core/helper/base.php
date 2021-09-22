<?php

use Core\Auditorias\Auditorias;

/**Retornar la direccion web de la aplicacion */
function baseUrl($ext = false)
{
    if($ext)
    {
        return getEnt('app.URL').$ext;
    }

    return getEnt('app.URL');
}//Fin de la funcion

function insertError($data)
{
    $auditorias = new Auditorias();
    $auditorias->insertError($data);
}//Fin de la funcion

function insertAuditoria($data)
    {
        $auditorias = new Auditorias();
        $auditorias->insertAuditoria($data);
    }//Fin de la funcion

/**Obtener un segmento de la url */
function getSegment($num = 0)
{
    /**Direccion de solicitud */
    $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    /**Direccion base de la aplicacion */
    $baseUrl = parse_url(baseUrl(), PHP_URL_PATH);

    /**Si ambas direcciones son iguales*/
    if($requestUrl == $baseUrl)
        return  '' ;

    /**Segementos de la direccion base */
    $baseSegments = explode("/", $baseUrl);

    /**Segmentos de la direccion de solicitud */
    $uriSegments = explode("/", $requestUrl);

    /**Contar los segmentos de la aplicacion base */
    $baseSegments = count($baseSegments)-2;
    
    if(isset($uriSegments[$baseSegments+$num]))
        return $uriSegments[$baseSegments+$num];

    return false;
}