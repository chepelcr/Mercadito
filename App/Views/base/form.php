<div class="modal fade" id="modalAccion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titulo-form" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frm">
                <div class="modal-body">
                    <div class="container">
                        <div class="container-fluid">
                            <?php
                                if(isset($nombreForm))
                                {
                                    if(isset($dataForm))
                                        echo view($nombreForm, $dataForm);

                                    else
                                        echo view($nombreForm);
                                }//Fin de la validacion
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="w-100 btn btn-primary btt-grd">Guardar</button>
                    <button type="button" class="w-100 btn btn-secondary btt-edt">Editar</button>
                    <button type="button" class="w-100 btn btn-danger btt-mod">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>