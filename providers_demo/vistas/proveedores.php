<?php ?>
<!DOCTYPE html>
<html lang="es">
<?php include '../conexion.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../Lib/bootstrap/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Lib/bootstrap/js/bootstrap.js"></script>
    <script src="../js/scripts.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <?php include '../includes/header.php'; ?>
    <script src="../js/funciones.js"></script>
    <style>
.modal-lg {
    max-width: 1800px;
}

.marc {
    width: 120px;
}

.tooltitle {
    width: 300%;
}

.aprobar:hover, .printer:hover{
cursor: pointer;
}
    </style>
</head> 
<body>
<?php include '../scripts.php' ?>
<?php include './navbar.php' ?>
    <div class="m-4">
        <?php include './tabs.php' ?>
    </div>
  
</html>