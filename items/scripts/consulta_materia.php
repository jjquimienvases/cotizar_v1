<?php

// include "../../conectar.php";

header('Content-Type: application/json');

$response = new stdClass;

$conexion = new mysqli('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');



$fun = $_POST['key'];

switch ($fun) {

    case 'Q1':

        $id = $_POST['id_materia'];

            $sql = "SELECT * FROM materia_prima WHERE id = $id OR nombre = '$id'";
        

        $r = $conexion->query($sql);

        if ($o = $r->fetch_object()) {

            $resultado = $o;

        }

        $response->resultado = $resultado;

        break;

}

echo json_encode($response);

?>