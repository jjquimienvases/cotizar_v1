
<?php

// include "../../conectar.php";

header('Content-Type: application/json');

$response = new stdClass;

$conexion = new mysqli('127.0.0.1', 'cotizar', 'LeinerM4ster', 'cotizar');



$fun = $_POST['key'];

switch ($fun) {

    case 'Q1':

        $id = $_POST['cliente'];

        $sql = "SELECT * FROM factura_orden

                WHERE  order_id LIKE '%$id%'  OR order_receiver_address LIKE '%$id%'";

        $r = $conexion->query($sql);

        if ($o = $r->fetch_object()) {

            $resultado = $o;
        }

        $response->resultado = $resultado;

        break;
}

echo json_encode($response);

?>

