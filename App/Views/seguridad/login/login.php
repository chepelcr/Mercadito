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

            <div class="card-body bg-secondary">
                <p class="card-text pl-0 login-box-msg text-center"><b>Inicio de sesión</b></p>
                <form id="frmLogin" class="text-black" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="user" name="user" placeholder="correo@example.com">
                        <label for="user">Correo electronico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="pswd" name="pswd" placeholder="**********">
                        <label for="pswd">Contraseña</label>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-3 text-center">
                            <a data-bs-toggle="tooltip" data-bs-placement="bottom" title="Volver" class="btn btn-dark"
                                role="button" href="<?= baseUrl()?>"><i class="fas fa-arrow-left"></i></button></a>
                        </div>
                        <!-- /.col -->

                        <div class="col-9">
                            <button type="submit" class="fw-bold btn btn-warning w-100">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->

            <div class="card-footer bg-mercadito-oscuro">
                <div class="row">
                    <div class="col-12">
                        <a role="button" href="<?= baseUrl('login/olvido')?>"
                            class="btn btn-azul-oscuro btn-block fw-bold">Olvidé mi
                            contraseña</a>

                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.card-footer-->
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

    <script src="<?=getFile('dist/js/base/base.js')?>"></script>

    <script type="text/javascript">
    $("#frmLogin").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "login/consultar",
            "method": "post",
            "data": $('#frmLogin').serialize(),
            "dataType": "json"
        }).done(function(response) {
            switch (response.estado) {
                case '1':
                    location.reload();
                break;

                //Si la contrasenia ya expiro
                case '2':
                    //Envia mensaje de error al usuario
                    Swal.fire({
                        title: 'Atencion',
                        text: response.error,
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false
                    }).then((result) => {
                        //Redirecciona a la pagina de cambio de contraseña
                        location.reload();
                    });
                break;

                default:
                    Swal.fire({
                        title: 'Atencion',
                        text: response.error,
                        icon: 'warning',
                        timer: 2000,
                        showConfirmButton: false
                    });
                break;
            } //Fin switch
        }); //Fin del ajax
    }); //Fin del submit
    </script>
</body>

</html>