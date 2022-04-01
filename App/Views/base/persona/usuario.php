<div class="card card-form">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fas fa-user-tie"></i> Informacion de Usuario
        </h4>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!--Nombre de usuario -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de usuario</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control inp nombre_usuario" id="nombre_usuario" name="nombre_usuario" type="text" placeholder="Ingrese el nombre de usuario" value="<?php if(isset($nombre_usuario)) echo $nombre_usuario?>" required max="100">
                    </div>
                </div>
            </div>

            <!-- Empresa -->
            <div class="col-md-5">
                <div class="form-group">
                    <label for="empresa">Organizacion</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-building"></i>
                            </span>
                        </div>

                        <select required class="form-control inp" name="id_organizacion" id="id_organizacion">
                            <option value="">Seleccionar</option>
                            <?php foreach($organizaciones as $organizacion): ?>
                            <option value="<?php echo $organizacion->id_organizacion; ?>"
                                <?php if(isset($id_organizacion) && $id_organizacion == $organizacion->id_organizacion) echo 'selected'; ?>>
                                <?php echo $organizacion->nombre; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Rol -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user-tag"></i>
                            </span>
                        </div>

                        <select required class="form-control inp" name="id_rol" id="id_rol">
                            <option value="">Seleccione</option>
                            <?php foreach($roles as $rol): ?>
                            <option value="<?php echo $rol->id_rol; ?>"
                                <?php if(isset($id_rol) && $id_rol == $rol->id_rol) echo 'selected'; ?>>
                                <?php echo $rol->nombre_rol; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>