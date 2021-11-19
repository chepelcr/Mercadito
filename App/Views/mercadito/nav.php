<?php
if(is_admin()):
?>

<div class="col-md-9">
    <nav class="nav nav-pills flex-column flex-sm-row text-center">
        <a class="flex-sm-fill text-sm-center nav-link " href="<?=baseUrl('mercado/inscripciones')?>">Participantes</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('seguridad')?>">Administradores</a>
    </nav>
</div>

<div class="col-md-3">
    <button class="btn btn-danger w-100" type="button" id="btnAgregar">Agregar <?=$objeto?></button>
</div>
<?php 
else:?>
<div class="col-md-9">
    <nav class="nav nav-pills flex-column flex-sm-row text-center">
        <a class="flex-sm-fill text-sm-center nav-link" href="<?=baseUrl('mercado/productos')?>">Productos</a>
    </nav>
</div>
<div class="col-md-3">
    <button class="btn btn-danger w-100" type="button" id="btnAgregar">Agregar producto</button>
</div>

<?php endif;?>