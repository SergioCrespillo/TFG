<?php
    require_once __DIR__.'/estructura/config.php';
    require_once __DIR__.'/formularioComments.php';
    require_once __DIR__.'/includes/comments.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Inicio - BancoTFG</title>
    <link rel="stylesheet" href="http://localhost/TFG/css/estilo_bancoTFG.css">
    <link rel="stylesheet" href="http://localhost/TFG/css/estilo_comments.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
</head>

<body>
    
    <?php
	require("estructura/cabecera.php");
    ?>

    <main>
        <section class="contenedor sobre-nosotros">
            <h2 class="titulo">Nuestro producto</h2>
            <div class="contenedor-sobre-nosotros">
                <img src="media/ilustracion2.svg" alt="" class="imagen-about-us">
                <div class="contenido-textos">
                    <h3><span>1</span>SIEMPRE INFORMADO</h3>
                    <p>Desde tu banca online en BancoTFG podrás consultar tus gastos e ingresos,
                        configurar alertas para ver los movimientos de tus cuentas y
                        hacer transferencias y gestionar tus domiciliaciones o recibos.</p>
                    <h3><span>2</span>PAGA CON TU MÓVIL</h3>
                    <p>Opera con tus tarjetas desde tu banca online, donde puedes
                        consultar el PIN de tus tarjetas si lo olvidas,
                        activar o desactivar tu tarjeta cuando lo necesites y
                        pagar con el móvil.</p>
                </div>
            </div>
        </section>
        <br>
        <h2>Que dicen nuestros clientes</h2><br>
        <?php
            $entr=new comments();
            $i=0;
            $size=0;
            $size=$entr->getSize("comments");
            $comentarios=$entr->getComentarios();
            $i = $size;

            while($i > intval($size - 2)){
                $comentario = $comentarios[$i-1]['comentario'];    
                $nombre = $comentarios[$i-1]['usuario'];
                $html = <<<EOF
                <div class="slideshow-container">
                    <div class="mySlides fade">
                        <div class="container_1">
                            <h3>$nombre</h3>
                            <p>$comentario</p>
                        </div>
                    </div>
                </div>
                EOF;
                echo"$html";
                --$i;
            }
            $html = <<<EOF
            <br>
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span> 
                    <span class="dot" onclick="currentSlide(2)"></span> 
                </div>
                <script>
                let slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                showSlides(slideIndex = n);
                }

                function showSlides(n) {
                let i;
                let slides = document.getElementsByClassName("mySlides");
                let dots = document.getElementsByClassName("dot");
                if (n > slides.length) {slideIndex = 1}    
                if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";  
                dots[slideIndex-1].className += " active";
                }
                </script>
            EOF;
            echo "$html";
        ?>
        </section>
        <br>
        <?php
            if (isset($_SESSION['loged'])) {
                $form = new FormularioComments(); 
                ?>
                <div class="container">
                    <?php
                        $form->gestiona();
                        ?>
                </div>
                <?php
            }
        ?>
        <br>
        <section class="about-services">
            <div class="contenedor">
                <h2 class="titulo">Nuestros servicios</h2>
                <div class="servicio-cont">
                    <div class="servicio-ind">
                        <img src="media/ilustracion1.svg" alt="">
                        <h3>Bizum</h3>
                        <p>Es un servicio sencillo, gratuito, inmediato y seguro.</p>
                    </div>
                    <div class="servicio-ind">
                        <img src="media/ilustracion4.svg" alt="">
                        <h3>Apple Pay</h3>
                        <p>Todas sus tarjetas Banca March en sus dispositivos Apple.</p>
                    </div>
                    <div class="servicio-ind">
                        <img src="media/ilustracion3.svg" alt="">
                        <h3>Google Pay</h3>
                        <p>La forma sencilla y rápida de pagar en miles de establecimentos, webs y apps de todo el mundo.</p>
                    </div>
                </div>
            </div>
        </section>               
    </main>
    <?php
	require("estructura/pie.php");
    ?>
</body>
</html>