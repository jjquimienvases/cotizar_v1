<?php

  include('conexion.php');



  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // $title = $con->real_escape_string(htmlentities($_POST['cliente']));

    // $description = $con->real_escape_string(htmlentities($_POST['description']));

    $cot = $con->real_escape_string(htmlentities($_POST['cotizacion']));

    // $punto_despacho = $con->real_escape_string(htmlentities($_POST['id_bodega']));



  }



  $new_name_file = "";

  $tipo = "";

//   $comercial = $_POST['vendedor'];

//   $total = $_POST['monto'];

//   $pago = $_POST['pago'];

  $code = "";

  $codigo = "";

  $demo_1 = "";

  $demo_2 = "";





  //insert de la foto

  $nombreImg=$_FILES['imagen']['name'];

  $ruta=$_FILES['imagen']['tmp_name'];

  $destino="./imagenes/".$nombreImg;

  $estado = "venta finalizada";





  if(copy($ruta, $destino)){
   $ins = $con ->query("UPDATE files SET salida_name = '$nombreImg', salida_ruta='$destino', estado = '$estado' WHERE order_id = $cot");
  }



  if ($ins) {

    echo "Aprobaste la salida de esta mercancia :D";

  }else{

    echo  "no se agrego correctamente";

  }

 ?>
