<?php
// la variable controller guarda el nombre del controlador y action guarda la acción por ejemplo registrar 
//si la variable controller y action son pasadas por la url desde layout.php entran en el if

require_once '../Core/Config/Routes.php';

$default_controller = 'Inicio';
$default_action = 'index';

/**Crear instancia de la clase rutas */
$routes = new Routes();

$routes->setDefault($default_controller, $default_action);

/**Realizar una solicitud a la aplicacion */
$routes->llamar();

?>
