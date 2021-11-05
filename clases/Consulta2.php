<?php
// require_once __DIR__ . "/conectar.php";
// $conectar = "our-project/conectar.php";
// require_once $conectar;


function conectar(){
  $servidor="ftp.jjquimienvases.com";
  $nombreBd="jjquimienvases_cotizar";
  $usuario="jjquimienvases_jjadmin";
  $pass="LeinerM4ster";
  $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }
  return $conexion;
}
class Consulta
{
    private $con = null;
    function __construct()
    {
        $this->con = conectar();
    }

    private function prepareQuery($sql, $values)
    {
        $stmt = $this->con->prepare($sql);
        // foreach ($values as $v) {
        //     // var_dump($v);
        //     // $value_type = "s";
        //     // try {
        //     //     intval($v);
        //     //     $value_type = "d";
        //     // } catch (Exception $e) {
        //     //     var_dump($e);
        //     // }

        //     $stmt->bind_param("s", $v);
        // }
        return $stmt;
    }

    function find($sql)
    {
        $result = $this->con->query($sql);
        if ($result) return $result->fetch_all(MYSQLI_ASSOC);
        return [];
    }

    function findOne($sql)
    {
        $result = $this->con->query($sql);
        if ($result) return $result->fetch_assoc();
        return null;
    }

    function exec($sql)
    {
        try {
            // $this->con->execute($sql);
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
