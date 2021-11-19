//Documento listo
$(document).ready(function() {
    //Cuando se le da click al boton de agregar
    $(document).on('click', '#btnAgregar', function () {
        $(".titulo-form").html('Agregar participante');
        reiniciarUbicacion();
    });

    //Agregar un nuevo usuario
    $("#frm").on('submit', function (e) {
        e.preventDefault();

        Pace.track(function () {
            $.ajax({
                "url": base + "mercado/guardar/participantes",
                "method": "post",
                "data": $('#frm').serialize(),
                "dataType": "json",
            }).done(function (response) {

                if (!response.error) {
                    mensajeAutomaticoRecargar("Atencion", 'Participante agregado correctamente, revisar correo electronico.', "success");
                } //Fin del if
                else {
                    mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
                } //Fin del else
            });
        });
    });
});