<div class="card card-form">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-circle"></i> Datos personales
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Cerrar">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>

    <div class="card-body">
        <input class="form-control form-control-lg inp id_cliente" id="id_cliente" name="id_cliente" type="hidden">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- Cédula del cliente -->
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="text-left">Número de cédula</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input class="form-control inp identificacion" onblur="validar_identificacion(this.value)" id="identificacion"
                                    name="identificacion" type="text" placeholder="Ingrese el número de cédula" value="<?php if(isset($identificacion)) echo formatear_cedula($identificacion, $id_tipo_identificacion)?>" required max="100">
                                    
                                <div class="input-group-append">
                                    <!-- Boton para eliminar el contenido del campo -->
                                    <button class="btn btn-danger inp identificacion btn-eliminar" disabled type="button" onclick="vaciar_cedula()" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de cedula-->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="text-left">Tipo de identificación</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <select id="id_tipo_identificacion" name="id_tipo_identificacion"
                                    class="form-control inp tipo_identificacion id_tipo_identificacion">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($identificaciones as $key => $identificacion): ?>
                                    <option value="<?=$identificacion->id_tipo_identificacion?>"
                                        <?php if(isset($id_tipo_identificacion) && $id_tipo_identificacion == $identificacion->id_tipo_identificacion) echo "selected"?>>
                                        <?=$identificacion->tipo_identificacion?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nombre completo -->
            <div class="col-md-8">
                <div class="form-group">
                    <label class="text-left razon">Nombre completo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control inp nombre" placeholder="Nombre del contribuyente" id="nombre" name="nombre" required
                            value="<?php if(isset($nombre)) echo $nombre?>" type="text" max="100">
                    </div>
                </div>
            </div>

            <!-- Genero -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="genero">Genero</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-venus-mars"></i>
                            </span>
                        </div>
                        <select required class="form-select inp" id="genero" name="genero">
                            <option value="">Seleccione</option>
                            <option value="F" <?php if(isset($sexo) && $sexo == 'F') echo 'selected'; ?>>
                                Femenino
                            </option>
                            <option value="M" <?php if(isset($sexo) && $sexo == 'M') echo 'selected'; ?>>
                                Masculino
                            </option>
                            <option value="O" <?php if(isset($sexo) && $sexo == 'O') echo 'selected'; ?>>
                                Otro
                        </select>
                    </div>
                </div>
            </div>

            <!-- Nacionalidad -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nacionalidad">Nacionalidad</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-globe-americas"></i>
                            </span>
                        </div>
                        <select required class="form-select inp" id="cod_pais" name="cod_pais">
                            <option value="">Seleccionar</option>
                            <?php
                                    foreach ($codigos as $nacionalidad): ?>
                            <option value="<?php echo $nacionalidad->cod_pais; ?>"
                                <?php if(isset($cod_pais) && $cod_pais == $nacionalidad->cod_pais) echo 'selected'; ?>>
                                <?php echo $nacionalidad->nombre; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Fecha de nacimiento -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input required type="date" class="form-control inp perfil" id="fecha_nacimiento"
                            name="fecha_nacimiento" placeholder="Fecha de nacimiento" required
                            value="<?php if(isset($fecha_nacimiento)) echo $fecha_nacimiento; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>