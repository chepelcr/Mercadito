<!-- Listadp de productos de un usuario -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php
                            echo view('mercadito/nav', array('objeto'=>'producto'));
                        ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" id="listado">
                        <thead class=" text-primary">
                            <th>
                                Nombre
                            </th>
                            <th>
                                Descripcion
                            </th>

                            <th>
                                Acciones
                            </th>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($productos))
                                    foreach ($productos as $producto):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $producto->nombre; ?>
                                </td>
                                <td>
                                    <?php echo $producto->descripcion; ?>
                                </td>
                                <td>
                                    <!-- Ver informacion-->
                                    <button class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Ver información" id="ver" value="<?=$producto->id_producto?>"
                                        type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Modificar -->
                                    <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Modificar" id="modificar" value="<?=$producto->id_producto?>"
                                        type="button">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <!-- Cambiar imagen -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Cambiar imagen" id="cambiarImagen" value="<?=$producto->id_producto?>"
                                        type="button">
                                        <i class="fas fa-image"></i>
                                    </button>

                                    <?php
                                        //Si el estado es 1, eliminar
                                        if ($producto->estado == 1)
                                            echo '<button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Desactivar" id="desactivar" value="'.$producto->id_producto.'" type="button">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>';

                                        //Si el estado es 0, activar
                                        else
                                            echo '<button class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Activar" id="activar" value="'.$producto->id_producto.'" type="button">
                                                <i class="fas fa-check"></i>
                                            </button>';
                                    ?>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de listado de productos de un usuario -->

<!--Modal para agregar o modificar un usuario-->
<?php
    
    echo view('base/form', $dataModal);    
?>