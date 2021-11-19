<!-- Listadp de productos de un usuario -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php
                            echo view('mercadito/nav');
                        ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="listado">
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
                                    <?php echo $producto->precio; ?>
                                </td>
                                <td>
                                    <?php echo $producto->cantidad; ?>
                                </td>
                                <td>
                                    <?php echo $producto->total; ?>
                                </td>
                                <td>
                                    <?php echo $producto->fecha; ?>
                                </td>
                                <td>
                                    <a href="<?php echo baseUrl(); ?>productos/editar/<?php echo $producto->id_producto; ?>"
                                        class="btn btn-success btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?php echo baseUrl(); ?>productos/eliminar/<?php echo $producto->id_producto; ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>