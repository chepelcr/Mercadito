<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadito del Trueque | Login</title>

    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

    <!-- Icono del mercadito -->
    <link rel="shortcut icon" href="<?= getFile('images/logo feria.png')?>" type="image/x-icon">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= getFile('styles/adminlte.min.css')?>">
    <!-- Estilos personalizados-->
    <link rel="stylesheet" href="<?=getFile('styles/estilos.css')?>">
    <!-- Pace Style-->
    <link rel="stylesheet" href="<?= baseUrl('dist/plugins/pace-progress/themes/center-radar.css')?>">
</head>

<body class="hold-transition login-page bg-mercadito-claro">
    <div class="login-box">
        <div class="card card-dark">
            <!-- login-logo -->
            <div class="card-header text-center">
                <img src="<?= getFile('images/logo feria.png')?>" class="w-25">
            </div>
            <!-- /login-logo -->

            <form id="frm_contrasenia" class="text-black" method="post">
                <div class="card-body bg-secondary">
                    <p class="card-text pl-0 login-box-msg text-center"><b>Cambiar contrasenia</b></p>

                    <?= view('seguridad/perfil/contrasenia')?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-mercadito-oscuro">
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btt-grd btn btn-azul-oscuro btn-block fw-bold w-100">Cambiar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.card-footer-->
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font-Awesome -->
    <script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>

    <!-- Pace -->
    <script src="<?= getFile('dist/plugins/pace-progress/pace.min.js') ?>"></script>

    <!-- Base -->
    <script src="<?= getFile('dist/js/base/base.js') ?>"></script>

    <!-- Contrasenia-->
    <script src="<?=getFile('dist/js/seguridad/contrasenia.js')?>"></script>

    <script type="text/javascript">

    $("#frm_contrasenia").on('submit', function(e) {
        e.preventDefault();

        Pace.track(function() {
            $.ajax({
                "url": base + "seguridad/update/contrasenia",
                "method": "post",
                "data": $('#frm_contrasenia').serialize(),
                "dataType": "json"
            }).done(function(response) {
                if (!response.error) {
                    mensajeAutomaticoRecargar('Atencion', 'Contraseña actualizada correctamente',
                    'success');
                } else {
                    mensajeAutomaticoRecargar('Atencion', response.error, 'error');
                }
            }); //Fin del ajax
        }); //Fin de track
    }); //Fin del submit
    </script>
</body>

</html>