/**Id de la feria que esta cargada en el sistema */
id_feria_activo = '';

//Cuando el documento esta listo
$(document).ready(function () {
    /**Cargar el preloader y luego el inicio */
    loading();

    /**Cuando el usuario da click a a */
    $(document).on('click', '.navbar-brand', function (e) {
        e.preventDefault();
    });

    /**Cuando se cierra un modal-submodulo */
    $(document).on('hidden.bs.modal', '.modal-submodulo', function (e) {
        cargar_inicio_modulo(modulo_activo);
    });

    //Cuando el usuario para por encima de un nav-modulo
    $(document).on('mouseover', '.nav-modulo', function (e) {
        //Mostrar el span del nav-modulo
        $(this).find('.nav-text').show();
    });

    //Cuando el usuario sale de un nav-modulo
    $(document).on('mouseout', '.nav-modulo', function (e) {
        //Ocultar el span del nav-modulo
        $(this).find('.nav-text').hide();
    });
});

/**Cargar la animación de inicio
 * @param funcion_cargar - Funcion que se ejecutara al terminar la animación
 * La funcion puede tener n parametros
 */
function loading(function_cargar = function () { }) {
    var num = 0;
    $('.content-wrapper').hide();
    $('.main-header').hide();
    $('.main-footer').hide();
    $('.contenedor').hide();

    for (i = 0; i <= 100; i++) {
        setTimeout(function () {
            if (num == 100) {
                $('.loader').hide();

                $('.main-header').show();
                $('.main-footer').show();
                $('.content-wrapper').show();

                //Ocultar los span dentro de los botones .nav-modulo
                $('.nav-modulo').find('.nav-text').hide();

                if(id_feria_activo != ''){
                    //Mostrar el boton de nav-ferias
                    $('.nav-ferias').show();
                }

                else{
                    //Ocultar el boton de nav-ferias
                    $('.nav-ferias').hide();
                }

                //Si la funcion tiene contenido
                if (function_cargar == '') {
                    cargar_inicio();
                }

                //Si la funcion tiene contenido
                else {
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
    activar_modulo_boton('inicio');

    //Ocultar el contenedor de informacion
    $('.contenedor').hide();

    //Ocultar todos los span de los botones .nav-modulo
    $('.nav-modulo').find('.nav-text').hide();

    elemento_activo = '';
    form_activo = '';

    modulo_activo = '';
    submodulo_activo = '';

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

    //Ocultar todos los span de los botones .nav-modulo
    $('.nav-modulo').find('.nav-text').hide();

    //Abrir el span dentro del nav-modulo
    $('.nav-' + nombre_modulo).find('.nav-text').show();

    //Si el nombre del submodulo no esta vacio
    if (nombre_submodulo != '') {
        if(nombre_submodulo == 'mercadito' || nombre_submodulo == 'contacto' || nombre_submodulo == 'quienes_somos'){
            //Activar el boton del submodulo
            $('.btn_' + nombre_modulo + '_' + nombre_submodulo).addClass('btn-warning').removeClass('btn-secondary');

            //Desactivar otros botones
            $('.nav-item').each(function (i, e) {
                $(e).find('.nav-submodulo').addClass('btn-dark').removeClass('btn-info');
            });
        }

        else
        {
            //Activar el boton del submodulo
            $('.btn_' + nombre_modulo + '_' + nombre_submodulo).addClass('btn-info').removeClass('btn-dark');

            //Desactivar otros botones
            $('.nav-item').each(function (i, e) {
                if (!$(e).hasClass('nav-' + nombre_modulo)) {
                    $(e).find('.nav-submodulo').addClass('btn-dark').removeClass('btn-info');
                }
            });

            //Activar el .nav-menu
            $('.nav-menu-' + nombre_modulo).addClass('btn-success').removeClass('btn-danger');
        }
    }
}

/**Abrir una feria virtual */
function cargar_feria(id_feria = '', tipo = 'listado'){
    if(id_feria != '')
    {
        //Si la feria activa es igual a la feria que se quiere cargar
        if(id_feria_activo == id_feria)
        {
            //Se carga la feria activa
            cargar_listado('inicio', 'mercadito', base + 'inicio/mercadito/' + id_feria + '/listado');
        }

        else
        {
            //Solicitud ajax a la url para iniciar la feria y personalizar la pagina
            $.ajax({
                url: base + 'inicio/mercadito/' + id_feria + '/inicio',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    //Si la respuesta es correcta
                    if(!data.error)
                    {
                        id_feria_activo = id_feria;

                        //console.log(data);
                        cargar_listado('inicio', 'mercadito', base + 'inicio/mercadito/' + id_feria + '/listado');
                    }

                    else
                    {
                        mensajeAutomatico('Error', data.error, 'error');
                    }
                }
            });
        }
    }

    else
    {
        if(id_feria_activo != '')
        {
            cargar_listado('inicio', 'mercadito', base + 'inicio/mercadito/' + id_feria_activo + '/listado');
        }

        else
        {
            location.href = base + 'inicio/mercadito';
        }
    }

    //Mostrar el boton de nav-ferias
    $('.nav-ferias').show();
}
