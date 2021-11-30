<?php
$mysqli2 = new mysqli ('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

session_start();
$user =$_SESSION['user'];
$id = $_POST['id'];
$nuevoestado = "Transito";
$consulta ="UPDATE `traspasos` SET `estado`= '$nuevoestado' WHERE codigo = '$id'";
$did = $mysqli2->query($consulta);

$act = "UPDATE `traspasos` SET `empaca` = '$user' WHERE codigo = '$id'";
$did = $mysqli2->query($act);

echo $did;
header('Location: aprobar_mercancia.php'); ?>
