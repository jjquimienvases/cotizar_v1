<?php

include 'conectar.php';

	$conexion= conectar();

  session_start();


$usuario = $_SESSION['user'];
  

  $codigo = $_POST['codigo'];
  $producto = $_POST['name'];
  $stock2 = $_POST['cantidad'];
  $stockactual = $_POST['stock'];
  $factura = $_POST['factura'];
  $proveedor = $_POST['proveedor'];
  $bodega = $_POST['bodega'];
  $unidad = $_POST['empaque'];
  $precio = $_POST['precio'];



  $nuevostock = 0;

  $totalstock = 0;
  
  $time = time();
  
  $fecha_actual = date("Y-m-d H:i:s", $time);

  $estado_aprobado = "Finalizado";
//   $consulta = $conexion->query("SELECT stock FROM".$bodega."WHERE id =".$codigo);

$consultando_stock = $conexion ->query("SELECT * FROM $bodega WHERE id = $codigo");


       
       if($consultando_stock == 1){
            while($registro = mysqli_fetch_array($consultando_stock)){
             $stock = $registro["stock"];
             
             $nuevostock = 0;
             $nuevostock = $stock + $stock2;
             $estesi = floatval($nuevostock);
             
             $consultando_solicitud_de_mercancia = $conexion -> query("SELECT * FROM solicitud_productos WHERE item_code = $codigo");
             
             
             if($consultando_solicitud_de_mercancia){
                 while($registro_solicitud = mysqli_fetch_array($consultando_solicitud_de_mercancia)){
                     $estado = $registro_solicitud["estado"];
                     $fecha = $registro_solicitud["fecha_solicitud"];
                     $cantidad = $registro_solicitud["item_quantity"];
                    $update_solicitud_mercancia = $conexion -> query("UPDATE solicitud_productos SET estado ='$estado_aprobado', fecha_aprobacion = '$fecha_actual', asistente = '$usuario', item_quantity = '$stock2' WHERE item_code = $codigo");
                 }
                 
                 
             }else{
                 
             }
          
               $actualizar_query = "UPDATE ".$bodega." SET stock = ".$estesi." WHERE id = ".$codigo;
               
               $sql2="INSERT INTO ingresos (code,contratipo,cantidad,factura,Proveedor) VALUES ('$codigo', '$producto', '$stock2', '$factura','$proveedor') ";

               
               $sql_update_1 =$conexion ->query("UPDATE productos_ibague SET unidad ='$unidad', gramo = '$precio', contratipo = '$producto' WHERE id = $codigo");
               $sql_update_2 ="UPDATE producto_av SET unidad ='$unidad', gramo = '$precio', contratipo = '$producto' WHERE id = $codigo";
               $sql_update_3 ="UPDATE producto_d1 SET unidad ='$unidad', gramo = '$precio', contratipo = '$producto' WHERE id = $codigo";
               $sql_update_4 ="UPDATE producto SET unidad ='$unidad', gramo = '$precio', contratipo = '$producto' WHERE id = $codigo";

               
               if($sql_update_1){
                         $conexion->query($sql_update_2);
                         $conexion->query($sql_update_3);
                         $conexion->query($sql_update_4);
                        $ok_probandpo =  $conexion->query($actualizar_query);
                        $conexion->query($sql2);
                        echo '<script> alert("Estamos actualizando el stock"); window.location="nuevamercancia.php";</script>';

               }else{
                   print_r("no funciona la actualizacion de los datos de este producto en las bodegas");
               }
               
               
            }
       }else{
   print_r("no funciona");
       }




      ?>



      ?>
