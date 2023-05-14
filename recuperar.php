<?php
require_once __DIR__.'/estructura/config.php';
require_once __DIR__ . '/estructura/aplicacion.php';

$correo = $_POST['txtcorreo'];
$app = aplicacion::getSingleton();
$conn = $app->conexionBd();
$query = sprintf("SELECT * FROM customer WHERE correo = '%s'", $conn->real_escape_string($correo));
$rs = $conn->query($query);
$result = false;
if ($rs) {
    if ( $rs->num_rows == 1) {
        $fila = $rs->fetch_assoc();
        $enviarpass = $fila['pass'];
        $paracorreo = $correo;
        $titulo = "Recuperar Password";
        $mensaje = "Tu password es: ".$enviarpass;
        $tucorreo = "From: xxxx@gmail.com";

        if(mail($paracorreo,$titulo,$mensaje,$tucorreo)){
            echo "<script> alert('Contraseá enviada');window.location= 'index.php' </script>";
        }
        else{
            echo "<script> alert('Error');window.location= 'index.php' </script>";
        }
    }
    $rs->free();
} else {
    echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
    exit();
}
?>