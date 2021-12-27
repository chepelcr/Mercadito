<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
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
            <div class="row text-center">
                <div class="col-3 img-div-center">
                    <a class="text-muted" target="_blank" href="<?= baseUrl()?>">
                        <img class="img-fluid w-75 img-centro-vert-hor"
                            src="<?= getFile('images/logo sin letras.png') ?>" alt="logo">
                    </a>
                </div>

                <div class="col-3">
                    <a class="text-muted" target="_blank"
                        href="https://www.facebook.com/Mercadito-de-Trueque-Verde-Manantial-100507492089380">
                        <i class="fab fa-facebook-square fa-3x"></i>
                    </a>
                </div>

                <div class="col-3">
                    <a class="text-muted" target="_blank" href="https://www.instagram.com/truequeverdemanantial/">
                        <i class="fab fa-instagram-square fa-3x"></i>
                    </a>
                </div>

                <div class="col-3">
                    <a class="text-muted" target="_blank" href="https://wa.me/50688214946"">
                                    <i class=" fab fa-whatsapp-square fa-3x"></i>
                    </a>
                </div>
            </div>

        </ul>
        <form class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl()?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('mercado')?>">Mercadito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('contacto')?>">Contacto</a>
                </li>
            </ul>
        </form>
    </div>
</nav>