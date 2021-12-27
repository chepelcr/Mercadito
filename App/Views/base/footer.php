<!-- Footer -->
<footer class="pb-2">
    <div class="container">
        <div class="container-fluid">
            <!-- Section: Links  -->
            <?= view('base/nav-inf')?>

            <div class="container pt-2">
                <div class="row pt-2 bg-mercadito-oscuro rounded text-white">
                    <!-- Copyright -->
                    <div class="col-8">
                        <section class="pt-2">
                            <p class="text-left">
                                © 2021 Derechos reservados:
                                <a class="text-reset fw-bold" href="<?= baseUrl() ?>">Feria del trueque: Verde
                                    Manantial</a>
                            </p>
                        </section>
                    </div>

                    <div class="col-4">
                        <div class="container">
                            <?php 
                                if(!is_login())
                                {
                            ?>
                            <h6 class="text-end fw-bold">
                                <a role="button" class="btn bg-mercadito-claro" href="<?= baseUrl('login') ?>">Iniciar
                                    sesión</a>
                            </h6>
                            <?php 
                                }
                                else
                                {
                            ?>
                            <h6 class="text-end fw-bold">
                                <a role="button" class="btn bg-mercadito-claro"
                                    href="<?= baseUrl('login/salir') ?>">Cerrar
                                    sesión</a>
                            </h6>
                            <?php 
                                }
                            ?>

                        </div>
                    </div>
                    <!-- Copyright -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer -->