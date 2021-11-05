<?php
include "../Invoice.php";
$conexion = conectar();
  $fun = $_POST['key'];
  switch ($fun) {
      case 'Q1':
         $id = $_POST['factura_orden'];
          $sql = "SELECT * FROM factura_orden
                WHERE order_id='$id'  OR order_receiver_name LIKE '%$id%' ";
          $r = $conexion->query($sql);
          if ($o = $r->fetch_object()) {
           $resultado = $o;
          }
          echo json_encode($resultado);
          break;
    }
 ?>
