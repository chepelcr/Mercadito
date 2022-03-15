<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<!-- AdminLTE App -->
<script src="<?=getFile('dist/js/adminlte.min.js')?>"></script>

<!-- overlayScrollbars -->
<script src="<?=getFile('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>

<!-- Pace -->
<script src="<?=getFile('dist/plugins/pace-progress/pace.min.js')?>"></script>

<!-- SweetAlert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font-Awesome -->
<script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>

<!--DataTables-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

<!-- DataTables || Select -->
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>


<!-- Base | Mensajes -->
<?=getScript('base/mensajes')?>

<!-- Base | Login -->
<?=getScript('base/login')?>

<!-- Base | Nav -->
<?=getScript('base/nav')?>

<!-- Base | Modulos -->
<?=getScript('base/modulos')?>

<!-- Base | Listado -->
<?=getScript('base/listado')?>

<!-- Base | Ubicaciones -->
<?=getScript('base/ubicaciones')?>

<!-- Base | Hacienda -->
<?=getScript('base/hacienda')?>

<!-- Form | Campos -->
<?=getScript('form/campos')?>

<!-- Form | Operaciones -->
<?=getScript('form/operaciones')?>

<!-- Form || Permisos -->
<?=getScript('form/permisos')?>

<?php
    if(is_login())
    {
?>

<!-- Seguridad | Usuarios -->
<?=getScript('seguridad/usuarios')?>

<?php
    }//is_login

    if(isset($script))
        echo $script;
?>