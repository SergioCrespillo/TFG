<?php
require_once __DIR__.'/../estructura/config.php';
require_once __DIR__.'/../estructura/aplicacion.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Perfil</title>
		<link rel="stylesheet" href="../css/estiloPerfil.css">
    	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
		<script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script>
    </head>
    <body>
		<main>
		<?php
			include __DIR__.'/../estructura/cabecera.php';
		?>
		<section class="portafolio">
            <div class="contenedor">
                <h2 class="titulo">Mi cuenta</h2>
                <div class="galeria-port">
                    <div class="imagen-port">
						<a href="editar_perfil.php">
                        <img src="https://cdn-icons-png.flaticon.com/512/3779/3779252.png" alt="">
                        <div class="hover-galeria">
                            <img src="../media/icono1.png" alt="">
                            <p>Editar datos personales</p>
                        </div>
						
						</a>
                    </div>
                    <div class="imagen-port">
						<a href="editar_password.php">
                        <img src="https://cdn-icons-png.flaticon.com/512/815/815744.png" alt="">
                        <div class="hover-galeria">
                            <img src="../media/icono1.png" alt="">
                            <p>Cambiar contraseña</p>
                        </div>
						</a>
                    </div>
                    <div class="imagen-port">
						<a href="viewAccounts.php">
                        <img src="https://cdn-icons-png.flaticon.com/512/2721/2721031.png" alt="">
                        <div class="hover-galeria">
                            <img src="../media/icono1.png" alt="">
                            <p>Revisar cuentas</p>
                        </div>
						</a>
                    </div>
                    <div class="imagen-port">
						<a href="transfer.php">
                        <img src="https://cdn-icons-png.flaticon.com/512/1770/1770992.png" alt="">
                        <div class="hover-galeria">
                            <img src="../media/icono1.png" alt="">
                            <p>Realizar transferencia</p>
                        </div>
						</a>
                    </div>
                    <div class="imagen-port">
						<a href="http://localhost/TFG/contacto.php">
                        <img src="https://cdn-icons-png.flaticon.com/512/3347/3347661.png" alt="">
                        <div class="hover-galeria">
                            <img src="../media/icono1.png" alt="">
                            <p>Ayuda</p>
                        </div>
						</a>
                    </div>
                </div>
            </div>
        </section>
		<?php
			include __DIR__.'/../estructura/pie.php';
		?>
		</main>
    </body>
</html>
