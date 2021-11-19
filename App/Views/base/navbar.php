<nav class="navbar navbar-expand-lg navbar-dark bg-secondary rounded">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=baseUrl()?>">Feria del Trueque</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('mercado')?>">Mercadito</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('contacto/quienes_somos')?>">¿Quienes somos?</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?=baseUrl('contacto')?>">Contacto</a>
                </li>
            </ul>
            <form class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                        if(is_login())
                        {
                            if(!is_admin())
                            {
                                echo '<li class="nav-item">
                                <a class="nav-link" href="'.baseUrl("mercado/productos").'">Productos <i class="fa fa-shopping-cart"></i>
                                </a></li>';
                            }

                            else
                            {
                                echo '<li class="nav-item">
                                <a class="nav-link" href="'.baseUrl("mercado/inscripciones").'">Inscripciones <i class="fas fa-store-alt"></i></a></li>';
                                echo '<li class="nav-item">
                                <a class="nav-link" href="'.baseUrl("seguridad").'">Administradores <i class="fas fa-users"></i></a>
                                <!-- Icono de usuarios-->
                                </li>';
                            }

                            //Perfil
                            echo '<li class="nav-item">
                            <a class="nav-link" href="'.baseUrl("seguridad/perfil").'">'.getSession('nombre').' <i class="fas fa-user-circle fa-lg"></i></a>
                            
                            </li>';
                        }

                        else
                        {
                            //Inscripciones
                            echo '<li class="nav-item">
                            <a class="nav-link" href="'.baseUrl("mercado/inscripciones").'">Inscripciones 
                            <!-- Icono de tienda -->
                            <i class="fas fa-store-alt"></i></a></li>';

                        }

                        
                    ?>
                </ul>
            </form>
        </div>
    </div>
</nav>