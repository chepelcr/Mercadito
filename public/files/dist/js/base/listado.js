/**Transformar una tabla a datatable */
function crear_data_table(nombre_tabla)
{
    $('#'+ nombre_tabla).DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
    });
}//Fin de la funcion

function campos_activos(estado)
{
    $('.inp').attr("readonly", estado);
    $('.inp').attr("disabled", estado);
}

function vaciar_campos()
{
    $('.inp').val("");
}

/**Lenar un formulario con la informacion enviada */
function llenarFrm(objeto, titulo)
{
    if (objeto) {
        $.each(objeto, function(key, valor) {
            $("#" + key).val(valor)
        });

        $(".titulo-form").html(titulo);

        $('.btt-mod').show();
        $('.btt-edt').hide();
        $('.btt-grd').hide();

        campos_activos(false);

        //Mostrar el modal
        $('#modalAccion').modal('show');
    }//Fin de la validacion
}//Fin de la funcion

function verFrm(objeto, titulo)
{
    if (objeto) {
        $.each(objeto, function(key, valor) {
            $("#" + key).val(valor);
        });

        campos_activos(true);
        
        $(".titulo-form").html(titulo);

        //Mostrar el modal del usuario
        $('#modalAccion').modal('show');

        $('.btt-mod').hide();
        $('.btt-edt').show();
        $('.btt-grd').hide();
    }//Fin de la validacion
}//Fin de la funcion

$(document).ready(function(){
    crear_data_table('listado');

    //Editar un usuario
    $(document).on('click', '.btt-edt', function (e) {
        $('.btt-edt').hide();
        $('.btt-mod').show();

        campos_activos(false);
    });//Fin de editar un usuario

    //Mostrar el modal para agregar o modificar un objeto
    $(document).on('click', '#btnAgregar', function() {

        $('.btt-mod').hide();
        $('.btt-edt').hide();
        $('.btt-grd').show();

        vaciar_campos();
        campos_activos(false);
        
        $('#modalAccion').modal('show');
    });

    //Cuando se cierra el modal de acciones
    $('#modalAccion').on('hidden.bs.modal', function() {
        vaciar_campos();
        campos_activos(true);
    });
});