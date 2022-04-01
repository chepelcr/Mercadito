<div class="card">
    <!-- Informacion de organizacion -->
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-building"></i> Informacion general
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <!-- Imagen de la organizacion -->
            <div class="col-md-2">
                <img src="<?= getFile('images/logo feria.png') ?>" class="img-fluid img-centro-vert logo_organizacion"
                    alt="Responsive image">
            </div>

            <div class="col-md-10">
                <div class="row">
                    <!-- Nombre de la organizacion -->
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="nombre">Nombre de la organizacion</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                </div>
                                <input class="form-control inp nombre" id="nombre" name="nombre" type="text"
                                    placeholder="Ingrese el nombre de la organizacion"
                                    value="<?php if(isset($nombre)) echo $nombre?>" required max="100">
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de organizacion -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="id_tipo_organizacion">Tipo de organizacion</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                </div>
                                <select class="form-control inp" id="id_tipo_organizacion"
                                    name="id_tipo_organizacion" required>
                                    <option value="">Seleccionar</option>
                                    <?php foreach($tipos_organizacion as $tipo_organizacion): ?>
                                    <option value="<?php echo $tipo_organizacion->id_tipo_organizacion; ?>"
                                        <?php if(isset($tipo_organizacion) && $tipo_organizacion->id_tipo_organizacion == $tipo_organizacion->id_tipo_organizacion) echo 'selected'; ?>>
                                        <?php echo $tipo_organizacion->tipo_organizacion; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Descripcion de la organizacion -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripcion de la organizacion</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                </div>
                                <textarea class="form-control inp descripcion" id="descripcion" name="descripcion"
                                    type="text" placeholder="Ingrese la descripcion de la organizacion"
                                    value="<?php if(isset($descripcion)) echo $descripcion?>" required
                                    max="100"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Pais de origen campo 'cod_pais'  -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="cod_pais">Pais de origen</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                </div>
                                <select class="form-control inp" id="cod_pais" name="cod_pais" required>
                                    <option value="">Seleccionar</option>
                                    <?php foreach($paises as $pais): ?>
                                    <option value="<?php echo $pais->cod_pais; ?>"
                                        <?php if(isset($pais) && $pais->cod_pais == $pais->cod_pais) echo 'selected'; ?>>
                                        <?php echo $pais->pais; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <!-- Cuenta con Whatsapp (Si o no) -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="whatsapp">Whatsapp</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                </div>
                                <select class="form-control inp" id="whatsapp" name="whatsapp" required>
                                    <option value="">Seleccionar</option>
                                    <option value="1" <?php if(isset($whatsapp) && $whatsapp == 1) echo 'selected'; ?>>
                                        Si
                                    </option>
                                    <option value="0" <?php if(isset($whatsapp) && $whatsapp == 0) echo 'selected'; ?>>
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Agregar imagen -->
                    <div class="col-md-5" id="logo_organizacion">
                        <div class="form-group">
                            <label for="imagen">Agregar logo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                </div>
                                <input class="form-control inp imagen" id="logo" name="logo" type="file"
                                    placeholder="Ingrese la imagen de la organizacion"
                                    value="<?php if(isset($imagen)) echo $imagen?>" required max="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>