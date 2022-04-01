<!-- Listadp de productos de organizaciones -->
<thead class=" text-primary">
    <th>
        ID
    </th>
    <th>
        Nombre
    </th>

    <th>
        Estado
    </th>

    <th>
        Acciones
    </th>
</thead>
<tbody>
    <?php
    if (isset($tipos))
        foreach ($tipos as $tipo) :
    ?>
    <tr>
        <td>
            <?php echo $tipo->id_tipo_organizacion; ?>
        </td>
        <td>
            <?php echo $tipo->tipo_organizacion; ?>
        </td>
        <td>
            <?php if ($tipo->estado == 1) : ?>
            <i class="fas fa-lightbulb text-success"></i>
            <?php else : ?>
            <i class="fas fa-lightbulb text-danger"></i>
            <?php endif; ?>
        </td>
        <td>
        <?= get_botones($tipo->id_tipo_organizacion, 'tipo', 'organizacion', 'tipos',  $tipo->estado) ?>
        </td>
    </tr>
    <?php
        endforeach;
    ?>
</tbody>