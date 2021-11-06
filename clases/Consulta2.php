<?php
include_once "../clases/Conexion.php";
class Consulta extends Conexion
{
    private $con;
    function __construct()
    {
        $this->con = $this->conectar();
    }

    private function prepareQuery($sql, $values)
    {
        $stmt = $this->con->prepare($sql);
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
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
