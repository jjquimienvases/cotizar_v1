<?php
 include 'conexion.php';
 session_start();
 
 $id_rol = $_SESSION['id_rol'];
  
  $href = "";
  if($id_rol == 2){
      $href = "../panel_mostrador.php";
  }else if($id_rol == 3){
      $href = "../panel_d1.php";
  }else if($id_rol == 5){
      $href = "../asistente.php";
  }else if($id_rol == 7){
      $href = "../panel_ibague.php";
  }else if($id_rol == 6){
      $href = "../panel_bodega.php";
  }else{
      $href = "../Panel_Comerciales.php";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/head.php'; ?>
    <title>Etiquetas</title>
    <style>
        #search_1 {
  display: flex;
  justify-content: center;
  align-items:center;
}
    </style>
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $href; ?>">JJ QUIMIENVASES SAS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $href; ?>">Home</a>
        </li>
       
      </ul>
      <span class="navbar-text">
        GENERADOR DE ETIQUETAS
      </span>
    </div>
  </div>
</nav>
     <?php include 'includes/body.php'; ?>
</body>
<script src="funciones.js"></script>
</html>