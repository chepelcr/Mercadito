<nav class="navbar navbar-expand-lg navbar-dark bg-secondary rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=baseUrl()?>">Feria del Trueque</a>

        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('mercado')?>">Mercadito</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('contacto/quienes_somos')?>">¿Quienes somos?</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('contacto')?>">Contacto</a>
                </li>

                <div class="d-flex">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=baseUrl('contacto/inscripciones')?>">Inscripciones</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?=baseUrl('contacto')?>">Productos</a>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>