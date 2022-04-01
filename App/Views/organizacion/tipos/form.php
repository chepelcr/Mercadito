<!-- Formulario para los tipos de organizacion -->
<div class="card">
    <!-- Nombre del tipo -->
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">Tipo de organizacion</h4>
            <i class="fas fa-building"></i>
        </div>
    </div>

    <!-- Formulario -->
    <div class="card-body">
        <div class="row">
            <!-- Nombre del tipo -->
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                        </div>
                        <input class="form-control inp" id="tipo_organizacion" name="tipo_organizacion" type="text"
                            placeholder="Ingrese el nombre del tipo" value="<?php if(isset($tipo_organizacion)) echo $tipo_organizacion?>"
                            required max="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>