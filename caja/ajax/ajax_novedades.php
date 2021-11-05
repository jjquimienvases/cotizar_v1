<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
include "../consultas.php";

session_start();
$json = array();

$data = json_decode(file_get_contents("php://input"), true);



// $monto = $data["monto"];
$user_rol = $_SESSION['id_rol'];
$user_name = $_SESSION['user'];
$id = intval($_SESSION['userid']);
$novedad = $data["novedad"];
$monto = $data["monto"];









if (isset($novedad)) {
    subirNovedad($_SESSION, $monto, $novedad);
}
print_r($novedad);
