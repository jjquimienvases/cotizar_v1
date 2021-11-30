<?php
   include 'conexionn.php';
   session_start();

   $user_id = $_SESSION['userId'];
   $user_name = $_SESSION['user'];
   $rol_user= $_SESSION['id_rol'];
   $status = "transito";
   echo "<pre>";
    print_r($rol_user);
   echo "</pre>";
   $tmp = array();
   $res = array();

   $consulta_mercancia_pendiente = $conexion -> query("SELECT * FROM traspasos WHERE estado = '$status' AND id_rol_bodega_entrada = $rol_user");

   while ($row = $consulta_mercancia_pendiente->fetch_assoc()) {
       $tmp = $row;
       array_push($res, $tmp);
   }

 ?>
