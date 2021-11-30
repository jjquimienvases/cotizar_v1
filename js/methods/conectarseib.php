<?php
include '../../conectar.php';

session_start();

$user_id = $_SESSION['userid'];
header('Content-Type: application/json');
$response = new stdClass;
$conexion = conectar();
  $fun = $_POST['key'];
  switch ($fun) {
      case 'Q1':
         $id = $_POST['producto'];
         if($user_id == 27){
             
          $sql = "SELECT * FROM productos_ibague2 WHERE id='$id'  OR contratipo LIKE '%$id%'";
         }else{
             
          $sql = "SELECT * FROM productos_ibague WHERE id='$id'  OR contratipo LIKE '%$id%'";
         }
          $r = $conexion->query($sql);
          if ($o = $r->fetch_object()) {
           $resultado = $o;
          }
        $response->resultado = $resultado;
          break;
    }
    echo json_encode($response);
 ?>
