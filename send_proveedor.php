<?php
// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

include 'conectar.php';
$conexion = conectar();

$compania = $_POST['empresa'];
$asesor = $_POST['asesor'];
$telefono = $_POST['telefono'];

if(isset($compania)){
    $sqlInsertar = "INSERT INTO proveedor (compania, asesor, telefono) VALUES ('$compania','$asesor','$telefono')";
 $did = mysqli_query($conexion,$sqlInsertar);
 

echo $did;
echo '<script> alert("Se agrego correctamente el proveedor"); window.location="proveedores.php";</script>';
}else{
    echo '<script> alert("No funciona correctamente el string"); </script>';

}


  ?>

