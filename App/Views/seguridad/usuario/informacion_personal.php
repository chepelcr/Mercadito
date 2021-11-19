<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fas fa-user-edit"></i>
            Informacion personal
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <input class="form-control inp" value="<?php if(isset($id_usuario)) echo $id_usuario; ?>" type='hidden'
                id="id_usuario" name="id_usuario">

            <!-- Nombre -->
            <div class="col-md-5">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control inp perfil" id="nombre" name="nombre"
                            placeholder="Nombre Completo" required value="<?php if(isset($nombre)) echo $nombre; ?>">
                    </div>
                </div>
            </div>

            <!-- Apellidos -->
            <div class="col-md-7">
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control inp perfil" id="apellidos" name="apellidos" required
                            placeholder="Apellidos" value="<?php if(isset($apellidos)) echo $apellidos; ?>">
                    </div>
                </div>
            </div>

            <!-- Tipo de identificacion -->
            <div class="col-md-5">
                <div class="form-group">
                    <label for="tipo_identificacion">Tipo de identificación</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-id-card"></i>
                            </span>
                        </div>
                        <select class="form-select inp perfil" id="tipo_identificacion" name="tipo_identificacion"
                            required>
                            <option value="">Seleccionar</option>
                            <!-- Nacional o extranjero -->
                            <?php
                                if(isset($tipo_identificacion)){//nacional, extranjero o juridica
                                    if($tipo_identificacion == 'N'){
                                        echo "<option value='N' selected>Nacional</option>";
                                        echo "<option value='E'>Extranjero</option>";
                                        echo "<option value='J'>Juridica</option>";
                                    }else if($tipo_identificacion == 'E'){
                                        echo "<option value='N'>Nacional</option>";
                                        echo "<option value='E' selected>Extranjero</option>";
                                        echo "<option value='J'>Juridica</option>";
                                    }else if($tipo_identificacion == 'J'){
                                        echo "<option value='N'>Nacional</option>";
                                        echo "<option value='E'>Extranjero</option>";
                                        echo "<option value='J' selected>Juridica</option>";
                                    }
                                }else{
                                    echo "<option value='N'>Nacional</option>";
                                    echo "<option value='E'>Extranjero</option>";
                                    echo "<option value='J'>Juridica</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Identificacion -->
            <div class="col-md-7">
                <div class="form-group">
                    <label for="cedula_usuario">Identificación</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-id-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control cedula-usuario inp perfil" onblur="verificar()" id="cedula_usuario"
                            name="cedula_usuario" required placeholder="Identificación"
                            value="<?php if(isset($cedula_usuario)) echo $cedula_usuario; ?>">
                    </div>
                </div>
            </div>

            <!-- Nacionalidad -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nacionalidad">Nacionalidad</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-globe-americas"></i>
                            </span>
                        </div>
                        <select required class="form-select inp" id="id_nacionalidad" name="id_nacionalidad">
                            <option value="">Seleccione</option>
                            <?php
                                    foreach ($nacionalidades as $nacionalidad): ?>
                            <option value="<?php echo $nacionalidad->cod_pais; ?>"
                                <?php if(isset($id_nacionalidad) && $id_nacionalidad == $nacionalidad->cod_pais) echo 'selected'; ?>>
                                <?php echo $nacionalidad->nombre; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Fecha de nacimiento -->
            <div class="col-md-4">
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
                        <select required class="form-select inp" id="sexo" name="sexo">
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
        </div>
    </div>
</div>