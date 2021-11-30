<?php
include 'conexion.php';
session_start();
$user_name = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/head.php' ?>
    <title>Gestionar Inventarios</title>
</head>

<body>
    <?php include 'includes/body.php'; ?>

</body>
<?php include 'includes/foot.php'; ?>

</html>