<?php
include 'conexion.php';
$conexion = conectar();
session_start();
include 'variables.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traspasos</title>
    <?php include 'includes/head.php'; ?>
    <script src="js/funciones_generales.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <hr class="text-secondary">
    
        <div class="transfer_list" id="transfer_list">
            <?php include 'vistas/transfer_list.php'; ?>
        </div>
        <div class="create_transfer" id="create_transfer">
            <?php include 'vistas/create_transfer.php'; ?>
        </div>
    </div>
</body>
<script src="js/funciones_vue.js"></script>

</html>