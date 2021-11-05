<?php
include "../conexion.php";
// $con = new mysqli('localhost','root','','cotpruebas');

session_start();
$id_rol = $_SESSION['id_rol'];
$user_id = $_SESSION['userid'];
if ($id_rol == 2) {
    $bodega_entrada = "producto";
} else if ($id_rol == 3) {
    $bodega_entrada = "producto_d1";
} else if ($id_rol == 6) {
    $bodega_entrada = "producto_av";
} else if ($id_rol == 4) {
    $bodega_entrada = "producto_av";
} else if ($user_id == 27) {
    $bodega_entrada = "productos_ibague2";
} else if ($id_rol == 7) {
    $bodega_entrada = "productos_ibague";
} else {
    $bodega_entrada = "producto_av";
}

header('Content-Type: application/json');

$response = new stdClass;
$fun = $_POST['key'];
$status_p = "pendiente";

switch ($fun) {
    case 'Q1':
        $id = $bodega_entrada;
        $sql = "SELECT * FROM traspaso_producto_id WHERE bodega_entrada = '$bodega_entrada' AND item_status = 'pendiente'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;
}
echo json_encode($response);

?>