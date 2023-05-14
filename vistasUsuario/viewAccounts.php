<?php
require_once __DIR__.'/../estructura/config.php';
require_once __DIR__.'/../includes/formularioPerfil.php';
require_once __DIR__.'/../includes/account.php';
require_once __DIR__.'/../includes/transaction.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Cuentas</title>
        <link rel="stylesheet" href="http://localhost/TFG/css/estilo_account.css"/>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet"> 
        <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script>
        <script type="text/javascript" src="../js/jquery-3.5.0.js"></script>
	    <script type="text/javascript" src="../js/validarRegistro.js"></script>
    </head>

    <body>
        <?php
            include __DIR__.'/../estructura/cabecera.php';
        ?>
        <h3>Estado de mi cuenta bancaria</h3><br>
        <div class="container">
            <img src="http://localhost/TFG/media/secureAC.gif" width="160" height="120"><br/>
            <?php
                $acc = Account::buscaId();
                $balance = Account::buscaBalance();
                $i=0;
                $size=0;
                $size=Transaction::getSize($acc);
                $html = <<< EOF
                <label class="fname">Cuenta BancoTFG</label>
                <label class="op_balance">$balance $</label><br/><br/>
                <label class="recent">Actividad reciente</label><br/>
                EOF;
                echo "$html";
                $tam = mysqli_fetch_assoc($size);
                while($i < intval($tam)){
                    $trans = Transaction::buscaTran_amount($acc);
                    $fecha = Transaction::buscaTran_fecha($acc);
                    $html2 = <<< EOF
                    <img src="https://cdn-icons-png.flaticon.com/512/60/60606.png" width="23">
                    <label class="activity">&nbsp&nbsp&nbsp($fecha) Transferencia</label>
                    <label class="dinero">-$trans $</label>
                    EOF;
                    echo "$html2";
                    ++$i;
                }
            ?>
        </div><br/>
        <?php
            include __DIR__.'/../estructura/pie.php';
        ?>
    </body>
</html>
