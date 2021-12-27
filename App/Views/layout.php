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

<body class="bg-mercadito-claro pt-2">
    <div class="container">
        <div class="container-fluid">
            <img src="<?=getFile('images/letras feria.png')?>" class="img-fluid align-self-center pb-2" alt="">

            <?php 
                echo view('base/navbar');
            ?>
        </div>
    </div>

    <div class="container pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        if(isset($dataView))
                            echo view($nombreVista, $dataView);
                        
                        else
                            echo view($nombreVista);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo view('base/footer')?>

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