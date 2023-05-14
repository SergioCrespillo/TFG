<?php
require_once __DIR__ . '/../estructura/aplicacion.php';

class Comments
{
    public static function guarda_comentario($comentario, $user, $email)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO comments(comentario, usuario, email) VALUES('%s', '%s', '%s')"
            , $conn->real_escape_string($comentario)
            , $conn->real_escape_string($user)
            , $conn->real_escape_string($email));
        if ( $conn->query($query) ) {
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $user;
    }

    public function getSize($tbl) {
        $app = aplicacion::getSingleton();
        $conexion = $app->conexionBd();
        $tbl_name = "comments";
        if ($conexion->connect_error) {
            die("La conexion falló: " . $conexion->connect_error);
        }
        else{
            if($tbl_name!=""){
                $tbl_name=$tbl;
            }
            $query = "SELECT * FROM $tbl_name ";
            $result = $conexion->query($query);
            return $result->num_rows;
        }
        return 0;
    }

    public function getComentarios(){
        $app = aplicacion::getSingleton();
        $conexion = $app->conexionBd();
        $tbl_name = "comments";
        if ($conexion->connect_error) {
            die("La conexion falló: " . $conexion->connect_error);
        }
        else{
            $query = "SELECT * FROM $tbl_name";
            $result = $conexion->query($query);
            $items=[];
            while($row= $result->fetch_assoc()){
                $item= [
                    'comentario' => $row['comentario'],
                    'usuario' => $row['usuario'],
                    'email' => $row['email'],
                ];
                array_push($items, $item);
            }
        }
        return $items;
    }
}
