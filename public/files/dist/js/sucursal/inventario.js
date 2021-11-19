$(document).ready(function() {
    //Modificar un producto del inventario
    $(document).on('click', '.btt-mod', function(e) {
        e.preventDefault();

        $("#identificacion").attr("disabled", false);
        
        $.ajax({
            "url": base + "empresa/update/clientes",
            "method": "post",
            "data": $('#frmCliente').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (!response.error) {
                swal({
                    title: "Atencion",
                    text: "Cliente actualizado correctamente",
                    icon: "success",
                    timer: 2000,
                    buttons: false
                }).then(function(){
                    location.reload();    
                });//Fin del mensaje
            } //Fin del if
            else {
                mensajeAutomatico('Atencion', 'Ha ocurrido un error', 'error');
            } //Fin del else
        });
    });//Fin de modificar un usuario

    $(document).on('click', '#modificar', function() {
        var id_inventario_detalle = this.value;

        $.ajax({
            "url": base + "sucursal/obtener/" + id_inventario_detalle + '/inventarioDetalle',
            "dataType": "json",
        }).done(function(response) {
            if (response) {
                $.each(response, function(key, valor) {
                    $("#" + key).val(valor)
                    $("#" + key).attr("disabled", false);
                });
            }
        });
    
        //Mostrar el modal del articulo
        $('#modalAccion').modal('show');
    
        $('.btt-mod').show();
        $('.btt-grd').hide();
    });//Fin de mostrar un cliente
});

$(document).on('click', '#btnAgregar', function() {

    $("#identificacion").attr("disabled", false);
});

//Verificar id del producto
function verificar() {
    var cedula = $("#identificacion").val();
    
    $.ajax({
        "url": base + "empresa/validar/" + cedula + '/clientes',
        "dataType": "json",
    }).done(function(response) {
        
        if (response) {
            if(!response.error)
            {
                mensaje("Alerta", "El articulo ya se encuentra agregado", "info");

                $(".inp").attr("disabled", true);
                $("#btnGuardar").attr("disabled", true);

                $("#identificacion").attr("disabled", false);
            }//Fin de validacion de error

            else
            {

            }
        }//Fin de validacion de respuesta

        else
        {
            $(".inp").attr("disabled", false);
            $("#btnGuardar").attr("disabled", false);
        }
    });
}