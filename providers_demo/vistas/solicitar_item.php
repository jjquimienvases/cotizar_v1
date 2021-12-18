<?php 
 include '../conexion.php';
 session_start();
 $user = $_SESSION['user'];
 $id_rol = $_SESSION['id_rol'];
 $bodega_entrada = "";
 if($id_rol == 6){
    $bodega_entrada = "producto_av";
 }else if($id_rol == 7){
    $bodega_entrada = "productos_ibague";
 }else{
     $bodega_entrada = "producto_av";
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../includes/header.php'; ?>
    <title>Solicitar Mercancia</title>
</head>
<body>
    <?php include 'nav_bar_.php'; ?>
    <div class="container">
        <h3 class="text-center text-danger mt-2">Bienvenido <?= $user?>, Este apartado esta desarrollado para generar solicitudes de mercancia</h3>
        <hr>
      <?php include 'form_solicitud.php'; ?>
    </div>
</body>
</html>