<?php
require_once __DIR__.'/form.php';
require_once __DIR__.'/usuario.php';

class FormularioContacto extends Form
{
    public function __construct() {
        parent::__construct('formContacto');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $html = <<<EOF
            <label for="fname">Nombre</label>
            <input type="text" name="name" placeholder="Tu nombre.." class="field" requiered>
            <label for="lname">Correo Electrónico de Contacto</label>
            <input name="email" type="text" placeholder="Tu correo.." class="field" requiered> 
            <label for="country">Tipo de Mensaje</label>
            <select name="consulta" required>
                <option value=""/> Por favor selecciona una opcion</option>
                <option value="Evaluacion"/> Evaluacion</option>
                <option value="Sugerencia"/> Sugerencia</option>
                <option value="Criticas"/> Criticas</option>
            </select> 
            <label for="subject">Motivo de la consulta</label>
            <textarea id="message" name="message" placeholder="Mensaje.." style="height:200px" required></textarea>
            <input type="submit" class="btn btn-green" value="Enviar Mensaje"> <br/><br/>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
    
        $nombre = isset($datos['name']) ? $datos['name'] : '';
                
        if ( empty($nombre) ) {
            $result[] = "Necesitas ingresar tu nombre";
        }
        
        $email = isset($datos['email']) ? $datos['email'] : '';
        if ( empty($email) || strpos($email, "@") === false) {
            $result[] = "Ingresa un correo electrónico válido.";
        }

        $consulta=isset($datos['consulta']) ? $datos['consulta'] : '';
        if ( empty($consç) ) {
            $result[] = "";
        }

        $motivo=isset($datos['motivo']) ? $datos['motivo'] : '';
        if ( empty($motivo) ) {
            $result[] = "Explique su motivo";
        }
        

        $headers  = 'From: ' . $email ;
        //"From:" . $email;
        $emailPrincipal= 'screspil@ucm.es';
        //mirar consulta y motivo
        if (count($result) === 0) {
            if(mail($emailPrincipal, $consulta,$motivo,$headers)){
                echo "Mensaje enviado";   
            }
           else{
               $result = "ha habido un problema";
           }
            
        }
        //me sale error aqui
        return $result;
    }
   
}