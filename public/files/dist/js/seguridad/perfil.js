function campos_activos(estado)
{
    $('.inp').attr("readonly", estado);
    $('.inp').attr("disabled", estado);
}

//Cambiar el estado del campo de la cedula
function campo_cedula(estado)
{
    $("#tipo_identificacion").attr("disabled", estado);

    $("#cedula_usuario").attr("disabled", estado);
    $("#cedula_usuario").attr("readonly", estado);
}

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
        location.reload();
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
    
    //Actualizar el perfil del usuario
    $("#frm_usuario").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "seguridad/update/perfil",
            "method": "post",
            "data": $('#frm_usuario').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (!response.error) {
                $(".perfil").attr("readonly", true);
                $('#btn_guardar').hide();
                $('#btn_cancelar').hide();

                $('#btn_editar').show();
                $('#btn_contrasenia').show();
                $('#btn_foto').show();

                //Mostrar mensaje de exito
                mensajeAutomaticoRecargar('Atencion', 'Perfil actualizado correctamente', 'success');
            } //Fin del if
            else {
                mensajeAutomatico('Atencion',response.error, 'error');
            } //Fin del else
        });
    });//Fin del evento submit


    //Realizar cambio de contraseña
    $("#frm").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            "url": base + "seguridad/update/contrasenia",
            "method": "post",
            "data": $('#frm').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (!response.error) {
                //Enviar mesaje de exito
                mensajeAutomaticoRecargar('Atencion', 'Contraseña actualizada correctamente', 'success');
                
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', response.error, 'error');
            } //Fin del else
        });
    });
});