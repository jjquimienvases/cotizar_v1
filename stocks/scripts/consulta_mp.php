<?php

include "../conexion.php";
header('Content-Type: application/json');

$response = new stdClass;

// $conexion = new mysqli('localhost', 'root', '', 'cotpruebas');



$fun = $_POST['key'];

switch ($fun) {

    case 'Q1':

        $id = $_POST['cliente'];

        $sql = "SELECT * FROM producto

                WHERE  id LIKE '%$id%'  OR contratipo LIKE '%$id%'";

        $r = $conexion->query($sql);

        if ($o = $r->fetch_object()) {

            $resultado = $o;

        }

        $response->resultado = $resultado;

        break;

}

echo json_encode($response);

?>
