function correoValido (correo){
    var emailPattern = "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$";
    return correo.match(emailPattern) ? true : false;
}
function cambiarFondo(id, valor, mensaje){
    if (valor==true) {
        $(id).css("background-color", "rgb(241, 255, 162)");
    } else {
        $(id).css("background-color", "rgb(255, 182, 182)");
        alert(mensaje);
    }
}
function usuarioExiste(data, status){
    var mensaje = "Lo sentimos, este nombre de usuario no está disponible.";
    if(data==="existe"){
        cambiarFondo("#username_reg", false, mensaje);
    }else{
        cambiarFondo("#username_reg", true, mensaje);
    }
}

$(document).ready(function(){
    var pass = "";
    $("#email_reg").change(function(){
        var mensaje="El correo electrónico debe tener un formato válido.";
        cambiarFondo("#email_reg", correoValido($("#email_reg").val()), mensaje);
    });

    $("#codPos_reg").change(function(){
        var mensaje="El código postal debe estar compuesto de 5 dígitos";
        cambiarFondo("#codPos_reg", $("#codPos_reg").val().length == 5 && !isNaN($("#codPos_reg").val()), mensaje);
    });

    $("#pass_reg").change(function(){
        pass=$("#pass_reg").val();
        var mensaje="El contraseña debe contener al menos 5 caracteres";
        cambiarFondo("#pass_reg", $("#pass_reg").val().length > 5, mensaje);
    });

    $("#pass_reg2").change(function(){
        var mensaje="Las contraseñas no coinciden.";
        cambiarFondo("#pass_reg2", $("#pass_reg2").val().length > 5 && pass==$("#pass_reg2").val(), mensaje);
    });

    //AJAX
    $("#username_reg").change(function(){
        var url="procesos/comprobarUsuario.php?user=" + $("#username_reg").val();
        $.get(url,usuarioExiste);
    });
});
