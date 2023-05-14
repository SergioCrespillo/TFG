<?php
require_once __DIR__.'/includes/form.php';
require_once __DIR__.'/includes/usuario.php';
require_once __DIR__.'/includes/account.php';
class FormularioLogin extends Form
{
    public function __construct() {
        parent::__construct('formLogin');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $email = '';
        $pass = '';
        if(isset($_COOKIE["documentNumber"]) && isset($_COOKIE["password"])){
            $email = isset($_COOKIE["documentNumber"]) ? $_COOKIE["documentNumber"] : $email;
            $pass = isset($_COOKIE["password"]) ? $_COOKIE["password"] : $pass;
        }

        $html = <<<EOF
            <label for="fname">Nombre</label>
                <input type="text" name="documentNumber" placeholder="DNI number.." value="$email" class="field" requiered>
            <label for="lname">Contraseña</label>
                <input id="pass_login" name="password" type="password" value="$pass" class="field" placeholder="*******" required> <br/>
            <p><input type="checkbox" name="remember" /> Remember me</p>
            <center><input type="submit" class="btn btn-green" value="Iniciar sesión"></center> <br/>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $nombreUsuario = filter_var($datos['documentNumber']);
        $password = $datos['password'];

        if(!empty($datos["remember"])) {
            setcookie ("documentNumber",$nombreUsuario,time()+ 3600,null,null,true,true);
            setcookie ("password",$password,time()+ 3600, null,null,true,true);
            echo "Cookies Set Successfuly";
        } else {
            setcookie ("documentNumber",$nombreUsuario,time()+ 3600,null,null,true,true);
            setcookie ("password",$password,time()+ 3600, null,null,true,true);
            echo "Cookies Not Set";
        }

        $usuario = Usuario::login($nombreUsuario, $password);
        if ( ! $usuario ) {
            // No se da pistas a un posible atacante
            $result[] = "<p class=\"error\">Ugnknown user or password.</p>";
        } else {
            $_SESSION['loged'] = true;
            $_SESSION['documentNumber']=$usuario->documentNumber();
            $_SESSION['password']=$usuario->password();
            $_SESSION['user_mod']=$usuario->documentNumber();
            /*$acc = Account::allUserAccounts();
            if(sizeof($acc)){
                $_SESSION['useracnum']=$acc[0]->getAcnumber(); //No sirve por ahora
            }*/
            $result = 'index.php';
        }
        return $result;
    }
}