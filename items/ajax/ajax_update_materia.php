<?php

$con = new mysqli('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');

$id = $_POST['id'];
$costo = $_POST['costo'];
$porcentaje = $_POST['presentacion'];
$nombre = $_POST['materia'];
$estado = $_POST['estado'];

$sql = $con->query("UPDATE materia_prima SET costo = $costo, nombre = '$nombre', porcentaje = $porcentaje, estado = '$estado' WHERE id = $id");

if($sql){
    $sql_ = $con->query("SELECT * FROM producto_av pa INNER JOIN materia_prima mp ON pa.padre = mp.id WHERE pa.padre = $id");
 $puntos = ['producto','producto_av','producto_d1','productos_ibague','productos_ibague2'];
 
 $garrafa = 20;
 $kilo = 1;
 $total_items = 0;
 $total_venta_bogota = 0;
 $total_venta_ibague = 0;
 $ibague_variable = 0.22;
 foreach($sql_ as $data):
    $presentacion = $data['contratipo'];
    $id = $data['id'];
    $estado = $data['estado'];
    $margen_demo = "0.".$data['margen'];
  //lo primero, dejar el costo sin iva 
  $costo_inicial_sin_iva = $data['costo'] / 1.19;
  //obetenemos precio gramo 
  $precio_gramo = round($costo_inicial_sin_iva / ($data['porcentaje'] * 1000),2);
  //obtenemos cuantos gramos caben por envase
  if($estado == "liquido"){
  $valor_x = $data['porcentaje'] / $garrafa;
  }else{ 
  $valor_x = $data['porcentaje'] / $kilo;       
  }
  //capacidades
  $cantidad_gramos_por_capacidad = $valor_x * $data['capacidad'];
  //item asociado
  $item_asociado = $data['item_asociado'];
  $sql_item_asociado = $con->query("SELECT gramo as Total FROM producto_av WHERE id = $item_asociado");
  foreach($sql_item_asociado as $datas){
      $costo_item_a = $datas['Total'];
  }
  if($item_asociado == 606 || $item_asociado == 599){
      $sql_tapa = $con->query("SELECT gramo as Total FROM producto_av WHERE id = 48005");
      foreach($sql_tapa as $data_t){
        $costo_tapa = $data_t['Total'];

        $total_items = $costo_item_a + $costo_tapa;
      }
  }else{
    $total_items = $costo_item_a;
  }
//definiciendo costo por gramo
  $costo_total_gramos = $precio_gramo * $cantidad_gramos_por_capacidad;
//obteniendo taxes
  $subtotal = $costo_total_gramos + $total_items;
  $iva = $subtotal * 0.19;
  $ss_total = $subtotal + $iva;
  $margen = $ss_total * $margen_demo;
  $variable_i = round($ibague_variable * $cantidad_gramos_por_capacidad,2);

  //totales de venta
  $total_venta_bogota = round($ss_total + $margen,2); 
  $total_venta_ibague = round($ss_total + $margen + $variable_i,2); 


  //Hacemos una consulta para obtener el id
  $sql_get_id = $con->query("SELECT id FROM producto_av WHERE contratipo LIKE '%$presentacion%' AND item_asociado != 0 AND padre = $id");
  foreach($sql_get_id as $data_g){
  $item_id = $data_g['id'];
  }
  //Hacemos la actualizacion del precio y el nombre
    //consulta con foreach
    $new_name = $presentacion." (".$cantidad_gramos_por_capacidad.")ML";
    foreach($puntos as $punto){
        if($punto == "productos_ibague" || $punto == "productos_ibague2"){
        $sql_update = $con->query("UPDATE $punto SET gramo = $total_venta_ibague, visibilidad = 1 WHERE id = $item_id");
        }else{
        $sql_update = $con->query("UPDATE $punto SET gramo = $total_venta_bogota, visibilidad = 1 WHERE id = $item_id");
        }
        
        if($sql_update){
         echo $sql_update;
    }else{
        echo 0;
    }
        
    }

    
 endforeach;
}else{
    echo 0;
}
 
