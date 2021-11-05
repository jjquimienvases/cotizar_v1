<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "../Model/main.php";
require '../vendor/autoload.php';

$app = new \Slim\App;


/* ---------- Api para consultar todos los productos  ----------*/
$app->get('/productos/all/', function (Request $request, Response $response) {

    $sql = "SELECT * FROM producto_av";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
$app->get('/productos/all/{producto}', function (Request $request, Response $response) {
     
    $producto = $request->getAttribute("producto"); 
    $sql = "SELECT * FROM producto_av WHERE id LIKE '%$producto%' OR contratipo LIKE '%$producto%'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});

$app->get('/productos/one/{producto}', function (Request $request, Response $response) {
     
    $producto = $request->getAttribute("producto"); 
    $sql = "SELECT * FROM producto_av WHERE id = $producto OR contratipo = '$producto'";
    try {
        $conexion = new main();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $factura_orden = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($factura_orden);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});



$app->run();