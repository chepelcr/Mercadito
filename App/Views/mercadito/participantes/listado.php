<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php
                        echo view('mercadito/nav', array('submodulo'=>'inscripciones','objeto'=>'participante'));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <!--Card-->
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <table class="table table-striped" id="listado">
                        <thead>
                            <tr class="text-center">
                                <th class="col-3">Numero de cédula</th>
                                <th class="col-5">Nombre completo</th>
                                <th class="col-3">Estado</th>
                                <th class="col-1">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($participantes as $participante):?>
                            <tr class="text-center">
                                <td><?=$participante->cedula_usuario?></td>
                                <td><?=$participante->nombre.' '.$participante->apellidos?></td>
                                <td>
                                    <?php 
                                    if($participante->estado == 1){
                                        echo '<span class="badge badge-success">Activo</span>';
                                    }elseif ($participante->estado == 2) {
                                        echo '<span class="badge badge-danger">Inactivo</span>';
                                    }elseif ($participante->estado == 3) {
                                        echo '<span class="badge badge-warning">Pendiente de verificacion</span>';
                                    }?>
                                </td>
                                <td>
                                    <!-- Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Opciones
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <!-- Ver informacion-->
                                            <button class="dropdown-item" id="ver"
                                                value="<?=$participante->id_usuario?>" type="button">Ver
                                                información</button>

                                            <!-- Modificar -->
                                            <button class="dropdown-item" id="modificar"
                                                value="<?=$participante->id_usuario?>" type="button">Modificar</button>

                                            <!-- Enviar contrasenia -->
                                            <button class="dropdown-item" id="enviar"
                                                value="<?=$participante->id_usuario?>" type="button">Enviar
                                                contraseña</button>

                                            <!-- Si el estado del usuario es 1, 2 o 3 -->
                                            <?php 
                                                if ($participante->estado == 1)
                                                    echo '<button class="dropdown-item" id="desactivar" value="'.$participante->id_usuario.'" type="button">Desactivar</button>';

                                                else if ($participante->estado == 2)
                                                    echo '<button class="dropdown-item" id="activar" value="'.$participante->id_usuario.'" type="button">Activar</button>';

                                                else if ($participante->estado == 3)
                                                    echo '<button class="dropdown-item" id="validar" value="'.$participante->id_usuario.'" type="button">Validar informacion</button>';
                                            ?>
                                        </div>
                                    </div>
                                </td>
                                <!--Fin de las opciones-->
                            </tr>
                            <!--Fin de la fila-->
                            <?php endforeach;?>
                            <!--Fin del ciclo-->
                        </tbody>
                        <!--/Cuerpo de la tabla-->
                    </table>
                    <!--/Table-->
                </div>
            </div>
            <!--/Card body-->
        </div>
        <!--/Card-->
    </div>
</div>

<!--Modal para agregar o modificar un usuario-->
<?php
    
    echo view('base/form', $dataModal);    
?>