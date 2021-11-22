<?php
include 'conectar.php';
$con = conectar();
$code = $_POST['cotizacion'];
$nuevostock = 0;
$totalstock = 0;
$bodega = $_POST['bodega'];



$consulta =  $con->query("SELECT * FROM factura_orden_producto WHERE order_id = $code");

$consulta_estado = $con -> query("SELECT estado as estado_actual FROM factura_orden WHERE order_id = $code");
$data=mysqli_fetch_assoc($consulta_estado);
$estado = $data['estado_actual'];


if ($estado == "anulado") {
die("error: Esta cotizacion ya fue anulada");

}else{
  if (mysqli_num_rows($consulta) > 0) {
    while ($datos = mysqli_fetch_array($consulta)) {
      $codigo_producto = $codes[] = $datos['item_code'];
      $producto_cantidad = $cantidad[] = $datos['order_item_quantity'];
      $gramos_perfumeria = $gramos[] = $datos['gramos'];
      $envases = $envase[] = $datos['envases'];
      $tapas = $tapa[] = $datos['tapa'];

      if($gramos_perfumeria == "0"){
        $captura_stock_Actual = $con -> query ("SELECT * FROM $bodega WHERE id = $codigo_producto");

        if ($captura_stock_Actual) {
          while ($data_stock = mysqli_fetch_array($captura_stock_Actual)) {
            $stock =  $stockactual[] = $data_stock['stock'];
            $nuevostocks = 0;
            $stock_actual = $stock;
            $nuevostocks = $stock_actual + $producto_cantidad;
            $consulta_suma_productos = $con -> query("UPDATE $bodega SET stock = $nuevostocks WHERE id = $codigo_producto");
          }
        }
      }else{
        //aqui se estan  sumando los gramos
        $cosultando_stock_perfume = $con ->query("SELECT * FROM $bodega WHERE id = $codigo_producto");
          if($cosultando_stock_perfume){
            while ($data_stock_p = mysqli_fetch_array($cosultando_stock_perfume)) {
              $stock_p =  $stockactual_p[] = $data_stock_p['stock'];
              $nuevostocks = 0;
              $stock_actual_p = $stock_p;
              $nuevostocks = $stock_actual_p + $gramos_perfumeria;
              $consulta_suma_mercancia = $con ->query("UPDATE $bodega SET stock = $nuevostocks WHERE id = $codigo_producto");
            }
          }
 //aqui se estan  sumando los envases
 $cosultando_stock_envase = $con ->query("SELECT * FROM $bodega WHERE id = $envases");
 if($cosultando_stock_envase){
   while ($data_stock_e = mysqli_fetch_array($cosultando_stock_envase)) {
     $stock_e =  $stockactual_e[] = $data_stock_e['stock'];
     $nuevostocks = 0;
     $stock_actual_e = $stock_e;
     $nuevostocks = $stock_actual_e + $producto_cantidad;
     $consulta_suma_envase = $con ->query("UPDATE $bodega SET stock = $nuevostocks WHERE id = $envases");
   }
 }
 //aqui vamos a sumar las tapas
 if($tapas != 0){
   $cosultando_stock_tapas = $con ->query("SELECT * FROM $bodega WHERE id = $tapas");
   if($cosultando_stock_tapas){
     while ($data_stock_t = mysqli_fetch_array($cosultando_stock_tapas)) {
       $stock_t =  $stockactual_t[] = $data_stock_t['stock'];
       $nuevostocks = 0;
       $stock_actual_t = $stock_t;
       $nuevostocks = $stock_actual_t + $producto_cantidad;
       $consulta_suma_tapas = $con ->query("UPDATE $bodega SET stock = $nuevostocks WHERE id = $tapas");
     }
   }
 }



      }


  }


 }else{
   die("error: No hay datos en esta cotizacion");
 }



 $anulado = "anulado";

 if ($consulta_suma_productos) {
   $consulta_estado =  $con->query("UPDATE factura_orden SET estado = '$anulado' WHERE order_id = $code");
   $consulta_estado =  $con->query("UPDATE solicitud_anular SET estado = '$anulado' WHERE order_id = $code");

 }else{

 }



   echo $consulta_estado;


}

?>