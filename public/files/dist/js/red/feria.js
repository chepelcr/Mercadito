//Cuando se le da click al boton de informacion
$(document).on('click', '.btt_inf', function() {
    var id_puesto = this.value;

    var nombre = 'informacion_puesto'

    console.log(nombre);

    var modal_informacion = new bootstrap.Modal(document.getElementById(nombre), {
        keyboard: false
    });

    modal_informacion.show();
});