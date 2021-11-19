<?php
// la variable controller guarda el nombre del controlador y action guarda la acción por ejemplo registrar 
//si la variable controller y action son pasadas por la url desde layout.php entran en el if

require_once '../Core/Config/Routes.php';

/**Crear instancia de la clase rutas */
$app = new Routes();

/**Realizar una solicitud a la aplicacion */
$app->llamar();

?>
