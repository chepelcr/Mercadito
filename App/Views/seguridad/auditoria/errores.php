<!--Card-->
<div class="card">
    <div class="card-header">
        <nav class="nav nav-pills flex-column flex-sm-row">
            <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad/errores')?>">Errores</a>
            <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad/auditorias')?>">Auditorias</a>
        </nav>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover text-center" id="listado">
            <thead>
                <tr>
                    <th>Fecha del error</th>
                    <th>Tabla</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($errores as $error):?>
                <tr>
                    <td><?=$error->createdAt?></td>
                    <td><?=$error->controlador?></td>
                    <td class="text-left"><?=$error->sentencia?></td>
                </tr>
                <!--Fin de la fila-->
                <?php endforeach;?>
                <!--Fin del ciclo-->
            </tbody>
            <!--/Cuerpo de la tabla-->
        </table>
        <!--/Table-->
    </div>
    <!--/Card body-->
</div>
<!--/Card-->