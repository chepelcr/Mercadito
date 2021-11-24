var base = "http://192.168.0.5/universidad/tcu/mercadito/Mercadito/public/";
//var base = "https://206.189.246.224/";

//Inicializar los tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

//Barra de navegación dinamica
$(".nav-link").each(function (i, e) {
    if ($(e).attr('href') == window.location.href) {
        $(e).parents().closest(".nav-item").addClass("menu-open");
        $(e).parents().closest(".nav-item").children('.nav-link').addClass("active");
        $(e).addClass("active");
    }
});

//Enviar un mensaje al usuario
function mensaje(titulo, mensaje, icono) {
    Swal.fire({
        icon: icono,
        title: titulo,
        text: mensaje,
        showConfirmButton: true,
        confirmButtonText: 'Aceptar',
      })
}//Fin del mensaje

//Mensaje que se cierra automaticamente
function mensajeAutomatico(titulo, mensaje, icono) {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: icono,
        timer: 2000,
        showConfirmButton: false,
    })//Fin del mensaje
}//Fin del mensaje

//Mensaje que se cierra automaticamente y recarga la pagina
function mensajeAutomaticoRecargar(titulo, mensaje, icono) {
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
