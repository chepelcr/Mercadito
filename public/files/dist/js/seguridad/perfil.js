$(document).ready(function() {
    campos_activos(true);

    $('#btn_guardar').hide();
    $('#btn_cancelar').hide();

    //Evento para cambiar el estado del boton guardar
    $(document).on('click', '#btn_editar', function() {
        $('#btn_guardar').show();
        $('#btn_cancelar').show();

        $('#btn_editar').hide();
        $('#btn_contrasenia').hide();
        $('#btn_foto').hide();

        campos_activos(false);
        
        campo_cedula(true);
    });

    //Cuando se le da click al boton cancelar
    $(document).on('click', '#btn_cancelar', function() {
        //location.reload();
    });

    //Mostrar el modal para agregar o modificar un usuario
    $(document).on('click', '#btn_contrasenia', function() {
        //Icono de contrasenia
        html = '<i class="fa fa-key"></i>';

        $(".modal-title").html(html + ' Cambio de contraseña');

        $(".pass").val("");
        
        $('.btt-mod').hide();
        $('.btt-edt').hide();
        
        $('.btt-grd').show();
    });
});