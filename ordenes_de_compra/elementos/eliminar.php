<?php

 include '../conexion.php';
$id = $_POST["id"];

$consulta = $conexion->query("DELETE FROM solicitud_productos WHERE id = $id");
   if(!$consulta){
     echo "error al eliminar este registro";
     exit();
   }else{
     echo "Se elimino correctamente este registro";
   }

 ?>
