<div class="row row-cols-1 row-cols-md-1 g-4">
    <div class="col-md-7">
        <div class="card rounded bg-secondary text-white">
            <div class="card-header bg-dark">
                <h1 class="card-title fs-4">Dejanos tus comentarios</h1>
            </div>

            <form id="frm_contacto">
                <div class="card-body">
                    <div class="input-group">
                        <label class="col-4" for="nombre_cliente">Nombre completo: </label>
                        <input class="form-control" required type="text" placeholder="Nombre completo"
                            name="nombre_cliente" id="nombre_cliente">
                    </div>

                    <br>

                    <div class="input-group">
                        <label class="col-4" for="nombre_cliente">Telefono: </label>
                        <input class="form-control" required type="text" placeholder="(xxx) xxxx-xxxx" name="telefono"
                            id="telefono">
                    </div>

                    <br>

                    <div class="input-group">
                        <label class="col-4" for="nombre_cliente">Correo electronico: </label>
                        <input class="form-control" required type="email" placeholder="Correo electronico" name="correo"
                            id="correo">
                    </div>

                    <br>

                    <div class="input-group">
                        <label class="col-4" for="nombre_cliente">Nombre del videojuego: </label>
                        <textarea name="mensaje" required id="mensaje" cols="30" rows="5"
                            placeholder="Dejanos tu mensaje!" class="form-control"></textarea>
                    </div>

                    <br>
                </div>

                <div class="card-footer bg-dark">
                    <div class="text-center">
                        <button class="btn btn-secondary" onclick="alert('Mensaje enviado')" type="submit">Enviar
                            solicitud</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="col-md-5">
        <div class="card text-white bg-secondary rounded">
            <div class="card-header text-center bg-dark">
                <h3 class="card-title fs-4">Encuentranos</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <article>
                            <header class="card-subtitle"><b>Direccion</b></header>
                            <section>
                                <p class="card-text">
                                    De la escuela Mora y cañas, 150m oeste y 75m sur.
                                </p>

                                <div class="text-center">
                                    <iframe class="w-100"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1652.130520762349!2d-84.81717781556995!3d9.979548547925818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa02ef67bfb42cb%3A0xa6f45103df7ba465!2zOcKwNTgnNDUuOSJOIDg0wrA0OScwMi40Ilc!5e0!3m2!1ses-419!2scr!4v1626197771681!5m2!1ses-419!2scr"
                                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </section>
                        </article>
                    </div>
                </div>
                
                <br>

                <div class="row text-center">
                        <div class="col-4">
                            <a class="text-dark" href="http://www.facebook.com">
                                <i class="fab fa-facebook-square fa-3x"></i>
                            </a>
                        </div>

                        <div class="col-4">
                            <a class="text-dark" href="http://www.instagram.com">
                                <i class="fab fa-instagram-square fa-3x"></i>
                            </a>
                        </div>

                        <div class="col-4">
                            <a class="text-dark" href="http://www.twitter.com">
                                <i class="fab fa-twitter-square fa-3x"></i>
                            </a>
                        </div>
                </div>
            </div>

            <div class="card-footer bg-dark text-muted">
                <article>
                    <header>Informacion de contacto</header>

                    <br>

                    <section>
                        Correo: <a href="#" class="text-white fw-bold">Doña Sonia</a>
                        <br>
                        Telefono: <a href="#" class="text-white fw-bold">(506) 8821-4946</a>
                    </section>
                </article>
            </div>
        </div>



    </div>
</div>