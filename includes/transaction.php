<?php
require_once __DIR__ . '/../estructura/aplicacion.php';

class Transaction
{

    public static function buscaTransaction($acnumber)
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM trandetails WHERE acnumber = '%s'", $conn->real_escape_string($acnumber));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $tran = new Transaction(
                    $fila['tnumber'],
                    $fila['acnumber'],
                    $fila['dot'],
                    $fila['medium_of_transaction'],
                    $fila['transaction_amount']);
                $result = $tran;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaTran_amount($acnumber)
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM trandetails WHERE acnumber = '%s'", $conn->real_escape_string($acnumber));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $result = $fila['transaction_amount'];
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaTran_fecha($acnumber)
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM trandetails WHERE acnumber = '%s'", $conn->real_escape_string($acnumber));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $result = $fila['dot'];
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function getSize($acc) {
        $app = aplicacion::getSingleton();
        $conexion = $app->conexionBd();
        $tbl_name = "trandetails";
        if ($conexion->connect_error) {
            die("La conexion falló: " . $conexion->connect_error);
        }
        else{
            if(self::buscaTran_amount($acc) != NULL){
                $query = "SELECT * FROM $tbl_name ";
                $result = $conexion->query($query);
                $result->num_rows;
                return $result;
            }
        }
        return 0;
    }

    public static function crea(
        $tnumber,
        $acnumber,
        $dot,
        $medium_of_transaction,
        $transaction_amount)
    {
        $tran = self::buscaTransaction($acnumber);
        if ($tran) {
            return false;
        }
            $tran = new Transaction(
                $tnumber,
                $acnumber,
                $dot,
                $medium_of_transaction,
                $transaction_amount);
        return self::inserta($tran);
    }
    
    private static function inserta($tran)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO trandetails(tnumber, acnumber, dot, medium_of_transaction, transaction_amount) VALUES('%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($tran->tnumber)
            , $conn->real_escape_string($tran->acnumber)
            , $conn->real_escape_string($tran->dot)
            , $conn->real_escape_string($tran->medium_of_transaction)
            , $conn->real_escape_string($tran->transaction_amount));
        if ( $conn->query($query) ) {
            $tran->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $tran;
    }
    
    private $tnumber;
    private $acnumber;
    private $dot;
    private $medium_of_transaction;
    private $transaction_amount;
    

    public function __construct(
        $tnumber,
        $acnumber,
        $dot,
        $medium_of_transaction,
        $transaction_amount)
    {
        $this->tnumber= $tnumber;
        $this->acnumber= $acnumber;
        $this->dot= $dot;
        $this->medium_of_transaction= $medium_of_transaction;
        $this->transaction_amount= $transaction_amount;
    }

    public function tnumber(){
        return $this->tnumber;
    }

    public function acnumber()
    {
        return $this->acnumber;
    }

    public function dot()
    {
        return $this->dot;
    }

    public function medium_of_transaction()
    {
        return $this->medium_of_transaction;
    }

    public function transaction_amount()
    {
        return $this->transaction_amount;
    }
    
}
