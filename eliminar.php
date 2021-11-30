<?php
include 'conexion.php';
$conexion = conectar();

$id = $_POST["id"];

$consulta = $conexion->query("DELETE FROM modal_info WHERE id = $id");
   if(!$consulta){
     echo "error al eliminar este registro";
     exit();
   }else{
     echo "Se elimino correctamente";
   }
 ?>
