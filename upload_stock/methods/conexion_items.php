<?php
include "../conexion.php";
header('Content-Type: application/json');
session_start();
$response = new stdClass;
// $conexion = conectar();
$fun = $_POST['key'];
$id = $_POST['codigo_item'];
$user = $_SESSION['user'];
$user_id = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];

$bodega = "";
if ($user_rol == 3) {
    $bodega = "producto_d1";
} else if ($user_rol == 2) {
    $bodega = "producto";
} else if ($user_rol == 7) {
    $bodega = "productos_ibague";
} else {
    $bodega = "producto_av";
}
// $response->post = $_POST;
switch ($fun) {
    case 'Q1':
        $id = $_POST['codigo_item'];
        
        $sql = "SELECT * FROM $bodega
                WHERE id = $id";
        $r = $con->query($sql); 
        if($r){
            if ($o = $r->fetch_object()) {
                $resultado = $o;
            }
            $response->resultado = $resultado;
        }        
        break;
    }
    // echo $id;
    echo json_encode($response);

?>