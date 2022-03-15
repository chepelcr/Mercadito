//documento de javascript para el modulo de puesto
//Habilitar un puesto
function habilitar_puesto(id_puesto) {
    $.ajax({
        "url": base + "mercado/activar/" + id_puesto + "/puestos",
        "dataType": "json",
    }).done(function (response) {
        if (!response.error) {
            mensajeAutomaticoRecargar("Alerta", 'Puesto habilitado correctamente', "success");
        } //Fin del if
        else {
            mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
        } //Fin del else
    });
}//Fin de habilitar un puesto

//Desabilita un puesto
function desactivar_puesto(id_puesto) {
    $.ajax({
        "url": base + "mercado/desactivar/" + id_puesto + "/puestos",
        "dataType": "json",
    }).done(function (response) {
        if (!response.error) {
            mensajeAutomaticoRecargar("Alerta", 'Puesto deshabilitado correctamente', "success");
        } //Fin del if
        else {
            mensajeAutomatico('Atencion', 'Ha ocurrido un error: ' + response.error, 'error');
        } //Fin del else
    });
}//Fin de deshabilitar un puesto

function campos_activos(estado)
{
    $('.inp').attr("readonly", estado);
    $('.inp').attr("disabled", estado);
}

function countChars(obj){
    var maxLength = 250;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById("charNum").innerHTML = '<span style="color: red;">Ha excedido el limite de '+maxLength+' caractetes</span>';
    }else{
        document.getElementById("charNum").innerHTML = charRemain + ' caracteres restantes';
    }
}

function validar_puesto()
{
    var id_puesto = $('#id_puesto').val();

    if(id_puesto == '')
    {
        campos_activos(false);
        $('.div-img').show();
    }

    else
    {
        campos_activos(true);
        $('.div-img').hide();
    }
}//fin de la funcion validar_puesto

function ocultar_activar()
{
    var estado = $('#estado').val();

    if(estado == '1')
    {
        $('#btn_desactivar').hide();
    }

    else
    {
        if(estado == '0')
        {
              $('#btn_activar').hide();
        }
    }
}

//Cuando esta listo el documento
$(document).ready(function(){
    $('#btn_guardar').hide();
    $('#btn_cancelar').hide();

    validar_puesto();

    //Evento para cambiar el estado del boton guardar
    $(document).on('click', '#btn_editar', function() {
        $('#btn_guardar').show();
        $('#btn_cancelar').show();

        campos_activos(false);
        ocultar_activar();

        $('#btn_editar').hide();
        $('#btn_foto').hide();
    });

    //Cuando se da click en el boton foto
    $(document).on('click', '#btn_foto', function() {
        $('#btn_foto').hide();
        $('#btn_editar').hide();
        
        ocultar_activar();

        $('#btn_guardar').show();
        $('#btn_cancelar').show();

        $('.div-img').show();

        //Activar el campo de imagen
        $('#imagen_puesto').attr("disabled", false);
        $('#imagen_puesto').attr("readonly", false);
    });

    //Cuando se da click en el boton cancelar
    $(document).on('click', '#btn_cancelar', function() {
        location.reload();
    });

    //Cuando se envia el formulario frm_puesto
    $('#frm_puesto').submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            "url": base + "mercado/update/puestos",
            "method": "post",
            "data": formData,
            "dataType": "json",
            "contentType": false,
            "processData": false,
            "cache": false
        }).done(function(response) {
            
            if (!response.error) {
                //Mostrar mensaje de exito
                mensajeAutomaticoRecargar('Atencion', 'Puesto actualizado correctamente', 'success');
            } //Fin del if
            else {
                mensajeAutomatico('Atencion',response.error, 'error');
            } //Fin del else
        });
    });

    //Cuando se envia el formulario frm_crear
    $('#frm_crear').submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            "url": base + "mercado/guardar/puestos",
            "method": "post",
            "data": formData,
            "dataType": "json",
            "contentType": false,
            "processData": false,
            "cache": false
        }).done(function(response) {
            
            if (!response.error) {
                //Mostrar mensaje de exito
                mensajeAutomaticoRecargar('Atencion', response.success, 'success');
            } //Fin del if
            else {
                mensajeAutomatico('Atencion',response.error, 'error');
            } //Fin del else
        });
    });

    //Cuando le da click al boton activar
    $(document).on('click', '#btn_activar', function() {
        var id_puesto = $('#id_puesto').val();
        
        habilitar_puesto(id_puesto);
    });

    //Cuando le da click al boton desactivar
    $(document).on('click', '#btn_desactivar', function() {
        var id_puesto = $('#id_puesto').val();

        desactivar_puesto(id_puesto);
    });
});

