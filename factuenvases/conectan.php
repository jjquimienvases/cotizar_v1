<?php
class Conexion{
    private $mysql;
    private $bdName = "jjquimienvases_cotizar";
    private $user;
    private $pass;
// 'ftp.jjquimienvases.com', 'jquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar'
    public function __construct(){
        $this->bdName = $bdName;
        $this->user = "jquimienvases_jjadmin";
        $this->pass = "LeinerM4ster";
    }

    public function conectar(){
        $this->mysql = new mysqli(
            "ftp.jjquimienvases.com",
            $this->user,
            $this->pass,
            $this->bdName
        );

        if (mysqli_connect_errno()) {
            printf("Error de conexión: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function ejecutar($query){
        return $this->mysql->query($query);
    }

    public function desconectar(){
        $this->mysql->close();
    }
}
?>
