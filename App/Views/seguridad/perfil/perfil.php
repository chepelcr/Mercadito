<form id="frm_usuario">
    <div class="card">
        <div class="card-header">
            <!-- Informacion personal-->
            <h3 class="card-title">
                <i class="fa fa-user-circle-o"></i> Perfil
            </h3>
        </div>


        <div class="card-body">
            <?php 
                echo view('seguridad/usuario/informacion_personal', $perfil);

                echo view('seguridad/usuario/panel_contacto', $perfil);
                
                echo view('base/provincias', $perfil->ubicacion);
            ?>
        </div>

        <div class="card-footer">
            <div id="panel_guardar" class="d-flex justify-content-around">
                <button type="submit" class="btn btn-primary w-75" id="btn_guardar">
                    </i> Guardar
                </button>

                <!-- Boton para Cancelar -->
                <button type="button" class="btn btn-danger w-20" id="btn_cancelar">
                    <i class="fa fa-times"></i> Cancelar
                </button>
            </div>

            <div id="panel_perfil" class="d-flex justify-content-around">
                <button class="btn btn-info w-25 btn-grd" type="button" id="btn_editar">Editar perfil</button>

                <button class="btn btn-danger w-25" type="button" id="btn_contrasenia" data-bs-toggle="modal"
                    data-bs-target="#modalAccion">Cambiar
                    contraseña</button>
            </div>
        </div>
    </div>
</form>

<?php
    echo view('base/form', $dataForm);
?>