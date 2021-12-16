<?php
include "../conexion.php";
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



switch ($fun) {

    case 'Q1':

        $id = $_POST['item'];

        $sql = "SELECT * FROM $bodega_entrada

                WHERE id='$id' AND visibilidad != 0";

        $r = $con->query($sql);

        

        if ($o = $r->fetch_object()) {

            $resultado = $o;

        }

        $response->resultado = $resultado;

        break;

}

echo json_encode($response);
