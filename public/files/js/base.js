//Sidebar dinamico
$(".nav-link").each(function(i, e) {
    if ($(e).attr('href') == window.location.href) {
        $(e).parents().closest(".nav-item").addClass("menu-open");
        $(e).parents().closest(".nav-item").children('.nav-link').addClass("active");
        $(e).addClass("active");
    }
});