<?php

include('conexion.php');
// $con = new mysqli ('localhost','root','','cotpruebas');

session_start();

$rol = $_SESSION['id_rol'];

//declarando variables de texto
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $cliente = $con->real_escape_string(htmlentities($_POST['cliente']));
  $comercial = $con->real_escape_string(htmlentities($_POST['comercial']));
  $deuda_total = $con->real_escape_string(htmlentities($_POST['monto']));
  $monto_cancelado = $con->real_escape_string(htmlentities($_POST['abono']));
  $metodo_pago = $con->real_escape_string(htmlentities($_POST['metodo_pago']));
  $cotizacion = $con->real_escape_string(htmlentities($_POST['order']));
}

$nombreImg=$_FILES['imagen']['name'];
$ruta=$_FILES['imagen']['tmp_name'];
$destino="./imagenes/".$nombreImg;
$estado = "";

$restante = $deuda_total - $monto_cancelado;

if($monto_cancelado >= $deuda_total){
    $estado = "finalizado";
}else{
    $estado = "pendiente";
}

$fecha = DATE('Y-m-d H:m:s');

if(copy($ruta, $destino)){
   // primero vamos a insertar en la tabla de abonos 

    $ins =  "INSERT INTO order_abono(order_id, order_receiver_name, comercial, deuda,abono,restante,metodo_de_pago,order_date,estado_abono,id_rol) VALUES 
     ($cotizacion,'$cliente','$comercial',$deuda_total,$monto_cancelado,$restante,'$metodo_pago','$fecha','$estado',$rol)";
     $execute = $con->query( $ins);

    $ins2 = "INSERT INTO file_abono (order_id, ruta, archivo, metodo_de_pago,nuevo_abono) VALUES 
    ($cotizacion,'$destino','$nombreImg','$metodo_pago',$monto_cancelado)";
    
     if ($execute) {
      $execute2 = $con->query($ins2);
  }else{
    echo 0;
  }
 


  }
  
     if ($execute2) {
      echo $execute2;
  }else{
    echo 0;
  }
  
  //ejecutando la consulta y condiconandoelresultado 

 