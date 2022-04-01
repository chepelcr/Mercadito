<!DOCTYPE html>
<html lang="es">

<head>
    <?php
        if(isset($dataHead))
            echo view('base/head', $dataHead);

        else
            echo view('base/head');
    ?>
</head>

<body class="bg-mercadito-claro layout-fixed layout-footer-fixed layout-top-nav">
    <div class="wrapper">
        <div class="loader">
            <div class="circle-small"></div>
            <figure>
                <img class="circle-inner-inner img-fluid" src="<?=baseUrl('files/images/logo sin letras.png')?>"
                    alt="Red de trueke">

                <!-- Colocar 'cargando' abajo de la imagen -->
                <figcaption class="text-center pt-5">
                    <h1>Mercadito del Trueque</h1>
                </figcaption>
            </figure>
        </div>

        <?php 
            echo view('base/navbar', $nav);
        ?>

        <div class="content-wrapper pt-2 bg-transparent">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="inicio">
                            <?php
                                echo view('inicio/dash', $data_inicio);
                            ?>
                        </div>

                        <div class="col-md-12">
                            <!-- Recorre submodulos y cargar modulo de inicio -->
                            <?php
                                foreach ($modulos as $modulo) {
                                    $nombre_modulo = $modulo->nombre_modulo;
                            ?>

                            <div id="contenedor_<?=$nombre_modulo?>">
                                <?php
                                    echo view('base/modal/modulo', $modulo);

                                        //var_dump($modulo->submodulos);
                                        //Recorrer submodulos
                                        foreach($modulo->submodulos as $submodulo):
                                            $submodulo->nombre_modulo = $modulo->nombre_modulo;

                                            //var_dump($submodulo);

                                            if($modulo != 'administracion' && $submodulo != 'auditorias')
                                                echo view('base/modal/submodulo', $submodulo);
                                        endforeach;
                                ?>
                            </div>

                            <?php } ?>
                        </div>


                        <div class="col-md-12 contenedor pt-2 pb-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-body bg-dark">
                                        <?= view('base/header') ?>
                                    </div>
                                </div>

                                <div class="col-md-12" id="contenedor">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Perfil del usuario que ha iniciado sesion -->
        <?php 
            echo view('base/persona/perfil', array('perfil'=> getPerfil()));

            if(!is_login())
                echo view('base/modal/login');
            ?>

        <?php echo view('base/footer')?>
    </div>

    <?php

        if(isset($script))
        {
            $data = array(
                'script'=>$script
            );
    
            echo view('base/script', $data);
        }

        else
            echo view('base/script');
    ?>
</body>

</html>