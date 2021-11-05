<?php
 include '../conexion.php';
 session_start();
 $user = $_SESSION['user'];
 $user_id = $_SESSION['userid']; 
 $item_code = $_POST['codes'];
 $item_quantity = $_POST['quantity'];
 $estado = "transito";

 $cod = explode(",",$item_code); 
 $quantity = explode(",",$item_quantity); 


 for ($i=0; $i < count ($cod)  ; $i++) {
//    $sql_item = ("UPDATE stocks_upload_information SET item_quantity = $quantity[$i], item_status = '$estado' WHERE transfer_id = $order AND item_code = $cod[$i]");
   $sql_item = "UPDATE stocks_upload_information SET new_stock = $quantity[$i], status = 'finalizado' WHERE id_user = $user_id AND item_code = $cod[$i]";
   $execute = $con->query($sql_item);
  }
  if($execute){
    $sql_select = $con->query("SELECT * FROM stocks_upload_information WHERE id_user = $user_id AND status = 'finalizado'");
    foreach($sql_select as $datas){
        $bodega = $datas['bodega'];
        $item_codes = $datas['item_code'];
        $new_quantity = $datas['new_stock'];

        $sql_update = "UPDATE $bodega SET stock = $new_quantity WHERE id = $item_codes";
        $execute_ = $con->query($sql_update);
    }
    if($execute_){
        echo $execute_;
    }else{
        echo 0;
    }
  }else{
      echo 0;
  }