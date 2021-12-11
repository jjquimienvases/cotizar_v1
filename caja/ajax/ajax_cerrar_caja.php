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


$monto = $data["monto"];
$user_rol = $_SESSION['id_rol'];
$user_name = $_SESSION['user'];
$id = intval($_SESSION['userid']);



$cc = isCajaCerradaLastDay($id);
if (empty($cc)) {
    if ($id === 27 && $id === 26) {
        header('location: ../../panel_ibague.php');
    } elseif ($id === 2) {
        // header('location: ../../Panel_Comerciales.php');
        http_response_code(500);
        $json["redirect"] = true;
        $json["url"] = "../Panel_Comerciales.php";
    } elseif ($id === 8) {
        http_response_code(500);
        $json["redirect"] = true;
        $json["url"] = "../panel_mostrador.php";
    } elseif ($id === 9) {
        http_response_code(500);
        $json["redirect"] = true;
        $json["url"] = "../panel_d1.php";
    }
}


$caja_cerrada = isCajaCerrada($id);

if ($caja_cerrada) {
    $json = array();
    http_response_code(500);
    $json["err"] = 1002;
    $json["msg"] = "La caja ya se encuentra cerrada para el día de hoy";
    echo json_encode($json);
    exit;
} else {
    cerrarCaja($_SESSION, intval($monto));
    http_response_code(200);
    echo json_encode("Caja cerrada correctamente");
    exit;
}
