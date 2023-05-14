<?php
require_once __DIR__.'/form.php';
require_once __DIR__.'/usuario.php';

class FormularioPerfil extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $documentNumber = $_SESSION['user_mod'];
        $usuario=Usuario::buscaUsuario($documentNumber);
        $firstName = $usuario->firstName();
        $lastName = $usuario->lastName();
        $city = $usuario->city();
        $phoneNumber = $usuario->phoneNumber();
        $occupation = $usuario->occupation();

        $html = <<<EOF
            <p class="titulo_reg" >DNI: $documentNumber</p>	
            <label for="fname">Nombre</label>
                <input id="nombre_reg" name="nombre" type="text" class="field" value="$firstName" required>
            <label for="fname">Apellidos</label>
                <input id="apell_reg" name="apellido" type="text" class="field" value="$lastName" required>
            <label for="fname">Ciudad</label>
                <input id="prov_reg" name="ciudad" type="text" class="field" placeholder="Madrid" value="$city" required>
            <label for="fname">Teléfono</label>
                <input id="local_reg" name="telefono" type="text" class="field" value="$phoneNumber" required>
            <label for="fname">Ocupación</label>
                <input id="occ_reg" name="occupation" type="text" class="field" value="$occupation" required>
            <input type="submit" class="btn btn-green" value="Aceptar"> <br/><br/>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        $documentNumber = $_SESSION['user_mod'];

        $firstName = htmlspecialchars(isset($datos['nombre']) ? $datos['nombre'] : '');
        if ( empty($firstName)) {
            $result[] = "El campo nombre no pude estar vacío.";
        }

        $lastName = htmlspecialchars(isset($datos['apellido']) ? $datos['apellido'] : '');
        if ( empty($lastName)) {
            $result[] = "El campo apellido no pude estar vacío.";
        }

        $city = htmlspecialchars(isset($datos['ciudad']) ? $datos['ciudad'] : '');
        if ( empty($city)) {
            $result[] = "El campo Ciudad no puede estar vacío.";
        }

        $phoneNumber = htmlspecialchars(isset($datos['telefono']) ? $datos['telefono'] : '');
        if ( empty($phoneNumber)) {
            $result[] = "El campo Teléfono no pude estar vacío.";
        }

        $occupation = htmlspecialchars(isset($datos['occupation']) ? $datos['occupation'] : '');
        if ( empty($occupation)) {
            $result[] = "El campo Ocupación no pude estar vacío.";
        }
        
        if (count($result) === 0) {
            $user = new Usuario($_SESSION['documentNumber'], $firstName, $lastName, NULL,
            $city, $phoneNumber, $occupation, NULL);
            Usuario::actualizaPerfil($user);
            echo"<center/><h1> Tu datos han sido actualizados correctamente </h1>";
        }
        return $result;
    }
}
?>