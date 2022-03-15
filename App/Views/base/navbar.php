<nav class="main-header navbar navbar-expand navbar-dark bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=baseUrl()?>">
            <img src="<?=getFile('images/logo sin letras.png')?>" alt="Mercadito del Trueque" class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
            <span class="brand-text font-weight-light">Trueque Verde Manantial</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button class="btn btn-secondary" type="button">
                        <i class="fas fa-store"></i> Mercadito
                    </button>
                </li>

                <li class="nav-item">
                    <!---Contacto-->
                    <button class="btn btn-secondary" type="button">
                        <i class="fas fa-phone"></i> Contacto
                    </button>
                </li>
            </ul>
            <form class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                        if(is_login())
                        {
                            echo view('base/drop', array('modulos' => $modulos));

                            //Perfil
                            echo '<li class="nav-item">
                            <button class="btn btn-secondary nav-modulo" data-toggle="tooltip" title="Perfil" onclick="abrir_perfil()"
                                type="button">'.getSession('nombre').' <i class="fas fa-user-circle nav-icon"></i>
                            </button>
                            </li>';

                            //Logout
                            echo '<li class="nav-item">
                            <!-- Salir -->
                            <button class="btn btn-secondary nav-modulo" data-toggle="tooltip" title="Salir" onclick="salir()" type="button">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                            </button>
                            </li>';

                        }
                    ?>
                </ul>
            </form>
        </div>
    </div>
</nav>