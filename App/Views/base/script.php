<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>

<!-- overlayScrollbars -->
<script src="<?=getFile('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=getFile('dist/js/adminlte.min.js')?>"></script>

<!-- SweetAlert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font-Awesome -->
<script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>

<!-- Pace -->
<script src="<?=getFile('dist/plugins/pace-progress/pace.min.js')?>"></script>

<!-- Cleave-->
<script src="<?=getFile('dist/plugins/cleave.js/dist/cleave.min.js')?>"></script>

<!-- Cleave phone-->
<script src="https://nosir.github.io/cleave.js/dist/cleave-phone.i18n.js"></script>

<!-- Script base-->
<script src="<?=getFile('dist/js/base/base.js')?>"></script>

<?php
    if(isset($script))
        echo $script;
?>