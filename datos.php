<?php
include 'conectar.php';
$conexion = conectar();
session_start();
$usuario = $_SESSION['userid'];
$select = mysqli_query($conexion,"select * from modal_info WHERE user = '$usuario'");
while($dat=mysqli_fetch_assoc($select)){
  $arr[]=$dat;
}
 json_encode($arr);
 ?>
