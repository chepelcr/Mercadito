<nav class="main-header navbar navbar-expand navbar-dark bg-secondary nav-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=baseUrl()?>" onclick="cargar_inicio()">
            <img src="<?=getFile('images/logo sin letras.png')?>" alt="Mercadito del Trueque"
                class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
            <span class="brand-text font-weight-light"><?= $nombre_feria?></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-top"
            aria-controls="navbar-top" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-top">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item pr-1">
                    <button class="btn btn-secondary nav-ferias btn_inicio_mercadito nav-modulo" type="button"
                        onclick="cargar_feria()">
                        <i class="fas fa-store"></i> Mercadito
                    </button>
                </li>

                <li class="nav-item pr-1">
                    <!---Contacto-->
                    <button class="btn btn-secondary btn_inicio_contacto nav-modulo" type="button"
                        onclick="cargar_listado('inicio', 'contacto', '<?= baseUrl('inicio/contacto/listado') ?>')">
                        <i class="fas fa-phone"></i> Contacto
                    </button>
                </li>

                <!-- Quienes somos -->
                <li class="nav-item pr-1">
                    <button class="btn btn-secondary btn_inicio_quienes_somos nav-modulo" type="button"
                        onclick="cargar_listado('inicio', 'quienes_somos', '<?= baseUrl('inicio/quienes_somos/listado') ?>')">
                        <i class="fas fa-users"></i> Quienes somos
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
                            echo '<li class="nav-item pr-1">
                            <button class="btn btn-secondary nav-modulo btn-perfil" data-toggle="tooltip" title="Perfil" onclick="abrir_perfil()"
                                type="button"><i class="fas fa-user-circle nav-icon"></i> '.getSession('nombre').'
                            </button>
                            </li>';
                        }
                        
                        //Mostrar boton para registrar organizacion
                            echo '<li class="nav-item pr-1">
                            <button class="btn btn-warning btn-registro-organizacion" data-toggle="tooltip" title="Registrar organización" onclick="abrir_registro_organizacion()"
                                type="button"><i class="fa-solid fa-plug-circle-check"></i>
                            </button>
                            </li>';

                            echo '<li class="nav-item pr-1 nav-ferias">
                            <button class="btn btn-danger btn-salir-feria" data-toggle="tooltip" title="Salir de feria" onclick="salir_feria()"
                                type="button"><i class="fas fa-sign-out-alt nav-icon"></i>
                            </button>
                            </li>';
                        if(is_login())
                        {
                            //Logout
                            echo '<li class="nav-item">
                            <!-- Salir -->
                            <button class="btn btn-dark" data-toggle="tooltip" title="Cerrar sesión" onclick="salir()" type="button">
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