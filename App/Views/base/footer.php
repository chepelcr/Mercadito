<!-- Footer -->
<div class="container">
    <div class="container-fluid">
        <footer class="text-center text-lg-start pb-2">
            <!-- Section: Links  -->
            <section class="d-flex justify-content-center justify-content-lg-between pb-2">
                <div class="container text-center text-md-start">
                <?= view('base/nav-inf')?>
                </div>
            </section>
            <!-- Section: Links  -->

            <div class="container bg-mercadito-oscuro rounded text-white">
                <div class="row pt-2">
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
        </footer>
    </div>
</div>
<!-- Footer -->