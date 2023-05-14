<?php
require_once __DIR__.'/estructura/config.php';
require_once __DIR__.'/includes/formularioContacto.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="http://localhost/TFG/css/estilo_datos.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
  </head>
  <body>

    <?php
      include __DIR__.'/estructura/cabecera.php';
    ?>
    <h3>Información sobre Protección de Datos</h3>

    <button class="accordion">¿Quién es el responsable del tratamiento de sus datos?</button>
    <div class="panel">
      <br>
      <p>
        BancoTFG (Trabajo Final de Grado). <br>
        Dirección postal: C/ Prof. José García Santesmases 9, 28040 Madrid <br>
        Contacto: screspil@ucm.es <br>
      </p>
    </div>
    <br>
    <button class="accordion">¿Qué tipos de datos personales recopilamos y tratamos? </button>
    <div class="panel">
      <br>
      <p>
        Datos de carácter identificativo y de contacto: Documento de identidad (NIF, DNI, NIE, Documento de identidad no español/CIF), nombre y apellidos, residencia, teléfono, ocupación. <br><br>
      </p>
      <p>
          Con independencia de la naturaleza de su relación con BancoTFG, éste no recopilará ni tratará categorías especiales de datos sobre usted (por ejemplo, datos relativos a su salud, origen étnico, creencias religiosas u opiniones políticas). <br><br>
          Por último, BancoTFG no recopilará ni tratará datos de menores, a menos que mantengan contratos con la entidad, ya sea directamente o con la representación de sus padres o tutores. El tratamiento de datos de dichos menores se limitará exclusivamente al mantenimiento y seguimiento del producto o servicio contratado.
      </p>
    </div>
    <br>
    <button class="accordion">¿Es obligatorio facilitar sus datos?</button>
    <div class="panel">
      <br>
      <p>
        Será obligatorio que Ud. nos facilite sus datos en la medida en que Usted desee contratar un producto o servicio con el Banco, debiendo mantenerlos actualizados, de forma que responda en todo momento a su situación real.
      </p>
    </div>
    <br>
    <button class="accordion">¿Cuáles son sus derechos cuando nos facilita sus datos? </button>
    <div class="panel">
      <br>
      <p>
        Usted podrá ejercer sus derechos de acceso, portabilidad, rectificación, supresión, limitación y oposición. Además, Usted tendrá derecho a no ser objeto de una decisión basada únicamente en el tratamiento automatizado, de manera que podrá solicitar intervención humana en la toma de decisiones que le conciernan por parte del BancoTFG y expresar su punto de vista, pudiendo impugnar la decisión.
      </p>
    </div>
    <br>
    
    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        } 
      });
    }
    </script>

    <?php
      include __DIR__.'/estructura/pie.php';
    ?>
    </div>
  </body>
</html>