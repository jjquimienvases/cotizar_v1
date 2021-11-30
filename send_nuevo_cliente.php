<?php

// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

include 'conectar.php';
$conexion = conectar();

session_start();
$usuario = $_SESSION['userid'];


  $dato1=$_POST['nombre'];
  $dato2=$_POST['cc'];
  $dato3=$_POST['email'];
  $dato4=$_POST['telefono'];
  $dato5=$_POST['direccion'];
  $dato6=$_POST['ciudad'];
  $dato7 = $_POST['puntos'];

        $sql = "SELECT count(cedula) as total FROM clientes WHERE cedula = '$dato2'";
        $dad = mysqli_query($conexion,$sql);

      $data=mysqli_fetch_assoc($dad);
      $cuenta = $data['total'];

    $sqlInsert = "INSERT INTO clientes (nombres, cedula, direccion, ciudad, telefono, email,puntos_perfumeria)
   VALUES ('$dato1', '$dato2', '$dato5', '$dato6', '$dato4', '$dato3','$dato7')";
   
   $editar = "UPDATE clientes SET puntos_perfumeria = $dato7 WHERE cedula = $dato2";
       if ($cuenta > 0) {
         $did = mysqli_query($conexion,$editar);
       }else{
         if(!empty($dato2) && !empty($dato1)){
          $did = mysqli_query($conexion,$sqlInsert);
        }
       }



  echo $did; 


 ?>
