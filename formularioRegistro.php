<?php
require_once __DIR__.'/includes/form.php';
require_once __DIR__.'/includes/usuario.php';
require_once __DIR__.'/includes/account.php';

class FormularioRegistro extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $documentNumber = '';
        $firstName = '';
        $lastName = '';
        $city = '';
        $phoneNumber ='';
        $occupation = '';
        if ($datos) {
            $documentNumber = isset($datos['document']) ? $datos['document'] : $documentNumber;
            $firstName = isset($datos['fName']) ? $datos['fName'] : $firstName;
            $lastName = isset($datos['lName']) ? $datos['lName'] : $lastName;
            $city = isset($datos['city']) ? $datos['city'] : $city;
            $phoneNumber = isset($datos['mobileno']) ? $datos['mobileno'] : $phoneNumber;
            $occupation = isset($datos['occupation']) ? $datos['occupation'] : $occupation;
        }
        $html = <<<EOF
            <label for="fname">DNI</label>
                <input id="docu_reg" name="document" type="text" class="field" value="$documentNumber" required>
            <label for="fname">Nombre</label>
                <input id="name_reg" name="fName" type="text" class="field" value="$firstName" required>
            <label for="fname">Apellido</label>
                <input id="lname_reg" name="lName" type="text" class="field" value="$lastName" required>
            <label for="fname">Ciudad</label>
                <input id="ciudad" name="ciudad" type="text" class="field" value="$city" required>
            <label for="fname">Teléfono</label>
                <input id="telefono" name="telefono" type="text" class="field" value="$phoneNumber" required>
            <label for="fname">Ocupación</label>
                <input id="occupation" name="occupation" type="text" class="field" value="$occupation" required>
            <label for="fname">Contraseña</label>
                <input id="pass_reg" name="password" type="password" class="field" placeholder="*******" required minlength="6"
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,16}$">
            <label for="fname">Confirmar contraseña</label>
                <input id="pass_reg2" name="password2" type="password" class="field" placeholder="*******" required minlength="6"
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,16}$">
            <center><a href="http://localhost/TFG/protecciondatos.php">Información de Protección de Datos</a><br> 
            <br><input id="reg_boton" type="submit" class="boton_reg" value="Registrarse"></center><br/>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        $documentNumber = htmlspecialchars($datos['document']);
        $firstName = htmlspecialchars($datos['fName']);
        $lastName = htmlspecialchars($datos['lName']);
        $city =  htmlspecialchars($datos['ciudad']);
        $phoneNumber = htmlspecialchars($datos['telefono']);
        $occupation = htmlspecialchars($datos['occupation']);
        $password = htmlspecialchars($datos['password']);
        $password2 = htmlspecialchars($datos['password2']);
        if (strcmp($password, $password2) !== 0 ) {
            $result[] = "Los passwords deben coincidir";
        }
        $condAcept=$datos['condAcept'];

        if (count($result) === 0) {
            $user = Usuario::crea($documentNumber, $firstName, $lastName, $password, $city,
            $phoneNumber, $occupation, NULL);
            
                #$_SESSION['error'] = "<h3>Su cuenta se ha registrado correctamente</h3>";
                $opening_balance = 1000;
                $user = null;
                $atype = 'Saving';
                $astatus = 'Active';

                $app = aplicacion::getSingleton();
                $conn = $app->conexionBd();
                $query = sprintf("SELECT MAX(acnumber) as max_ac FROM account");
                $rs = $conn->query($query);
                $result = false;
                if ($rs) {
                $result=array();
                while($fila = $rs->fetch_assoc()){
                    $acc = Account::crea($fila['max_ac'] + 1, $documentNumber, $opening_balance, $user, $atype, $astatus);
                }

                $rs->free();
                } else {
                    echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                    exit();
                }
                echo "<h3>Su cuenta se ha registrado correctamente</h3>";
                $result = 'autenticacion.php';
        }
        return $result;
    }
}