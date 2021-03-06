<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadito del Trueque | Olvido</title>

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
        <!-- /.login-logo -->
        <div class="card card-dark">
            <div class="card-header text-center">
                <img src="<?= getFile('images/logo feria.png')?>" class="w-25">
            </div>

            <form id="frmRecuperar" method="post">
                <div class="card-body bg-secondary">
                    <p class="login-box-msg"><b>Recuperar contraseña</b></p>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="user" name="user" placeholder="correo@example.com">
                        <label class="text-black" for="user">Correo electronico</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-secondary">
                    <div class="row">
                        <div class="col-3 text-center">
                            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Volver" class="btn btn-dark"
                                role="button" href="<?= baseUrl('login')?>"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <!-- /.col -->
                        <div class="col-9">
                            <button type="submit" class="fw-bold btn btn-warning w-100">Realizar
                                solicitud</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
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
    <script src="<?=getFile('dist/plugins/pace-progress/pace.min.js')?>"></script>

    <script src="<?=getFile('dist/js/base/login.js')?>"></script>
</body>

</html>