//Cuando se le da click al boton de informacion
function abrir_puesto(id_puesto)
{
    var nombre = 'informacion_puesto';

    var modal_informacion = new bootstrap.Modal(document.getElementById(nombre), {
        keyboard: false
    });

    modal_informacion.show();
}