<!--Panel para asignar los permisos de los modulos a un rol especifico -->
<div class="card card-permisos">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2 class="card-title">
                Permisos
            </h2>

            <i class="fas fa-user-lock"></i>
        </div>
    </div>

    <div class="card-body">
        <?php
            //Recorrer los modulos
            foreach ($modulos as $modulo) {
                echo view('seguridad/rol/elementos/permisos_modulo', array('modulo' => $modulo));
            }
        ?>
    </div>
</div>