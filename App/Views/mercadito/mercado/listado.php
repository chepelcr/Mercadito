<div class="card bg-transparent">
    <div class="card-header text-white bg-dark">
        <h1 class="card-title fs-4">Mercadito Virtual del Trueque</h1>
    </div>

    <div class="card-body bg-secondary">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
             foreach ($puestos as $puesto):
            ?>
            <div class="col">
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