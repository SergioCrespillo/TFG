<?php
require_once __DIR__.'/form.php';
require_once __DIR__.'/usuario.php';
require_once __DIR__.'/account.php';
require_once __DIR__.'/transaction.php';

class FormularioTransferencia extends Form
{
    public function __construct() {
        parent::__construct('formTransferencia');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $user_phone = '';
        $medium_transaction = '';
        $transaction_type = '';
        $amount = '';
        if ($datos) {
            $medium_transaction = isset($datos['medium_transaction']) ? $datos['medium_transaction'] : $medium_transaction;
            $transaction_type = isset($datos['transaction_type']) ? $datos['transaction_type'] : $transaction_type;
            $amount = isset($datos['amount']) ? $datos['amount'] : $amount;
        }
        
        $html = <<<EOF
        <label for="fname">Número de teléfono al que quiere realizar la transferencia</label>
            <input id="prov_reg" name="phone" type="text" class="field" value="$user_phone" required>
        <label for="fname">Medio de transacción</label>
            <select name="medium_transaction" id="trans" value="$medium_transaction" required>
                <option>Cheque</option>
                <option>Cash</option>
            </select>
        <label for="fname">Cantidad de la transacción</label>
            <input id="prov_reg" name="amount" type="number" min = 0 class="field" value="$amount" required>
        <input type="submit" class="btn btn-green" value="Aceptar"> <br/><br/>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        $dot = date('Y-m-d');

        $phone = htmlspecialchars(isset($datos['phone']) ? $datos['phone'] : '');
        if ( empty($phone)) {
            $result[] = "El campo phone no pude estar vacío.";
        }

        $medium = isset($datos['medium_transaction']) ? $datos['medium_transaction'] : '';
        if ( empty($medium)) {
            $result[] = "El campo medium_transaction no pude estar vacío.";
        }

        $amount = isset($datos['amount']) ? $datos['amount'] : '';
        if ( empty($amount) || $amount < 0) {
            $result[] = "El campo amount no pude estar vacío.";
        }

        if (count($result) === 0) {
            $app = aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $query = sprintf("SELECT MAX(tnumber) as max_tn FROM trandetails");
            $rs = $conn->query($query);
            $result = false;
            if ($rs) {
            $result=array();
            while($fila = $rs->fetch_assoc()){
                $acc = Account::buscaId();
                $transaction = Transaction::crea($fila['max_tn'] + 1, $acc, $dot, $medium, $amount);
            }

            $rs->free();
            } else {
                echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            }
            $tran_type1 = 'Withdrawal';
            $tran_type2 = 'Deposit';
            $acc1 = Account::buscaId();
            Account::actualiza($tran_type1, $amount, $acc1);
            $user = Usuario::buscaNumero($phone);
            if(!$user){
                echo "Número de teléfono incorrecto";
                exit();
            }
            $acc2 = Account::UserAccount($user);
            Account::actualiza($tran_type2, $amount, $acc2);
            echo"<center/><h1> Tu datos han sido actualizados correctamente </h1>";
        }
        $result = 'index.php';
    }
}
?>