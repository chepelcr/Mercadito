//Cuando el documento esta listo
$(document).ready(function () {
    /**Cargar el preloader y luego el inicio */
    loading();
});

/**Cargar la animación de inicio
 * @param funcion_cargar - Funcion que se ejecutara al terminar la animación
 */
function loading(function_cargar = function () { }) {
    var num = 0;
    $('.content-wrapper').hide();
    $('.main-header').hide();
    $('.main-footer').hide();

    for (i = 0; i <= 100; i++) {
        setTimeout(function () {
            if (num == 100) {
                $('.loader').hide();

                $('.main-header').show();
                $('.main-footer').show();
                $('.content-wrapper').show();

                //Si la funcion tiene contenido
                if (function_cargar != '') {
                    function_cargar();
                }

            }
            num++;
        }, i * 40);
    };
}

/**Cargar el modulo de inicio de la aplicacion */
function cargar_inicio() {
    poner_titulo('inicio');
    desactivar_tooltips();

    //Cargar el modulo de inicio
    cargar_modulo('inicio');

    //Activar el boton de inicio
    //activar_modulo_boton('inicio');

    elemento_activo = '';
    form_activo = '';

    activar_tooltips();
}

/**Cargar el modulo de inicio de un modulo 
 * @param nombre_modulo - Nombre del modulo a cargar
*/
function cargar_inicio_modulo(nombre_modulo) {
    poner_titulo(nombre_modulo);
    //desactivar_tooltips();

    activar_modulo_boton(nombre_modulo);

    //Cerrar todos los modal
    $('.modal').modal('hide');

    //Abrir el modal-nombre_modulo
    $('#modal-' + nombre_modulo).modal('show');

    elemento_activo = 'modal-' + nombre_modulo;

    form_activo = '';

    //activar_tooltips();
}

/**Activar el boton para un modulo y su submodulo 
 * @param nombre_modulo - Nombre del modulo a activar
 * @param nombre_submodulo - Nombre del submodulo a activar
*/
function activar_modulo_boton(nombre_modulo, nombre_submodulo = '') {
    $('.nav-button').each(function (i, e) {
        //Desactivar todos los botones
        $(e).removeClass('btn-info');
        $(e).addClass('btn-dark');
    });

    //Desactivar todos los .nav-menu
    $('.nav-menu').each(function (i, e) {
        $(e).removeClass('btn-success');
        $(e).addClass('btn-danger');
    });

    //Desactivar otros botones
    $('.nav-modulo').addClass('btn-secondary').removeClass('btn-warning');

    //Activar el boton del modulo
    $('.nav-' + nombre_modulo).addClass('btn-warning').removeClass('btn-secondary');

    if (nombre_modulo == 'documentos') {
        $('.btn-documentos').addClass('btn-info').removeClass('btn-dark');
    }

    //Si el nombre del submodulo no esta vacio
    if (nombre_submodulo != '') {
        //Activar el boton del submodulo
        $('.btn_' + nombre_modulo + '_' + nombre_submodulo).addClass('btn-info').removeClass('btn-dark');

        //Desactivar otros botones
        $('.nav-item').each(function (i, e) {
            if (!$(e).hasClass('nav-' + nombre_modulo)) {
                $(e).find('.nav-submodulo').addClass('btn-dark').removeClass('btn-info');
            }
        });

        //Desactivar todos los .nav-menu
        $('.nav-menu').each(function (i, e) {
            $(e).removeClass('btn-success');
            $(e).addClass('btn-danger');
        });

        //Activar el .nav-menu
        $('.nav-menu-' + nombre_modulo).addClass('btn-success').removeClass('btn-danger');
    }
}

