<?php
 include '../conexion.php';
 $bodega = "";
 $sql_= $conexion->query("SELECT * FROM stocks_uploads WHERE estado = 'pendiente'");
  foreach($sql_ as $data):
    $id_rol = $data['id_rol'];
    $sku = $data['sku'];
    $contratipo = $data['contratipo'];
    $nuevo_stock =$data['nuevo_stock'];
      if($id_rol == 1){
        $bodega = "producto_av";
      }else if($id_rol == 7){
        $bodega = "productos_ibague";
      }else if($id_rol == 2){
        $bodega = "producto";
      }else if($id_rol == 3){
        $bodega = "producto_d1";
      }
     
      $sql_update = $conexion->query("UPDATE $bodega SET stock = $nuevo_stock WHERE id = $sku");
      $sql_update_estado = $conexion->query("UPDATE stocks_uploads SET estado = 'finalizado' WHERE sku = $sku");
      
      if($sql_update){
          echo $sql_update;
      }else{
          echo 0;
      }
    endforeach;
