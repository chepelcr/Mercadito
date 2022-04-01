<div class="row">
    <input class="form-control form-control-lg inp" id="id_rol" name="id_rol" type="hidden">

    <!-- Nombre del rol -->
    <div class="col-md-12">
        <div class="card card-form">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fa fa-pencil-square-o"></i>
                    Informacion
                </h4>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Nombre del rol -->
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="nombre_rol">Nombre del rol</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <!-- Icono de rol -->
                                        <i class="fas fa-user-tag"></i>
                                    </div>
                                </div>
                                <input class="form-control inp" id="nombre_rol" name="nombre_rol" type="text"
                                    placeholder="Nombre del rol" required>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de rol -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="tipo_rol">Tipo de rol</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <!-- Icono de rol -->
                                        <i class="fas fa-user-tag"></i>
                                    </div>
                                </div>
                                <select class="form-control inp" id="id_tipo_rol" name="id_tipo_rol" required onchange="modulos_tipo(this.value)">
                                    <option value="">Seleccionar</option>
                                    <?php foreach($tipos_roles as $tipo_rol): ?>
                                    <option value="<?php echo $tipo_rol->id_tipo_organizacion; ?>">
                                        <?php echo $tipo_rol->tipo_organizacion; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <?php echo view('seguridad/rol/elementos/permisos', array('modulos'=>$modulos))?>
    </div>
</div>