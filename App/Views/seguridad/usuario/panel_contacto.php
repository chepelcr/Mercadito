<!-- Informacion de contacto -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fas fa-user-tie"></i>
            Informacion de contacto
        </h4>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <!-- Telefono -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control inp perfil" id="telefono" name="telefono"
                            placeholder="Teléfono" required value="<?php if(isset($telefono)) echo $telefono; ?>">
                    </div>
                </div>
            </div>

            <!-- Correo -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control inp perfil" id="correo" name="correo"
                            placeholder="Correo" required value="<?php if(isset($correo)) echo $correo; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>