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
                                //Mostrar puesto
                                echo '<li class="nav-item">
                                    <a class="nav-link" href="'.baseUrl("mercado/puesto").'">
                                        Puesto <i class="fas fa-people-carry"></i>
                                    </a>
                                </li>';

                                 //Mostrar catalogo
                                 echo '<li class="nav-item">
                                    <a class="nav-link" href="'.baseUrl("mercado/catalogo").'">
                                        Catalogo <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>';
                            }

                            else
                            {
                                echo view('base/nav/drop_seguridad');

                                echo view('base/nav/drop_feria');
                            }

                            //Perfil
                            echo '<li class="nav-item">
                            <a class="nav-link" href="'.baseUrl("seguridad/perfil").'">'.getSession('nombre').' <i class="fas fa-user-circle fa-lg"></i></a>
                            
                            </li>';
                        }
                    ?>
                </ul>
            </form>
        </div>
    </div>
</nav>