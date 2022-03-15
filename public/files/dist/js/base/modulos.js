/** Nombre del modulo activo */
var modulo_activo = '';

/** Nombre del submodulo activo */
var submodulo_activo = '';

/** Elemento que se está mostrando en la aplicación */
var elemento_activo = '';

/**Activar tooltips */
function activar_tooltips() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
}

/**Desactivar tooltips */
function desactivar_tooltips() {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip('dispose')
    });
}

/**Ocultar todos los contenedores de la página */
function ocultar_contenedores() {
    //Ocultar el contenedor de inicio
    $('#inicio').hide();

    //Ocultar el contenedor
    $('#contenedor').hide();

    //Ocultar los modal
    $('.modal').modal('hide');
}

/**Cargar un modulo en la pantalla 
 * @param {string} nombre_modulo Nombre del modulo a cargar
*/
function cargar_modulo(nombre_modulo) {
    ocultar_contenedores();

    activar_tooltips();

    elemento_activo = nombre_modulo;

    $('#' + nombre_modulo).show();
}

/**Cuando el documento está listo */
$(document).ready(function () {
    activar_tooltips();

    $(document).keydown(function (e) {
        //Si no hay ningun input enfocado
        if (!$('input:focus').length && !$('textarea:focus').length && !$('select:focus').length && e.ctrlKey) {
            if (modulo_activo != 'inicio' && e.ctrlKey && submodulo_activo != 'inicio') {
                //Si el usuario presiona ctrlLeft+n en un modulo distinto al de inicio y documentos
                if (e.which == 78 && form_activo == '') {
                    e.preventDefault();
                    agregar('Agregar ' + submodulo_activo)
                }

                if (form_activo != '') {
                    //Si el usuario presiona ctrlLeft+e
                    if (e.which == 69) {
                        e.preventDefault();
                        editar();
                    }

                    //Si el usuario presiona ctrl+c
                    if (e.which == 67) {
                        e.preventDefault();
                        cancelar_accion();
                    }
                }

                else {
                    if (table != null) {
                        //Si el usuario presiona la tecla flecha abajo
                        if (e.which == 40) {
                            //Ir al siguiente elemento
                            siguiente_elemento();
                        }
    
                        //Si el usuario presiona la tecla flecha arriba
                        if (e.which == 38) {
                            //Ir al anterior elemento
                            elemento_anterior();
                        }
                    }
                }
            }

            else {
                //Si el usuario presiona ctrlLeft+e
                if (e.which == 69) {
                    e.preventDefault();
                    cargar_inicio_modulo('empresa');
                }

                //Si el usuario presiona ctrlLeft+s
                if (e.which == 83) {
                    e.preventDefault();
                    cargar_inicio_modulo('seguridad');
                }

                //Si el usuario presiona ctrlLeft+d
                if (e.which == 68) {
                    e.preventDefault();
                    cargar_inicio_modulo('documentos');
                }

                //Si el usuario presiona ctrlLeft+i
                if (e.which == 73) {
                    e.preventDefault();
                    cargar_inicio();
                }
            }
        }
    });
});

/**Cambiar el titulo de la pagina y agregarla al historial 
 * @param {string} modulo Nombre del modulo a cargar
 * @param {string} submodulo Nombre del submodulo a cargar
*/
function poner_titulo(modulo, submodulo = 'inicio') {
    modulo_activo = modulo;
    submodulo_activo = submodulo;

    //modulo con primera letra en mayuscula
    var modulo_mayuscula = modulo.charAt(0).toUpperCase() + modulo.slice(1);

    //Submodulo con primera letra en mayuscula
    var submodulo_mayuscula = submodulo.charAt(0).toUpperCase() + submodulo.slice(1);

    //Eliminar guiones bajos de los nombres de los modulos en mayuscula
    modulo_mayuscula = modulo_mayuscula.replace(/_/g, ' ');

    //Eliminar guiones bajos de los nombres de los submodulos en mayuscula
    submodulo_mayuscula = submodulo_mayuscula.replace(/_/g, ' ');

    $('.modulo-pagina').text(modulo_mayuscula);

    $('.submodulo-pagina').text(submodulo_mayuscula);

    if (submodulo_mayuscula != 'Inicio') {
        titulo = 'Red de Trueque | ' + modulo_mayuscula + ' | ' + submodulo_mayuscula;

        //Agregar pagina al historial
        history.pushState(null, null, base + modulo + '/' + submodulo);
    }

    else {
        titulo = 'Red de Trueque | ' + modulo_mayuscula;

        //Agregar pagina al historial
        history.pushState(null, null, base + modulo);
    }

    //Cambiar el titulo del navegador web
    $('title').text(titulo);
}//Fin de poner_titulo