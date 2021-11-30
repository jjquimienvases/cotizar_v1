<?php

 include '../conexion.php';
$id = $_POST["id"];
$no_recibido = "no recibido";


$_UPDATE = $conexion ->query("UPDATE traspasos SET estado = '$no_recibido' WHERE id = $id");
   if(!$_UPDATE){
     echo "error al eliminar este registro";
     exit();
   }else{
     echo "Se elimino correctamente este registro";
   }

 ?>
