<?php
require_once __DIR__ . '/../estructura/aplicacion.php';

class Usuario
{

    public static function login($nombreUsuario, $password)
    {
        $user = self::buscaUsuario($nombreUsuario);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }

    public static function buscaUsuario($documentNumber)
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM customer WHERE identityNumber = '%s'", $conn->real_escape_string($documentNumber));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario(
                    $fila['identityNumber'],
                    $fila['fname'],
                    $fila['ltname'],
                    $fila['password'],
                    $fila['city'],
                    $fila['phone'],
                    $fila['occupation'],
                    $fila['filename']);
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaImagen($user)
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT filename FROM customer WHERE identityNumber = '%s'", $conn->real_escape_string($user->documentNumber));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $result = $fila['filename'];
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaNumero($phone)
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM customer WHERE phone = '%s'", $conn->real_escape_string($phone));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario(
                    $fila['identityNumber'],
                    $fila['fname'],
                    $fila['ltname'],
                    $fila['password'],
                    $fila['city'],
                    $fila['phone'],
                    $fila['occupation'],
                    $fila['filename']);
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function eliminaUsuario($nombreUsuario){
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("DELETE FROM customer WHERE ltname='%s'", $conn->real_escape_string($username));
        $result = $conn->query($query);
        if ($result == FALSE) {
            echo "Error al eliminar el usuario." . $query . "<br>" . $conexion->error;
            return false;
        }
        return true;
    }

    public static function crea(
        $documentNumber,
        $firstName,
        $lastName,
        $password,
        $city,
        $phoneNumber,
        $occupation,
        $filename)
    {
        $user = self::buscaUsuario($documentNumber);
        if ($user) {
            //No da pistas a un posible atacante
            return false;
        }
            $user = new Usuario(
                $documentNumber,
                $firstName,
                $lastName,
                self::hashPassword($password),
                $city,
                $phoneNumber,
                $occupation,
                $filename);
        return self::guarda($user);
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public static function guarda($user)
    {
        if ($user->id !== null) {
            return self::actualiza($user);
        }
        return self::inserta($user);
    }
    
    private static function inserta($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO customer(identityNumber, password, fname, ltname, city, phone, occupation, filename) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->documentNumber)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->firstName)
            , $conn->real_escape_string($usuario->lastName)
            , $conn->real_escape_string($usuario->city)
            , $conn->real_escape_string($usuario->phoneNumber)
            , $conn->real_escape_string($usuario->occupation)
            , $conn->real_escape_string($usuario->filename));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }

    public static function actualiza($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE customer SET password='%s', fname='%s', ltname='%s', city='%s'
        , phone='%s', occupation='%s', filename='%s' WHERE identityNumber = '%s'"
             , $conn->real_escape_string($usuario->password)
             , $conn->real_escape_string($usuario->firstName)
             , $conn->real_escape_string($usuario->lastName)
             , $conn->real_escape_string($usuario->city)
             , $conn->real_escape_string($usuario->phoneNumber)
             , $conn->real_escape_string($usuario->occupation)
             , $conn->real_escape_string($usuario->$filename)
             , $conn->real_escape_string($usuario->documentNumber));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->documentNumber;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }

    
    public static function actualizaPerfil($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE customer SET fname='%s', ltname='%s', city='%s'
        , phone='%s', occupation='%s' WHERE identityNumber = '%s'"
             , $conn->real_escape_string($usuario->firstName)
             , $conn->real_escape_string($usuario->lastName)
             , $conn->real_escape_string($usuario->city)
             , $conn->real_escape_string($usuario->phoneNumber)
             , $conn->real_escape_string($usuario->occupation)
             , $conn->real_escape_string($usuario->documentNumber));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->documentNumber;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }

    public static function actualizaPass($usuario)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE customer SET password = '%s' WHERE identityNumber = '%s'"
             , $conn->real_escape_string($usuario->password)
             , $conn->real_escape_string($usuario->documentNumber));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->documentNumber;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }

    public static function actualizaFile($usuario, $filename)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("UPDATE customer SET filename = '%s' WHERE identityNumber = '%s'"
             , $conn->real_escape_string($filename)
             , $conn->real_escape_string($usuario->documentNumber));
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->documentNumber;
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }
    
    public $documentNumber;
    private $firstName;
    private $lastName;
    private $password;
    private $city;
    private $phoneNumber;
    private $occupation;
    private $filename;

    public function __construct(
        $documentNumber,
        $firstName,
        $lastName,
        $password,
        $city,
        $phoneNumber,
        $occupation,
        $filename)
    {
        $this->documentNumber= $documentNumber;
        $this->firstName= $firstName;
        $this->lastName= $lastName;
        $this->password= $password;
        $this->city= $city;
        $this->phoneNumber= $phoneNumber;
        $this->occupation= $occupation;
        $this->filename= $filename;
    }

    public function documentNumber(){
        return $this->documentNumber;
    }

    public function firstName()
    {
        return $this->firstName;
    }

    public function lastName()
    {
        return $this->lastName;
    }

    public function password()
    {
        return $this->password;
    }

    public function city()
    {
        return $this->city;
    }

    public function phoneNumber()
    {
        return $this->phoneNumber;
    }

    public function occupation()
    {
        return $this->occupation;
    }

    public function filename()
    {
        return $this->filename;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);

    }
}
