<?php
require_once __DIR__.'/../includes/usuario.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="http://localhost/TFG/css/estilo_bancoTFG.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
</head>
<body>
<header>
        <nav>
            <a href="http://localhost/TFG/index.php">HOME</a>
            <a href="#">Personas</a>
            <a href="#">Banca privada</a>
            <?php
				if (isset($_SESSION['loged'])) {
					$user = Usuario::buscaUsuario($_SESSION['documentNumber']);
					//echo $user->firstName();
					/*$img = Usuario::buscaImagen($user);
					if($img){
						echo"<img src=\"http://localhost/TFG/media/<?php echo $img; ?>\">";
					}
					else{
						echo"<li><a class=\"logo_usuario\" href=\"http://localhost/TFG/vistasUsuario/perfil.php\"><img src=\"http://localhost/TFG/media/icono_perfil.png\"></a>";
						echo"<ul>";
					}*/
					//echo"<li><a class=\"logo_usuario\" href=\"http://localhost/TFG/vistasUsuario/perfil.php\"><img src=\"http://localhost/TFG/media/icono_perfil.png\"></a>";
					//echo"<ul>";
					echo "<a href=\"http://localhost/TFG/vistasUsuario/perfil.php\">PERFIL</a>";
					echo "<a href=\"http://localhost/TFG/logout.php\">SALIR</a>";

					if(isset($_SESSION['tiempo'])){
						//Tiempo en segundos para dar vida a la sesión.
						$inactivo = 120;//2min en este caso.
						//Calculamos tiempo de vida inactivo.
						$vida_session = time() - $_SESSION['tiempo'];
						if($vida_session > $inactivo){
							session_unset();
							session_destroy();
							header("location: index.php");
						}
						else {  // si no ha caducado la sesion, actualizamos
							$_SESSION['tiempo'] = time();
						}
					} else {
						//Activamos sesion tiempo.
						$_SESSION['tiempo'] = time();
					}
				} else {
			?>
						<a href="registro.php">HAZTE CLIENTE</a>
						<a href="autenticacion.php">ACCESO CLIENTES</a>	
			<?php
				}
			?>
            <a href="http://localhost/TFG/contacto.php">Contacto</a></li>
        </nav>
        <section class="textos-header">
            <h1>Sitio web seguro frente a ciberataques</h1>
            <h2>Universidad Complutense de Madrid</h2>
        </section>
        <div class="wave" style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none"
                style="height: 100%; width: 100%;">
                <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                    style="stroke: none; fill: #fff;"></path>
            </svg></div>
</header>
</body>
</html>