<!-- Permisos -->
<div class="card card-permisos-modulo card-permisos-<?=$modulo->nombre_modulo?>">
    <div class="card-header">
        <h4 class="card-title">
            <?= ucfirst(str_replace('_', ' ',$modulo->nombre_modulo))?>
        </h4>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa-solid <?= $modulo->icono?>"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Recorrer los submodulos de sucursal -->
            <?php
                $nom_modulo = $modulo->nombre_modulo;

                foreach ($modulo->submodulos as $submodulo) 
                {
                    $nom_submodulo = $submodulo->nombre_submodulo;

                    if($nom_submodulo == 'configuracion' && $nom_modulo != 'organizacion' || $nom_submodulo == 'usuarios')
                    {
                        echo '<div class="col-md-12';
                    }

                    else
                    {
                        switch ($nom_modulo) {
                            case 'organizacion':
                                echo '<div class="col-md-6';
                                break;
    
                            case 'administracion':
                                echo '<div class="col-md-6';
                                break;
    
                            case 'trueque':
                                echo '<div class="col-md-6';
                                break;
    
                            default:
                                echo '<div class="col-md-4';
                                break;
                        }
                    }

                    echo ' col-permisos-submodulo col-'.$nom_modulo.'-'.$nom_submodulo.'">';
            ?>
                <div class="card card-permisos-<?=$nom_modulo?>-<?=$nom_submodulo?> card-permisos-submodulo">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">
                                <?= ucfirst(str_replace('_', ' ', $submodulo->nombre_submodulo))?>
                            </h5>

                            <i class="fa-solid <?= $submodulo->icono?>"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dropdown d-flex justify-content-around">
                            <!-- Recorrer los permisos del modulo y mostrar checkbox-->
                            <?php
                                foreach ($submodulo->acciones as $permiso)
                                {
                                    $nom_permiso = $permiso->nombre_accion;
                            ?>
                                
                            <!--Agregar un boton -->
                            <button type="button"
                            class="btn btn-secondary inp btn-permiso btn_<?='permiso_'.$modulo->nombre_modulo.'_'.$submodulo->nombre_submodulo.'_'.$permiso->nombre_accion; ?>" 
                            data-toggle="tooltip" title="<?= ucfirst($permiso->nombre_accion)?>"
                            onclick="marcar_permiso('<?=$modulo->nombre_modulo?>', '<?=$submodulo->nombre_submodulo?>', '<?=$permiso->nombre_accion?>')">
                                <i class="fa-solid <?= $permiso->icono?>"></i>
                            </button>

                            <div class="form-group form-check" hidden>
                                <input type="checkbox" class="form-check-input inp inp-chk"
                                    id="<?='permiso_'.$modulo->nombre_modulo.'_'.$submodulo->nombre_submodulo.'_'.$permiso->nombre_accion; ?>"
                                    name="<?='permiso_'.$modulo->nombre_modulo.'_'.$submodulo->nombre_submodulo.'_'.$permiso->nombre_accion; ?>">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>