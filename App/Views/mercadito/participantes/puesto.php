<div class="card">
    <?php
     if($puesto):
    ?>
    <div class="card-header">
        <h4><i class="fas fa-user-tie"></i> Informacion del puesto </h4>
    </div>
    <form id="frm_puesto">
        <div class="card-body">
            <div class="row">
                <?php
                    echo view('mercadito/puesto/form', $puesto);
                ?>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
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
                    <button class="btn btn-info w-25 btn-grd" type="button" id="btn_editar">Editar puesto</button>

                    <!-- Cambiar foto del puesto -->
                    <button class="btn btn-warning w-25" type="button" id="btn_foto">Cambiar imagen</button>

                    <!-- Si el estado es 1, activar -->
                    <?php if (isset($puesto->estado) && $puesto->estado == 0) { ?>
                    <button class="btn btn-success w-25" type="button" id="btn_activar">Activar</button>
                    <?php } else { ?>
                    <button class="btn btn-danger w-25" type="button" id="btn_desactivar">Desactivar</button>
                    <?php } ?>

                </div>
            </div>
        </div>
    </form>
    <?php
     else:
    ?>
    <div class="card-header">
        <h4><i class="fas fa-user-tie"></i> Informacion del puesto </h4>
    </div>

    <form id="frm_crear">
        <div class="card-body">
            <div class="row">
                <?php
                    echo view('mercadito/puesto/form');
                ?>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <!-- Boton para crear un puesto -->
                    <button class="btn btn-success w-25" type="submit" id="btn_crear">Crear puesto</button>
                </div>
            </div>
        </div>
    </form>
    <?php
     endif;
    ?>
</div>