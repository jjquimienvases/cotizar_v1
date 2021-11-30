<?php
include '../conectar.php';
$con = conectar();


header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


// use \Psr\Http\Message\ServerRequestInterface as Request;
// use \Psr\Http\Message\ResponseInterface as Response;

// require_once "../Model/main.php";
// require '../vendor/autoload.php';

// $app = new \Slim\App;

// $app->get('/productos/all/', function (Request $request, Response $response) {

//     $sql = "SELECT id,contratipo FROM producto_av WHERE visibilidad = 1 LIMIT 100";
//     try {
//         // $conexion = new main();
//         // $conexion = $conexion->conectar();
//         $resultado = $con->query($sql);
//         if ($resultado->rowCount() > 0) {
//             $factura_orden = $resultado->fetch_all(MYSQLI_ASSOC);
//             echo json_encode($factura_orden);
//         }
//     } catch (PDOException $e) {
//         echo '{"error" : {"text":' . $e->getMessage() . '}';
//     }
// });


// $app->run();

$sql = $con->query("SELECT * FROM producto_av WHERE visibilidad = 1 LIMIT 100");
$new_data_p = [];
 foreach($sql as $data_p){
     $data_p = (object) $data_p;
     $ns = new stdClass;
    
      $ns->id = $data_p->id;
      $ns->producto = $data_p->contratipo;
     $new_data_p = $ns;
     
     $my_json =  json_encode($new_data_p);
   
     
     print_r($my_json);
     
 }
