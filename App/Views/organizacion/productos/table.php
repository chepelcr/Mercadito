<!-- Listadp de productos de organizaciones -->
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
    if (isset($productos))
        foreach ($productos as $producto) :
    ?>
    <tr>
        <td>
            <?php echo $producto->nombre; ?>
        </td>
        <td>
            <?php echo $producto->descripcion; ?>
        </td>
        <td>
        <?= get_botones($producto->id_producto, 'producto', 'organizacion', 'productos',  $producto->estado) ?>
        </td>
    </tr>
    <?php
        endforeach;
    ?>
</tbody>