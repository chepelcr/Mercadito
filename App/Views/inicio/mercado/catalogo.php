<div class="modal fade" id="catalogo" aria-hidden="true" aria-labelledby="titulo_catalogo" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo_catalogo">Catalogo de articulos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="card h-100 text-center">
                            <div class="card-header">
                                <img src="<?= getFile('images/logo feria.png') ?>" class="card-img-top w-75 p-1"
                                    alt="Imagen del producto">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <b>Nombre del producto</b>
                                </h5>
                                <p class="card-text">
                                    <b>Precio:</b> $100 <br>
                                    <b>Cantidad:</b> 10 <br>
                                    <b>Descripción:</b> Descripcion del producto <br>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a target="_blank"
                                    href="https://wa.me/50670391069/?text=Me interesa el producto que estás truequeando"
                                    class="btn btn-outline-success">Solicitar por
                                    WhatsApp</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#informacion_puesto" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>