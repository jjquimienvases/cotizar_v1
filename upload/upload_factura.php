<?php
include('conexion.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $title = $con->real_escape_string(htmlentities($_POST['title']));
    // $description = $con->real_escape_string(htmlentities($_POST['description']));
    $cot = $con->real_escape_string(htmlentities($_POST['cotizacion']));
    $bodega = $con->real_escape_string(htmlentities($_POST['bodega_descuento_stock']));

    $tipo = "pdf";

    $file_name = $_FILES['file']['name'];

    $new_name_file = null;

    if ($file_name != '' || $file_name != null) {
        $file_type = $_FILES['file']['type'];
        list($type, $extension) = explode('/', $file_type);
        if ($extension == 'pdf') {
            $dir = 'files/';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $file_tmp_name = $_FILES['file']['tmp_name'];
            $estado = "alistamiento";
            $tipo = "pdf";

            //$new_name_file = 'files/' . date('Ymdhis') . '.' . $extension;
            $new_name_file = $dir . file_name($file_name) . '.' . $extension;
            if (copy($file_tmp_name, $new_name_file)) {
                $ins = $con->query("UPDATE files SET url = '$new_name_file', type = '$tipo', estado = '$estado' WHERE order_id = '$cot'");
            }else{

            }
        }
    }
}
  //DESCONTANDO INVENTARIO
  $code = $_POST['cotizacion'];

  $nuevostock = 0;
  $totalstock = 0;
  $status = "finalizado";
  
 
 $consulta_estado = $con -> query ("UPDATE factura_orden SET estado = '$status' WHERE order_id = '$code'");
 $consulta_estado_fm = $con -> query ("UPDATE factura_modificada SET estado = '$status' WHERE order_id = '$code'");
 $consulta =  $con->query("SELECT order_item_quantity,item_code FROM factura_orden_producto WHERE order_id = '$code'");
 while ($o = $consulta->fetch_object()){
 if (floatval($nuevostock)==0) {
   $nuevostock = floatval($o->order_item_quantity);
 }

 $consulta3 = $con->query("SELECT stock FROM $bodega WHERE id = '{$o->item_code}'");
 $stock = floatval($consulta3->fetch_row()[0]);
 $nuevostock = $stock-$o->order_item_quantity;

 if($consulta3){
  $sql1="UPDATE $bodega SET stock ='$nuevostock' WHERE id = '{$o->item_code}'";
  $con->query($sql1);
 }else{
  echo "No se actualizo el stock de la bodeba seleccionada";
 }
 }
 
 $consultando_valor_total = $con ->query("SELECT * FROM factura_orden WHERE order_id = $code");
      while($valor = mysqli_fetch_array($consultando_valor_total)){
                   $price = $valor["order_total_after_tax"];
                   $cedula = $valor["cedula"];
                   
                   $puntos = floatval($price / 1000);
                   $p = explode(".", $puntos);
                   
                   $consultando_puntosN = $con ->query("SELECT * FROM clientes WHERE cedula = $cedula");
                         while($data = mysqli_fetch_array($consultando_puntosN)){ $puntoN = $data["puntos_naturales"];}
                   
                   $puntos_naturales = $puntosN + $p[0];
                   $update_puntos=$con->query("UPDATE clientes SET puntos_naturales = $puntos_naturales WHERE cedula = $cedula");
                     }
 

 if ($ins) {
       echo 'Haz actualizado el Stock de la bodega seleccionada';
   } else {
       echo 'Fallo el string, revisar formulario y consultar con el desarrollador';
   }


//actualizando estado 

 ?>
