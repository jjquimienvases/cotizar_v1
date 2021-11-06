<?php


class Conexion
{

  private $host = "173.230.154.140";
  private $port = 3307;
  private $user = "cotizar";
  private $password = "dev";
  private $dbname = "cotizar_prod";

  public function conectar($db=null)
  {
    $cnx = new mysqli($this->host, $this->user, $this->password, (!$db ? $this->dbname : $db), $this->port);
    if ($cnx->connect_error) {
      die("Connection Failed: " . $cnx->connect_error);
    }
    return $cnx;
  }
}
