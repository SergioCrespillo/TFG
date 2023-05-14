<?php
require_once __DIR__.'/estructura/config.php';
require_once __DIR__.'/includes/formularioContacto.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="http://localhost/TFG/css/estilo_contact.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
  </head>
  <body>
      <?php
        include __DIR__.'/estructura/cabecera.php';
      ?>

      <h3>Contacto</h3>
      <p>Para cualquier consulta relacionada con el banco, póngase en contacto con nosotros. Estamos tratando de resolver todos sus problemas</p>
      <div class="container">
        <?php
          $form=new formularioContacto();
          $form->gestiona();
        ?>
      </div>
    <br>
    <?php
      include __DIR__.'/estructura/pie.php';
    ?>
    </div>
  </body>
</html>