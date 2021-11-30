<?php

 include '../conexion.php';

$quantity = $_POST["cantidad_recibida"];
$no_recibido = "no recibido";
$finalizado = "Finalizado";


$codigo=$id[1];
echo 
$codigo;


/* $bodega_entrada = "";
if ($rol_usuario = 1) {
  $bodega_entrada = "producto_av";
}else if($rol_usuario = 2){
  $bodega_entrada = "producto";
}else if($rol_usuario = 3){
  $bodega_entrada = "producto_d1";
}else if($rol_usuario = 4 OR $rol_usuario = 6){
  $bodega_entrada = "producto_av";
}else if($rol_usuario = 7){
  $bodega_entrada = "productos_ibague";
}

//bodega salida
if ($rol_usuario = 1) {
    $bodega_salida = "producto_av";
  }else if($rol_usuario = 2){
    $bodega_salida = "producto";
  }else if($rol_usuario = 3){
    $bodega_salida = "producto_d1";
  }else if($rol_usuario = 4 OR $rol_usuario = 6){
    $bodega_salida = "producto_av";
  }else if($rol_usuario = 7){
    $bodega_salida = "productos_ibague";
  }
 */


$consultando_mercancia = $conexion -> query("SELECT * FROM traspasos WHERE id = $id" ); 
while ($registro = mysqli_fetch_array($consultando_mercancia)){
    $cantidad = $registro['cantidad'];
      
    $actualizar_cantidad2=$conexion->query("UPDATE traspaso SET cantidad=".$cantidad." where id=".$registro['id']);
    $codigo = $registro['codigo'];
    $bodega_entrada = $registro['bodega_entrada'];
    $bodega_salida = $registro['bodega_salida'];
  
    //buscar el stock de ese producto en cada bodega
    //bodega salida 
    $stock_bodega_salida = $conexion -> query("SELECT * FROM $bodega_salida WHERE id = $codigo");
     while($info_salida = mysqli_fetch_array($stock_bodega_salida)){
         $stock_salida = $info_salida['stock'];
        }
    //bodega entrada
    $stock_bodega_entrada = $conexion -> query("SELECT * FROM $bodega_entrada WHERE id = $codigo");
    while($info_entrada = mysqli_fetch_array($stock_bodega_entrada)){
        $stock_entrada = $info_entrada['stock'];
       }    

    $nuevo_stock_salida = $stock_salida - $cantidad;   
    $nuevo_stock_entrada = $stock_entrada + $cantidad;   
  


   $consulta_actualizar_stock_salida = $conexion -> query("UPDATE $bodega_salida SET stock = $nuevo_stock_salida WHERE id = $codigo");
   $consulta_actualizar_stock_entrada = $conexion -> query("UPDATE $bodega_entrada SET stock = $nuevo_stock_entrada WHERE id = $codigo");
    
   //consulta para actualizar el estado del traspaso 

   $consulta_para_actualizar_estado = $conexion -> query("UPDATE traspasos SET estado = $finalizado WHERE id = $id");

}

$mensaje = "Este producto se aprobo correctamente";



 ?>
