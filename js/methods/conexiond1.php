<?php
include '../../conectar.php';
header('Content-Type: application/json');
$response = new stdClass;
$conexion = conectar();
  $fun = $_POST['key'];
  switch ($fun) {
      case 'Q1':
         $id = $_POST['producto'];
          $sql = "SELECT * FROM producto_d1
                WHERE id='$id'  OR contratipo LIKE '%$id%'";
          $r = $conexion->query($sql);
          if ($o = $r->fetch_object()) {
           $resultado = $o;
          }
        $response->resultado = $resultado;
          break;
    }
    echo json_encode($response);
 ?>