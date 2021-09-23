 <div class="card">
     <div class="card-header bg-dark text-white">
         <h1 class="card-title fs-4">Mercadito Virtual del Trueque</h1>
     </div>

     <div class="card-body bg-secondary">
         <div class="row row-cols-1 row-cols-md-3 g-4">
             <div class="col">
                 <div class="card h-100 text-center">
                     <div class="container">
                         <img src="<?=getFile('images/logo sin letras.png')?>" class="card-img-top p-2"
                             alt="Imagen del puesto o empresa">
                     </div>

                     <div class="card-body">
                         <h5 class="card-title fs-6">"Nombre del puesto 1"</h5> <br>
                         <button type="button" id="btn_informacion" value="1" class="btn btn-primary">Mas
                             informacion</button>
                     </div>
                 </div>
             </div>
             <div class="col">
                 <div class="card h-100 text-center">
                     <div class="container">
                         <img src="<?=getFile('images/logo sin letras.png')?>" class="card-img-top p-2"
                             alt="Imagen del puesto o empresa">
                     </div>
                     <div class="card-body">
                         <h5 class="card-title fs-6">"Nombre del puesto 2"</h5> <br>
                         <button type="button" id="btn_informacion" value="1" class="btn btn-primary">Mas
                             informacion</button>
                     </div>
                 </div>
             </div>
             <div class="col">
                 <div class="card h-100 text-center">
                     <div class="container">
                         <img src="<?=getFile('images/logo sin letras.png')?>" class="card-img-top p-2"
                             alt="Imagen del puesto o empresa">
                     </div>
                     <div class="card-body">
                         <h5 class="card-title fs-6">"Nombre del puesto 3"</h5> <br>
                         <button type="button" id="btn_informacion" value="1" class="btn btn-primary">Mas
                             informacion</button>
                     </div>
                 </div>
             </div>
             <div class="col">
                 <div class="card h-100 text-center">
                     <div class="container">
                         <img src="<?=getFile('images/logo sin letras.png')?>" class="card-img-top p-2"
                             alt="Imagen del puesto o empresa">
                     </div>
                     <div class="card-body">
                         <h5 class="card-title fs-6">"Nombre del puesto 4"</h5> <br>
                         <button type="button" id="btn_informacion" value="1" class="btn btn-primary">Mas
                             informacion</button>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 </div>
 </div>
 </div>

 <div class="row" id="puesto">
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
                                 <img src="<?=getFile('images/logo sin letras.png')?>" class="card-img-top p-2"
                                     alt="Imagen del puesto o empresa">
                             </div>
                         </div>
                         <div class="col-md-8">
                             <article>
                                 <P>
                                     <b>Numero de puesto</b>: 1 <br>
                                     <b>Descripción general</b>: Descripcion del puesto <br> <br>
                                     <b>Informacion de contacto</b> <br>
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

     <div class="modal fade" id="catalogo" aria-hidden="true" aria-labelledby="titulo_catalogo" tabindex="-1">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="titulo_catalogo">Catalogo de articulos</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="row row-cols-1 row-cols-md-3 g-4">
                         <div class="col">
                             <div class="card h-100">
                                 <div class="text-center">
                                     <img src="<?=getFile('images/logo feria.png')?>" class="card-img-top w-75 p-1"
                                         alt="Imagen del producto">
                                 </div>
                                 <div class="card-body text-center">
                                     <h5 class="card-title">Nombre del producto</h5>
                                     <p class="card-text">Descripcion.</p>
                                 </div>
                                 <ul class="list-group list-group-flush">
                                     <li class="list-group-item">Valor: $0000</li>
                                 </ul>
                                 <div class="card-body">
                                     <a target="_blank"
                                         href="https://wa.me/50670391069/?text=Me interesa el producto que estás truequeando"
                                         class="btn btn-outline-success">Soliciar Informacion por
                                         WhatsApp</a>
                                 </div>
                             </div>
                         </div>

                         <div class="col">
                             <div class="card h-100">
                                 <div class="text-center">
                                     <img src="<?=getFile('images/logo feria.png')?>" class="card-img-top w-75 p-1" alt="...">
                                 </div>
                                 <div class="card-body text-center">
                                     <h5 class="card-title">Nombre del producto</h5>
                                     <p class="card-text">Descripcion.</p>
                                 </div>
                                 <ul class="list-group list-group-flush">
                                     <li class="list-group-item">Valor: $0000</li>
                                 </ul>
                                 <div class="card-body">
                                     <a target="_blank"
                                         href="https://wa.me/50670391069/?text=Me interesa el producto que estás truequeando"
                                         class="btn btn-outline-success">Soliciar Informacion por
                                         WhatsApp</a>
                                 </div>
                             </div>
                         </div>

                         <div class="col">
                             <div class="card h-100">
                                 <div class="text-center">
                                     <img src="<?=getFile('images/logo feria.png')?>" class="card-img-top w-75 p-1" alt="...">
                                 </div>
                                 <div class="card-body text-center">
                                     <h5 class="card-title">Nombre del producto</h5>
                                     <p class="card-text">Descripcion.</p>
                                 </div>
                                 <ul class="list-group list-group-flush">
                                     <li class="list-group-item">Valor: $0000</li>
                                 </ul>
                                 <div class="card-body">
                                     <a target="_blank"
                                         href="https://wa.me/50670391069/?text=Me interesa el producto que estás truequeando"
                                         class="btn btn-outline-success">Soliciar Informacion por
                                         WhatsApp</a>
                                 </div>
                             </div>
                         </div>
                         <div class="col">
                             <div class="card h-100">
                                 <div class="text-center">
                                     <img src="<?=getFile('images/logo feria.png')?>" class="card-img-top w-75 p-1" alt="...">
                                 </div>
                                 <div class="card-body text-center">
                                     <h5 class="card-title">Nombre del producto</h5>
                                     <p class="card-text">Descripcion.</p>
                                 </div>
                                 <ul class="list-group list-group-flush">
                                     <li class="list-group-item">Valor: $0000</li>
                                 </ul>
                                 <div class="card-body">
                                     <a target="_blank"
                                         href="https://wa.me/50670391069/?text=Me interesa el producto que estás truequeando"
                                         class="btn btn-outline-success">Soliciar Informacion por
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
 </div>

<script>

</script>