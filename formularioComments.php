<?php
require_once __DIR__.'/includes/form.php';
require_once __DIR__.'/includes/comments.php';
class FormularioComments extends Form
{
    public function __construct() {
        parent::__construct('formComments');
    }
    
    protected function generaCamposFormulario($datos)
    {
        $html = <<<EOF
            <label for="fname">Nombre</label>	
                <input id="name" name="name" type="text" class="field" required> <br/>
            <label for="fname">Correo electrónico</label>
                <input id="email" name="email" type="text" class="field" required> <br/>
            <label for="subject">Escribe tu comentario</label>
            <textarea id="message" name="comment" placeholder="Mensaje.." style="height:200px" required></textarea>
            <center><input type="submit" class="btn btn-green" value="Enviar Mensaje"></center> <br/>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $comentario = htmlspecialchars($datos['comment']);
        $user = htmlspecialchars($datos['name']);
        $email = htmlspecialchars($datos['email']);

        Comments::guarda_comentario($comentario, $user, $email);
        $result = 'index.php';
        return $result;
    }
}