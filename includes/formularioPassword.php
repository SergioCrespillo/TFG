<?php
require_once __DIR__.'/form.php';
require_once __DIR__.'/usuario.php';

class FormularioPassword extends Form
{
    public function __construct() {
        parent::__construct('formPassword');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $documentNumber = $_SESSION['user_mod'];
        $usuario=Usuario::buscaUsuario($documentNumber);
        $password = $usuario->password();

        $html = <<<EOF
            <p class="titulo_reg" >DNI: $documentNumber</p>
            <input name="perfil" type="hidden" value="$password">
            <label for="fname">Contraseña anterior</label>
                <input id="pass_reg" name="password" type="password" class="field" placeholder="*******" required minlength="6">
            <label for="fname">Confirmar contraseña anterior</label>
                <input id="pass_reg2" name="password2" type="password" class="field" placeholder="*******" required minlength="6">
            <label for="fname">Nueva contraseña</label>
                <input id="pass_reg2" name="password3" type="password" class="field" placeholder="*******" required minlength="6"
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,16}$">
            <input type="submit" class="btn btn-green" value="Aceptar"> <br/><br/>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $documentNumber = $_SESSION['user_mod'];
        
        $password = isset($datos['password']) ? $datos['password'] : null;
        if ( empty($password) || mb_strlen($password) < 6 ) {
            $result[] = "El password tiene que tener una longitud de al menos 6 caracteres.";
        }

        $password2 = isset($datos['password2']) ? $datos['password2'] : null;
        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $result[] = "Los passwords deben coincidir";
        }

        $password3 = isset($datos['password3']) ? $datos['password3'] : null;
        if ( empty($password3) || mb_strlen($password3) < 6 ) {
            $result[] = "El password tiene que tener una longitud de al menos 6 caracteres.";
        }
        if (count($result) === 0) {
            $user=Usuario::buscaUsuario($documentNumber);
            $user->cambiaPassword($password3);
            Usuario::actualizaPass($user);
            echo"<center/><h1> Tu datos han sido actualizados correctamente </h1>";
        }
        return $result;
    }
}
?>