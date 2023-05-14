<?php
require_once __DIR__.'/../estructura/config.php';
require_once __DIR__.'/../includes/formularioPassword.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Editar - Password</title>
        <link rel="stylesheet" href="http://localhost/TFG/css/estilo_editar_password.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
        <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script>
        <script type="text/javascript" src="../js/jquery-3.5.0.js"></script>
	    <script type="text/javascript" src="../js/validarRegistro.js"></script>
    </head>
    <body>
        <?php
            include __DIR__.'/../estructura/cabecera.php';
        ?>

        <h3>Editar contraseña</h3>
        <div class="container">
            <?php
                $_SESSION['user_mod'] = $_SESSION['documentNumber'];
                $form = new FormularioPassword(); 
                $form->gestiona();
            ?>
        </div>
        </br>
        <?php
            include __DIR__.'/../estructura/pie.php';
        ?>
        </div>
    </body>
</html>