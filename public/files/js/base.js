var base = "http://localhost/universidad/tcu/mercadito/Mercadito/public/";
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