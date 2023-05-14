<?php
require_once __DIR__.'/estructura/config.php';
require_once __DIR__.'/formularioLogin.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="http://localhost/TFG/css/estilo_login.css"/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
</head>

<body>	
	<?php
		include __DIR__.'/estructura/cabecera.php';
	?>

	<h3>Inicio de sesión</h3>
	<div class="container">
		<?php 
			if(isset($_SESSION['loged'])){
				header('Location: index.php');
			}
			if(isset($_SESSION['error'])){
				echo "<div class=error>";
				$error=$_SESSION['error'];
				echo "$error";
				echo "</div>";
			}
			$form = new FormularioLogin(); 
			$form->gestiona();
		?>
	</div>
	<br>
	<?php
		include __DIR__.'/estructura/pie.php';
	?>
</body>
</html>