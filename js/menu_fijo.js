posicionarMenu();
$(window).scroll(function() {    
    posicionarMenu();
});
function posicionarMenu() {
    var altura_del_menu = $(".menul").outerHeight(true) + 20 ;
    $('.menul').addClass('fixed');
    $('.aviso').css('margin-top', (altura_del_menu) + 'px');
}