<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "../src/SERVER.php";
require_once "../src/mainModel.php";
//require_once "../src/clientesvo.php";
//require_once "../src/clientesModel.php";
require '../vendor/autoload.php';

$app = new \Slim\App;

$app->get('/api/clientes', function (Request $request, Response $response) {
    $sql = "SELECT * FROM clientes";
    try {
        $conexion = new mainModel();
        $conexion = $conexion->conectar();
        $resultado = $conexion->query($sql);
        if ($resultado->rowCount() > 0) {
            $clientes = $resultado->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($clientes);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e->getMessage() . '}';
    }
});
$app->run();
