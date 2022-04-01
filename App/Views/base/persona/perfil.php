<div class="modal fade" id="perfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <!-- Contenido del modal -->
        <div class="modal-content">

            <!-- Titulo del modal -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title">
                    <i class="fas fa-user-circle"></i>
                    Perfil de usuario
                </h5>
                <button type="button" class="btn bg-transparent text-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Inicio del modal -->
            <form id="frm_perfil">
                <!-- Contenido del modal -->
                <div class="modal-body">
                    <div class="container">
                        <div class="container-fluid">
                        <?= view('seguridad/usuario/form', $perfil)?>
                        </div>
                    </div>
                </div>

                <!-- Footer del modal -->
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div id="panel_guardar" class="d-flex justify-content-around">
                            <!-- Grupo de botones -->
                            <button type="button" onclick="guardar_perfil()" disabled class="btn btn-grd-prf btn-primary w-75" title="Guardar" data-toggle="tooltip">
                                </i>
                            </button>

                            <!-- Boton para Cancelar -->
                            <button type="button" onclick="cancelar_perfil()" disabled class="btn btn-cnl-prf btn-danger w-20" data-toggle="tooltip" title="Cancelar">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>

                        <div id="panel_perfil" class="d-flex justify-content-around">
                            <button class="btn btn-warning w-25" data-toggle="tooltip" type="button" title="Editar perfil">
                                <i class="fas fa-user-edit"></i>
                            </button>

                            <!-- Ver organizacion -->
                            <button onclick="ver_organizacion();" type="button" class="btn btn-info w-25"
                                data-toggle="tooltip" title="Ver organización">
                                <i class="fas fa-building"></i>
                            </button>

                            <button class="btn btn-danger w-25" type="button"data-toggle="tooltip" title="Cambiar contraseña">
                                <i class="fas fa-key"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>