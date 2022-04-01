<?php

/**Validar si una organizacion pertenece a una feria */
function pertenece_feria($id_feria = '')
{
    $puestosModel = model('Puestos');
    $puestosModel->where('id_feria', $id_feria)->where('id_organizacion', getSession('id_organizacion'));

    $puesto = $puestosModel->fila();

    if($puesto)
    {
        $estado = $puesto->estado;

        if($estado == 1)
        {
            return true;
        }
    }

    return false;
}//Fin de la funcion para validar si una organizacion pertenece a una feria

/**Validar si hau una feria activa en la página */
function feria_activa()
{
    return getSession('feria');
}