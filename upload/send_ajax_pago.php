<?php
include('conexion.php');
session_start();
$rol = $_SESSION['id_rol'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $con->real_escape_string(htmlentities($_POST['title']));
  $description = $con->real_escape_string(htmlentities($_POST['description']));
  $cot = $con->real_escape_string(htmlentities($_POST['cotizacion']));
  $punto_despacho = $con->real_escape_string(htmlentities($_POST['id_bodega']));
}

$new_name_file = "";
$tipo = "";
$comercial = $_POST['vendedor'];
$total = $_POST['monto'];
$pago = $_POST['pago'];
$code = "";
$codigo = "";
$demo_1 = "";
$demo_2 = "";
$canal_v = $_POST['canal_v'];
$fecha_actual = date('Y-m-d H:m:s');


//insert de la foto
$nombreImg = $_FILES['imagen']['name'];
$ruta = $_FILES['imagen']['tmp_name'];
$destino = "../imagenes/" . $nombreImg;
$estado = "s_factura";
$estado2 = "pendiente";
$monto_cancelado = 0;


if ($pago != "credito") {
   

print_r("INSERT INTO files(title,description,url,type,order_id,file_name,file_ruta,estado,archivo_name,archivo_ruta,id_punto_venta) VALUES ('$title','$description','$new_name_file','$tipo','$cot','$nombreImg','$destino','$estado','$demo_1','$demo_2','$punto_despacho')");
  return;
  $ins = $con->query("INSERT INTO files(title,description,url,type,order_id,file_name,file_ruta,estado,archivo_name,archivo_ruta,id_punto_venta) VALUES ('$title','$description','$new_name_file','$tipo','$cot','$nombreImg','$destino','$estado','$demo_1','$demo_2','$punto_despacho')");
  $ins2 = $con->query("INSERT INTO factura_modificada(order_id,order_receiver_name,comercial,total,estado,metodopago,code,codigo,canal,order_date) VALUES ('$cot','$title','$comercial','$total','$estado','$pago','$code','$codigo','$canal_v','$fecha_actual')");
  

  return;
  // $ins3 = $con ->query("UPDATE factura_orden SET order_date = '$fecha_actual' WHERE order_id = $cot");
  $ins4 = $con->query("UPDATE factura_orden SET metodo_de_pago = '$pago' WHERE order_id = $cot");
} else {
  $ins5 =  "INSERT INTO order_abono(order_id, order_receiver_name, comercial, deuda,abono,restante,metodo_de_pago,order_date,estado_abono,id_rol) VALUES 
    ($cot,'$title','$comercial',$total,$monto_cancelado,$total,'$pago','$fecha_actual','$estado2',$rol)";
  $execute = $con->query($ins5);

  $ins6 = "INSERT INTO file_abono (order_id,order_date, ruta, archivo, metodo_de_pago,nuevo_abono) VALUES 
   ($cot,'$fecha','$destino','$nombreImg','$pago',$monto_cancelado)";
  $execute2 = $con->query($ins6);

  $ins = ("INSERT INTO files(title,description,url,type,order_id,file_name,file_ruta,estado,archivo_name,archivo_ruta,id_punto_venta,salida_name,salida_ruta,order_date) 
      VALUES ('$title','$description','$new_name_file','$tipo','$cot','$nombreImg','$destino','$estado','$demo_1','$demo_2','$punto_despacho','pendiente','pendiente','$fecha_actual')");
  $execute = $con->query($ins);
  $ins2 = $con->query("INSERT INTO factura_modificada(order_id,order_receiver_name,comercial,total,estado,metodopago,code,codigo,canal) VALUES ('$cot','$title','$comercial','$total','$estado','$pago','$code','$codigo','$canal_v')");
  // $ins3 = $con ->query("UPDATE factura_orden SET order_date = '$fecha_actual' WHERE order_id = $cot");
  $ins4 = $con->query("UPDATE factura_orden SET metodo_de_pago = '$pago' WHERE order_id = $cot");
}




if ($ins) {
  echo $ins;
} else {
  echo 0;
}
