<nav class="navbar navbar-expand-lg navbar-dark bg-mercadito-oscuro rounded grounded">
    <a class="navbar-brand" href="<?=baseUrl()?>">
        <div class="col-2 img-div-center">
            <img class="img-fluid w-25 img-centro-vert-hor" src="<?= getFile('images/logo sin letras.png') ?>"
                alt="logo">
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- Inicio -->
            <li class="nav-item text-white">
                © 2021 José Pablo Campos:
                <a class="text-reset fw-bold nax-link" href="<?= baseUrl() ?>">TCU Comer Organico</a>
            </li>
        </ul>

        <form class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Facebook -->
                <li class="nav-item">
                    <a class="nav-link" target="_blank"
                        href="https://www.facebook.com/Mercadito-de-Trueque-Verde-Manantial-100507492089380">
                        <i class="fab fa-facebook-square fa-lg"></i>
                    </a>
                </li>

                <!-- Instagram -->
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://www.instagram.com/truequeverdemanantial/">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </li>

                <!-- Whatsapp -->
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://wa.me/50688214946">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <?php 
                    if(!is_login())
                    {
                ?>
                    <!-- Login -->
                    <a class="nav-link btn btn-azul-oscuro" href="<?= baseUrl('login')?>" role="button" data-toggle="tooltip" title="Iniciar sesión">
                        <i class="fas fa-sign-in-alt fa-lg"></i>
                    </a>
                    <?php 
                    }
                    ?>
                </li>
            </ul>
        </form>
    </div>
</nav>