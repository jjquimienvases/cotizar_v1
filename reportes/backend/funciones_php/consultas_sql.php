<?php 
 

 function conectando(){
    $servidor="localhost";
    $nombreBd="cotpruebas";
    $usuario="root";
    $pass="";
    $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
    if ($conexion->connect_error) {
      die("Connection failed: " . $conexion->connect_error);
    }
    return $conexion;
  }

  $conexiones = conectando();
 
  /* $fecha_actual = date("Y-m-D H:i:s"); */
  $fecha_actual = "2021-03-01";



 $consulta_call = $conexiones -> query("SELECT * FROM factura_orden WHERE order_date LIKE '%$fecha_actual%' AND metodopago LIKE '%bancolombia%' AND estado != 'pendiente'");
 $consulta_mostradorjj = $conexiones -> query("SELECT * FROM factura_orden WHERE order_date LIKE '%$fecha_actual%' AND metodopago LIKE '%mostradorjj%' AND estado !='solicitud anular'");
 $consulta_mostradord1 = $conexiones -> query("SELECT * FROM factura_orden WHERE order_date LIKE '%$fecha_actual%' AND metodopago LIKE '%mostradord1%' AND estado !='solicitud anular'");
 $consulta_ibague1 = $conexiones -> query("SELECT * FROM factura_orden WHERE order_date LIKE '%$fecha_actual%' AND metodopago LIKE '%mostrador_ibague_1%' AND estado !='solicitud anular'");
 $consulta_ibague2 = $conexiones -> query("SELECT * FROM factura_orden WHERE order_date LIKE '%$fecha_actual%' AND metodopago LIKE '%mostrador_ibague_2%' AND estado !='solicitud anular'");
 






?>