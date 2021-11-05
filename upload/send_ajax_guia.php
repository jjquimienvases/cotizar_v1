<?php

include('conexion.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cot = $con->real_escape_string(htmlentities($_POST['cotizacion']));

     //INSERTANDO LAS IMAGENES
     $estado = "Finalizado";
     $nombreImg=$_FILES['imagen']['name'];
     $ruta=$_FILES['imagen']['tmp_name'];
     $destino="./imagenes/".$nombreImg;
     if(copy($ruta, $destino)){

       $ins = $con->query("UPDATE files SET archivo_name = '$nombreImg', archivo_ruta = '$destino', estado = '$estado' WHERE order_id = '$cot'");

     }


  }

  if ($ins) {
    echo "Haz Finalizado Esta Cotizacion Corectamente";
  }else{
    echo "No Funciona El String";
  }

?>
