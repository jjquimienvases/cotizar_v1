<?php
include_once 'conectar.php';
	$conexion= conectar();

    $codigo = $_POST['codigo'];
  $producto = $_POST['name'];
  $stock2 = $_POST['cantidad'];
  $stockactual = $_POST['stock'];
  $cliente = $_POST['cliente'];

  $nuevostock = 0;

  $totalstock = 0;

  $consulta = $conexion->query("SELECT stock FROM producto WHERE id = '$codigo'");
  $stock = floatval($consulta->fetch_row()[0]);

  $nuevostock = $stock + $stock2;

   if($consulta){

     $sql1="UPDATE producto SET stock ='$nuevostock' WHERE id = '$codigo'";
     $conexion->query($sql1);
     echo '<script> alert("Estamos actualizando el stock"); window.location="devolucion.php"; </script>';
   }else{
      query()->error;
     '<script> alert("NO FUNCIONA"); </script>';
   }
   if($cliente){
     $sql2="INSERT INTO devoluciones (code,contratipo,cantidad,cliente) VALUES ('$codigo', '$producto', '$stock2', '$cliente') ";
     $conexion->query($sql2);
   }else{
     query()->error;
     '<script> alert("No funciona");  </script>';
   }





      ?>
