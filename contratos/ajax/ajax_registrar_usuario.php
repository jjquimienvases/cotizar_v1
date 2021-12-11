<?php 

 include '../conexion.php';
  
 //variables

$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$ciudad = $_POST['ciudad'];
$fecha_inicio = $_POST['date_inicio'];
$fecha_final = $_POST['date_final'];
$telefono = $_POST['telefono'];
$direction = $_POST['direccion'];
$cargo = $_POST['cargo'];
$email = $_POST['email'];
$estado = "activo";
$eps = $_POST['eps'];
$afp = $_POST['afp'];
$inicio_prestacion = $_POST['prestacion_inicio'];
$final_prestacion = $_POST['prestacion_final'];

 $sql = $con->query("INSERT INTO `users_information`(`cedula`, `nombres`, `telefono`, `direccion`, `cargo`, `ciudad`, `email`, `fecha_inicio`, `fecha_final`, `estado`,`afp`,`eps`,`prestacion_inicio`,`prestacion_final`)
 VALUES ($cedula,'$nombres',$telefono,'$direction','$cargo','$ciudad','$email','$fecha_inicio','$fecha_final','$estado','$afp','$eps','$inicio_prestacion','$final_prestacion')");

  if($sql){
      echo $sql;
  }else{
      echo 0;
  }

 