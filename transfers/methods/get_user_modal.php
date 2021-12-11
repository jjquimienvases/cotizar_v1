



<?php
include '../conexion.php';
// $con = new mysqli('localhost','root','','cotpruebas');

header('Content-Type: application/json');

$response = new stdClass;



$fun = $_POST['key'];

switch ($fun) {

    case 'Q1':

        $id = $_POST['transfer'];

        $sql = "SELECT * FROM traspaso_orden

                WHERE transfer_id = $id";

        $r = $con->query($sql);

        if ($o = $r->fetch_object()) {

            $resultado = $o;

        }

        $response->resultado = $resultado;

        break;

}

echo json_encode($response);

?>

