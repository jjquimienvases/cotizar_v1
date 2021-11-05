<?php

$bodega = '';

include('conexion.php');
session_start();

$id_rol = $_SESSION['id_rol'];
if ($id_rol == 7) {
  //bodega de ibagueto
  $bodega = "productos_ibague";
} else if ($id_rol == 2) {
  //bodega mostrador principal bogota
  $bodega = "producto";
} else if ($id_rol == 3) {
  //bodega mostrador D1
  $bodega = "producto_d1";
}


$date = date("Y-m-d H:m:s");
$solicitar = (isset($_POST['soli_fact'])) ? $_POST['soli_fact'] : "";
$cotizacion = $_POST['cotizaciones'];
$cliente = $_POST['nombre'];
$crear_factura = "Crear Factura";
$estado = "pendiente"; //estado de la solicitud de factura
$status = "Finalizado"; // Estado de la cotizacion en la tabla de factura_orden
$array = array();
$metodo_de_pago = $_POST['metodo_pago'];
$metodos_de_pago = $_POST["metodos_pago"] ?? [];
$abono_credito = isset($_POST['abono_credito']); 
$monto_cancelado = $_POST['monto_cancelado'];
$monto = $_POST['monto'];
$restante = $monto - $monto_cancelado;
$comercial = $_POST['comercial'];
$efectivo = $metodos_de_pago[0];
$datafono = $metodos_de_pago[1];
$bancolombia = $metodos_de_pago[2];
$davivienda = $metodos_de_pago[3];
$try_ = $_POST['change_value'];

// echo "<pre>";

// //  print_r("monto"+ $monto);
// //  print_r("cancelado"+$monto_cancelado);
//  print_r("restante"+$restante);
// echo "</pre>";

//  return;
 if ($abono_credito == 1) {
  $ins =  "INSERT INTO order_abono(order_id, order_receiver_name, comercial, deuda,abono,restante,metodo_de_pago,order_date,estado_abono,id_rol) VALUES 
  ($cotizacion,'$cliente','$comercial',$monto,$monto_cancelado,$restante,'$metodo_de_pago','$date','$estado',$id_rol)";
  $did2 = $con->query($ins);

  $ins2 = "INSERT INTO file_abono (order_id, metodo_de_pago,nuevo_abono) VALUES 
 ($cotizacion,'$metodo_de_pago',$monto_cancelado)";
  $did1 = $con->query($ins2);
} else {}

// print_r($ins);
// print_r($ins2);

// return;
$consulta_info_cliente = $con->query("SELECT * FROM factura_orden WHERE order_id = $cotizacion");

if ($try_ == "leiner_master") {
  while ($datos = mysqli_fetch_array($consulta_info_cliente)) {
    $email = $datos['email'];
    $cedula = $datos['cedula'];
  }
    $consulta_factura = $con->query("INSERT INTO notificaciones (tipo_notificacion, cotizacion, cliente, estado, email)
     VALUES('$crear_factura', '$cotizacion', '$cliente', '$estado', '$email')");
      $multiple_pago = "multiple";
      $consulta_update_estado = $con->query("UPDATE factura_orden SET estado = '$status', metodo_de_pago = '$multiple_pago', order_date = '$date' WHERE order_id = $cotizacion");
    $did_leiner = $con->query("INSERT INTO `metodos_de_pago`
(
`order_id`,
`efectivo`,
`datafono`,
`bancolombia`,
`davivienda`,
`order_date`)
VALUES
($cotizacion,
 $efectivo,
 $datafono,
 $bancolombia,
 $davivienda,
  '$date')
");
 
 


 
if ($did_leiner) {
  echo $did_leiner;
  
} else {
  echo $did_leiner;
  echo $cotizacion;
  echo 'Fallaron algunas consultas, revisar el estado de la cotizacion y contactar al desarrollador';
}
 
}else{
 if ($metodo_de_pago == "efectivo") {
  //   $consulta_update_estado = "UPDATE factura_orden SET estado = '$status' WHERE order_id = $cotizacion";
  //   $demo =  $con ->query($consulta_update_estado);
  $did = $con->query("UPDATE factura_orden SET metodo_de_pago = '$metodo_de_pago', estado = '$status', order_date = '$date' WHERE order_id = $cotizacion");
  while ($datos = mysqli_fetch_array($consulta_info_cliente)) {
    $email = $datos['email'];
    $cedula = $datos['cedula'];
  }
    if ($solicitar != 0) {
      $consulta_factura = $con->query("INSERT INTO notificaciones (tipo_notificacion, cotizacion, cliente, estado, email)
            VALUES('$crear_factura', '$cotizacion', '$cliente', '$estado', '$email')");
    }
  //condicion de pago si es diferente a efectivo
}else if($bodega == 'producto' || $bodega == 'producto_d1'){
     //solicitar factura
  while ($datos = mysqli_fetch_array($consulta_info_cliente)) {
    $email = $datos['email'];
    $cedula = $datos['cedula'];

    $consulta_factura = $con->query("INSERT INTO notificaciones (tipo_notificacion, cotizacion, cliente, estado, email)
     VALUES('$crear_factura', '$cotizacion', '$cliente', '$estado', '$email')");
    if ($consulta_factura) {
      //actualizar estado de la cotizacion
      $did = $con->query("UPDATE factura_orden SET estado = '$status', metodo_de_pago = '$metodo_de_pago', order_date = '$date' WHERE order_id = $cotizacion");
    }
  }
  //fin del while
}else {
  //solicitar factura
  while ($datos = mysqli_fetch_array($consulta_info_cliente)) {
    $email = $datos['email'];
    $cedula = $datos['cedula'];

    $consulta_factura = $con->query("INSERT INTO notificaciones (tipo_notificacion, cotizacion, cliente, estado, email)
     VALUES('$crear_factura', '$cotizacion', '$cliente', '$estado', '$email')");
    if ($consulta_factura) {
      //actualizar estado de la cotizacion
      $did = $con->query("UPDATE factura_orden SET estado = '$status', metodo_de_pago = '$metodo_de_pago', order_date = '$date' WHERE order_id = $cotizacion");
    }
  }
  //fin del while
}

// if ($abono_credito == 1) {
//   $ins =  "INSERT INTO order_abono(order_id, order_receiver_name, comercial, deuda,abono,restante,metodo_de_pago,order_date,estado,id_rol) VALUES 
//   ($cotizacion,'$cliente','$comercial',$monto,$monto_cancelado,$restante,'$metodo_de_pago','$date','$estado',$id_rol)";
//   $did2 = $con->query($ins);

//   $ins2 = "INSERT INTO file_abono (order_id, metodo_de_pago,nuevo_abono) VALUES 
//  ($cotizacion,'$metodo_de_pago',$monto_cancelado)";
//   $did1 = $con->query($ins2);
// } else {}


if ($did) {
  echo $did;
} else {
  echo $did;
  echo $cotizacion;
  echo 'Fallaron algunas consultas, revisar el estado de la cotizacion y contactar al desarrollador';
}


}
  


// if ($did) {
//   echo $did;
// } else {
//   echo $did;
//   echo $cotizacion;
//   echo 'Fallaron algunas consultas, revisar el estado de la cotizacion y contactar al desarrollador';
// }
