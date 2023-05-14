<?php
require_once __DIR__.'/../estructura/config.php';
require_once __DIR__.'/../includes/formularioTransferencia.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Transferencia</title>
        <link rel="stylesheet" href="http://localhost/TFG/css/estilo_transferencia.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
        <script type="text/javascript" src="../js/jquery-3.5.0.js"></script>
	    <script type="text/javascript" src="../js/validarRegistro.js"></script>
    </head>
    <body>
        <?php
            include __DIR__.'/../estructura/cabecera.php';
        ?>
        
        <h3>Realizar transferencia</h3>
        <div class="container">
            <?php
                $_SESSION['user_mod'] = $_SESSION['documentNumber'];
                $form = new FormularioTransferencia(); 
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