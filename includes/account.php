<?php
require_once __DIR__ . '/../estructura/aplicacion.php';

class Account{

    public static function allUserAccounts(){

        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM account WHERE custid = '%s'", $conn->real_escape_string($_SESSION['user_mod']));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $result=array();
            while($fila = $rs->fetch_assoc()){
                $account = new Account(
                    $fila['acnumber'],
                    $fila['custid'],
                    $fila['opening_balance'],
                    $fila['user_phone'],
                    $fila['atype'],
                    $fila['astatus']);
                array_push($result, $account);
            }

            $rs->free();

        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function UserAccount($user){

        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT acnumber FROM account WHERE custid = '%s'", $conn->real_escape_string($user->documentNumber));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $result = $fila['acnumber'];
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaId()
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT acnumber FROM account WHERE custid = '%s'", $conn->real_escape_string($_SESSION['user_mod']));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $result = $fila['acnumber'];
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function buscaBalance()
    {
        $app = aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT opening_balance FROM account WHERE custid = '%s'", $conn->real_escape_string($_SESSION['user_mod']));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $result = $fila['opening_balance'];
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    public static function crea(
        $acnumber,
        $custid,
        $opening_balance,
        $aod,
        $atype,
        $astatus)
    {
            $acc = new Account(
                $acnumber,
                $custid,
                $opening_balance,
                $aod,
                $atype,
                $astatus);
        return self::guarda($acc);
    }

    public static function guarda($acc)
    {
        return self::inserta($acc);
    }

    private static function inserta($acc)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO account(acnumber, custid, opening_balance, user_phone, atype, astatus) VALUES('%s', '%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($acc->acnumber)
            , $conn->real_escape_string($acc->custid)
            , $conn->real_escape_string($acc->opening_balance)
            , $conn->real_escape_string($acc->aod)
            , $conn->real_escape_string($acc->atype)
            , $conn->real_escape_string($acc->astatus));
        if ( $conn->query($query) ) {
            $acc->id = $conn->insert_id;
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }


    private $acnumber;
    private $custid;
    private $user;
    private $opening_balance;
    private $aod;
    private $atype;
    private $astatus;

    public function __construct(
        $acnumber,
        $custid,
        $opening_balance,
        $user,
        $atype,
        $astatus
    ){
        $this->acnumber= $acnumber;
        $this->custid= $custid;
        $this->opening_balance= $opening_balance;
        $this->user= $user;
        $this->atype= $atype;
        $this->astatus= $astatus;
    }

    public static function getAcnumber(){
        return $this->acnumber;
    }

    public function getCustid(){
        return $this->custid;
    }

    public function getUser(){
        return $this->user;
    }

    public function getOpeningBalance(){
        return $this->opening_balance;
    }

    public function getAod(){
        return $this->aod;
    }

    public function getAtype(){
        return $this->atype;
    }

    public function getAstatus(){
        return $this->astatus;
    }


    public static function actualiza($tran_type, $amount, $acc)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        if($tran_type == 'Deposit') {
            $query=sprintf("UPDATE account SET opening_balance = opening_balance + $amount WHERE acnumber= '%s'"
            , $conn->real_escape_string($acc));
        }
        else{
            $query=sprintf("UPDATE account SET opening_balance = opening_balance - $amount WHERE acnumber= '%s'"
            , $conn->real_escape_string($acc));
        }

        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar la cuenta";
                exit();
            }
        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $acc;
    }

}