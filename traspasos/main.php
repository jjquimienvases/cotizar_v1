<?php

class main{
/*-----Función Conexion -----*/
public static function conectar()
{
    try {
        $conexion = new PDO('mysql:host=ftp.jjquimienvases.com;dbname=jjquimienvases_cotizar', 'jjquimienvases_jjadmin', 'LeinerM4ster');
        $conexion->exec("SET CHARACTER SET utf8");

        return $conexion;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
/*-----Función Ejecutar Consultas Simples -----*/
public static function ejecutar_consulta_simples($consulta)
{
    $sql = self::conectar()->prepare($consulta);
    $sql->execute();
    return $sql;
}

}