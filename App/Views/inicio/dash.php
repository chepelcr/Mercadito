<div class="row">
    <!-- Noticias -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Noticias
                    </h3>

                    <!-- Ver noticias -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-noticias">
                        <i class="fa fa-newspaper-o"></i>
                    </button>
                </div>
            </div>

            <div class="card-body scroll_vertical_inicio">
                <!-- Colocar 4 noticias -->
                <?php //foreach($noticias as $noticia):?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= 'Noticia 1' //$noticia->titulo?>
                        </h3>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <p class="card-text text-truncate pr-2">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit, molestias accusamus
                            doloremque velit porro esse recusandae voluptas ex inventore reprehenderit quam error
                            nam, nulla nesciunt temporibus maiores saepe labore enim.
                            <?='' //$noticia->descripcion ?>
                        </p>
                        <button onclick="ver_noticia(1)" class="btn btn-dark" title="Leer mas" data-toggle="tooltip">
                            <a href="<?='#' //$noticia->url?>" class="text-white" role="button">
                                <i class="fa fa-eye"></i>
                            </a>
                        </button>
                    </div>
                </div>
                <?php //endforeach;?>
            </div>
        </div>
    </div>

    <!-- Eventos -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        Eventos
                    </h3>

                    <!-- Ver calendario -->
                    <button class="btn btn-dark" title="Ver calendario" data-toggle="tooltip"
                        onclick="ver_calendario()">
                        <i class="fa fa-calendar"></i>
                    </button>
                </div>
            </div>

            <div class="card-body scroll_vertical_inicio">
                <!-- Colocar 4 eventos -->
                <?php //foreach($eventos as $evento):?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= 'Evento 1' //$evento->titulo?>
                        </h3>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <p class="card-text text-truncate pr-2">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, hic debitis excepturi
                            consequuntur repellat iusto in mollitia harum ipsa ducimus fugiat optio, rem culpa esse.
                            Alias dolor ut non id.
                            <?= '' //$evento->descripcion?>
                        </p>

                        <!-- Mas informacion -->
                        <button type="button" onclick="cargar_inicio_modulo('eventos')" class="btn btn-dark"
                            data-toggle="tooltip" title="Mas informacion">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <?php //endforeach;?>
            </div>
        </div>
    </div>

    <?php if(!is_login()):?>
    <div class="col-md-8">
        <?php else:?>
        <div class="col-md-4">
            <?php endif;?>
            <!-- Imagenes -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">
                            Imagenes
                        </h3>

                        <button type="button" onclick="cargar_inicio_modulo('galeria')" class="btn btn-dark"
                            data-toggle="tooltip" title="Ver galeria">
                            <i class="fa fa-image"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Colocar 4 cards en row.col-md-3 -->
                    <div class="row">
                        <?php //foreach($imagenes as $imagen):?>
                        <?php if(!is_login()):?>
                        <div class="col-md-2">
                            <?php else:?>
                        <div class="col-md-4">
                                <?php endif;?>
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?= getFile('images/logo feria.png') //getFile($imagen->url)?>"
                                            class="img-fluid" alt="Imagen de prueba" onclick="verImagen( 'images/logo feria.png' /*'$imagen->url'*/)">
                                    </div>
                                </div>
                        </div>
                        <?php //endforeach;?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ferias virtuales -->
        <div class="col-md-4 pb-3">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">
                            Ferias virtuales
                        </h3>

                        <button type="button" onclick="ver_ferias()" class="btn btn-dark"
                            data-toggle="tooltip" title="Ver ferias">
                            <i class="fa fa-calendar"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body scroll_vertical_inicio">
                    <!-- Colocar 4 ferias -->
                    <?php foreach($ferias as $feria):?>
                        <div class="card card-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">
                                    <?= $feria->nombre?>
                                </h3>

                                <!-- Mas informacion -->
                                <button type="button" onclick="cargar_feria('<?=$feria->id_feria ?>', 'inicio')" class="btn btn-dark"
                                    data-toggle="tooltip" title="Mas informacion">
                                    <i class="fa-solid fa-handshake-simple"></i>
                                </button>
                            </div>
                        </div>
                        <?php endforeach;?>
                </div>
            </div>
        </div>

        <?php if(is_login()):?>
        <!-- Modulos -->
        <div class="col-md-4 pb-3">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">
                            Modulos
                        </h3>

                        <button disabled type="button" onclick="cargar_inicio_modulo('modulos')" class="btn btn-dark"
                            data-toggle="tooltip" title="Ver modulos">
                            <i class=" fa fa-cubes"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body scroll_vertical_inicio">
                    <!-- Colocar 4 modulos -->
                    <?php foreach($modulos as $modulo):?>
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <p class="card-title w-75 ">
                                <?= ucwords(str_replace('_', ' ',$modulo->nombre_modulo))?>
                            </p>

                            <button type="button" onclick="cargar_inicio_modulo('<?php echo $modulo->nombre_modulo?>')"
                                title="<?php echo ucwords(str_replace('_', ' ',$modulo->nombre_modulo))?>"
                                data-toggle="tooltip" class="btn btn-dark">
                                <!-- Icono del modulo -->
                                <i class="fa <?php echo $modulo->icono?>"></i>
                            </button>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>