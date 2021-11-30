<?php

include '../conexion.php';


$fun = $_POST['key'];
switch ($fun) {
    case 'Q1':
        $precio = $_POST['precio'];
        $producto = $_POST['producto'];
        $proveedor = $_POST['proveedor'];

        $sqlExist = $con->query("SELECT * FROM proveedor_producto WHERE producto_id = $producto AND proveedor_id = $proveedor");
        if (mysqli_num_rows($sqlExist) > 0) {
            $sqlUpdate = "UPDATE proveedor_producto SET precio = '$precio' WHERE producto_id = $producto AND proveedor_id = $proveedor";
            $did = $con->query($sqlUpdate);
        } else {
            $sqlInsertar = "INSERT INTO proveedor_producto (proveedor_id, producto_id, precio) VALUES ($proveedor,$producto,$precio)";
            $did = $con->query($sqlInsertar);
        }
      if($did){
          echo $producto;
      }else{
          echo 0;
      }
        break;
}

