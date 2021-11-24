<div class="modal fade" id="informacion_puesto" aria-hidden="true" aria-labelledby="nombre_puesto" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nombre_puesto">"Nombre del puesto"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="container">
                                <img src="<?= getFile('images/logo sin letras.png') ?>" class="card-img-top p-2"
                                    alt="Imagen del puesto o empresa">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <article>
                                <P>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
                                    voluptatum!
                                </P>
                                    <b>Informacion de contacto</b> <br>
                                    <b>Nombre:</b> Nombre del contacto <br>
                                    <b>Numero de telefono</b>: 7039-1069 <br>
                                    <b>Correo electronico</b>: <a href="#">chepelcr@outlook.com</a>
                                </P>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#catalogo" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Catalogo de articulos</button>
                    <button class="btn btn-info">Enviar correo electroncico</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        echo view('mercadito/mercado/catalogo');
    ?>