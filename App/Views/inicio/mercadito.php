<div class="card card-dark">
    <div class="card-header text-white bg-dark">
        <h5 class="card-title">Mercadito del trueque</h5>
    </div>

    <div class="card-body bg-secondary">
        <div class="row">
            <?php
             foreach ($puestos as $puesto):
            ?>
            <div class="col-md-2 p-1">
                <div class="card card-puesto">
                    <div class="card-body card-front">
                        <img src="<?= getFile('images/organizaciones/'.$puesto->logo) ?>" class="img-fluid pt-2"
                            alt="Logo de la organizacion">
                    </div>

                    <div class="card-body card-back">
                        <div class="h-100">
                            <h5 class="card-text text-black h-25 pt-3">
                                <b><?= $puesto->nombre_organizacion ?></b>
                            </h5>

                            <p class="card-text pt-0 h-50">
                                <?= $puesto->descripcion ?>
                            </p>

                            <div class="pb-5">
                                <button type="button" class="btn btn-primary btn-block"
                                    onclick="abrir_puesto(this.value)" type="button" value="<?= $puesto->id_puesto ?>">
                                    Ver información</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row" id="puesto">
    <?php
        echo view('inicio/mercado/informacion_puesto');
    ?>

</div>