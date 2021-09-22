//Cuando se le da click al boton de modificar
$(document).on('click', '#btn_informacion', function() {
    var id_puesto = this.value;

    //document.getElementById('puesto').innerHTML = '';

    /*$.ajax({
        "url": base + "puesto/obtener/" + id_puesto,
        "dataType": "json",
    }).done(function (response) {
        document.getElementById('puesto').innerHTML = response;
    });*/

    var modal_informacion = new bootstrap.Modal(document.getElementById('informacion_puesto'), {
        keyboard: false
    });
    modal_informacion.show();
});