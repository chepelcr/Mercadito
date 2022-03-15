/**Enviar un mensaje al usuario
 * @param titulo Titulo del mensaje
 * @param mensaje Mensaje del mensaje
 * @param icono Icono del mensaje
*/
function mensaje(titulo, mensaje, icono = 'info') {
    Swal.fire({
        icon: icono,
        title: titulo,
        text: mensaje,
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
    })
}//Fin del mensaje

/**Mensaje que se cierra automaticamente
 * @param titulo Titulo del mensaje
 * @param mensaje Mensaje del mensaje
 * @param icono Icono del mensaje
 * @param timer Tiempo que se muestra el mensaje
*/
function mensajeAutomatico(titulo, mensaje, icono = 'info', timer = 2500) {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: icono,
        timer: timer,
        showConfirmButton: false,
    })//Fin del mensaje
}//Fin del mensaje

/**Mensaje que se cierra automaticamente y recarga la pagina
 * @param titulo Titulo del mensaje
 * @param mensaje Mensaje del mensaje
 * @param icono Icono del mensaje
 * @param timer Tiempo que se muestra el mensaje
*/
function mensajeAutomaticoRecargar(titulo, mensaje, icono = 'info', timer = 2500) {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: icono,
        timer: 2000,
        showConfirmButton: false,
    }).then((result) => {
        location.reload();
    })//Fin del mensaje
}//Fin del mensaje

/**Mensaje que realiza una accion luego de mostrarse
 * @param titulo Titulo del mensaje
 * @param mensaje Mensaje del mensaje
 * @param icono Icono del mensaje
 * @param accion Funcion que se ejecuta al mostrarse el mensaje
 */
function mensajeAutomaticoAccion(titulo, mensaje, icono = 'info', accion = function() { }) {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: icono,
        timer: 2000,
        showConfirmButton: false,
    }).then((result) => {
        accion();
    })//Fin del mensaje
}//Fin del mensaje