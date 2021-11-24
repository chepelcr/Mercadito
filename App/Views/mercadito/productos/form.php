<!-- Id del producto-->
<input type="hidden" name="id_producto" value="<?php if(isset($id_producto)) echo $id_producto; ?>">

<div class="row">
    <!-- Nombre del producto -->
    <div class="col-md-8">
        <div class="form-group">
            <label for="nombre">Nombre del articulo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control inp" id="nombre" name="nombre" placeholder="Nombre del articulo"
                    required value="<?php if(isset($nombre)) echo $nombre; ?>">
            </div>
        </div>
    </div>

    <!-- Tipo [Producto o servicio]-->
    <div class="col-md-4">
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <select class="form-select inp" id="tipo" name="tipo" required>
                    <option value="">Elegir</option>
                    <option value="P" <?php if(isset($tipo) && $tipo == 'P') echo 'selected'; ?>>Producto</option>
                    <option value="S" <?php if(isset($tipo) && $tipo == 'S') echo 'selected'; ?>>Servicio</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Descripcion del producto -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <textarea class="form-control inp" id="descripcion" name="descripcion"
                    placeholder="Descripción del producto"
                    required><?php if(isset($descripcion)) echo $descripcion; ?></textarea>
            </div>
        </div>
    </div>

    <!-- Precio del producto -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="precio">Precio</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="number" class="form-control inp" id="precio" name="precio" placeholder="Precio" required
                    value="<?php if(isset($precio)) echo $precio; ?>">
            </div>
        </div>
    </div>

    <!-- Imagen -->
    <div class="col-md-6 imagen">
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                <input type="file" class="form-control form-control-file inp" id="nombre_imagen" name="nombre_imagen"
                    placeholder="Imagen" required value="<?php if(isset($nombre_imagen)) echo $nombre_imagen; ?>">
            </div>
        </div>
    </div>
</div>