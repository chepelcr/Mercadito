<div class="row nav-auditorias" id="nav-auditorias">
    <div class="col-md-12 bg-gradient-gray rounded">
        <div class="row">
            <div class="col col-lg col-md col-sm p-1">
                <button class="btn btn-dark btn-modulo w-100 btn_administracion_auditorias" type="button"
                    onclick="cargar_listado('administracion', 'auditorias', '<?=baseUrl('administracion/auditorias/listado')?>')">
                    Auditorias
                </button>
            </div>

            <!-- Errores -->
            <div class="col col-lg col-md col-sm p-1">
                <button class="btn btn-dark btn-modulo w-100 btn_administracion_errores" type="button"
                    onclick="cargar_listado('administracion', 'errores', '<?=baseUrl('administracion/errores/listado')?>')">
                    Errores
                </button>
            </div>
        </div>
    </div>
</div>