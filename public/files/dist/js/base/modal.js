/**
 * @param {boolean} modal Nombre del modal activo
 */
var modal_activo = '';

/**Abrir un modal
 * @param {string} nombre_modal Nombre del modal a abrir
 */
function abrir_modal(nombre_modal) {
    //Cerrar todos los modal
    $('.modal').modal('hide');

    //Abrir el modal-nombre_modulo
    $('#' + nombre_modal).modal('show');

    modal_activo = true;
    elemento_activo = nombre_modal;
}

/**Cerrar modal 
 * @param {string} nombre_modal Nombre del modal a cerrar
*/
function cerrar_modal(nombre_modal = '') {
    if (nombre_modal == '') {
        if(modal_activo != false) {
            nombre_modal = elemento_activo;
        }
    }

    $('#' + nombre_modal).modal('hide');
    modal_activo = false;
}
