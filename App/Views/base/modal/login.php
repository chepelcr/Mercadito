<!-- Modal para loguearse en el mercadito del trueque -->
<div class="modal fade" id="modal_login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body bg-mercadito-claro login-page" style="max-height: 500px;">
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
                                    <input type="email" class="form-control" id="user" name="user"
                                        placeholder="correo@example.com">
                                    <label for="user">Correo electronico</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="pswd" name="pswd"
                                        placeholder="**********">
                                    <label for="pswd">Contraseña</label>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-3 text-center">
                                        <button data-bs-dismiss="modal" aria-label="Volver" data-bs-toggle="tooltip" type="button"
                                            data-bs-placement="bottom" title="Volver" class="btn btn-dark" onclick="cargar_inicio()"><i class="fas fa-arrow-left"></i></button>
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
            </div>
        </div>
    </div>
</div>