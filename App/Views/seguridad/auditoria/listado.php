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
                    <th>Fecha</th>
                    <th>Tabla</th>
                    <th>Fila</th>
                    <th>Accion</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auditorias as $auditoria):?>
                <tr>
                    <td><?=$auditoria->created_at?></td>
                    <td><?=$auditoria->tabla?></td>
                    <td><?=$auditoria->id_fila?></td>
                    <td><?=$auditoria->accion?></td>
                    <td><?=$auditoria->nombre_usuario?> </td>
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
    <!--/Card body-->
</div>
<!--/Card-->