<?php
 include '../conexion.php';
 session_start();
 $user = $_SESSION['user'];
 $user_rol = $_SESSION['id_rol'];
 
 $item_code = $_POST['codes'];
 $item_quantity = $_POST['quantity'];
 $order = $_POST['order'];
 $estado = "transito";

 $cod = explode(",",$item_code); 
 $quantity = explode(",",$item_quantity); 
  
  
  if($user_rol == 9){
      for ($i=0; $i < count ($cod)  ; $i++) {
   $sql_item = ("UPDATE traspaso_producto_id SET item_quantity = $quantity[$i], item_status = '$estado' WHERE transfer_id = $order AND item_code = $cod[$i]");
   $execute = $con->query($sql_item);
  }

  if($execute){
    echo $execute; 
  }else{
      echo 0;
  }

  }else{
      $sql = $con->query("UPDATE `traspaso_orden` SET `empaca`= '$user',`estado`= '$estado' WHERE transfer_id = $order");

 for ($i=0; $i < count ($cod)  ; $i++) {
   $sql_item = ("UPDATE traspaso_producto_id SET item_quantity = $quantity[$i], item_status = '$estado' WHERE transfer_id = $order AND item_code = $cod[$i]");
   $execute = $con->query($sql_item);
  }

  if($execute){
    echo $execute; 
  }else{
      echo 0;
  } 
  }


