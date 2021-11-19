$(document).ready(function() {
    //Agregar un nuevo libro
    $("#frm").on('submit', function(e) {
        e.preventDefault();

        result = insertFrm('sucursal');

        if(result!=0)
        {
            swal({
                title: "Atencion",
                text: 'Sucursal registrada con exito',
                icon: 'success',
                timer: 2000,
                buttons: false
            }).then(function(){
                location.reload();
            });//Fin del mensaje   
        }//Fin de validacion de resultado
    });

    //Modificar un cliente
    $(document).on('click', '.btt-mod', function(e) {
        e.preventDefault();
        
        $.ajax({
            "url": base + "sucursal/update",
            "method": "post",
            "data": $('#frm').serialize(),
            "dataType": "json",
        }).done(function(response) {
            
            if (response != 0) {
                swal({
                    title: "Atencion",
                    text: "Sucursal actualizada correctamente",
                    icon: "success",
                    timer: 3000,
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

    //Cuando se le da click al boton de modificar
    $(document).on('click', '#modificar', function() {
        var id_sucursal = this.value;

        $.ajax({
            "url": base + "empresa/obtener/" + id_sucursal + '/sucursales',
            "dataType": "json",
        }).done(function(response) {
            
            if (response) {
                $.each(response, function(key, valor) {
                    $("#" + key).val(valor)
                    $("#" + key).attr("disabled", false);
                });

                llenarUbicacion(response.cod_provincia, response.cod_canton, response.cod_distrito, response.id_ubicacion);

                if(response.estado !=0)
                    $("#estado").prop("checked", response.estado)
            }//Fin de la validacion de respuesta
        });

        //Mostrar el modal del articulo
        $('#modalAccion').modal('show');

        $('.btt-mod').show();
        $('.btt-grd').hide();
    });

    //Cuando se le da click al boton de inventario
    $(document).on('click', '#inventario', function() {
        var id_sucursal = this.value;

        Pace.track(function() 
        {
            $.ajax({
                "url": base + "empresa/inventarios/" + id_sucursal,
                "dataType": "json",
            }).done(function(response) {
                
                if (!response.error) {
                    var html = '';
                    var i;

                    for (i = 0; i < response.length; i++) {
                        console.log(response[i]);
                        html += '<tr>' +
                            '<td>' + response[i].codigo + '</td>' +
                            '<td>' + response[i].descripcion + '</td>' +
                            '<td>' + response[i].precio_venta + ' </td>' +
                            '<td>' + response[i].cantidad_inventario + '</td>' +
                        '</tr>';
                    }//Fin del ciclo

                    $('#inventario_body').html(html);

                    crear_data_table('tbl_inventario');

                    //Mostrar el modal del inventario
                    $('#modal_inventario').modal('show');
                }//Fin de la validacion de respuesta

                else
                    mensajeAutomatico('Atencion', response.error, 'error');
            });
        });
    });
});