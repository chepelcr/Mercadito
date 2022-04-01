<thead>
    <tr class="text-center">
        <th class="col-7">Nombre</th>
        <th class="col-2">Estado</th>
        <th class="col-3">Opciones</th>
    </tr>
</thead>

<tbody>
    <?php foreach ($organizaciones as $participante):
            if($participante->id_tipo_organizacion != 4 && $submodulo == 'organizaciones'):
        ?>
    <tr class="text-center">
        <td class="col-7"><?=$participante->nombre?></td>
        <td class="col-2">
            <?php 
                                    if($participante->estado == 1){
                                        echo '<span class="badge badge-success">Activo</span>';
                                    }elseif ($participante->estado == 2) {
                                        echo '<span class="badge badge-danger">Inactivo</span>';
                                    }elseif ($participante->estado == 3) {
                                        echo '<span class="badge badge-warning">Pendiente de verificacion</span>';
                                    }?>
        </td>
        <td class="col-3">
            <?= get_botones($participante->id_organizacion, 'organizacion', 'trueque', 'organizaciones',  $participante->estado) ?>
        </td>
        <!--Fin de las opciones-->
    </tr>
    <!--Fin de la fila-->
    <?php
        else:
            if($participante->id_tipo_organizacion == 4 && $submodulo == 'ferias'):
    ?>
            <tr class="text-center">
        <td class="col-7"><?=$participante->nombre?></td>
        <td class="col-2">
            <?php 
                                    if($participante->estado == 1){
                                        echo '<span class="badge badge-success">Activo</span>';
                                    }elseif ($participante->estado == 2) {
                                        echo '<span class="badge badge-danger">Inactivo</span>';
                                    }elseif ($participante->estado == 3) {
                                        echo '<span class="badge badge-warning">Pendiente de verificacion</span>';
                                    }?>
        </td>
        <td class="col-3">
            <?= get_botones($participante->id_feria, $objeto, $modulo, $submodulo,  $participante->estado) ?>
        </td>
        <!--Fin de las opciones-->
    </tr>
    <!--Fin de la fila-->
    <?php
            endif;


        endif;
    endforeach; ?>
    <!--Fin del ciclo-->
</tbody>
<!--/Cuerpo de la tabla-->