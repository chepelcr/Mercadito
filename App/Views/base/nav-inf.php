<nav class="navbar navbar-expand-lg navbar-dark bg-mercadito-oscuro rounded grounded">
    <a class="navbar-brand" href="<?=baseUrl()?>">
        <div class="col-2 img-div-center">
            <img class="img-fluid w-25 img-centro-vert-hor" src="<?= getFile('images/logo sin letras.png') ?>"
                alt="logo">
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footer"
        aria-controls="footer" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="footer">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- Inicio -->
            <li class="nav-item text-white">
                © 2022 José Pablo Campos:
                <a class="text-reset fw-bold nax-link"
                    href="https://sociologia.fcs.ucr.ac.cr/index.php/proyectos/accion-social/2-uncategorised/302-programa-de-la-economia-social-solidaria"
                    data-toggle="tooltip" title="Escuela de Sociología, Universidad de Costa Rica" target="_blank">TCU
                    Comer Organico</a>
            </li>
        </ul>

        <form class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Facebook -->
                <li class="nav-item" title="Facebook" data-toggle="tooltip">
                    <a class="nav-link" target="_blank"
                        href="https://www.facebook.com/Mercadito-de-Trueque-Verde-Manantial-100507492089380">
                        <i class="fab fa-facebook-square fa-lg"></i>
                    </a>
                </li>

                <!-- Instagram -->
                <li class="nav-item" title="Instagram" data-toggle="tooltip">
                    <a class="nav-link" target="_blank" href="https://www.instagram.com/truequeverdemanantial/">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </li>

                <!-- Whatsapp -->
                <li class="nav-item" title="Whatsapp" data-toggle="tooltip">
                    <a class="nav-link" target="_blank" href="https://wa.me/50688214946">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </a>
                </li>

                <?php 
                    if(!is_login())
                    {
                ?>
                <li class="nav-item" data-toggle="tooltip" title="Iniciar sesión">
                    <!-- Login -->
                    <button type="button" class="nav-link btn btn-azul-oscuro" onclick="cargar_login()">
                        <i class="fas fa-sign-in-alt fa-lg"></i>
                    </button>
                </li>
                <?php 
                    }
                    ?>
            </ul>
        </form>
    </div>
</nav>