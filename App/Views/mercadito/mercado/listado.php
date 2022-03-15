<div class="card card-dark">
    <div class="card-header text-white bg-dark">
        <div class="row p-2">
            <div class=" col-md-12 rounded bg-white border">
                <div class="row">
                    <div class="col-1 p-2">
                        <img src="<?=getfile('images/logo sin letras.png')?>" class="img-fluid"
                            style="max-height: 100px;" alt="Logo">
                    </div>

                    <div class="col-11">
                        <h1 class="text-right font-weight-bolder" style="color: yellowgreen;">
                            Mercadito del Trueque
                        </h1>

                        <h3 class="text-right font-weight-bold" style="color: darkcyan;">
                            Verde Manantial
                        </h3>
                    </div>
                </div>
            </div>

        </div>
        <!--    <h1 class="card-title fs-4">Mercadito Virtual del Trueque</h1> -->
    </div>

    <div class="card-body bg-secondary scroll_vertical">
        <div class="row">
            <?php
             foreach ($puestos as $puesto):
            ?>
            <div class="col-md-3">
                <div class="card h-100 text-center">
                    <div class="container">
                        <img src="<?= getFile('images/logo sin letras.png') ?>" class="card-img-top p-2"
                            alt="Imagen del puesto o empresa">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title text-black fs-6">
                            <?= $puesto->nombre_puesto ?>
                        </h5> <br>
                        <button type="button" class="btn btn-primary btt_inf" value="<?= $puesto->id_puesto ?>">
                            Ver información</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row" id="puesto">
    <?php
        echo view('mercadito/mercado/informacion_puesto');
    ?>

</div>