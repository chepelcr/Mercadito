<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadito del Trueque | Login</title>

    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
        <div class="card card-outline card-dark">
            <div class="card-header text-center bg-dark">
                <img src="<?= getFile('images/logo feria.png')?>" class="w-25">
            </div>

            <div class="card-body bg-secondary">
                <p class="card-text pl-0 login-box-msg text-center"><b>Inicio de sesión</b></p>
                <form id="frmLogin" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Correo electronico" name="usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="contrasenia">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <button type="submit" class="fw-bold btn btn-primary btn-warning w-100">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->

            <div class="card card-footer bg-mercadito-oscuro">
                <div class="row">
                    <div class="col-3 text-center">
                        <a class="btn btn-dark" role="button" href="<?= baseUrl()?>"><i
                                class="fas fa-arrow-left"></i></button></a>
                    </div>
                    <!-- /.col -->
                    <div class="col-9">
                        <a role="button" href="<?= baseUrl('login/olvido')?>" class="btn btn-info btn-block fw-bold">Olvidé mi
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Font-Awesome -->
    <script src="https://kit.fontawesome.com/3e7bda16db.js" crossorigin="anonymous"></script>

    <script src="<?=getFile('js/base.js')?>"></script>

    <script type="text/javascript">
    var base = "http://localhost/universidad/tcu/mercadito/Mercadito/public/";


    $("#frmLogin").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "login/consultar",
            "method": "post",
            "data": $('#frmLogin').serialize(),
            "dataType": "json"
        }).done(function(response) {
            if (response == 1) {
                window.location.href = base + "";
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'Usuario o contraseña incorrectos', 'error');
            } //Fin del else
        }); //Fin del ajax
    }); //Fin del submit

    //Abrir el modal de registro de usuario cuando se le da click al boton de registrar
    $(document).on('click', '#registro', function() {
        //Mostrar el modal del usuario
        $('#modalUsuario').modal('show');
    });

    //Agregar un nuevo usuario
    $("#frmRegistro").on('submit', function(e) {
        e.preventDefault();

        Pace.track(function() {
            $.ajax({
                "url": base + "login/registro",
                "method": "post",
                "data": $('#frmRegistro').serialize(),
                "dataType": "json",
            }).done(function(response) {
                if (response == 0) {
                    mensajeAutomatico('Atencion',
                        'El correo indicado ya se encuentra registrado', 'error');
                } else {
                    if (response != -1) {
                        swal({
                            title: "Atencion",
                            text: 'Registro finalizado, revisa tu correo para finalizar',
                            icon: 'success',
                            timer: 4000
                        });

                        $("#modalUsuario").modal("hide");
                    } //Fin del if
                    else {
                        mensajeAutomatico('Atencion',
                            'Debes aceptar los terminos y condiciones', 'warning');
                    } //Fin del else
                } //Fin de la respuesta diferente de 0
            }); //Fin del ajax
        });
    });
    </script>
</body>

</html>