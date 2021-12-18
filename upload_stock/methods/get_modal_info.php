<?php
include "../conexion.php";
// $con = new mysqli('localhost','root','','cotpruebas');
header('Content-Type: application/json');

$response = new stdClass;
$fun = $_POST['key'];

switch ($fun) {
    case 'Q1':
        $user_id = $_POST['users_id'];
        // $sql = "SELECT * FROM `traspaso_producto_id` INNER JOIN traspaso_orden ON traspaso_producto_id.transfer_id = traspaso_orden.transfer_id WHERE traspaso_orden.transfer_id = $id";
        $sql = "SELECT * FROM stocks_upload_information WHERE id_user = $user_id AND status = 'pendiente'";
        $r = $conexion->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;
}
echo json_encode($response);

?>