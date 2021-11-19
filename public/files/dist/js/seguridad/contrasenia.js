//Verificar la contrasenia que esta ingresando el usuario
function verificar_contraseña() {
    var nueva_contraseña = $('#new_pswd').val();
    var contra_nueva_conf = $('#conf_pswd').val();

    if(nueva_contraseña != contra_nueva_conf){
        $(".btt-grd").attr("disabled", true);

        mensajeAutomatico("Atencion", "La nueva contraseña no coincide, verifiquela e intente de nuevo.", "error");
    }//Fin de la validacion

    if(nueva_contraseña == contra_nueva_conf){
        $(".btt-grd").attr("disabled", false);
    }//Fin de la validacion
}//Fin de la funcion