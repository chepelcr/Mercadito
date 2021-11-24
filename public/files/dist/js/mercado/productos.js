$("#frm").enctype = "multipart/form-data";

$(".imagen").hide();

//Cuando el documento esta listo
$(document).ready(function () {

    //Cuando se le da click al boton de agregar
    $(document).on('click', '#btnAgregar', function () {
        $(".titulo-form").html('Agregar producto');

        //Mostrar la columna de imagen
        $(".imagen").show();
    });

    //Agregar un nuevo producto
    $("#frm").on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        
        Pace.track(function () {
            $.ajax({
                "url": base + "mercado/guardar/productos",
                "method": "post",
                "data": formData,
                "dataType": "json",
                "contentType": false,
                "processData": false,
                "cache": false
            }).done(function (response) {
                if (!response.error) {
                    mensajeAutomaticoRecargar("Atencion", response.success, "success");
                } //Fin del if
                else {
                    mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
                } //Fin del else
            });
        });
    });
});