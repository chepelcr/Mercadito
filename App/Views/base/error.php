<div class="row pt-2 justify-content-start h-100">
    <div class="col-12 ">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h2 class="col-4 text-center text-warning">
                        <br>
                        
                        <?php if(!is_null($error))
                        {
                            echo $error->codigo;
                        }?>
                    </h2>

                    <div class="col-8">
                        <br>

                        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Atencion</h3>

                        <p>
                            <?php if(!is_null($error))
                        {
                            echo $error->mensaje;
                        }?>
                        </p>
                    </div>
                    <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
            </div>
        </div>
    </div>
</div>