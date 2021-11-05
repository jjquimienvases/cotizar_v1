<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos Y Novedades</title>
    <?php include 'includes/head.php'; ?>
    <style>
    

    a{
        color: #ffffff;
        text-decoration: none;
    }
#hidden_button{
    display:none;
}
    </style>
</head>
<body>
    <button type="button" id="hidden_button" onclick="get_ventas()"></button>
<?php include 'includes/info.php'; ?>
</body>
<script src="js/funciones.js"></script>
</html>