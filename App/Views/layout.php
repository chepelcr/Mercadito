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
                    alt="Modas Laura">

                <!-- Colocar 'cargando' abajo de la imagen -->
                <figcaption class="text-center pt-5">
                    <h1>Mercadito del Trueque</h1>
                </figcaption>
            </figure>
        </div>

        <?php 
            echo view('base/navbar', array('modulos' => $modulos));
        ?>

        <div class="content-wrapper pt-2 bg-transparent">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="inicio">
                            <?php
                                echo view('inicio/dash', array('modulos'=>$modulos));
                            ?>
                        </div>

                        <div class="col-md-12">
                            <!-- Recorre submodulos y cargar modulo de inicio -->
                            <?php
                                foreach ($modulos as $modulo) {
                                    $nombre_modulo = $modulo->nombre_modulo;
                            ?>

                            <div class="contenedor" id="contenedor_<?=$nombre_modulo?>">
                                <?php
                                    echo view('base/modal/modulo', $modulo);

                                        //var_dump($modulo->submodulos);
                                        //Recorrer submodulos
                                        foreach($modulo->submodulos as $submodulo):
                                            $submodulo->nombre_modulo = $modulo->nombre_modulo;

                                            //var_dump($submodulo);

                                            if($modulo != 'seguridad' && $submodulo != 'auditorias')
                                                echo view('base/modal/submodulo', $submodulo);
                                        endforeach;
                                ?>
                            </div>

                            <?php } ?>
                        </div>


                        <div class="col-md-12 contenedor" id="contenedor">
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Perfil del usuario que ha iniciado sesion -->
        <?= view('base/persona/perfil', array('perfil'=> getPerfil()))?>

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