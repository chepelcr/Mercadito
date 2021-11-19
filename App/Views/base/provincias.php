<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-map-marker-alt"></i> Direccion
        </h3>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Provincia</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-select inp provincia">
                            <option value="">Seleccione una provincia</option>
                            <?php foreach ($provincias as $provincia): ?>
                                <option value="<?php echo $provincia->cod_provincia; ?>" <?php if(isset($cod_provincia))
                                    if($cod_provincia == $provincia->cod_provincia) echo 'selected'; ?>>
                                    <?php echo $provincia->provincia; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Cantón</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-select inp canton" disabled>
                            <option value="">Seleccione un cantón</option>
                            <?php
                                if(isset($cantones))
                                    foreach ($cantones as $canton):
                            ?>
                                <option value="<?php echo $canton->cod_canton; ?>" <?php if(isset($cod_canton))
                                    if($cod_canton == $canton->cod_canton) echo 'selected'; ?>>
                                    <?php echo $canton->canton; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Distrito</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-select inp distrito" disabled>
                            <option value="">Seleccione un distrito</option>
                            <?php
                                if(isset($distritos))
                                    foreach ($distritos as $distrito):
                            ?>
                                <option value="<?php echo $distrito->cod_distrito; ?>" <?php if(isset($cod_distrito))
                                    if($cod_distrito == $distrito->cod_distrito) echo 'selected'; ?>>
                                    <?php echo $distrito->distrito; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="text-left">Barrio</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-select inp barrio" disabled id="id_ubicacion" name="id_ubicacion">
                            <option value="">Seleccione un barrio</option>
                            <?php
                                if(isset($barrios))
                                    foreach ($barrios as $barrio):
                            ?>
                                <option value="<?php echo $barrio->id_ubicacion; ?>" <?php if(isset($id_ubicacion))
                                    if($id_ubicacion == $barrio->id_ubicacion) echo 'selected'; ?>>
                                    <?php echo $barrio->barrio; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="text-left">Otras señas</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <textarea class="form-control inp" name="otras_senias" id="otras_senias" cols="30"
                            rows="3">
                            <?php if(isset($otras_senias)) echo $otras_senias; ?>
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>