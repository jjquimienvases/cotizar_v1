<?php
//   $conexion = new mysqli('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas');


   include 'conexion.php';

   $consulta = $con -> query("SELECT * FROM call_punto_de_venta");

   $id = $_POST['id'];
   $cliente = $_POST['cliente'];
   $comercial = $_POST['comercial'];
   $monto = $_POST['monto'];
   $punto_venta = "mostradorjj";
   $metodo_de_pago = $_POST['metodo_de_pago'];
   $factura = $_POST['factura'];
   $solicitud = "Crear Factura";
   $datos_adicionales = "";
   $estado_factura = "pendiente";
   $canal_v = $_POST['canal_v'];
   $fecha_actual = date('Y-m-d H:m:s');
   $monto_real = preg_replace('([^A-Za-z0-9 ])','', $monto);
   $myString = substr($monto_real, 0, -2); //este es el monto sin caracteres ni decimales 
   $bodega_salida = $_POST['bodega_salida'];
   $bodega_descuento = "";
   if($bodega_salida == "mostrador principal"){
       $bodega_salida = "mostradorjj";
       $bodega_descuento = "producto";
   }else if($bodega_salida == "mostrador D1"){
$bodega_salida = $_POST['bodega_salida'];
$bodega_descuento = "producto_d1";
   }else if($bodega_salida == "ibague"){
       $bodega_salida = $_POST['bodega_salida'];
       $bodega_descuento = "productos_ibague";
   }else if($bodega_salida == "ibague2"){
       $bodega_salida = $_POST['bodega_salida'];
       $bodega_descuento = "productos_ibague2";
   }else if($bodega_salida == "call center"){
          $bodega_salida = "mostradorjj";
       $bodega_descuento = "producto_av";
   }

//  echo "<pre>";
//     print_r($_POST);
//  echo "</pre>";
// return;

   $finalizado = "Finalizado";

   //consulta para actualizar el estado de la cotizacion a finalizado
   $consulta_actualizar = $con -> query ("UPDATE call_punto_de_venta SET estado = '$finalizado', order_date = '$fecha_actual' WHERE order_id = $id");
   $consulta_actualizar_2 = $con -> query ("UPDATE factura_orden SET estado = '$finalizado', metodo_de_pago = '$metodo_de_pago' WHERE order_id = $id");
   
   //consulta para adjuntar cotizacion a venta de leidy
   $consulta_reporte_call = $con -> query ("INSERT INTO factura_modificada (order_id, order_receiver_name, comercial, total, estado, metodopago, code, codigo, punto_pago,canal)
   VALUES('$id','$cliente','$comercial','$myString','$finalizado','$metodo_de_pago','$datos_adicionales','$datos_adicionales','$bodega_salida','$canal_v') ");

   //consulta para adjuntar datos si solicita factura
     if ($facura == 0) {

     }else{

    $consulta_informacion = $con -> query("SELECT * FROM factura_orden WHERE order_id = $id");
    while ($valores = mysqli_fetch_array($consulta_informacion)) {
      $email = $valores['email'];

      $consulta_solicitar_factura = $con -> query ("INSERT INTO notificaciones (tipo_notificacion,cotizacion,cliente,estado,email)
      VALUES ('$solicitud',$id,'$cliente','$estado_factura','$email')");
    }
    }

  //consulta para descontar inventario

  if(isset($_POST)) {

    $captura_datos = "SELECT * FROM factura_orden_producto WHERE order_id = $id";
    $ins = mysqli_query($con,$captura_datos);

    if (mysqli_num_rows($ins) > 0) {
      while ($datos = mysqli_fetch_array($ins)) {
        $codigo_producto = $code[] = $datos['item_code'];
        $producto_cantidad = $cantidad[] = $datos['order_item_quantity'];



        $captura_stock_Actual = $con->query ("SELECT * FROM '$bodega_descuento' WHERE id = $codigo_producto");
        if ($captura_stock_Actual) {
          while ($data_stock = mysqli_fetch_array($captura_stock_Actual)) {
            $stock =  $stockactual[] = $data_stock['stock'];
            $nuevostocks = 0;
            $stock_actual = $stock;
            $nuevostocks = $stock_actual - $producto_cantidad;

            $consulta_descuenta = $con->query("UPDATE $bodega_descuento SET stock = $nuevostocks WHERE id = $codigo_producto");

          }
        }

      }
    }else{
      die("error: No hay datos en esta cotizacion");
    }


  }


  if ($consulta_descuenta) {
    echo "<script> alert(se completo esta venta); </script>";
    header('Location: pedidos_pendientes_mostrador.php');
  }else{
      echo "No se desconto la mercancia de esta bodega, contactar al desarrollador";
  }










    // var_dump($consulta);
    //
    // return;


 ?>
