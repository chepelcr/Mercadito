<!-- Id del puesto-->
<input type="hidden" name="id_puesto" id="id_puesto" value="<?php if(isset($id_puesto)) echo $id_puesto; ?>">

<!-- Estado-->
<input type="hidden" name="estado" id="estado" value="<?php if(isset($estado)) echo $estado; ?>">

<div class="row">
    <div class="col-md-2">
        <div class="container">
            <div class="form-group img-div-center">
                <br>
                <!-- Mostrar Imagen del puesto si existe-->
                <?php if(isset($imagen_puesto) && $imagen_puesto != ''): ?>
                <img src="<?php getFile('images/puestos/'.$imagen_puesto) ?>" class="img-fluid img_puesto p-2" alt="Responsive image">
                <?php else: ?>
                <img src="<?= getFile('images/logo sin letras.png') ?>" class="image img-fluid img_puesto p-2"
                    alt="Imagen del puesto o empresa">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="row">
            <!-- Nombre del puesto -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nombre">Nombre del puesto</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control inp" id="nombre_puesto" name="nombre_puesto"
                            placeholder="Nombre a mostrar en la feria" required
                            value="<?php if(isset($nombre_puesto)) echo $nombre_puesto; ?>">
                    </div>
                </div>
            </div>

            <!-- Descripcion del puesto -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <textarea class="form-control inp" maxlength="250" onkeyup="countChars(this);" id="descripcion" name="descripcion"
                            placeholder="Descripción del puesto"
                            required><?php if(isset($descripcion)) echo $descripcion; ?></textarea>
                    </div>
                    <p id="charNum" class="text-right">250 caracteres restantes</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 div-img">
        <!-- Cambiar imagen -->
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input class="form-control form-control-file inp" type="file" name="imagen_puesto"
                id="imagen_puesto">
        </div>
    </div>
</div>